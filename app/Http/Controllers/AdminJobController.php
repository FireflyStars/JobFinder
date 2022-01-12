<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\Category\CategoryService;
use App\Services\Company\CompanyService;
use App\Services\Job\JobService;

class AdminJobController extends Controller
{
    protected $categoryService;
    protected $companyService;
    protected $jobService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CategoryService $categoryService, CompanyService $companyService, JobService $jobService)
    {
        $this->categoryService = $categoryService;
        $this->companyService = $companyService;
        $this->jobService = $jobService;
    }

    public function index()
    {
        return view('admin.job.index', []);
    }

    public function loadJobs(Request $request) {
        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Job::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Job::select('count(*) as allcount')->where('title', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Job::orderBy($columnName,$columnSortOrder)
        ->where('jobs.title', 'like', '%' .$searchValue . '%')
        ->select('jobs.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();
        
        foreach($records as $record){
            $category = $this->categoryService->find($record->category_id);
            $category = (isset($category->name)) ? $category->name : "N/A";

            $company = $this->companyService->find($record->company_id);
            $company = (isset($company->name)) ? $company->name : "N/A";

            $editLink = "<a href='". url('admin/job/'. $record->id . '/edit') ."' class='btn btn-xs btn-primary mb-2'><i class='ace-icon fa fa-pencil bigger-130'></i> Edit</a>";
            $deleteLink = "<button class='btn btn-danger btn-xs deleteJobButton' data-jobid='". $record->id ."'><i class='ace-icon fa fa-trash-o bigger-130'></i> Delete  </button>";        
            if($record->is_premium == false) {
                $premiumLink = "<button class='btn btn-info btn-xs makeJobPremium' data-jobid='". $record->id ."'><i class='ace-icon fa fa-star bigger-130'></i> Premium  </button>";        
            } else {
                $premiumLink = "<button class='btn btn-info btn-xs removeJobPremium' data-jobid='". $record->id ."'><i class='ace-icon fa fa-star-0 bigger-130'></i> Remove Premium  </button>";        
            }

            $data_arr[] = array(
                "id" => $record->id,
                "title" => $record->title,
                "jobType" => \Config::get('constants.jobTypes')[$record->job_type],
                "location" => ($record->location == 'office' || $record->location == 'remote_region') ? $record->location_detail : "Remote",
                "apply" => "<a href='". url($record->apply_link) . "' target='_blank'>view</a>",
                "premium" => ($record->is_premium == true) ? "Yes" : "No",
                "category" => ucfirst($category),
                "company" => ucfirst($company),
                "action" => $editLink.' '.$deleteLink.' '.$premiumLink
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }


    public function create()
    {
        $data['categories'] = $this->categoryService->findAll();
        return view('admin.job.create', $data);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jobTitle'=> 'required|max:255',
            'jobCategory'=>'required',
            'jobType'=>'required',
            'jobLocation'=>'required',
            'jobOfficeLocation'=>$request->jobLocation === 'office' ? 'required' : 'nullable',
            'jobRegionalRestriction'=>$request->jobLocation === 'remote_region' ? 'required' : 'nullable',
            'jobApplyLink'=> 'url',
            'companyName'=>'required',
            'companyEmail'=>'required|email:rfc,dns',
            'companyLogo' => ($request->hasFile('companyLogo')) ? 'image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'companyWebsite' => 'nullable|url'
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        if($request->jobLocation === 'office') 
            $request['jobLocationDetail'] = $request->jobOfficeLocation;
        else if($request->jobLocation === 'remote_region')
            $request['jobLocationDetail'] = $request->jobRegionalRestriction;
        else
            $request['jobLocationDetail'] = null;

        
        if ($request->hasFile('companyLogo')) {
			$name = "";
            $image = $request->file('companyLogo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/'.env('COMPANY_IMAGE_PATH'));
            $image->move($destinationPath, $name);
			$request['companyLogoPath'] = $name;
        }
        
        $company = $this->companyService->findByEmail($request['companyEmail']);
        
        if(!$company) {
            $company = $this->companyService->create($request);
        } else {
            $company = $this->companyService->update($company['id'], $request);
        }
        
        $request['companyId'] = $company['id'];
        $request['isPremium'] = (isset($request['isPremium']) && $request['isPremium']) ? true : false;
        $request['creationStep'] = 2;

        $this->jobService->create($request->all());

        session()->flash('message', 'Job has been created successfully.');
        return redirect('admin/job');
    }


    public function edit($id)
    {
        $data = [];
        $jobDetails = $this->jobService->find($id);
        if(!empty($jobDetails)) {
            $data['categories'] = $this->categoryService->findAll();
            $data['job'] = $jobDetails;
            return view('admin.job.edit', $data);
        }  else {
            session()->flash('message', 'Invalid job.');
            return redirect('admin/job');
        }
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jobTitle'=> 'required|max:255',
            'jobCategory'=>'required',
            'jobType'=>'required',
            'jobLocation'=>'required',
            'jobOfficeLocation'=>$request->jobLocation === 'office' ? 'required' : 'nullable',
            'jobRegionalRestriction'=>$request->jobLocation === 'remote_region' ? 'required' : 'nullable',
            'jobApplyLink'=> 'url',
            'companyName'=>'required',
            'companyEmail'=>'required|email:rfc,dns',
            'companyLogo' => ($request->hasFile('companyLogo')) ? 'image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'companyWebsite' => 'nullable|url'
        ]);

        // if validator fails
        if ($validator->fails()) {
            return redirect()->back()->WithErrors($validator)->withInput();
        }

        if($request->jobLocation === 'office') 
            $request['jobLocationDetail'] = $request->jobOfficeLocation;
        else if($request->jobLocation === 'remote_region')
            $request['jobLocationDetail'] = $request->jobRegionalRestriction;
        else
            $request['jobLocationDetail'] = null;

        
        if ($request->hasFile('companyLogo')) {
			$name = "";
            $image = $request->file('companyLogo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/'.env('COMPANY_IMAGE_PATH'));
            $image->move($destinationPath, $name);
			$request['companyLogoPath'] = $name;
        }
        
        $company = $this->companyService->findByEmail($request['companyEmail']);
        
        if(!$company) {
            $company = $this->companyService->create($request);
        } else {
            $company = $this->companyService->update($company['id'], $request);
        }
        
        $request['companyId'] = $company['id'];
        $request['isPremium'] = (isset($request['isPremium']) && $request['isPremium']) ? true : false;
        $request['creationStep'] = 2;

        $this->jobService->update($id, $request->all());

        session()->flash('message', 'Job has been updated successfully.');
        return redirect('admin/job/'.$id.'/edit');
    }


    public function destroy($id)
    {
        $job = $this->jobService->find($id);
        if (!empty($job)) {
            $job->delete();
            return json_encode(array('status' => 1, 'message' => 'Job has been deleted successfully.'));
        } else {
            return json_encode(array('status' => 0, 'message' =>'Somethings wents wrong'));
        }
        return redirect('admin/job');
    }

    public function makePremium(Request $request)
    {
        $id = $request['id'];
        $job = $this->jobService->find($id);
        if (!empty($job)) {
            $jobDetail = [];
            $jobDetail['isPremium'] = 1;
            $this->jobService->update($id, $jobDetail);
            return json_encode(array('status' => 1, 'message' => 'Job has been marked as premium.'));
        } else {
            return json_encode(array('status' => 0, 'message' =>'Somethings wents wrong'));
        }
        return redirect('admin/job');
    }

    public function removePremium(Request $request)
    {
        $id = $request['id'];
        $job = $this->jobService->find($id);
        if (!empty($job)) {
            $jobDetail = [];
            $jobDetail['isPremium'] = 0;
            $this->jobService->update($id, $jobDetail);
            return json_encode(array('status' => 1, 'message' => 'Job has been removed as premium.'));
        } else {
            return json_encode(array('status' => 0, 'message' =>'Somethings wents wrong'));
        }
        return redirect('admin/job');
    }
}
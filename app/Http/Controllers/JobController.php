<?php

namespace App\Http\Controllers;

use App\Helpers\CustomHelper;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\Job\JobService;
use App\Services\Company\CompanyService;
use App\Services\Category\CategoryService;

class JobController extends Controller {
    
    protected $jobService;
    protected $companyService;
    protected $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JobService $jobService, CompanyService $companyService, CategoryService $categoryService)
    {
        $this->jobService = $jobService;
        $this->companyService = $companyService;
        $this->categoryService = $categoryService;
    }

    /**
     * Search jobs
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchJobs(Request $request) {
        $data = [];
        $data['jobs'] = $this->jobService->findAllWithPagination($request->q, $request->category, $request->type);
        $data['categories'] = $this->categoryService->findAll();
        $data['request'] = $request;
        return view('jobs.listing', $data);
    }

    /**
     * Show the job post form.
     *
     * @return 
     */
    public function create($id = null)
    {
        $jobId = ($id) ? explode('::', base64_decode($id)) : [];

        $data = [];
        $data['jobId'] = 0;
        $data['categories'] = $this->categoryService->findAll();
        if(isset($jobId[0])) {
            $jobDetails = $this->jobService->find($jobId[0]);
            if(!empty($jobDetails)) {
                $data['jobData'] = $jobDetails;
                $data['jobId'] = $jobId[0];
            }  
        }
        return view('jobs.create', $data);
    }

    /**
     * Show the job post form.
     *
     * @return 
     */
    public function detail($id)
    { 
        $jobDetails = $this->jobService->find($id);
        if(!empty($jobDetails)) {
            $data = [];
            $data['categories'] = $this->categoryService->findAll();
            $data['jobData'] = $jobDetails;
            $data['code'] = $id;
            return view('jobs.detail', $data);
        }  
        abort(404);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
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
        $request['isPremium'] = (isset($request['jobPostType']) && $request['jobPostType'] == 'premium') ? true : false;
        $request['creationStep'] = 1;


        $response = $this->jobService->create($request);

        return redirect('preview-job/'.\CustomHelper::createJobUrl($response['id'], $company['id']));
    }

      /**
     * Preview the job post form.
     *
     * @return 
     */
    public function preview($id)
    {
        $jobId = explode('::', base64_decode($id));
        
        if(isset($jobId[0])) {
            $jobDetails = $this->jobService->find($jobId[0]);
            if(!empty($jobDetails)) {
                $data = [];
                $data['categories'] = $this->categoryService->findAll();
                $data['jobData'] = $jobDetails;
                $data['code'] = $id;
                return view('jobs.preview', $data);  
            }  
        }
        abort(404);
    }

    /**
     * Show the payment form
     *
     * @return 
     */
    public function payment($id)
    {
        $jobId = explode('::', base64_decode($id));

        if(isset($jobId[0])) {
            $jobDetails = $this->jobService->find($jobId[0]);
            if(!empty($jobDetails)) {
                if($jobDetails->creation_step == 2) { // if payment is already done than no need to show this payment form
                    return redirect('post-a-job');
                }
							

                $data = [];
                $data['jobData'] = $jobDetails;
                $data['code'] = $id;
                
                // Enter Your Stripe Secret
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                        
                $amount = ($jobDetails->is_premium == true) ? CustomHelper::getTotalJobPostCostForPremiumJobs() : CustomHelper::getSimpleJobPostCost();
                $amount *= 100;
                $amount = (int) $amount;
                
                $payment_intent = \Stripe\PaymentIntent::create([
                    'description' => 'Payment for Job # '.$jobDetails->id,
                    'amount' => $amount,
                    'currency' => env('JOBPOST_CURRENCY_NAME'),
                    'payment_method_types' => ['card'],
                ]);
                
                // add payment log with status=0 as pending
                $jobPaymentDetail = [];
                $jobPaymentDetail['currency'] = $payment_intent->currency;
                $jobPaymentDetail['price'] = $payment_intent->amount;
                $jobPaymentDetail['payment_id'] = $payment_intent->id;
                $jobPaymentDetail['status'] = 0;
                $jobPaymentDetail['job_id'] = $jobDetails->id;
                $this->jobService->createPaymentLog($jobPaymentDetail);

				$data['categories'] = $this->categoryService->findAll();
                $data['stripe_key'] = env('STRIPE_KEY');
                $data['intent'] = $payment_intent->client_secret;
                return view('jobs.payment', $data);  
            }  
        }
        abort(404);
    }

    /**
     * Show the payment form
     *
     * @return 
     */
    public function paymentDone(Request $request)
    {
        if(isset($request->job_id)) {
			$jobDetails = $this->jobService->find($request->job_id);
            if(!empty($jobDetails)) {
				// update payment log and mark status=1 as paid
				$this->jobService->updatePaymentLogStatusByJobId($request->job_id, 1);

				// update job status as completed
				$this->jobService->updateJobCreationStepById($request->job_id, 2);
				
				// send email
                try { 
                    $data = $request;
                    $data['subject'] = 'Job Posting';
                    $data['jobUrl']  = url('/post-a-job/'. \CustomHelper::createJobUrl($request->job_id, $jobDetails->company->id));
                    \CustomHelper::sendEmail([
                        'subject' => $data['subject'],
                        'to' => 'hassanmehmood6195@gmail.com',
                        'htmlBody' => view('email.create-job', $data)->render(),
                    ]);
                } catch(Exception $ex) {    
                }

                return redirect('post-a-job')->with('payment_done', 'Payment has been successfully completed.');
			}
        }

        return redirect('post-a-job')->with('error', 'Payment failed, please contact support.');
    }

    public function loadJobDetail($id)
    {
        $job = $this->jobService->find($id);
        if (!empty($job)) {
            return json_encode(array('status' => 1, 'html' => view('jobs.listing.rightsidedetail', ['jobData' => $job])->render()));
        } else {
            return json_encode(array('status' => 0, 'message' =>'Somethings wents wrong'));
        }
        return redirect('admin/job');
    }
}

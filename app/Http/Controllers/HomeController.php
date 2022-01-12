<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Job\JobService;
use App\Services\Category\CategoryService;

class HomeController extends Controller
{
    protected $jobService;
    protected $categoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JobService $jobService, CategoryService $categoryService)
    {
        $this->jobService = $jobService;
        $this->categoryService = $categoryService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $data['jobs'] = $this->jobService->findPremiumWithPagination();
        $data['newJobsToday'] = $this->jobService->findCountNewJobsToday();
        $data['categories'] = $this->categoryService->findAll();
        return view('app.index', $data);
    }
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        $data = [];
        $data['categories'] = $this->categoryService->findAll();
        return view('app.contact', $data);
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveContact(Request $request)
    {
        $request->validate([
            'phoneNumber'=> 'required',
            'reasonForContact'=> 'required',
            'companyEmail'=>'nullable|email:rfc,dns',
            'companyUrl' => 'nullable|url'
        ]);

        try {
            $data = $request;
            $data['subject'] = 'Contact Us';
            $data['logo'] = asset('assets/img/logo/logo.jpg');
            \CustomHelper::sendEmail([
                'subject' => 'Contact Us',
                'to' => 'ajjmair@gmail.com',
                'htmlBody' => view('email.contact-us', $data)->render(),
            ]);
            return redirect('/contact-us')->with('message', 'Contact form successfully submitted.');
        } catch(Exception $ex) {
            return redirect('/contact-us')->with('error', 'Failed to submit contact, please contact support');
        }
    }
}

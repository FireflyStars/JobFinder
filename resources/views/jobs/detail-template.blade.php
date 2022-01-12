<div class="row justify-content-md-center  ">
<div class="col col-lg-8 mainhgg">


    <div class="col col-lg-12">
   <div class="job-tittle">
                <h6>{{ $jobData->company->name }}</h4>
                <a href="{{ url('job-detail/'. $jobData->id) }}"><h4>{{ $jobData->title }}</h4></a>
                <span>{{ $jobData['created_at']->format('M d') }}</span>
                <span>{{ $jobData->category->name }}</span>
                <span>{{ \Config::get('constants.jobTypes')[$jobData->job_type] }}</span>
                @if(isset($jobData->salary))
                    <span>{{ \Config::get('constants.jobSalaryCurrency')[$jobData->salary->currency_type] . $jobData->salary->range_from .' - '. \Config::get('constants.jobSalaryCurrency')[$jobData->salary->currency_type] . $jobData->salary->range_to .' '.  \Config::get('constants.jobSalaryType')[$jobData->salary->rate] }}</span>
                @endif
            </div>

            <div class="apply-btn2">
                <a href="{{ url('job-detail/'. $jobData->id) }}" target="_blank" class="btn">Apply</a>
            </div>
        </div>
		 <div class="job-post-details col col-lg-12">

        <div class="post-details2  mb-50">
            {!! $jobData->description !!}
        </div>
    </div>

	 <div class="col col-lg-12 dtlbtm">

        <div class="hdn">
            <h5>Interested? Apply for this role.</h5>

            <div class="apply-btn2">
                <a href="{{ url('job-detail/'. $jobData->id) }}" target="_blank" class="btn">Apply</a>
            </div>
        </div>
    </div>
    </div>

<div class="col-xl-4 col-lg-4">
                <div class="post-details3  mb-50">
                    <div class="company-img company-img-details">
                        @if(isset($jobData->company) && $jobData->company->logo)
                            <a href="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}">
                                <img src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}" alt="">
                            </a>
                        @endif
                    </div>
                    <!-- Small Section Tittle -->
                    <div class="small-section-tittle">
                        <h4>{{ $jobData->company->name }}</h4>
                    </div>
                    <div class="compnde"> <span><i class="fas fa-globe"> <a href="{{ $jobData->company->website }}" />Visit website</a></i></span></div>
                    <div class="compnde"> <span><i class="fas fa-map-marker-alt"></i></span><span>{{ $jobData->company->location }}</span></div>
                    <div class="statm">
                        {!! $jobData->company->description !!}
                    </div>
                    <div class="post-details4">
                        <div class="aplly">
                            <div class="apply-btn2">
                                <a href="{{ url($jobData->apply_link) }}" class="btn">Apply Now</a>
                            </div>
                        </div>
                    </div>
                   </div>
				        </div>

<!-- job post company End -->

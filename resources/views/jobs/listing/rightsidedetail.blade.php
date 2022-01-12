<!-- Left Content -->
<div class="justify-content-md-center mainhg ">

    <div class="col-xs-12 col-lg-2">
        @if(isset($jobData->company) && $jobData->company->logo)
            <div class="company-img">
                <a href="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}"><img src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}" alt=""></a>
            </div>
        @endif
    </div>

    <div class="col-xs-12 col-lg-10">
        <div class="job-tittle">
            <h4>{{ $jobData->company->name }}</h4>
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

    <div class="col-xs-12 col-lg-12 dtlbtm">

        <div class="hdn">
            <h5>Interested? Apply for this role.</h5>

            <div class="apply-btn2">
                <a href="{{ url('job-detail/'. $jobData->id) }}" target="_blank" class="btn">Apply</a>
            </div>
        </div>
    </div>
</div>

<!-- single-job-content -->
<div class="single-job-items mb-30">
    <div class="job-items">
        <div class="company-img">
            @if(isset($jobData->company) && $jobData->company->logo) 
                <a href="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}"> 
                    <img src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}" alt="">
                </a> 
            @endif
        </div>
        <div class="job-tittle job-tittle2">
            <a href="{{ url('job-detail/'. $jobData->id) }}">
                <h4>{{ $jobData->title }}</h4>
            </a>
            <ul>
                <li>{{ $jobData->company->name }}</li>
                <li><i class="fas fa-map-marker-alt"></i>{{ $jobData->company->location }}</li>
                @if(isset($jobData->salary))
                    <li>{{ \Config::get('constants.jobSalaryCurrency')[$jobData->salary->currency_type] . $jobData->salary->range_from .' - '. \Config::get('constants.jobSalaryCurrency')[$jobData->salary->currency_type] . $jobData->salary->range_to .' '.  \Config::get('constants.jobSalaryType')[$jobData->salary->rate] }}</li>
                @endif
            </ul>
        </div>
    </div>
    <div class="items-link items-link2 f-right">
        <a href="{{ url('job-detail/'. $jobData->id) }}">{{ \Config::get('constants.jobTypes')[$jobData->job_type] }}</a>
        <span>{{ $jobData['created_at']->diffForHumans() }}</span>
    </div>
</div>
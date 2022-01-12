<!-- single-job-content -->
<div class="single-job-items mb-30 ajaxJobDetail {{($jobData->is_premium) ? 'premium' : ''}} {{($jobData->is_pinned) ? 'pinned' : ''}}" data-jobid="{{ $jobData->id }}">
    <div class="job-items">
        @if(isset($jobData->company) && $jobData->company->logo)
            <div class="company-img">
                <a href="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}"><img src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}" alt=""></a>
            </div>
        @endif
        <div class="job-tittle">
            <span class="company-name">{{ $jobData->company->name }}</span>
            <h4>{{ $jobData->title }}</h4>
            <ul>
                <li>{{ \Config::get('constants.jobTypes')[$jobData->job_type] }} - {{ ($jobData->location == 'remote_anywhere') ? "Remote" : $jobData->location_detail }}</li>
            </ul>
        </div>

            @if($jobData->is_premium)
                <small class="ad">Ad</small>
            @endif

            @if($jobData->is_pinned == 1)
                <small class="pinned">
                    <i class="fa fa-thumbtack"></i> Pinned
                </small>
            @endif
    </div>
</div>

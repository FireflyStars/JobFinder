@extends('layouts.app')

@section('content')


    <div class="topjbcolor ones">
        <div class="container">
            <div class="prgb">
                <div class="progress-barr">
                    <div class="step">

                        <div class="bullet">
                            <span>1</span>
                        </div>
                        <div class="check fas fa-check"></div>
                        <p>Job Details</p>
                    </div>
                    <div class="step active">
                        <div class="bullet">
                            <span>2</span>
                        </div>
                        <div class="check fas fa-check"></div>
                        <p>Review</p>
                    </div>
                    <div class="step">

                        <div class="bullet">
                            <span>3</span>
                        </div>
                        <div class="check fas fa-check"></div>
                        <p>Payment</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="job-post-company jbdet pt-20 ">
        <div class="container">
            <div class=" prviews formnew">
                <div class="row">
                    <div class="col-lg-6">
                        <h1>Preview your Job Listing</h1>
                        <h2>This is how your listing will look like, once posted</h2>
                    </div>
                    <div class="col-lg-6 float-right">
                        <a href="{{ url('post-a-job/'.$code) }}" class="mkch">Make Changes</a>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <div class="preview_box">
                        <div class="panel panel-default">
                            <div class="panel-header">
                                <h2>{{$jobData->title}}</h2>
                                <p>{{$jobData->category->name}}</p>
                            </div>
                            <div class="panel-body">
                                <p><strong class="text-dark">Job Description</strong></p>
                                {!! $jobData->description !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="preview_right">
                        <div class="media">

                            @if(isset($jobData->company) && $jobData->company->logo)
                                <a href="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}">
                                    <img class="mr-3" src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$jobData->company->logo) }}" alt="" style="width: 100px;">
                                </a>
                            @endif

                            <div class="media-body">
                                <h5 class="mt-0">{{ $jobData->company->name }}</h5>
                                <p>  <i class="fas fa-map-marker"></i> {{ $jobData->company->location }}</p>

                                <p class="text-main">
                                    <i class="fas fa-globe"></i>
                                    <a href="{{ $jobData->company->website }}" />Visit website</a>
                                </p>

                            </div>
                        </div>


                        <div class="company_dtl">
                            {!! $jobData->company->description !!}
                        </div>

                        <div class="job_extended_dtl">
                            <p>
                                Type of Position <br>
                                <strong>{{ ucwords( str_replace('_', ' ', $jobData->job_type) )}}</strong>
                            </p>
                            <p>
                                Annual Salary <br>
                                <strong>{{$jobData->salary->range_from}} - {{$jobData->salary->range_to}}</strong>
                            </p>
                        </div>


                    </div>
                </div>
            </div>


            <br>
            <br>


            <div class="container">
                <div class="prvbtns text-center">
                    <a href="{{ url('post-a-job/'.$code) }}" class="mkch default">Back to Job Detail</a>
                    <a href="{{ url('make-payment/'.$code) }}" class="mkch">Go to Payment</a>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- job post company End -->

@endsection

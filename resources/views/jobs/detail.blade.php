@extends('layouts.app')

@section('content')

<!-- job post company Start -->
<div class="job-post-company yhy">
    <div class="container">
        @include('jobs.detail-template', ['jobData' => $jobData])
    </div>
</div>
<!-- job post company End -->

@endsection

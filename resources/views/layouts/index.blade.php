@extends('layouts.app')

@section('content')

@include('categories.home-listing', ['categories' => $categories, 'newJobsToday' => $newJobsToday])

<!-- Client logo -->

 
<section>
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12" id="mainsss">
                <span class="mesage">
                    Categories
                </span>
                <div class="categories">
             @include('categories.single-listing', ['categories' => $categories])
                </div>
                
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12" id="mainsss">
                <span class="mesage">
                    Industry leading organizations are hiring content professionals right now
                </span>
                <div class="logos">
                    <div class="col-lg-2 col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                    <div class="col-lg-2 col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                    <div class="col-lg-2 col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                    <div class="col-lg-2 col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                    <div class="col-lg-2 col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                    <div class="col-lg-2  col-md-6 float-left">
                        <img src="{{ asset('assets/img/amazon.png') }}" />
                    </div>
                </div>
                <div></div>
            </div>
        </div>
    </div>
</section>
<!-- Client logo -->

<!-- Featured_job_start -->
@if(!empty($categories))
    @foreach($categories as $category)
        @if($category->jobs->count() > 0)
            @include('categories.job-category-listing', ['category' => $category])
        @endif
    @endforeach
@endif
<!-- Featured_job_end -->


@endsection
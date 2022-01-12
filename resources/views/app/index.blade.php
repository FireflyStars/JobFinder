@extends('layouts.app')

@section('content')
    <style type="text/css">
        .search {
            height: 60px;
            border-radius: 40px;
            padding: 0px 15px;
            border: 1px solid #CDD0E9;
        }
        .search-txt {
            border: none;
            background: none;
            outline: none;
            float: left;
            padding: 0;
            color: #333;
            font-size: 16px;
            line-height: 27px;
            width: 100%;
            margin-top: 16px;
        }
        .search-btn {
            position: relative;
            float: right;
            bottom: 30px;
            background: #F4A937 !important;
            color: #fff !important;
            padding: 25px 32px;
            border-radius: 40px;
            left: 17px;
            margin: -9px 6px 0 0;
        }
        .search-btn:hover{
            color: #000 !important;
        }
        .search-btn::before{
            background: #D4FAE2 !important;
            border-color: #D4FAE2 !important;

        }
        .mobile-foottp{
            display: none;
        }
        @media only screen and (max-width: 600px) {
            .mobile-foottp{
                background: url(../../assets/bttim_mobile.jpg);
                min-height: 300px;
                background-size: contain;
                background-repeat: no-repeat;
                display: block;
                /* background-attachment: fixed; */
                background-position: top;
                /* padding-top: 0px; */
                padding-top: 200px;
            }
            .foottp{
                background: #fff;
            }
            .riff{
                float: unset;
            }
        }
    </style>

    @include('categories.home-listing', ['categories' => $categories, 'newJobsToday' => $newJobsToday])
    <!-- Client logo -->
    <section class="ctgf">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <h3>
                        Categories
                        <a href="{{url('search-job')}}" style="float: right;font-size: 18px;color: #333 !important">View All</a>
                    </h3>
                    <div class="categories">
                        @include('categories.single-listing', ['categories' => $categories])
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section class="compn">
        <div class="container">
            <!-- Section Tittle -->
            <div class="">
                <div class="" id="mainsss">
                    <h3>
                        Companies
                        <a  href="{{url('search-job')}}" style="float: right;font-size: 18px;color: #333 !important">View All</a>
                    </h3>

                    <div class="row logos" >
                        <div class="col-sm-2 col-6">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                        <div class="col-sm-2 col-6">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                        <div class="col-sm-2 col-6">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                        <div class="col-sm-2 col-6">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                        <div class="col-sm-2 col-6">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                        <div class="col-sm-2 col-6 ">
                            <img class="img-fluid" src="{{ asset('assets/img/company.png') }}" />
                        </div>
                    </div>
                    <div></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Client logo -->
    <section class="featured-job-area feature-padding compn">
        <div class="container">
            <!-- Section Tittle -->
            <h3>
                We Will Help You
                <a href="{{url('search-job')}}" style="float: right;font-size: 18px;color: #333 !important">View All</a>
            </h3>
            <!-- Featured_job_start -->
        @if(!empty($categories))
            @foreach($categories as $category)
                @if($category->jobs->count() > 0)
                    @include('categories.job-category-listing', ['category' => $category])
                @endif
            @endforeach
        @endif
        <!-- Featured_job_end -->
            <div class="col-xl-12 vidl">
                <a href="{{url('/search-job')}}" type="button">View All Jobs <i class="ml-2 fa fa-arrow-right"></i></a>
            </div>
        </div>
    </section>
    <div class="col-xl-12 foottp">
        <div class="container">
            <div class="col-lg-6 ">

            </div>
            <div class="col-lg-6 riff">
                <div class="wrap-inner">
                    <h3>
                        Get Notified For<br>
                        Every New Job
                    </h3>
                    <p>Lorem ipsum dolor sit amet,Ut enim ad minim veniam, quis nostrud exercitation.</p>
                </div>
                <div class="search">
                    <input  class="search-txt" type="text" name="" placeholder="Your Email">
                    <a class="btn search-btn" href="#">
                        Subscribe
                    </a>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="mobile-foottp">
                </div>
            </div>
        </div>

    </div>

@endsection

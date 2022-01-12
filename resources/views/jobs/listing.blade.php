
@extends('layouts.app')

@section('content')


<!-- Job List Area Start -->
<div class="job-listing-area jbdet">
    <div class="container main-bg jbdet">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-8">
                <div class="wrap-inner fg">
				    <h1>All Jobs</h1>
				    <p>{{ $jobs->total() }} open roles.</p>
                </div>
            </div>
            <div class="col-lg-4 ">
            </div>
        </div>
	    <div class="row">
            <!-- Left content -->
            <div class="col-lg-12 pbtnss">
                <div class="popover__wrapper col-6 col-lg-2">
                    <a href="#">
                        <h2 class="popover__title">Categories</h2>
                    </a>
                    <div class="popover__content">
                        @if(!empty($categories))
                            <div>
                                <ul>
                                    <li><a href="{{ url('search-job?q=&category=') }}">All Categories</a></li>
                                    @foreach($categories as $category)
                                        <li><a href="{{ url('search-job?q=&category=') }}{{ $category->id }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="popover__wrapper col-5 col-lg-2">
                    <a href="#">
                        <h2 class="popover__title">Job Types</h2>
                    </a>
                    <div class="popover__content">
                        @if(!empty(\Config::get('constants.jobTypes')))
                            <div>
                                <ul>
                                    <li><a href="{{ url('search-job?q=&category=') }}">Any Type</a></li>
                                    @foreach(\Config::get('constants.jobTypes') as $key => $value)
                                        <li><a href="{{ url('search-job?q=&category=&type=') }}{{ $key }}">{{ $value }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="popover__wrapper col-6 col-lg-2">
                    <a href="{{ url('search-job?q=&category=') }}">
                        <h2 class="popover__title">Clear filters</h2>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-lg-5 col-md-6">
                <!-- Featured_job_start -->
                <section class="featured-job-area newar">
                    <div class="container">
                         @if(!empty($jobs))
                            @foreach($jobs->where('is_pinned', '1') as $job)
                                @include('jobs.listing.leftsidesingle', ['jobData' => $job])
                            @endforeach
                            @foreach($jobs->where('is_premium', '1') as $job)
                                @include('jobs.listing.leftsidesingle', ['jobData' => $job])
                            @endforeach

                            @foreach($jobs as $job)
                                    @if($job->is_pinned == '0' && $job->is_premium == '0')
                                        @include('jobs.listing.leftsidesingle', ['jobData' => $job])
                                    @endif
                            @endforeach
                        @endif
                    </div>
                </section>
                <!-- Featured_job_end -->
            </div>
            <div class="col-xs-7 col-lg-7 col-md-6">
				 <div class="job-post-company">
                    <div class="container">
                        <div class="row singleJobListingDetail">
                            @if(isset($jobs[0]) && $jobs[0]['id'])
                                @include('jobs.listing.rightsidedetail', ['jobData' => $jobs[0]])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
	 </div>
</div>
<!-- Job List Area End -->
<!--Pagination Start  -->
<div class="pagination-area pb-115 text-center">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="single-wrap d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        {{ $jobs->links() }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Pagination End  -->

<script type="text/javascript">
    $(document).on('ready', function() {
        $('section.featured-job-area').on('click', '.ajaxJobDetail', function(e) {
            var id = $(this).data('jobid');
            var token = $("meta[name='csrf-token']").attr("content");
            var url = "{{ URL('load-job-detail') }}";
            $.ajax(
            {
                url: url+"/"+id,
                type: "GET",
                success: function (data) {
                    var dataResult = JSON.parse(data);
                    console.log(dataResult);
                    if(dataResult.status == 1) {
                        $('.singleJobListingDetail').html(dataResult.html)
                    } else {
                        alert(dataResult.message)
                    }
                }
            });
        });
    });

</script>

<style>

a {
  text-decoration: none;
}
.newar h4{
    font-size: 14px;
    margin-bottom: 7px;
    color: #0b74ff;
    text-decoration: underline;
	font-weight:400;
    font-family: 'Urbanist', sans-serif;
}

.pbtnss{margin-bottom:20px;}
.popover__title {
    color: #fff;
    font-size: 1em;
    line-height: 1.4;
    position: relative;
    cursor: pointer;
    padding: 8px 15px;
    text-align: center;
    border-radius: 40px;
    background-color: #F4A937 !important;
    margin-bottom: 10px;
    margin-bottom: 10px;
}
.popover__wrapper:last-child .popover__title{background-color:transparent!important;color:#1C1D28 !Important;}
.popover__content a{
    color: #333;
}
.popover__content li{padding-bottom:10px;}
.popover__wrapper {
  position: relative;
  margin-top: 1.5rem;
  display: inline-block;
}
.popover__wrapper:last-child a h2{border:none !important;}
.popover__content {
  opacity: 0;
  visibility: hidden;
  position: absolute;
  top: 68px;
  transform: translate(0, 10px);
  background-color: #fff;
  padding: 1.5rem;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
  width: auto;
}

.popover__content:before {
  position: absolute;
  z-index: -1;
  content: "";
  right: calc(50% - 10px);
  top: -8px;
  border-style: solid;
  border-width: 0 10px 10px 10px;
  border-color: transparent transparent #bfbfbf transparent;
  transition-duration: 0.3s;
  transition-property: transform;
}

.popover__wrapper:hover .popover__content {
  z-index: 10;
  opacity: 1;
  visibility: visible;
  transform: translate(0, -20px);
  transition: all 0.5s cubic-bezier(0.75, -0.02, 0.2, 0.97);
}

.popover__message {
  text-align: center;
}

</style>
@endsection

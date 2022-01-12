<!-- Featured_job_start -->
<style type="text/css">
    @media only screen and (max-width: 1200px) {
        .owl-stage-outer {
            overflow: unset !important;
        }

        .owl-carousel {
            overflow: hidden !important;
        }

        @media only screen and (max-width: 600px) {
            .owl-stage-outer {
                overflow: unset !important;
            }

            .owl-carousel {
                overflow: hidden !important;
            }

            .owl-carousel .owl-nav .owl-prev {
                left: 5px !important;
            }
            .owl-carousel .owl-nav .owl-next{
                right: 8px;
            }

            /*.single-job-items .job-items{
                width: 100% !important;
            }*/
            /*.single-job-items{
                padding: 20px 7px !important;
                width: 250px !important;
            }
            .owl-stage .owl-item{
                width: 175px !important;
            }*/
            /*.owl-stage{
                padding-right: unset !important:
                padding-left:unset !important;
            }*/
        }
    }
</style>
<section class="featured-job-area feature-padding">
    <div class="container">
        <!-- Section Tittle -->


        <div class="row justify-content-center">

                <div class="col-xl-12 section-tittle text-left topscr">
                    <h2>{{ $category->name }}
                    </h2>
                    <span>{{ $category->jobs->count() }} <a href="{{ url('search-job?q=&category='.$category->id) }}">{{ $category->name }} jobs</a></span>
                </div>

            <div class="col-xl-12">
                <div class="owl-carousel">
                @if(!empty($category->jobs))
                    @foreach($category->jobs->take(5) as $job)
                        <!-- single-job-content -->

                            <div class="single-job-items mb-30">
                                <div class="job-items @if($job->is_premium == 1) featured @endif @if($job->is_pinned == 1) pinned @endif">

                                    @if($job->is_premium == 1)

                                        <small class="ad">Ad</small>
                                    @endif

                                    @if($job->is_pinned == 1)

                                        <small class="pinned">
                                            <i class="fa fa-thumbtack"></i> Pinned
                                        </small>
                                    @endif


                                    <div class="company-img">
                                        @if(isset($job->company) && $job->company->logo)
                                            <a href="{{ url('job-detail/'. $job->id) }}">
                                                <img src="{{ asset('/'.env('COMPANY_IMAGE_PATH').'/'.$job->company->logo) }}" alt="">
                                            </a>
                                        @endif
                                    </div>
                                    <div class="job-tittle">

                                        <a href="{{ url('job-detail/'. $job->id) }}">
                                            <h4>{{ $job->title }}</h4>
                                        </a>
                                        <ul>
                                            <li>{{ $job->category->name }}</li>
                                            <li><i class="fas fa-map-marker-alt"></i>{{ $job->company->location }}</li>
                                            @if(isset($job->salary))
                                                <li>{{ \Config::get('constants.jobSalaryCurrency')[$job->salary->currency_type] . $job->salary->range_from .' - '. \Config::get('constants.jobSalaryCurrency')[$job->salary->currency_type] . $job->salary->range_to .' '}}</li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="jobs-link">
                                        <a href="{{ url('job-detail/'. $job->id) }}"><button type="button">Apply</button></a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Featured_job_end -->

<script>
    $('.owl-carousel').owlCarousel({

        loop:false,
        margin:10,
        nav:true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:4,
            }
        }
    })


</script>

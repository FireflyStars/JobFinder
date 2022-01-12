<!-- Hero Area Start-->
<style type="text/css">
    .nav_top_btn{
        margin: 0 10px;
    }
    .bg-img-header{
        display: none;
    }
    @media only screen and (max-width: 600px) {
        .main-hero {
            background:#fff;
        }
        .bg-img-header{
            background: url(../../assets/hero_mobile.jpg);
            min-height: 300px;
            background-size: contain;
            background-repeat: no-repeat;
            display: block;
            /* background-attachment: fixed; */
            background-position: top;
            /* padding-top: 0px; */
            padding-top: 200px;
        }
        .jbs{
            display: none;
        }
        .main-bg{
            padding: 0;
        }

    }
</style>
<section class="main-hero">
    <div class="container main-bg">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-6">
                <div class="wrap-inner">
                    <span class="job-m">
                        <a href="#">{{ $newJobsToday }} new jobs</a> added today
                    </span>
                    <h1>
                        Land your dream content role
                    </h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi non <br> pulvinar quam, sed auctor augue.
                        Nam ac turpis vitae augue  <br> tincidunt luctus.</p>
                    <div class="search">
                        <input  class="search-txt" type="text" name="" placeholder="Enter Your Email Here">

                        <a class="btn search-btn" href="#">
                            Find a Job
                        </a>
                    </div>
{{--
                    <p><a href="{{ url('/search-job') }}">See all available jobs</a> and filter yourself (or see jobs with <a href="{{ url('/search-job') }}">Salary Transparency</a>)</p>
--}}
                </div>
            </div>
            <div id="" class="col-lg-6 bg-img-header">

            </div>
        </div>
       {{-- <div class="jbs">
                        <span>


                        </span>
        </div>--}}
    </div>
</section>
<!-- Hero Area End-->

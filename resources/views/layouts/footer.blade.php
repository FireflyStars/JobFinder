<style type="text/css">
.footer-tittle h4{
    font-family: 'Scheherazade New', serif;
    font-weight: 700;
    font-size: 18px;
    margin: 20px 0px !important;
    color: #fff;
    text-transform: capitalize !important;
}
.footer-tittle a{
    color: #C8C8CD !important;
    font-size: 14px !important;
}
@media only screen and (max-width: 600px) {
      .mobile-center{
        text-align: center;
      }
      .footer-bottom-area{
        text-align: center !important;
      }
      .footer-social{
        text-align: center !important;
        float: unset !important;
      }
}
</style>

<footer>
    <!-- Footer Start-->
    <div class="footer-area footer-bg footer-padding">
        <div class="container">
            <div class="row d-flex justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mobile-center">
                    <div class="single-footer-caption mb-50">
                        <div class="single-footer-caption mb-30">
                            <div class="footer-tittle">
                                <h3 style="border-bottom: 2px solid #474851;padding-bottom: 10px;display: inline-block;">Creatrhq.com</h3>
                                <div class="footer-pera">
                                    <p>Our team is now 100% remotely distributed, therefore, quarantining will not interrupt our operations at all. This allows us to operate normally regardless of the situation, as well as giving our employees the freedom and flexibility to make independent decisions during these uncertain times.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row footer-wejed justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 ">
                            <div class="footer-tittle-bottom" style="border-right: 2px solid #474851;">
                               <p class="mb-0"> 5000+  <span class="ml-2">Talented Hunter</span></p>

                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="footer-tittle-bottom" style="border-right: 2px solid #474851;">
                                <p class="mb-0">451  <span class="ml-2">Talented Hunter</span></p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <!-- Footer Bottom Tittle -->
                            <div class="footer-tittle-bottom">
                                <p class="mb-0">568  <span class="ml-2">Talented Hunter</span></p>
                            </div>
                        </div>
                    </div>
					{{-- @if(isset($categories) && !empty($categories))
						@include('categories.single-listing', ['categories' => $categories])
					@endif --}}

                </div>
                <div class="pl-5  col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="row">
                        <div class="col-4">
                        <div class="footer-tittle">
                           <h4>Home</h4>
                           <ul class="list-unstyled">
                                <li><a href="">Find a job</a></li>
                                <li><a href="">Post a job</a></li>
                                <li><a href="">Salary Transparency</a></li>
                           </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="footer-tittle">
                           <h4>Categories</h4>
                           <ul class="list-unstyled">
                                <li><a href="">Content Strategy</a></li>
                                <li><a href="">Content Design</a></li>
                                <li><a href="">Content Marketing</a></li>
                           </ul>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="footer-tittle">
                           <h4>About</h4>
                           <ul class="list-unstyled">
                                <li><a href="">Hiring</a></li>
                                <li><a href="">Contact Us</a></li>
                           </ul>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- <div class="col-xl-4 col-lg-4 col-md-5 col-sm-5">
                    <div class="single-footer-caption mb-50">
                        <div class="footer-tittle">
                            <h3>Hiring?
                            </h3>
                            <div class="footer-pera">
                                <p>We'll put your job ad in front of a growing community of content professionals..</p>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <!--  -->

        </div>
    </div>
    <!-- footer-bottom area -->
    <div class="footer-bottom-area footer-bg">
        <div class="container">
            <div class="footer-border">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-6 col-lg-6">
                        <div class="footer-copy-right">
                            <p>
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="footer-social f-right">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fas fa-globe"></i></a>
                            <a href="#"><i class="fab fa-behance"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End-->
</footer>

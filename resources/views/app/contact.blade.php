@extends('layouts.app')

@section('content')

<!-- Hero Area Start-->
<section class="main-hero">
<div class="contct">

<h1>Contact Us</h1>
<p>Curious about our process or pricing? Need help getting buy-in? Contact us right away — we’d love to help.

</p>


</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <!-- Logo -->
                <div class="contactform">
                    <form action="{{ url('/contact-us') }}" role="form" method="post">
                        {{ csrf_field() }}

                        @include('errors.form-error')
                        @include('layouts.success-msg')

                        <div class="form-group">
                            <input type="text" class="form-control" name="fullName" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="companyEmail" placeholder="Enter Company Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phoneNumber" placeholder="Enter Phone Number* (xxx) xxx-xxxx" required="required">  
                        </div>
                        <div class="form-group">
                            <input type="url" class="form-control" name="companyUrl" placeholder="Enter Company URL (e.g. www.domain.com)">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="reasonForContact" required="required" aria-required="true">
                                <option value="">Reason for Contact:</option>
                                @if(!empty(\Config::get('constants.reasonOfContact'))) 
                                    @foreach(\Config::get('constants.reasonOfContact') as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div> 
                        <div class="form-group">
                            <textarea name="message" rows="4" placeholder="Your Message"></textarea>  
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>                    
                </div>  
            </div> 
			<div class="col-lg-6 col-md-6">
			<div class="sidecnt">
			<h3>WE'RE HERE TO HELP
</h3>
<h2>Let's Talk</h2>
<p>

Your private information is protected. We will never spam or sell it to anyone, ever. - Vince, Founder & CEO



</p>
<span>Monday - Friday: 10 AM - 7 PM
</span>
<span>Saturday - Sunday: Closed
</span>
			</div>
			</div>
        </div>
    </div>
</section>
       
       

@endsection
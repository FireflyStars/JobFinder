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
                    <div class="step ">
                        <div class="bullet">
                            <span>2</span>
                        </div>
                        <div class="check fas fa-check"></div>
                        <p>Review</p>
                    </div>
                    <div class="step active">

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


    <!-- job post company Start -->
    <div class="job-post-company jbdet pt-20 pb-120">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="preview_box">
                        <div class="panel panel-default">
                            <div class="panel-header">
                                <h2 class="pt-3">Billing information (All payments are one off fees.)</h2>
                                <p>1 x 30-Day Job Ad Listing = <strong>{{ CustomHelper::printCurrency().CustomHelper::getSimpleJobPostCost() }}</strong></p>
                                @if($jobData->is_premium == true)
                                    <p>1 x Additional Promotion Upgrade	= <strong>{{ CustomHelper::printCurrency().CustomHelper::getPremiumJobPostCost() }}</strong></p>
                                    <p>You will be charged <strong>{{ CustomHelper::printCurrency().CustomHelper::getTotalJobPostCostForPremiumJobs() }}</strong></p>
                                @endif
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="payment_option">

                                            <h4>Card Type</h4>
                                            <br>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="py_option active">
                                                        <i class="fa fa-id-card"></i>
                                                        <span>Credit Card</span>
                                                        <i class="fa fa-check-circle ml-auto"></i>
                                                    </div>
                                                   {{-- <div class="py_option">
                                                        <i class="fa fa-id-card"></i>
                                                        <span>Credit Card</span>
                                                        <i class="fa fa-check-circle ml-auto"></i>
                                                    </div>--}}
                                                </div>
                                            </div>


                                        </div>

                                    </div>

                                    <div class="col-md-8">

                                        <div class="card border-0 payment-box">

                                            <h4>Card Detail</h4>

                                            <form action="{{ url('/payment-done') }}"  method="post" id="payment-form">
                                                @csrf
                                                <input type="hidden" name="job_id" value="{{ $jobData->id }}">
                                                <div class="card-body">
                                                    <div class="form-group mb-0">

                                                        <div id="card-element">
                                                            <!-- A Stripe Element will be inserted here. -->
                                                        </div>
                                                        <!-- Used to display form errors. -->
                                                        <div id="card-errors" role="alert"></div>
                                                        <input type="hidden" name="plan" value="" />
                                                    </div>
                                                </div>

                                                <div class="prvbtns text-left mt-0">
                                                    <a href="{{url('preview-job')}}/{{$code ?? ''}}" class="mkch default">Back to Preview</a>
                                                    <button
                                                        id="card-button"
                                                        class="pymntbtn mkch pull-left"
                                                        type="submit"
                                                        data-secret="{{ $intent }}"
                                                    > Pay  {{ CustomHelper::printCurrency().CustomHelper::getSimpleJobPostCost() }}
                                                    </button>

                                                </div>

                                            </form>
                                        </div>


                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <script>
            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)

            var style = {
                base: {
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            const stripe = Stripe('{{ $stripe_key }}', { locale: 'en' }); // Create a Stripe client.
            const elements = stripe.elements(); // Create an instance of Elements.
            const cardElement = elements.create('card', { hidePostalCode: true, style: style }); // Create an instance of the card Element.
            const cardButton = document.getElementById('card-button');
            const clientSecret = cardButton.dataset.secret;

            cardElement.mount('#card-element'); // Add an instance of the card Element into the `card-element` <div>.

            // Handle real-time validation errors from the card Element.
            cardElement.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.handleCardPayment(clientSecret, cardElement, {
                    payment_method_data: {
                        //billing_details: { name: cardHolderName.value }
                    }
                })
                    .then(function(result) {
                        console.log(result);
                        if (result.error) {
                            // Inform the user if there was an error.
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            console.log(result);
                            form.submit();
                        }
                    });
            });
        </script>
    </div>
@endsection

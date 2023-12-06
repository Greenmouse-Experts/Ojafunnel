@extends('layouts.dashboard-frontend')
<!-- place below the html form -->
<script>
    var currency = '{{$currency}}';
    var tamount = '{{$price}}';
    var current_currency;
    var multiplier = 1;

    // if(currency == "USD"){
    //     current_currency = 'USD';
    //     multiplier = Number.parseInt("{{ \App\Models\CurrencyRate::getBaseCur('USD')}}");
    //     tamount  = '{{$price}}' * multiplier;
    // } else if(currency == "GBP") {
    //     current_currency = 'GBP';
    //     multiplier = Number.parseInt("{{ \App\Models\CurrencyRate::getBaseCur('GBP')}}");
    //     tamount  = '{{$price}}' * multiplier;
    // } else if(currency == "₦") {
    //     current_currency = 'NGN';
    //     tamount = 1 * Number.parseInt('{{$price}}');
    // } else {
    //     current_currency = currency;
    //     tamount = 1 * Number.parseInt('{{$price}}');
    // }

    function paySubscriptionWithPaystack(){
        $('#stripePayment').hide();
        $.ajax({
            method: 'GET',
            url: '/retrieve/payment/' + 'Paystack', // Replace with your actual backend endpoint
            success: function(response) {
                if(tamount <= 0)
                {
                    alert('Please try again and if error persist, contact Administrator');
                } else {
                    var handler = PaystackPop.setup({
                        key: response.PAYSTACK_PUBLIC_KEY,
                        email: '{{Auth::user()->email}}',
                        amount: tamount * 100,
                        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                        callback: function(response){
                            let url = '{{ route("user.upgrade.account.confirm", [Crypt::encrypt($plan->id), ":response", Crypt::encrypt($price), Crypt::encrypt($currency)]) }}';
                            url = url.replace(':response', response.reference);
                            window.location.href=url;
                        },
                        onClose: function(){
                            alert('window closed');
                        }
                    });
                    handler.openIframe();
                }
            }
        });
    }

    function paySubscriptionWithFlutterwave()
    {
        $('#stripePayment').hide();

        $.ajax({
            method: 'GET',
            url: '/retrieve/payment/' + 'Flutterwave', // Replace with your actual backend endpoint
            success: function(response) {
                if(tamount <= 0)
                {
                    alert('Please try again and if error persist, contact Administrator');
                } else {
                    // Get the base URL of the current page
                    var baseUrl = window.location.origin;
                    // Configure FlutterwaveCheckout
                    FlutterwaveCheckout({
                        public_key: response.FLW_PUBLIC_KEY,
                        tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                        amount: tamount, // Amount in cents (e.g., $50.00 is 5000 cents)
                        currency: current_currency,
                        payment_options: "card",
                        customer: {
                            email: $('#email').val(), // Replace with your user's email
                        },
                        customizations: {
                            title: 'Top Up',
                            description: 'Top Up',
                            logo: baseUrl + '/dash/assets/images/Logo-fav.png', // Replace 'your-logo.png' with the actual path to your logo in the public folder
                        },
                        callback: function(response) {
                            console.log(response);
                            let url = '{{ route("user.upgrade.account.confirm", [Crypt::encrypt($plan->id), ":response", Crypt::encrypt($price), Crypt::encrypt($currency)]) }}';
                            url = url.replace(':response', response.reference);
                            window.location.href=url;
                        },
                        onclose: function() {
                            console.log('Payment closed');
                            // Handle actions when the payment modal is closed
                        }
                    });
                }
            },
                error: function(error) {
                console.error("Error fetching payment details:", error);
            }
        });
    }
</script>

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-12">
                            <h4 class="font-60">{{$plan->name}} Plan</h4>
                            <p>
                                Our service plans grow with your workforce!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="annoyed">
                        @if ($plan->description != "")
                            @foreach(explode(',', $plan->description) as $info)
                            <h1>
                                <i class="bi bi-check2">{{$info}}</i>
                            </h1>
                            @endforeach
                        @endif
                        @if($currency == 'USD' || $currency == 'GBP')
                        <div class="form" style="display: none;" id="stripePayment">
                            <h5 class="mt-3 mb-3 font-size-15">For Stripe Payment</h5>
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label for="Name">Name on card</label>
                                    <input type="text" name="cardName" id="card-name" placeholder="Enter card name" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <div id="card"></div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            @foreach(App\Models\PaymentGateway::latest()->where('status', 'Active')->get() as $payment)
                                <div class="col-12">
                                    @if($payment->name == 'Paystack' && $currency == 'NGN')
                                        <button type="button">
                                            PAY WITH PAYSTACK
                                        </button>
                                    @elseif(($payment->name == 'Flutterwave') && ($currency == 'NGN' || $currency == 'USD' || $currency == 'GBP'))
                                        <button type="button">
                                            PAY WITH FLUTTERWAVE
                                        </button>
                                    @elseif(($payment->name == 'Stripe') && ($currency == 'USD' || $currency == 'GBP'))
                                        <form action="{{ route('user.upgrade.account.with.stripe', [Crypt::encrypt($plan->id), Crypt::encrypt($price), Crypt::encrypt($currency)]) }}" method="post" id="checkoutForm">
                                            @csrf
                                            <button type="submit">
                                                PAY WITH STRIPE
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                            <div class="col-12">
                                <form action="{{ route('user.upgrade.account.with.balance', [Crypt::encrypt($plan->id), Crypt::encrypt($price), Crypt::encrypt($currency)]) }}" method="post" id="walletForm">
                                    @csrf
                                    <button type="button" class="payment-button" data-action="wallet">
                                        PAY WITH WALLET BALANCE
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8"></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.payment-button').forEach(function (button) {
            button.addEventListener('click', function () {
                var action = this.getAttribute('data-action');
                document.getElementById('walletForm').submit(); // Submit the wallet form
            });
        });
    });

    $.ajax({
        method: 'GET',
        url: '/retrieve/payment/' + 'Stripe', // Replace with your actual backend endpoint
        success: function(response) {
            $('#stripePayment').show();
            let stripe = Stripe(response.STRIPE_KEY);
            const elements = stripe.elements();
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px'
                    }
                }
            });

            const checkoutForm = document.getElementById('checkoutForm');
            const cardName = document.getElementById('card-name');
            cardElement.mount('#card');

            // Define the submit handler
            checkoutForm.addEventListener('submit', async (e) => {
                e.preventDefault();

                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: {
                        name: cardName.value
                    }
                });

                if (error) {
                    console.log('error');
                } else {
                    // Directly submit the form
                    let input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', 'payment_method');
                    input.setAttribute('value', paymentMethod.id);
                    checkoutForm.appendChild(input);

                    // Directly submit the form
                    checkoutForm.submit();
                }
            });
        },
        error: function(error) {
            console.error("Error fetching payment details:", error);
        }
    });

</script>
@endsection

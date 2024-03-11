<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{$shop->name}} | Oja Funnel | Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="title" name="{{$shop->name}} | Oja Funnel | Shop" />
    <meta content="description" name="{{$shop->description}} | Oja Funnel | Shop" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{$shop->logo}}" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel='stylesheet' href="{{ asset('assets/css/sweetalert2.min.css') }}">
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
        .hide {
            display: none !important;
        }
        #valid-msg,  #confirmvalid-msg{
            color: green !important;
            font-size: 12px !important;
        }
        #error-msg, #confirmerror-msg, #emailError, #confirmEmailError{
            color: red !important;
            font-size: 12px !important;
        }
    </style>
</head>

<body>
    <section class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="mobile-header-buttons">
                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>
                        <a class="navbar-brand" href="{{$shop->link}}">
                            {{$shop->name}}
                        </a>
                        <form class="inline-form" style="width: 100%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="#">
                                    <img src="{{$shop->logo ?? URL::asset('dash/assets/image/shop-logo.png')}}" alt="" class="img-fluid" width="40" />
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="page-content">
            <!-- container-fluid -->
            <div class="">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                            <h4 class="mb-sm-0 font-size-18">Checkout Details</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('user.shops.link', $shop->name)}}">Home</a></li>
                                    <li class="breadcrumb-item active">Checkout</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="checkout-tabs mb-4">
                        <div class="row">
                            <div class="col-xl-2 col-sm-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                                        <i class="bi bi-person-circle d-block check-nav-icon mt-4 mb-2"></i>

                                        <p class="fw-bold mb-4">Customer Info</p>
                                    </a>
                                    <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                        <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                        <p class="fw-bold mb-4">Payment Info</p>
                                    </a>
                                    <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                        <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                        <p class="fw-bold mb-4">Confirmation</p>
                                        <div class="Editt">

                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-sm-9">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="
                                            {{
                                                route('course.payment.checkout', [
                                                    'shopname' => $shop->name,
                                                    'promotion_id' => Request::get('promotion_id'),
                                                    'course_id' => Request::get('course_id')
                                                ])
                                            }}
                                        " id="checkoutForm" method="post">
                                            @csrf
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                                    <div>
                                                        <h4 class="card-title">Customer information</h4>
                                                        <p class="card-title-desc">Fill all information below</p>

                                                        <div class="form" id="myForm">
                                                            <span style="color: red" id="error"></span>
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Name *</label>
                                                                    <input type="text" name="name" id="name" placeholder="Enter your name" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Email *</label>
                                                                    <input type="email" name="email" id="email" class="customer_email" placeholder="Enter your email" required />
                                                                </div>

                                                                <input type="hidden" name="product_id" class="product_id" value="{{ Request::get('course_id') }}" />

                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Phone Number *</label>
                                                                    <input type="tel" name="phoneNo" id="phoneNo" placeholder="Enter your number" required />
                                                                    <span id="valid-msg" class="help-block hide">✓ Valid</span>
					                                                <span id="error-msg" class="help-block hide"></span>
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Address *</label>
                                                                    <input type="text" name="address" id="address" placeholder="Enter your address" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">State *</label>
                                                                    <input type="tel" name="state" id="state" placeholder="Enter your state" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Country *</label>
                                                                    <select class="form-control p-15 country" name="country" id="country">
                                                                        <option value="">-Select Country-</option>
                                                                        @if(sizeof($countries) > 0)
                                                                            @foreach($countries as $index => $country)
                                                                                @php
                                                                                    $country_code = $country['code'];
                                                                                    $country = $country['name'];
                                                                                @endphp
                                                                                <option value="{{ $country_code }}">{{ $country }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                    <!-- stripe/stripe-php -->
                                                                </div>
                                                                <div class="text-end mt-2">
                                                                    <a class="nav-link" class="text-decoration-none">
                                                                        <button type="button" id="activePayment" class="btn px-4 py-1" style="background-color: {{$shop->theme}}; color: #fff; border: 1px solid {{$shop->theme}}">
                                                                            Next
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                    <div>
                                                        <h4 class="card-title">Payment information</h4>
                                                        <p class="card-title-desc">Select payment below</p>
                                                        @foreach(App\Models\PaymentGateway::latest()->where('status', 'Active')->get() as $payment)
                                                            @if($payment->name == 'Paystack' && $shop->currency == 'NGN')
                                                            <div class="mt-3">
                                                                <div class="form-check form-check-inline font-size-16">
                                                                    <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                                </div>
                                                            </div>
                                                            @elseif(($payment->name == 'Flutterwave') && ($shop->currency == 'NGN' || $shop->currency == 'USD' || $shop->currency == 'GBP'))
                                                            <div class="mt-3">
                                                                <div class="form-check form-check-inline font-size-16">
                                                                    <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                                </div>
                                                            </div>
                                                            @elseif(($payment->name == 'Stripe') && ($shop->currency == 'USD' || $shop->currency == 'GBP' || $shop->currency == 'EUR'))
                                                            <div class="mt-3">
                                                                <div class="form-check form-check-inline font-size-16">
                                                                    <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                    <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        <div class="text-end mt-2">
                                                            <a type="button" class="text-decoration-none">
                                                                <button type="button" class="btn px-4 py-1" id="activeconfirm" style="background-color: {{$shop->theme}}; color: #fff; border: 1px solid {{$shop->theme}}">
                                                                    Next
                                                                </button>
                                                            </a>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                                    <div class="card shadow-none border mb-0">
                                                        <div class="card-body">
                                                            <h4 class="card-title mb-4">Order Summary</h4>
                                                            <div class="table-responsive">
                                                                <table class="table align-middle mb-0 table-nowrap">
                                                                    <thead class="tread">
                                                                        <tr>
                                                                            <th scope="col">Course</th>
                                                                            <th scope="col">Course Title</th>
                                                                            <th scope="col">Price</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php $total = 0 @endphp
                                                                        @if(session('cart'))
                                                                        @foreach(session('cart') as $id => $details)
                                                                        @php $total += $details['price'] @endphp
                                                                        <tr>
                                                                            <th scope="row"><img src="{{ $details['image'] ?? URL::asset('dash/assets/image/store-logo.png') }}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                            <td>
                                                                                <h5 class="font-size-14 text-truncate"><a href="javascrit(0);" class="text-dark">{{ isset($details['title']) ? $details['title'] : '' }} </a></h5>
                                                                            </td>
                                                                            <td>{{ $shop->currency_sign }}{{ number_format($details['price'], 2) }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <h6 class="m-0 text-end">Total:</h6>
                                                                            </td>
                                                                            <td>
                                                                                <input type="hidden" id="curr" value="{{$details['currency']}}" name="">

                                                                                {{ $shop->currency_sign }}{{ number_format($total, 2) }}

                                                                                <input type="hidden" id="totalAmount" value="{{ $total }}" name="">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <!-- Add a div to display error messages -->
                                                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
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
                                                                    <div class="row mt-4">
                                                                        <div class="col-sm-6">
                                                                            <button type="submit" id="payment-btn" class="btn d-none d-sm-inline-block" style="background-color: {{$shop->theme}}; color: #fff; border: 1px solid {{$shop->theme}}">
                                                                                PLACE ORDER
                                                                            </button>
                                                                        </div> <!-- end col -->
                                                                        <!-- end col -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-4" style="display: none;" id="paystackPayment">
                                                                <div class="col-sm-6">
                                                                    <button type="button" id="makePayment" class="btn d-none d-sm-inline-block" style="background-color: {{$shop->theme}}; color: #fff; border: 1px solid {{$shop->theme}}">
                                                                        PLACE ORDER
                                                                    </button>
                                                                </div> <!-- end col -->
                                                                <!-- end col -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
        <!-- End Page-content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="CartDelete" tabindex="-1" aria-labelledby="CartDeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body px-4 py-5 text-center">
                    <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="avatar-sm mb-4 mx-auto">
                        <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </div>
                    </div>
                    <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently remove this Product.</p>

                    <div class="hstack gap-2 justify-content-center mb-0">
                        <button type="button" class="btn btn-danger">Delete Now</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-2 mt-5">
                    <div class="text-center text-dark">Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{config('app.name')}} | All Right Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Button trigger modal -->

    <input type="hidden" value="{{ csrf_token() }}" id="txt_token1">
    <input type="hidden" value="{{ url('/') }}/" id="site_url">

    <!-- JAVASCRIPT -->
    <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script src="{{ asset('assets/js/jscripts.js') }}"></script>

    <script>
        $(document).ready(function () {
            // $('#paystackPayment').show();
            // Handle radio button change event
            $('input[name="paymentOptions"]').change(function () {
                // Check if the selected option is Stripe
                if ($(this).val() === 'Stripe') {
                    $('#stripePayment').show();
                    $('#paystackPayment').hide();
                } else if ($(this).val() === 'Flutterwave') {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                } else if ($(this).val() === 'Paypal') {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                } else {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                }
            });

            // Handle initial state
            if ($('input[name="paymentOptions"]:checked').val() === 'Stripe') {
                $('#stripePayment').show();
            }
        });
        var token = $('#txt_token1').val();
        var site_url = $('#site_url').val();

        $("#activePayment").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == '' || $('#address').val() == '' || $('#state').val() == '' || $('#country').val() == '') {
                $('#error').html('Please fill the asterisks field to continue');
            } else {

                if($('.customer_email').val() !== ""){
                    var datastring='customer_email='+$('.customer_email').val()
                    +'&product_id='+$('.product_id').val()
                    +'&product_type=courses'
                    +'&_token='+token;

                    $.ajax({
                        type: "POST",
                        url : site_url + "store-cart-details-tmp", // store users email temporary, delete back if they complete the payment
                        data: datastring,
                        cache: false,
                        timeout: 30000, // 30 second timeout
                        success : function(data){}
                    });
                }

                $('#v-pills-shipping-tab').removeClass('active')
                $('#v-pills-shipping').removeClass('show active')
                $('#v-pills-payment-tab').addClass('active')
                $('#v-pills-payment').addClass('show active')
            }

        })

        $("#activeconfirm").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == '' || $('#address').val() == '' || $('#state').val() == '' || $('#country').val() == '') {
                $('#error').html('Please fill the asterisks field to continue');
            } else {
                $('#v-pills-payment-tab').removeClass('active')
                $('#v-pills-payment').removeClass('show active')
                $('#v-pills-confir-tab').addClass('active')
                $('#v-pills-confir').addClass('show active')
            }
        })

        $("#makePayment").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == '' || $('#address').val() == '' || $('#state').val() == '' || $('#country').val() == '' || !$('input[name="paymentOptions"]:checked').val()) {
                alert('Please fill in the required fields to continue');
                $('#error').html('Please fill in the required fields to continue');
            } else {
                var selectedPaymentOption = $('input[name="paymentOptions"]:checked').val();
                var checkoutForm = document.getElementById('checkoutForm');
                var currency = document.getElementById("curr").value;
                var tamount = document.getElementById("totalAmount").value;
                if(currency != "NGN") {
                    var multiplier = 1;
                    if(currency == "USD"){
                        multiplier = Number.parseInt("{{ \App\Models\CurrencyRate::getBaseCur('USD')}}");
                        tamount  = tamount * multiplier;
                    }

                    if(currency != "GBP") {
                        multiplier = Number.parseInt("{{ \App\Models\CurrencyRate::getBaseCur('GBP')}}");
                        tamount  = tamount * multiplier;
                    }

                    if(currency != "NGN") {
                        tamount = 1 * Number.parseInt(tamount);
                    }
                }

                if (selectedPaymentOption == 'Paypal') {
                    // Prevent the default form submission
                    event.preventDefault();
                    // Your conditions are met, trigger the form submission asynchronously
                    // checkoutForm.submit();
                } else if (selectedPaymentOption == 'Flutterwave') {
                    $.ajax({
                        method: 'GET',
                        url: '/retrieve/payment/' + 'Flutterwave', // Replace with your actual backend endpoint
                        success: function(response) {
                            // Get the base URL of the current page
                            var baseUrl = window.location.origin;

                            $('#makePayment').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Payment processing...');

                            // Configure FlutterwaveCheckout
                            FlutterwaveCheckout({
                                public_key: response.FLW_PUBLIC_KEY,
                                tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                                amount: document.getElementById("totalAmount").value, // Amount in cents (e.g., $50.00 is 5000 cents)
                                currency: '{{$shop->currency}}',
                                payment_options: "card, banktransfer, ussd",
                                customer: {
                                    email: $('#email').val(), // Replace with your user's email
                                },
                                customizations: {
                                    title: 'Product Purchase',
                                    description: 'Purchased Products',
                                    logo: baseUrl + '/dash/assets/images/Logo-fav.png', // Replace 'your-logo.png' with the actual path to your logo in the public folder
                                },
                                callback: function(response) {
                                    console.log(response);
                                    // Handle the response after successful payment
                                    alert('Payment successful!');
                                    $( "#checkoutForm" ).submit();
                                },
                                onclose: function() {
                                    $('#error-message').html('Payment closed').show();
                                    $('#makePayment').attr('disabled', false).html('Place Order');
                                }
                            });
                        },
                        error: function(error) {
                            $('#error-message').html(error.message).show();
                            $('#makePayment').attr('disabled', false).html('Place Order');
                        }
                    });
                } else if (selectedPaymentOption == 'Paystack') {
                    $('#makePayment').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Payment processing...');

                    $.ajax({
                        method: 'GET',
                        url: '/retrieve/payment/' + 'Paystack', // Replace with your actual backend endpoint
                        success: function(response) {
                            var handler = PaystackPop.setup({
                                key: response.PAYSTACK_PUBLIC_KEY,
                                email: $('#email').val(),
                                amount: document.getElementById("totalAmount").value * 100,
                                ref: '' + Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                callback: function(response) {
                                    // alert(JSON.stringify(response))
                                    // let url = '{{ route("user.transaction.confirm", [':response', ':amount']) }}';
                                    // url = url.replace(':response', response.reference);
                                    // url = url.replace(':amount', document.getElementById("amount").value);
                                    // document.location.href=url;
                                    $("#checkoutForm").submit();
                                },
                                onClose: function() {
                                    $('#error-message').html('Window closed').show();
                                    $('#makePayment').attr('disabled', false).html('Place Order');
                                }
                            });
                            handler.openIframe();
                        },
                        error: function(error) {
                            $('#error-message').html(error.message).show();

                            $('#makePayment').attr('disabled', false).html('Place Order');
                        }
                    });
                } else {
                     // Handle other payment gateways or show an error message
                     $('#error-message').html('Unsupported payment option').show();
                }
            }
        })

        $.ajax({
            method: 'GET',
            url: '/retrieve/payment/' + 'Stripe', // Replace with your actual backend endpoint
            success: function(response) {
                let stripe = Stripe(response.STRIPE_KEY);
                const elements = stripe.elements();
                const cardElement = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px'
                        }
                    }
                });
                // Disable submit button and show loading state
                const checkoutForm = document.getElementById('checkoutForm');
                const cardName = document.getElementById('card-name');
                cardElement.mount('#card');

                checkoutForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    $('#payment-btn').attr('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Payment processing...');

                    const { paymentMethod, error } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                        billing_details: {
                            name: cardName.value
                        }
                    });

                    if (error) {
                        // Display the error message in the error message div
                        $('#error-message').html(error.message).show();
                        $('#payment-btn').attr('disabled', false).html('Place Order');
                    } else {
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
                // alert("Error fetching payment details: ".error.message);

                // Display the error message in the error message div
                $('#error-message').html(error.message).show();

                // console.error("Error fetching payment details: ", error);
                $('#payment-btn').attr('disabled', false).html('Place Order');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phoneNo");
        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");
        let validationTimeout;

        // here, the index maps to the error code returned from getValidationError - see readme
        const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        const iti = window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            initialCountry: "auto", // Automatically select the user's country
            separateDialCode: true, // Add a space between the country code and the phone number
            placeholderNumberType: "MOBILE", // Set the placeholder to match the user's mobile number format
            nationalMode: false, // Do not automatically switch to national mode
        });

        const updateMessages = () => {
            clearTimeout(validationTimeout);
            reset();
            if (input.value.trim()) {
                validationTimeout = setTimeout(() => {
                    if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        input.classList.add("error");
                        const errorCode = iti.getValidationError();
                        errorMsg.innerHTML = errorMap[errorCode];
                        errorMsg.classList.remove("hide");
                    }
                }, 300); // Adjust the delay time as needed (in milliseconds)
            }
        };

        const reset = () => {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on input: validate with slight delay
        input.addEventListener('input', updateMessages);

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

        // Set the initial value of the input to include the selected country code
        input.addEventListener('countrychange', () => {
            const countryCodeValue = iti.getSelectedCountryData().dialCode;
            input.value = `+${countryCodeValue}`;
        });
    </script>

    <style>
        .iti {
            display: block !important;
        }

        .iti__country-list {
            z-index: 2000 !important;
        }

        .iti__country-name {
            color: #000 !important;
        }

        .iti__dial-code {
            color: #000 !important;
        }
        .thumbnail {
            position: relative;
            padding: 0px;
            margin-bottom: 20px;
        }

        .thumbnail img {
            width: 80%;
        }

        .thumbnail .caption {
            margin: 7px;
        }

        .main-section {
            background-color: #F8F8F8;
        }

        .dropdown button.btn-info {
            /* float:right;
            padding-right: 30px; */
            color: {{$shop->color}};
            background: {{$shop->theme}};
        }

        .btn-success {
            color: {{$shop->color}} !important;
            background: {{$shop->theme}}!important;
        }

        .btn {
            border: 0px;
            margin: 10px 0px;
            box-shadow: none !important;
        }

        .dropdown .dropdown-menu {
            padding: 20px;
            /*top:30px !important;*/
            width: 350px !important;
            /*left:-110px !important;*/
            box-shadow: 0px 4px 7px #a8a7a7;
        }

        .total-header-section {
            border-bottom: 1px solid #d2d2d2;
        }

        .total-section p {
            margin-bottom: 20px;
        }

        .cart-detail {
            padding: 15px 0px;
        }

        .cart-detail-img img {
            width: 100%;
            height: 100%;
            padding-left: 15px;
        }

        .cart-detail-product p {
            margin: 0px;
            color: #000;
            font-weight: 500;
        }

        span.text-info {
            color: {{$shop->theme}}!important;
        }

        .cart-detail .price {
            font-size: 12px;
            margin-right: 10px;
            font-weight: 500;
        }

        .cart-detail .count {
            color: #C2C2DC;
        }

        .checkout {
            border-top: 1px solid #d2d2d2;
            padding-top: 15px;
        }

        .checkout .btn-primary {
            color: {{$shop->color}};
            background: {{$shop->theme}};
        }

        .dropdown-menu:before {
            content: " ";
            position: absolute;
            top: -20px;
            right: 50px;
            border: 10px solid transparent;
            border-bottom-color: #fff;
        }
    </style>
</body>
</html>

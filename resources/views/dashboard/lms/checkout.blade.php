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
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Address *</label>
                                                                    <input type="text" name="address" id="address" placeholder="Enter your address" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Country *</label>
                                                                    <!-- <input type="text" name="country" id="country" placeholder="Enter your country" required /> -->

                                                                    <select class="form-control p-15 txt_state" name="txt_state">
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
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">State *</label>
                                                                    <input type="tel" name="state" id="state" placeholder="Enter your state" required />
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
                                                        <div>
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOption" id="paymentoptionsRadio1" checked>
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Paystack</label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3">
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOption" id="paymentoptionsRadio1" checked>
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Flutterwave</label>
                                                            </div>
                                                        </div>
                                                        {{-- <h5 class="mt-3 mb-3 font-size-15">For card Payment</h5> --}}
                                                        <div class="form">
                                                            <div class="row">
                                                                {{-- <div class="col-lg-6 mb-4">
                                                                <label for="Name">Name on card</label>
                                                                <input type="text" name="name" placeholder="Enter card name" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Card Number</label>
                                                                <input type="email" name="name" placeholder="0000 0000 0000 0000" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Expiry Date</label>
                                                                <input type="date" name="name" placeholder="Enter expiry date" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">CVV Code</label>
                                                                <input type="date" name="name" placeholder="Enter cvv code" required />
                                                            </div> --}}
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

                                                    <!-- <div class="stripe_div">
                                                        <div class="panel panel-default credit-card-box">
                                                            <div class="row display-tr text-center mt-n4">
                                                                <div class="display-td">
                                                                    <img class="img-responsive" src="{{ asset('images/stripe.png') }}" style="width:110px;height:auto">
                                                                </div>
                                                            </div>

                                                            <div class="panel-body mt-n1">
                                                                <form role="form" action="#" method="post" action="{{ route('stripe.post') }}"  class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">

                                                                    @csrf
                                                                    <input type="hidden" id="txtFinalAmt" name="txtFinalAmt" value="100">

                                                                    <div class="row">
                                                                        <div class="mb-3 col-md-12 required">
                                                                            <label for="card-name" class="form-label">Name on Card <span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="card-name" name="card-name" placeholder="Enter your names on card" style="text-transform: capitalize;">
                                                                        </div>

                                                                        <div class="mb-3 col-md-12 required">
                                                                            <label for="card-number" class="form-label">Card Number <span class="text-danger">*</span></label>
                                                                            <input autocomplete='off' type="number" class="form-control card-number" id="card-number" placeholder="Enter your card number" name="card-number">
                                                                        </div>

                                                                        <div class="mb-3 col-sm-4 pe-sm-2 required">
                                                                            <label for="cvc" class="form-label">CVC <span class="text-danger">*</span></label>
                                                                            <input autocomplete='off' type="number" class="form-control card-cvc" id="cvc" placeholder="ex. 311" size='4' name="cvc">
                                                                        </div>

                                                                        <div class="mb-3 col-sm-4 col-6 pe-2 required">
                                                                            <label for="card-expiry-month" class="form-label">Exp Month <span class="text-danger">*</span></label>
                                                                            <input autocomplete='off' type="number" class="form-control card-expiry-month" id="card-expiry-month" placeholder="MM" size='2' name="card-expiry-month">
                                                                        </div>

                                                                        <div class="mb-3 col-sm-4 col-6 ps-2 required">
                                                                            <label for="card-expiry-year" class="form-label">Exp Year <span class="text-danger">*</span></label>
                                                                            <input autocomplete='off' type="number" class="form-control card-expiry-year" id="card-expiry-year" placeholder="YYYY" size='4' name="card-expiry-year">
                                                                        </div>

                                                                        <input type='hidden' autocomplete='off' class='stripeToken' name='stripeToken' />

                                                                        <div class="col-md-12 mt-4 text-center">
                                                                            <button class="btn btn-primary pe-6 ps-6 cmdPayNow" type="submit">Pay Now ($0.00)</button>

                                                                            <button class="btn btn-primary ms-2 pe-4 ps-4 cmdBack1" type="button">Back</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> -->
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
                                                                            <td>{{ isset($details['currency']) ? $details['currency'] : 'NGN' }}{{ number_format($details['price'], 2) }}</td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @endif
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <h6 class="m-0 text-end">Total:</h6>
                                                                            </td>
                                                                            <td>
                                                                                {{ $details['currency'] }}{{ number_format($total, 2) }}
                                                                                <input type="hidden" id="curr" value="{{$details['currency']}}" name="">
                                                                                {{ isset($details) ? $details['currency'] : 'NGN' }}{{ number_format($total, 2) }}
                                                                                <input type="hidden" id="totalAmount" value="{{ $total }}" name="">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="row mt-4">
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


    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script src="{{ asset('assets/js/jscripts.js') }}"></script>




    <script>
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
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == '' || $('#address').val() == '' || $('#state').val() == '' || $('#country').val() == '') {
                $('#error').html('Please fill the asterisks field to continue');
            }
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
            var handler = PaystackPop.setup({
                key: 'pk_test_dafbbf580555e2e2a10a8d59c6157b328192334d',
                email: $('#email').val(),
                amount: tamount * 100,
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
                    alert('window closed');
                }
            });
            handler.openIframe();
        })
    </script>
    <!-- Code injected by live-server -->
</body>
<style>
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
        color: {
                {
                $shop->color
            }
        }

        ;

        background: {
                {
                $shop->theme
            }
        }

        ;
    }

    .btn-success {
        color: {
                {
                $shop->color
            }
        }

        !important;

        background: {
                {
                $shop->theme
            }
        }

        !important;
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
        color: {
                {
                $shop->theme
            }
        }

        !important;
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
        color: {
                {
                $shop->color
            }
        }

        ;

        background: {
                {
                $shop->theme
            }
        }

        ;
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

</html>

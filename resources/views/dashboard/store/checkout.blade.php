<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{$store->name}} | Oja Funnel | StoreFront</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="title" name="{{$store->name}} | Oja Funnel | StoreFront" />
  <meta content="description" name="{{$store->description}} | Oja Funnel | StoreFront" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{Storage::url($store->logo)}}" />

  <!-- App Css-->
  <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  <!-- Bootstrap Css -->
  <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- style Css -->
  <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <!-- Font Css-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <script src="https://js.paystack.co/v1/inline.js"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
  <header class="pt-4">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-4 d-flex align-items-center">
            <a href="{{route('user.stores.link', $store->name)}}" style="display: contents;">
                <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="40" />
                <h3 class="mt-3 px-2">{{$store->name}}</h3>
            </a>
        </div>
        <div class="col-4">
          <form class="app-search d-none d-lg-block">
            <div class="position-relative">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="bx bx-search-alt"></span>
            </div>
          </form>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-between">
          <div>
            @auth
                <a href="{{route('user.my.store', Auth::user()->username)}}">Go to store</a>
            @else
                <a href="{{route('index')}}">Set up your own store</a>
            @endauth
          </div>

            {{-- <a href="{{route('user.cart', Auth::user()->username)}}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-cart-check"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}
                </button>
            </a> --}}
            <div class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>

                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img style="width: 70px" src="{{ Storage::url($details['image']) }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('cart', $store->name) }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </header>
  <div class="acc-border my-4"></div>

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
                                <li class="breadcrumb-item"><a href="{{route('user.stores.link', $store->name)}}">Home</a></li>
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
                                            route('payment.checkout', [
                                                'storename' => $store->name,
                                                'promotion_id' => Request::get('promotion_id'),
                                                'product_id' => Request::get('product_id'),
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

                                                                <input type="hidden" name="product_id" class="product_id" value="{{ Request::get('product_id') }}" />

                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Phone Number *</label>
                                                                    <input type="tel" name="phoneNo" id="phoneNo" placeholder="Enter your number" required />
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
                                                                    <input type="text" name="country" id="country" placeholder="Enter your country" required />
                                                                </div>
                                                                <div class="text-end mt-2">
                                                                    <a class="nav-link" class="text-decoration-none">
                                                                        <button type="button" id="activePayment" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                            Next
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                <div>
                                                    <h4 class="card-title">Payment information</h4>
                                                    <p class="card-title-desc">Select payment below</p>
                                                    @foreach(App\Models\PaymentGateway::latest()->where('status', 'Active')->get() as $payment)
                                                    <div class="mt-3">
                                                        <div class="form-check form-check-inline font-size-16">
                                                            <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                            <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                        </div>
                                                    </div>
                                                    @endforeach
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
                                                                    <button type="button" class="btn px-4 py-1" id="activeconfirm" style="color: #714091; border: 1px solid #714091">
                                                                        Next
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                                <div class="card shadow-none border mb-0">
                                                    <div class="card-body">
                                                        <!-- <h4 class="card-title ">Note</h4> -->
                                                        {{-- <h6 class="mb-4"><span class="text-danger">Note:</span> Kindly check your email to download your digital products.</h6> --}}

                                                        <h4 class="card-title mb-4">Order Summary</h4>
                                                        <div class="table-responsive">
                                                            <table class="table align-middle mb-0 table-nowrap">
                                                                <thead class="tread">
                                                                    <tr>
                                                                        <th scope="col">Product</th>
                                                                        <th scope="col">Product Desc</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $total = 0 @endphp
                                                                    @if(session('cart'))
                                                                        @foreach(session('cart') as $id => $details)
                                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                                            <tr>
                                                                                <th scope="row"><img src="{{ Storage::url($details['image']) }}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                                <td>
                                                                                    <h5 class="font-size-14 text-truncate"><a href="javascrit(0);" class="text-dark"><span class="badge badge-success" style="background: green">({{\App\Models\StoreProduct::getProductLabel($details['id'])}} Product)</span><br />{{ $details['name'] }} </a></h5>
                                                                                </td>
                                                                                <td>₦ {{ $details['price'] }}</td>
                                                                                <td>{{ $details['quantity'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <h6 class="m-0 text-end">Total:</h6>
                                                                        </td>
                                                                        <td>
                                                                            ₦ <input id="AmountToPay" value="" name="amountToPay" style="border: none; outline: none;">
                                                                            <input type="hidden" id="couponDiscount" value="" name="">
                                                                            <input type="hidden" id="couponID" value="" name="couponID">
                                                                            <input type="hidden" id="totalAmount" value="{{ $total }}" name="totalAmount">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <h4 class="card-title mt-4 mb-4">Have a coupon? <a href="#" onclick="myFunction()">Click here to enter your code</a></h4>
                                                        <span style="color: red" id="couponerror"></span>
                                                        <span style="color: green" id="couponsuccess"></span>
                                                        <form>
                                                            <div class="form" id="myDIV" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-lg-6 mt-1 mb-4">
                                                                        <p>If you have a coupon code, please apply it below.</p>
                                                                        <div style="display: block ruby;">
                                                                            <input type="text" name="coupon" id="coupon" required />
                                                                            <input type="button" id="submitCoupon" value="Apply Coupon" style="background: #556ee6; padding: .8rem; color: #fff;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="row mt-4">
                                                            <div class="col-sm-6">
                                                                <button type="button" id="makePayment" class="btn btn-success text-white d-none d-sm-inline-block">
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
  <script src="https://checkout.flutterwave.com/v3.js"></script>

  <script>
    var token = $('#txt_token1').val();
    var site_url = $('#site_url').val();

    window.onload=function(){
        $discount = $('#totalAmount').val() - $('#couponDiscount').val();
        $('#AmountToPay').val($discount);
    };

    $("#activePayment").click(function() {
        if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == ''  || $('#address').val() == ''  || $('#state').val() == '' || $('#country').val() == '' || $('#paymemtOptions').val() == '') {
            $('#error').html('Please fill the asterisks field to continue');
        } else {
            if($('.customer_email').val() !== ""){
                var datastring='customer_email='+$('.customer_email').val()
                +'&product_id='+$('.product_id').val()
                +'&product_type=products'
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
        if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == ''  || $('#address').val() == ''  || $('#state').val() == '' || $('#country').val() == '') {
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

            if (selectedPaymentOption == 'Stripe' || selectedPaymentOption == 'Paypal') {
                // Your conditions are met, trigger the form submission
                $('#checkoutForm').submit();
            } else if (selectedPaymentOption == 'Flutterwave') {
                $.ajax({
                    method: 'GET',
                    url: '/retrieve/payment/' + 'Flutterwave', // Replace with your actual backend endpoint
                    success: function(response) {
                        // Get the base URL of the current page
                        var baseUrl = window.location.origin;

                        // Configure FlutterwaveCheckout
                        FlutterwaveCheckout({
                            public_key: response.FLW_PUBLIC_KEY,
                            tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                            amount: document.getElementById("AmountToPay").value, // Amount in cents (e.g., $50.00 is 5000 cents)
                            currency: 'NGN',
                            payment_options: "card",
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
                                console.log('Payment closed');
                                // Handle actions when the payment modal is closed
                            }
                        });

                        // Trigger the Flutterwave Checkout modal
                        // handler.open();
                    },
                    error: function(error) {
                        console.error("Error fetching payment details:", error);
                    }
                });
            } else if (selectedPaymentOption == 'Paystack') {
                var handler = PaystackPop.setup({
                    key: 'pk_test_77297b93cbc01f078d572fed5e2d58f4f7b518d7',
                    email: $('#email').val(),
                    amount: document.getElementById("AmountToPay").value * 100,
                    ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                    callback: function(response){
                        // let url = '{{ route("user.transaction.confirm", [':response', ':amount']) }}';
                        // url = url.replace(':response', response.reference);
                        // url = url.replace(':amount', document.getElementById("amount").value);
                        // document.location.href=url;
                        $( "#checkoutForm" ).submit();
                    },
                    onClose: function(){
                        alert('window closed');
                    }
                });
                handler.openIframe();
            } else {
                // Handle other payment gateways or show an error message
                alert('Unsupported payment option');
            }
        }
    })

    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

    $("#submitCoupon").click(function()
    {
        if ($('#coupon').val() == '') {
            $('#couponerror').html('Please fill the coupon field to continue.');
        } else {

            $coupon = $('#coupon').val();
            $totalAmount = $('#totalAmount').val();
            $.ajax({
              url: "{{ route('user.store.check.coupon') }}",
                method: "post",
                data: {
                    _token: '{{ csrf_token() }}',
                    coupon: $coupon,
                    totalAmount: $totalAmount,
                },
                success: function (response) {
                    if(response['success'] === true)
                    {
                        $('#couponerror').hide();
                        $('#couponsuccess').show();
                        $('#couponsuccess').html(response['message']);
                        $('#couponDiscount').val(response['data'])
                        $('#couponID').val(response['id'])
                        $discount = $('#totalAmount').val() - response['data'];
                        $('#AmountToPay').val($discount);
                        $('#coupon').val('')
                    } else {
                        $('#couponsuccess').hide();
                        $('#couponerror').show();
                        $('#couponerror').html(response['message']);
                    }
                }
            });
        }
    });
</script>
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
.thumbnail .caption{
    margin: 7px;
}
.main-section{
    background-color: #F8F8F8;
}
.dropdown button.btn-info{
    /* float:right;
    padding-right: 30px; */
    color: {{$store->color}};
    background: {{$store->theme}};
}
.btn-success{
    color: {{$store->color}} !important;
    background: {{$store->theme}} !important;
}
.btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
}
.dropdown .dropdown-menu{
    padding:20px;
    /*top:30px !important;*/
    width:350px !important;
    /*left:-110px !important;*/
    box-shadow:0px 4px 7px #a8a7a7;
}
.total-header-section{
    border-bottom:1px solid #d2d2d2;
}
.total-section p{
    margin-bottom:20px;
}
.cart-detail{
    padding:15px 0px;
}
.cart-detail-img img{
    width:100%;
    height:100%;
    padding-left:15px;
}
.cart-detail-product p{
    margin:0px;
    color:#000;
    font-weight:500;
}

span.text-info{
    color: {{$store->theme}} !important;
}
.cart-detail .price{
    font-size:12px;
    margin-right:10px;
    font-weight:500;
}
.cart-detail .count{
    color:#C2C2DC;
}
.checkout{
    border-top:1px solid #d2d2d2;
    padding-top: 15px;
}
.checkout .btn-primary{
    color: {{$store->color}};
    background: {{$store->theme}};
}
.dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
}
</style>
</html>

<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{$shop->name}} | Oja Funnel | Shop</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="title" name="{{$shop->name}} | Oja Funnel | shopFront" />
  <meta content="description" name="{{$shop->description}} | Oja Funnel | Shop" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{$shop->logo}}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
    <section class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="mobile-header-buttons">
                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>
                        <a class="navbar-brand" href="#">
                            <img src="{{$shop->logo ?? URL::asset('dash/assets/image/shop-logo.png')}}" alt="" width="40" />
                            {{$shop->name}}
                        </a>
                        <form class="inline-form mt-3" style="width: 55%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        
                        {{-- <a href="{{route('user.cart', Auth::user()->username)}}">
                        <button type="button" class="btn btn-primary">
                            <i class="bi bi-cart-check"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}
                        </button>
                        </a> --}}
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="p-4">
                                @auth
                                    <a href="{{route('user.create.shop.course', Auth::user()->username)}}">Set up your own shop</a>
                                @else
                                    <a href="{{route('/')}}">Set up your own shop</a>
                                @endauth
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                </a>

                                <ul class="dropdown-menu">
                                    <div class="row total-header-section">
                                        <div class="col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </div>
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                        @endforeach
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Total: <span class="text-info">{{ $total }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img style="width: 70px" src="{{ $details['image'] ?? URL::asset('dash/assets/image/store-logo.png') }}" />
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p>{{ $details['title'] }}</p>
                                            <span class="price text-info"> {{ $details['currency'] }}{{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="{{ route('course.cart', $shop->name) }}" style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" class="btn btn-primary btn-block">View all</a>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="container home-banner-area text-center" style="background: {{$shop->theme}}!important; color: {{$shop->color}}">
        <div class="container">
            <img src="{{$shop->logo ?? URL::asset('dash/assets/image/shop-logo.png')}}" alt="" width="100" />
            <h3 class="mt-3 px-2" style="font-size: 30px;">{{$shop->name}}</h3>
        </div>
    </section>

    <div class="acc-border my-4"></div>

    <!-- main content -->
    <div class="container">
        <div class="page-content">
            <!-- container-fluid -->
            <div class="">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                            <h4 class="mb-sm-0 font-size-18">Cart</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap w-100">
                                        <thead class="tread">
                                            <tr class="font-500">
                                                <th scope="col">Course Name</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Course Description</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $total = 0 @endphp
                                            @if(session('cart'))
                                                @foreach(session('cart') as $id => $details)
                                                    @php $total += $details['price'] * $details['quantity'] @endphp
                                                        <tr data-id="{{ $id }}">
                                                            <td>
                                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">{{ $details['title'] }}</a></h5>
                                                            </td>
                                                            <td>
                                                                <img src="{{$details['image'] ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                                            </td>
                                                            <td>
                                                                <h5 class="font-size-14 text-wrap" style="width: 330px;"><a href="#" class="text-dark">{{ $details['description'] }}</a></h5>
                                                            </td>
                                                            <td>
                                                                {{ $details['currency'] }}{{ $details['price'] }}
                                                            </td>
                                                            <td>
                                                                <div class="me-3" style="width: 120px;">
                                                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart">
                                                                    <small style="font-size: 63%">Availabe: {{ $details['rmQuan'] }}</small>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{ $details['currency'] }}{{ $details['price'] * $details['quantity'] }}
                                                            </td>
                                                            <td>
                                                                <a href="javascript(0);" class="action-icon text-danger remove-from-cart"> <i class="fas fa-trash-can font-size-18"></i></a>
                                                            </td>
                                                        </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="7" class="text-right"><h4>Total ₦ {{ $total }}</h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="mt-4" style="display: flex; justify-content: space-between;">
                                    <div class="">
                                        <a href="{{route('user.shops.link', $shop->name)}}" class="btn d-none d-sm-inline-block btn-link">
                                            <i class="fas fa-arrow-left me-1"></i> Continue Shopping </a>
                                    </div>
                                    <div>
                                         <a href="{{route('course.checkout', $shop->name)}}" class="btn d-none d-sm-inline-block btn-link" style="display: flex; justify-content: flex-end;">
                                            <i class="fas fa-truck-fast me-1"></i> Proceed to Checkout </a>
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
    <!-- JAVASCRIPT -->
    <!-- Code injected by live-server -->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tinymce.min.js') }}"></script>
    <script src="{{ asset('frontend/js/multi-step-modal.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.webui-popover.min.js') }}"></script>
    <script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <script>
        $(".update-cart").change(function (e) {
            e.preventDefault();

            var ele = $(this);
            var quantity = ele.parents("tr").find(".quantity").val();
            var rm = "{{ $details['rmQuan'] ?? 0 }}";
            if (quantity > parseInt(rm)) {
                ele.parents("tr").find(".quantity").val(parseInt(rm))
            }
            else{
                $.ajax({
                url: '{{ route('course.update.cart') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id"),
                        quantity: quantity
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }

        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
    <!-- Code injected by live-server -->
</body>
<style>
.dropdown button.btn-info{
    /* float:right;
    padding-right: 30px; */
    color: {{$shop->color}};
    background: {{$shop->theme}};
}
.btn-success{
    color: {{$shop->color}} !important;
    background: {{$shop->theme}} !important;
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
    color: {{$shop->theme}} !important;
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
    color: {{$shop->color}};
    background: {{$shop->theme}};
}
.dropdown-menu:before{
    content: " ";
    position:absolute;
    top:-20px;
    right:50px;
    border:10px solid transparent;
    border-bottom-color:#fff;
}
.tread{
  background-color: #F5E6FE !important;
  /* padding: 10px 0px 10px 0; */
}
</style>
</html>

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

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
      .countdown {
          font-size: 24px;
          text-align: center;
          margin-top: 50px;
      }
  </style>
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
            <form class="app-search d-none d-lg-block" method="get" action="{{route('user.stores.link', $store->name)}}">
                @csrf
                <div class="input-group search-box mobile-search">
                    <input type="text" name='search_string' class="form-control" placeholder="Search for products">
                    <!-- <div class="input-group-append">
                        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                    </div> -->
                </div>
            </form>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-between">
          <div>
            @auth
                <a href="{{route('user.my.store', Auth::user()->username)}}">Set up your own store</a>
            @else
                <a href="{{route('index')}}">Set up your own store</a>
            @endauth

          </div>

            {{-- <a href="{{route('user.cart', Auth::user()->username)}}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-cart-check"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}
                </button>
            </a> --}}
            <div class="dropdown" style="right: 0; left: auto !important">
                <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart
                    @php
                        $cartCount = 0;
                        foreach((array) session('cart') as $id => $details) {
                            if(isset($details['store']) && $details['store']->name == $store->name) {
                                $cartCount++;
                            }
                        }
                    @endphp
                    <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                </button>

                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            @php
                                $cartCount = 0;
                                foreach((array) session('cart') as $id => $details) {
                                    if(isset($details['store']) && $details['store']->name == $store->name) {
                                        $cartCount++;
                                    }
                                }
                            @endphp
                            <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @if(isset($details['quantity']) && isset($details['price']) &&
                                isset($details['store']) &&
                                $details['store']->name == $store->name)
                                @php
                                    // Cast price to float and check if it's numeric
                                    $price = floatval(preg_replace('/[^-0-9.]/', '', $details['price']));
                                    $quantity = intval($details['quantity']);
                                    $total += $price * $quantity;
                                @endphp
                            @endif
                        @endforeach
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">{{$store->currency_sign}}{{number_format($total, 2) }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @if(isset($details['store']) && $details['store']->name == $store->name)
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img style="width: 70px" src="{{ Storage::url($details['image']) }}" />
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                        <p>{{ isset($details['name']) ? $details['name'] : '' }}</p>
                                        <span class="price text-info"> {{$details['currency_sign']}}{{ $price ? number_format($price, 2) : 0 }}</span> <span class="count"> Quantity:{{ isset($details['quantity']) ? $details['quantity'] : 1 }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="
                              @if($isvalid)
                                {{
                                  route('cart', [
                                    'storename' => $store->name,
                                    'promotion_id' => Request::get('promotion_id'),
                                    'product_id' => Request::get('product_id')
                                  ])
                                }}
                              @else
                                {{ route('cart', ['storename' => $store->name]) }}
                              @endif
                              " class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </header>
  <div class="acc-border my-4"></div>
  <div>
    <div class="container">
      <div class="hero-store d-flex align-items-center justify-content-center">
        <div class="text-center">
          <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="60" />
          <h3 class="mt-3 px-2">{{$store->name}}</h3>
          <h3 class="mt-3 px-2">{{$store->description}}</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- main content -->
  <div class="container">
    <div class="row mt-5">
      <div class="products col-lg-12 mt-5">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="found-head">
          <h3>All Products Found ({{$products->count()}})</h3>
        </div>
        <div class="found-con w-100 mt-5">
          <div class="row">
            @if ($products->count() > 0)
                @foreach ($products as $item)
                    @php
                    $targetDate = strtotime($item->date_to);
                    $now = time();
                    $timeRemaining = $targetDate - $now;
                    @endphp

                    <div class="col-md-4" id="item-{{ $item->id }}">
                        <div class="founds">
                          @if($item->type == 'Physical')
                          <span class="badge badge-pill badge-soft-dark text-end font-size-11" style="float: right;">Physical</span>
                          @else
                          <span class="badge badge-pill badge-soft-dark text-end font-size-11" style="float: right;">Digital</span>
                          @endif
                          <div class="found-top">
                              <img src="{{Storage::url($item->image)}}" alt="">
                              <div class="countdown">

                                <span name="ctimer" class="ctimer" from="{{$item->date_from}}" to="{{$item->date_to}}"></span>

                              </div>
                          </div>
                          <div class="p-2">
                              <p class="font-500">{{$item->name}}</p>

                              @if (@$timeRemaining <= 0)
                                <p class="dynamic_price">{{$store->currency_sign}}{{number_format($item->price, 2)}}</p>
                                @if ($item->price >= 1)
                                    <a href="{{ route('add.to.cart', [$item->id, $store->name]) }}"><i class="bi bi-cart-check"></i> Add to Cart</a>
                                @else
                                    <button disabled>Out of Stock</button>
                                @endif
                              @else
                                <p class="dynamic_price">{{$store->currency_sign}}{{number_format($item->new_price, 2)}} <span style="text-decoration:line-through;color:red;opacity:0.6;margin-left:4px;font-size:12px">NGN{{number_format($item->price, 2)}}</span></p>
                                @if ($item->new_price >= 1)
                                    <a href="{{ route('add.to.cart', [$item->id, $store->name]) }}"><i class="bi bi-cart-check"></i> Add to Cart</a>
                                @else
                                    <button disabled>Out of Stock</button>
                                @endif
                              @endif

                              @if ($isvalid)
                                @if(Request::has('promotion_id') && Request::has('product_id'))
                                  @if (Request::get('product_id') == $item->id)
                                    <div class="mt-2">
                                      Promotional code (<b>{{ Request::get('promotion_id') }}</b>) attached.
                                    </div>
                                  @endif
                                @endif
                              @endif
                          </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
  <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>
  <!-- Code injected by live-server -->

  <script>
    setInterval(() => {
        var ctimers = document.getElementsByClassName('ctimer');
        for(let i=0; i<ctimers.length; i++) {
            const el = ctimers[i];
            var date_from = el.getAttribute("from");
            var date_to = el.getAttribute("to");

            var deadline = new Date(date_to).getTime();
            var now = new Date().getTime();

            if(now < deadline) {
                var t = deadline - now;

                let days = Math.floor(t / (1000 * 60 * 60 * 24));
                let hours = Math.floor(
                    (t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor(
                    (t % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor(
                    (t % (1000 * 60)) / 1000);

                el.innerHTML = "" +
                        days + "d " + hours + "h " +
                        minutes + "m " + seconds + "s";

            } else {
                // de = true;
                // if(de) {
                //     document.getElementById("offer_form").setAttribute("action", uri + "&ext=1");
                // }
                // document.getElementById("timer").innerHTML = "";
                // document.getElementById("amt").innerHTML = new_amt;
            }
        }
    }, 500);
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

.hero-store {
    background: {{$store->theme}} !important;
    color: {{$store->color}} !important;
}
.btn{
    border:0px;
    margin:10px 0px;
    box-shadow:none !important;
    color: {{$store->color}} !important;
    background: {{$store->theme}} !important;
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

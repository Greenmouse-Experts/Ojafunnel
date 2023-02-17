<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{$shop->name}} | Oja Funnel | StoreFront</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="title" name="{{$shop->name}} | Oja Funnel | StoreFront" />
    <meta content="description" name="{{$shop->description}} | Oja Funnel | StoreFront" />
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
    <section class="TopMontain mt-5">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-lg-12">
                    <h2 class="course-carousel-title mb-4">All Courses Found {{\App\Models\Course::where('user_id', Auth::user()->id)->get()->count()}}</h2>
                </div>
                @forelse(\App\Models\Course::where('user_id', Auth::user()->id)->get() as $course)
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                <div class="course-image">
                                    <img src="{{$course->image ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">{{$course->title}}</h5>
                                    <p class="instructors">{{$course->description}}</p>
                                    <!-- <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div> -->
                                    <p class="price text-right">
                                        {{$course->currency}}{{number_format($course->price, 2)}}
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="webui-popover-content">
                            <div class="course-popover-content">
                                <div class="course-title">
                                    <a href="#">{{$course->title}}</a>
                                </div>
                                <!-- <div class="course-category">
                                    <span class="course-badge best-seller">Best seller</span>
                                    in
                                    <a href="">HTML</a>
                                </div> -->
                                <div class="course-meta">
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        Lessons
                                    </span>
                                    <!-- <span class=""><i class="far fa-clock"></i>
                                        2 Hours
                                    </span> -->
                                    <span class="">
                                        <i class="fas fa-closed-captioning"></i>{{$course->language}}
                                    </span>
                                </div>
                                <div class="course-subtitle">{{$course->subtitle ?? $course->description}}</div>
                                <div class="what-will-learn">
                                    <ul>
                                        {{$course->subtitle}}
                                    </ul>
                                </div>
                                <div class="popover-btns">
                                    <a href="{{ route('add.course.to.cart', $course->id) }}" type="button" class="btn add-to-cart-btn addedToCart big-cart-button-1" id="1">
                                        Add To Cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>
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
</body>

<style>
.dropdown button.btn-info{
    color: {{$shop->color}};
    background: {{$shop->theme}};
}
.dropdown .dropdown-menu{
    padding:20px;
    width:310px !important;
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
</style>

</html>
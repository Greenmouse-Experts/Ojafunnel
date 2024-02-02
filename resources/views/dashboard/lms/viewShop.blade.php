<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{$shop->name}} | Oja Funnel | Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{$shop->logo}}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Bootstrap Css -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

    <style>
        @media (max-width: 480px) {
            .mobile-cart-btn {
                display: block;
                background: indigo !important;
                padding-bottom: 10px !important;
                border:none;
            }

            .desktop-list {
                display: none !important;
            }

            .mobile-list {
                display: block;
            }
        }

        @media (min-width: 768px) {
            .mobile-cart-btn {
                display: block !important;
            }

            .desktop-list {
                display: block;
            }

            .mobile-list {
                display: none !important;
            }
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
                        <form class="inline-form mt-3" method="get" action="{{route('user.shops.link', $shop->name)}}" style="width: 80%;">
                            @csrf
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="p-4">
                                @auth
                                    <a href="{{route('user.create.shop.course', Auth::user()->username)}}">Set up your own shop</a>
                                @else
                                    <a href="{{route('signup')}}">Set up your own shop</a>
                                @endauth
                            </div>
                            <div class="dropdown">
                                <a class="btn btn-success dropdown-toggle" style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                </a>
                                <ul class="dropdown-menu" style="right: 0; left: auto !important">
                                    <div class="row total-header-section">
                                        <div class="col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </div>
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] @endphp
                                        @endforeach
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Total: <span class="text-info">{{$shop->currency_sign}}{{ number_format($total, 2) }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img style="width: 70px" src="{{ $details['image'] ?? URL::asset('dash/assets/image/store-logo.png') }}" />
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p>{{ isset($details['title']) ? $details['title'] : '' }}</p>
                                            <span class="price text-info"> {{$shop->currency_sign}}{{ $details['price'] ? number_format($details['price'], 2) : '' }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="
                                            @if($isvalid)
                                                {{
                                                    route('course.cart', [
                                                        'shopname' => $shop->name,
                                                        'promotion_id' => Request::get('promotion_id'),
                                                        'course_id' => Request::get('course_id')
                                                    ])
                                                }}
                                            @else
                                                {{ route('course.cart', ['shopname' => $shop->name]) }}
                                            @endif
                                            " style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" class="btn btn-primary btn-block">View all</a>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                            <div class="user-box menu-icon-box">
                                <div class="icon">
                                    <a href="#">
                                        <img src="{{$shop->logo ?? URL::asset('dash/assets/image/shop-logo.png')}}" alt="" class="img-fluid"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="container home-banner-area" style="background-image: linear-gradient(50deg, #0000007e, #0000007e), url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col">
                <div class="home-banner-wrap">
                        <h2>Best place for learning</h2>
                        <p>Learn from any topic, choose from category</p>
                        <!-- <form class="" action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search_string" placeholder="what do you want to learn?">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home-fact-area container">
        <div class="container">
            <div class="row">
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fas fa-bullseye float-left"></i>
                        <div class="text-box">
                            <h4>Online Courses</h4>
                            <p>Explore A Variety Of Fresh Topics</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-check float-left"></i>
                        <div class="text-box">
                            <h4>Expert Instruction</h4>
                            <p>Find The Right Course For You</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="home-fact-box mr-md-auto ml-auto mr-auto">
                        <i class="fa fa-clock float-left"></i>
                        <div class="text-box">
                            <h4>Lifetime Access</h4>
                            <p>Learn On Your Schedule</p>
                        </div>
                    </div>
                </div>
            </div>
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
                    <h2 class="course-carousel-title mb-4">All Courses Found {{$courses->count()}}</h2>
                </div>
                @forelse($courses as $course)
                <div class="col-lg-4 desktop-list" id="item-{{ $course->id }}">
                    <div class="course-box-wrap">
                        <a class="has-popover" href="
                            @if($isvalid && Request::get('course_id') == $course->id)
                                {{
                                    route('view.course.details', [
                                        'shopname' => $shop->name,
                                        'id' => Crypt::encrypt($course->id),
                                        'promotion_id' => Request::get('promotion_id'),
                                        'course_id' => Request::get('course_id')
                                    ])
                                }}
                            @else
                                {{ route('view.course.details', ['shopname' => $shop->name, 'id' => Crypt::encrypt($course->id)]) }}
                            @endif
                        ">
                            <div class="course-box">
                                <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                <div class="course-image" >
                                    <img src="{{$course->image ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">{{$course->title}}</h5>
                                    <p class="instructors">{{$course->description}}</p>
                                    @if ($isvalid)
                                        @if(Request::has('promotion_id') && Request::has('course_id'))
                                            @if (Request::get('course_id') == $course->id)
                                                <p class="text-dark">
                                                Promotional code (<b>{{ Request::get('promotion_id') }}</b>) attached.
                                                </p>
                                            @endif
                                        @endif
                                    @endif
                                    <!-- <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div> -->
                                    <p class="price text-right">
                                    {{$shop->currency_sign}}{{number_format($course->price, 2)}}
                                    </p>
                                    {{-- <button class="btn add-to-cart-btn mobile-cart-btn" item="{{$course->id}}" link="{{ route('add.course.to.cart', $course->id) }}" onclick="add_tocartMobile(this)">
                                        Add To Cart
                                    </button> --}}
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
                                        {{App\Models\Lesson::where('course_id', $course->id)->get()->count()}} Lessons
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


                <div class="col-lg-4 mobile-list" id="item-{{ $course->id }}">
                    <div class="course-box-wrap">
                        <div class="has-popover" >
                            <div class="course-box">
                                <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                <a href="
                                    @if($isvalid && Request::get('course_id') == $course->id)
                                        {{
                                            route('view.course.details', [
                                                'shopname' => $shop->name,
                                                'id' => Crypt::encrypt($course->id),
                                                'promotion_id' => Request::get('promotion_id'),
                                                'course_id' => Request::get('course_id')
                                            ])
                                        }}
                                    @else
                                        {{ route('view.course.details', ['shopname' => $shop->name, 'id' => Crypt::encrypt($course->id)]) }}
                                    @endif
                                ">
                                    <div class="course-image" >
                                        <img src="{{$course->image ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" class="img-fluid">
                                    </div>
                                </a>
                                <div class="course-details">
                                    <h5 class="title">{{$course->title}}</h5>
                                    <p class="instructors">{{$course->description}}</p>
                                    @if ($isvalid)
                                        @if(Request::has('promotion_id') && Request::has('course_id'))
                                            @if (Request::get('course_id') == $course->id)
                                                <p class="text-dark">
                                                Promotional code (<b>{{ Request::get('promotion_id') }}</b>) attached.
                                                </p>
                                            @endif
                                        @endif
                                    @endif
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
                                    <a class="btn add-to-cart-btn mobile-cart-btn" href="{{ route('add.course.to.cart', $course->id) }}">
                                        Add To Cart
                                    </a>
                                    <br>
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

    <script>
        function add_tocartMobile(e) {
            var url = e.getAttribute('link');
            window.location.href=url;
        }
    </script>
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

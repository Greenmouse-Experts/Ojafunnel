<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Oja Funnel | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Bootstrap Css -->
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
                        <form class="inline-form mt-3" style="width: 80%;">
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
                                        <a href="{{ route('cart', $shop->name) }}" class="btn btn-primary btn-block">View all</a>
                                    </div>
                                </div>
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
                <div class="col-lg-12">
                    <h2 class="course-carousel-title mb-4">Courses</h2>
                </div>
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548204/OjaFunnel-Images/html_yhwt1x.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">Html Full Course</h5>
                                    <p class="instructors">Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum itaque ducimus, praesentium quasi non facilis culpa quas voluptatem repellat consectetur.</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div>
                                    <p class="price text-right">
                                        $300
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="webui-popover-content">
                            <div class="course-popover-content">
                                <div class="course-title">
                                    <a href="#">Html Full Course</a>
                                </div>
                                <div class="course-category">
                                    <span class="course-badge best-seller">Best seller</span>
                                    in
                                    <a href="">HTML</a>
                                </div>
                                <div class="course-meta">
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        Lessons
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        2 Hours
                                    </span>
                                    <span class="">
                                        <i class="fas fa-closed-captioning"></i>English
                                    </span>
                                </div>
                                <div class="course-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa tenetur ullam commodi totam autem pariatur, magni maxime voluptas quae dolorem.</div>
                                <div class="what-will-learn">
                                    <ul>
                                        Html courses
                                    </ul>
                                </div>
                                <div class="popover-btns">
                                    <a href="#">
                                        <button type="button" class="btn add-to-cart-btn addedToCart big-cart-button-1" id="1">
                                            Add To Cart
                                        </button>
                                    </a>
                                    <button type="button" class="wishlist-btn" title="Add to wishlist" id="1"><i class="fas fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>

</html>
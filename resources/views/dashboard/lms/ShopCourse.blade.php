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
                            <li><a class="mobile-nav-trigger" href="#mobile-primary-nav">Menu<span></span></a></li>
                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>

                        <a class="navbar-brand" href="/">
                            OJAFUNNEL SHOP
                        </a>

                        <form class="inline-form mt-3" style="width: 80%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>

                        <div class="wishlist-box menu-icon-box" id="wishlist_items">

                        </div>

                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>

                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="">
                                    <img src="{{ asset('dash/assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="dropdown user-dropdown corner-triangle top-right">
                                <ul class="user-dropdown-menu">

                                    <li class="dropdown-user-info">
                                        <a href="">
                                            <div class="clearfix">

                                                <div class="user-details">
                                                    <div class="user-name">
                                                        <span class="hi">hi,</span>

                                                    </div>
                                                    <div class="user-email">
                                                        <span class="welcome">Welcome back</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="user-dropdown-menu-item">
                                        <a href="#">
                                            <i class="far fa-gem"></i>My Courses
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="container home-banner-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home-banner-wrap">
                        <h2>Best place for learning</h2>
                        <p>Learn from any topic, choose from category</p>
                        <form class="" action="" method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search_string" placeholder="what do you want to learn?">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
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
                            <h4>online_courses</h4>
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

    <section class="course-carousel-area container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="course-carousel-title">Top Courses</h2>
                    <div class="course-carousel">
                        <div class="course-box-wrap">
                            <a href="#" class="has-popover">
                                <div class="course-box">
                                    <!-- <div class="course-badge position best-seller">Best seller</div> -->
                                    <div class="course-image">
                                        <img src="" alt="" class="img-fluid">
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
                                        <a href="#">Html For Biggers</a>
                                    </div>
                                    <!-- <div class="course-category">
                                            <span class="course-badge best-seller">Best seller</span>
                                            in
                                            <a href="">PHP</a>
                                        </div> -->
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
                                        <button type="button" class="btn add-to-cart-btn addedToCart big-cart-button-1" id="1">
                                            Added To Cart
                                        </button>
                                        <button type="button" class="btn add-to-cart-btn addedToCart big-cart-button-1" id="1">
                                            Add To Cart
                                        </button>
                                        <button type="button" class="wishlist-btn" title="Add to wishlist" id="1"><i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="course-carousel-area container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="course-carousel-title">Top 10 latest courses</h2>
                    <div class="course-carousel">
                        <div class="course-box-wrap">
                            <a href="#">
                                <div class="course-box">
                                    <div class="course-image">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="course-details">
                                        <h5 class="title">Hamzat Title</h5>
                                        <p class="instructors">first and last name of the instructor</p>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="d-inline-block average-rating">5</span>
                                        </div>
                                        <p class="price text-right">
                                            <small>
                                                $200
                                            </small>
                                            $100
                                        </p>
                                    </div>
                                </div>
                            </a>
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
    <!-- <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
  <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script> -->
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

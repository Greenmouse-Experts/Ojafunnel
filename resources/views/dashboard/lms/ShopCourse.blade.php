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
                        <a class="navbar-brand" href="{{route('user.dashboard', Auth::user()->username)}}">
                            Ojafunnel Shop
                        </a>
                        <form class="inline-form mt-3" style="width: 80%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="user-box menu-icon-box">
                        <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger"></span>
                            </a>
                            <div class="dropdown user-dropdown corner-triangle top-right">
                                <ul class="user-dropdown-menu">
                                    <li class="user-dropdown-menu-item">
                                        <a href="#">
                                           My learning
                                        </a>
                                        <a href="{{route('user.my.cart', Auth::user()->username)}}">
                                          My Cart
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="">
                                    <img src="{{ asset('dash/assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid">
                                </a>
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
                <div class="col-lg-1">
                </div>
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
    <section class="TopMontain">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="course-carousel-title mb-4">Top Courses</h2>
                </div>
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889791/OjaFunnel-Images/1565838_e54e_16_lmsw3n.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">The Complete 2023 Web Development Bootcamp</h5>
                                    <p class="instructors">Become a Full-Stack Web Developer with just ONE course. HTML, CSS, Javascript, Node, React, MongoDB, Web3 and DApps</p>
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
                                    <a href="#">The Complete 2023 Web Development Bootcamp</a>
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
                                <div class="course-subtitle">Become a Full-Stack Web Developer with just ONE course. HTML, CSS, Javascript, Node, React, MongoDB, Web3 and DApps</div>
                                <div class="course-category"><b>Price: $300</b></div>
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
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889925/OjaFunnel-Images/2776760_f176_10_1_ildih4.jpg" draggable="fa
                                    " alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">100 Days of Code: The Complete Python Pro Bootcamp for 2023</h5>
                                    <p class="instructors">Master Python by building 100 projects in 100 days. Learn data science, automation, build websites, games and apps!</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div>
                                    <p class="price text-right">
                                        $500
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="webui-popover-content">
                            <div class="course-popover-content">
                                <div class="course-title">
                                    <a href="#">Laravel Full Course</a>
                                </div>
                                <div class="course-category">
                                    <span class="course-badge best-seller">Best seller</span>
                                    in
                                    <a href="">PHP</a>
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
                                <div class="course-subtitle">Master Python by building 100 projects in 100 days. Learn data science, automation, build websites, games and apps!</div>
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
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889793/OjaFunnel-Images/1693472_e1d5_14_k7xwuy.jpg" draggable="fa
                                    " alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">SwiftUI Masterclass 2023 - iOS App Development & Swift</h5>
                                    <p class="instructors">The Complete iOS 16 and 15 App Development Course with SwiftUI From Beginner to Advanced App Developer with Xcode</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div>
                                    <p class="price text-right">
                                        $1000
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="webui-popover-content">
                            <div class="course-popover-content">
                                <div class="course-title">
                                    <a href="#">SwiftUI Masterclass 2023 - iOS App Development & Swift</a>
                                </div>
                                <div class="course-category">
                                    <span class="course-badge best-seller">Best seller</span>
                                    in
                                    <a href="">iOS App Development</a>
                                </div>
                                <div class="course-meta">
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        Lessons
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        9 Hours
                                    </span>
                                    <span class="">
                                        <i class="fas fa-closed-captioning"></i>English
                                    </span>
                                </div>
                                <div class="course-subtitle">The Complete iOS 16 and 15 App Development Course with SwiftUI From Beginner to Advanced App Developer with Xcode</div>

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
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548206/OjaFunnel-Images/vue_hie5ra.jpg" draggable="fa
                                    " alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">Vue'js Full Course</h5>
                                    <p class="instructors">Illum itaque ducimus, praesentium quasi adipisicing elit. Illum itaque ducimus, praesentium quasi non facilis culpa quas voluptatem repellat consectetur.</p>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">5</span>
                                    </div>
                                    <p class="price text-right">
                                        $1000
                                    </p>
                                </div>
                            </div>
                        </a>
                        <div class="webui-popover-content">
                            <div class="course-popover-content">
                                <div class="course-title">
                                    <a href="#">Vue'js Full Course</a>
                                </div>
                                <div class="course-category">
                                    <span class="course-badge best-seller">Best seller</span>
                                    in
                                    <a href="">Vue framework</a>
                                </div>
                                <div class="course-meta">
                                    <span class=""><i class="fas fa-play-circle"></i>
                                        Lessons
                                    </span>
                                    <span class=""><i class="far fa-clock"></i>
                                        9 Hours
                                    </span>
                                    <span class="">
                                        <i class="fas fa-closed-captioning"></i>English
                                    </span>
                                </div>
                                <div class="course-subtitle">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa tenetur ullam commodi totam autem pariatur, magni maxime voluptas quae dolorem.</div>
                                <div class="what-will-learn">
                                    <ul>
                                        Vue'js Course
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
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548204/OjaFunnel-Images/html_yhwt1x.jpg" alt="" class="img-fluid">
                                </div>
                                <div class="course-details">
                                    <h5 class="title">The Complete 2023 Web Development Bootcamp</h5>
                                    <p class="instructors">Become a Full-Stack Web Developer with just ONE course. HTML, CSS, Javascript, Node, React, MongoDB, Web3 and DApps</p>
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
                                    <a href="#">The Complete 2023 Web Development Bootcamp</a>
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
                                <div class="course-subtitle">Become a Full-Stack Web Developer with just ONE course. HTML, CSS, Javascript, Node, React, MongoDB, Web3 and DApps</div>
                                <div class="course-category"><b>Price: $300</b></div>
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
                <div class="col-lg-4">
                    <div class="course-box-wrap">
                        <a href="#" class="has-popover">
                            <div class="course-box">
                                <div class="course-badge position best-seller">Best seller</div>
                                <div class="course-image">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548205/OjaFunnel-Images/laravel_iupjh0.png" alt="" class="img-fluid">
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
    <section class="TopMontain">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="course-carousel-title mb-4">Top 10 latest courses</h2>
                </div>
                <div class="col-lg-4">
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
                <div class="col-lg-4">
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
                <div class="col-lg-4">
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
<style>

html {
    color: #222;
    font-size: 1em;
    line-height: 1.4;
}
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css");
@import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700;800;900&display=swap");
:-moz-selection {
    background: #b3d4fc;
    text-shadow: none;
}

::selection {
    background: #b3d4fc;
    text-shadow: none;
}

body {
    font-family: "Montserrat", sans-serif !important;
    padding-right: 0 !important;
    color: #29303b;
    font-size: 15px;
}

body.white-bg {
    background: #fff;
}

body.gray-bg {
    background: #f7f8fa;
}

body.modal-open {
    overflow: auto;
}

p {
    margin: 0 0 10.5px;
}

a,
button,
input[type="button"] {
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -ms-webkit-transition: all 0.3s;
}

a {
    color: #007791;
}

a:hover {
    text-decoration: none;
    color: #003845;
}

*[data-toggle="modal"],
button {
    cursor: pointer;
}

a:focus,
.btn:focus,
.form-control:focus,
button:focus,
input:focus,
textarea:focus,
select:focus {
    outline: none;
    box-shadow: 0 0 0 0 !important;
}

fieldset,
label {
    margin: 0;
    padding: 0;
}

.tooltip {
    pointer-events: none;
}

.btn {
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
    padding: 11px 12px;
    font-size: 15px;
    border-radius: 2px;
    line-height: 1.35135;
    font-weight: 600;
}

.btn:hover,
.btn:focus {
    background-color: #992337;
    border-color: #992337;
    color: #fff;
}

textarea:focus,
.form-control:focus,
input:focus {
    border-color: #76c5d6;
}

.rating i {
    color: #dedfe0;
}

.rating i.filled {
    color: #f4c150;
}

.rating i.half-filled {
    position: relative;
}

.rating i.half-filled:after {
    position: absolute;
    content: "\f089";
    top: 0;
    left: 0;
    font-size: inherit;
    color: #f4c150;
    z-index: 1;
}

/*lesson css*/
.lesson_duration {
    background-color: #7c96ab;
    border-radius: 5px;
    padding: 3px 5px;
    color: #fff;
}

/*
    bootstrap overwrite css
*/
.container-xl,
.container-lg {
    width: 100%;
    padding-right: 20px;
    padding-left: 20px;
    margin-right: auto;
    margin-left: auto
}

/*
    menu
*/

.corner-triangle.top-left:after {
    top: -12px;
    left: 14px;
}

.corner-triangle.top-left:before {
    top: -14px;
    left: 14px;
}

.corner-triangle.top-right:after {
    top: -12px;
    right: 14px;
}

.corner-triangle.top-right:before {
    top: -14px;
    right: 14px;
}

.corner-triangle:after {
    border-color: transparent transparent #fff;
}

.corner-triangle:before {
    border-color: transparent transparent #e8e9eb;
}

.corner-triangle:before,
.corner-triangle:after {
    border-style: solid;
    border-width: 0 10px 13px;
    content: "";
    height: 0;
    width: 0;
    position: absolute;
}

.menu-area {
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    position: relative;
    background-color: #fff;
    width: 100%;
    z-index: 999;
}

.menu-area .navbar {
    padding: 0;
}
.signin-box-move-mobile-helper,
.signin-box-move-desktop-helper {
    display: none;
}

/*

    menu code was here

*/

.search-box {
    margin-right: 50px;
    padding: 10px 0;
}

.search-box input {
    background-color: #f2f3f5;
    border: 1px solid #f2f3f5;
    height: 45px;
    padding: 0 15px;
    border-radius: 2px 0 0 2px;
    font-size: 13px;
}

.search-box input:focus {
    background-color: #fff;
    border-color: #dedfe0;
    border-right-color: transparent;
}

.search-box input:focus + .input-group-append button {
    background-color: #fff;
    border-color: #dedfe0;
    border-left-color: transparent;
}

.search-box button {
    border: 1px solid #f2f3f5;
    border-radius: 0 2px 2px 0;
    font-size: 15px;
    padding: 10px 15px;
    background: #f2f3f5;
    color: #ec5252;
}

.search-box button:hover,
.search-box button:focus {
    background-color: #ec5252 !important;
    border-color: #ec5252;
    color: #fff;
}

.menu-icon-box .empty-box {
    padding: 20px;
}

.menu-icon-box .empty-box p {
    margin-bottom: 0px;
}

.menu-icon-box .empty-box a {
    display: inline-block;
    font-weight: 600;
    margin-top: 15px;
}

.menu-icon-box {
    position: relative;
    margin: 0 5px;
}

.menu-icon-box .icon {
    position: relative;
}

.menu-icon-box .icon .number {
    position: absolute;
    top: 14px;
    right: 2px;
    background-color: #ec5252;
    border-radius: 15px;
    color: #fff;
    font-size: 10px;
    line-height: 1.43;
    min-width: 19px;
    padding: 2px 6px;
    text-align: center;
    pointer-events: none;
}

.menu-icon-box .icon a {
    height: 45px;
    width: 45px;
    text-align: center;
    line-height: 45px;
    display: inline-block;
    border-radius: 50%;
    color: #686f7a;
    border: 1px solid transparent;
    margin: 10px 0;
    font-size: 18px;
}

.menu-icon-box .icon a:hover {
    background: rgba(20, 23, 28, .05);
    border-color: rgba(20, 23, 28, .05);
}

.menu-icon-box:hover > .dropdown {
    opacity: 1;
    visibility: visible;
}

.menu-icon-box .dropdown {
    position: absolute;
    z-index: 10;
    opacity: 0;
    visibility: hidden;
    background-color: #fff;
    border-top: 1px solid #e8e9eb;
    box-shadow: 0 4px 16px rgba(20, 23, 28, .25);
    color: #505763;
    font-size: 13px;
    left: inherit;
    list-style: none;
    margin: 0;
    right: -1px;
    text-align: left;
    top: 100%;
    width: 330px;
}

.course-list-dropdown .item-list {
    max-height: 230px;
    overflow-y: auto;
    margin-bottom: 10px;
}

.course-list-dropdown .item-list ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.course-list-dropdown .item-list ul li {
    padding: 23px 23px 10px;
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -ms-webkit-transition: all 0.3s;
}

.course-list-dropdown .item-list ul li:hover {
    background: #f2f3f5;
}

.course-list-dropdown .item-list ul a {
    display: block;
}

.course-list-dropdown .item-list .item .item-image {
    width: 60px;
    float: left;
}

.course-list-dropdown .item-list .item .item-details {
    padding-left: 70px;
}

.course-list-dropdown .item-list .item .item-details .course-name {
    color: #505763;
    font-size: 13px;
    font-weight: 600;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    -webkit-line-clamp: 1;
    -moz-line-clamp: 1;
    -ms-line-clamp: 1;
    -o-line-clamp: 1;
    line-clamp: 1;
}

.course-list-dropdown .item-list .item .item-details .instructor-name {
    color: #686f7a;
    font-size: 13px;
}

.course-list-dropdown .item-list .item .item-details .current-price {
    color: #ec5252;
    font-size: 18px;
    font-weight: 600;
    margin-right: 5px;
}

.course-list-dropdown .item-list .item .item-details .original-price {
    text-decoration: line-through;
    color: #686f7a;
}

.course-list-dropdown .item-list .item .item-details .instructor-name {
    color: #686f7a;
    font-size: 13px;
}

.course-list-dropdown .item-list .item .item-details .current-price {
    color: #ec5252;
    font-size: 18px;
    font-weight: 600;
    margin-right: 5px;
}

.course-list-dropdown .item-list .item .item-details .original-price {
    text-decoration: line-through;
    color: #686f7a;
}

.course-list-dropdown .item-list .item .item-details button {
    padding: 2px 8px;
    font-size: 13px;
    line-height: 1.35135;
    border-radius: 2px;
    width: 100%;
    color: #007791;
    background-color: #fff;
    border: 1px solid #007791;
}

.course-list-dropdown .item-list .item .item-details button:hover,
.course-list-dropdown .item-list .item .item-details button:focus {
    background: #e6f2f5;
}

.course-list-dropdown .dropdown-footer {
    background: #f2f3f5;
    padding: 5px 20px 25px;
}

.course-list-dropdown .dropdown-footer a {
    width: 100%;
    border: 0;
    color: #fff;
    background-color: #007791;
    padding: 11px 12px;
    font-size: 15px;
    line-height: 1.43;
    border-radius: 2px;
    font-weight: 600;
    margin-top: 20px;
    display: block;
    text-align: center;
}

.course-list-dropdown .dropdown-footer a:hover,
.course-list-dropdown .dropdown-footer a:focus {
    background: #003440;
}

.course-list-dropdown .dropdown-footer .cart-total-price {
    color: #686f7a;
    font-size: 15px;
    margin-top: 8px;
}

.course-list-dropdown .dropdown-footer .cart-total-price .current-price {
    color: #ec5252;
    font-size: 18px;
    font-weight: 600;
    margin-right: 5px;
}

.course-list-dropdown .dropdown-footer .cart-total-price .original-price {
    text-decoration: line-through;
    color: #686f7a;
    font-size: 14px;
}

.notifications-list-dropdown .notifications-head {
    padding: 12px;
    font-size: 15px;
    border-bottom: 1px solid hsla(210, 3%, 87%, .45);
    color: #29303b;
}

.notifications-list-dropdown .notifications-footer {
    background: #f7f8fa;
    height: 58px;
    box-shadow: 0 -3px 5px rgba(0, 0, 0, .05);
}

.notifications-list-dropdown .notifications-footer a,
.notifications-list-dropdown .notifications-footer button {
    color: #007791;
    font-size: 13px;
    font-weight: 600;
    padding: 20px 15px;
}

.notifications-list-dropdown .notifications-footer button {
    border: 0;
    background: transparent;
}

.notifications-list-dropdown .notifications-footer a:hover,
.notifications-list-dropdown .notifications-footer button:hover,
.notifications-list-dropdown .notifications-footer a:focus,
.notifications-list-dropdown .notifications-footer button:focus {
    color: #004d5e;
    background: #f2f3f5;
}

.notifications-list-dropdown .notifications-footer a i {
    margin-left: 5px;
    margin-right: 5px;
    transition: inherit;
    -webkit-transition: inherit;
    -ms-webkit-transition: inherit;
}

.notifications-list-dropdown .notifications-footer a:hover i {
    transform: translateX(5px);
}

.notification-list ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.notification-list ul li {
    padding: 10px 15px;
    border-bottom: 1px solid hsla(210, 3%, 87%, .45);
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
    -ms-webkit-transition: all 0.3s;
}

.notification-list ul li:hover {
    background: #f7f8fa;
}

.notification-list ul li a {
    display: block;
}

.notification-list .notification .notification-image {
    float: left;
    height: 64px;
    width: 64px;
}

.notification-list .notification .notification-details {
    padding-left: 74px;
}

.notification-list .notification .notification-details .notification-text {
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2;
    -moz-line-clamp: 2;
    -ms-line-clamp: 2;
    -o-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    width: 210px;
    height: 40px;
    color: #505763;
    margin-bottom: 0;
    line-height: 1.5;
}

.notification-list .notification .notification-details .notification-time {
    color: #686f7a;
    font-size: 13px;
    margin-top: 5px;
    margin-bottom: 0;
}

.notification-list .notification .notification-image img {
    border-radius: 50%;
}

.notification-list .notification {
    position: relative;
}

.notifications-list-dropdown .notification-list {
    max-height: 415px;
    overflow-y: auto;
}

.notification-list .notification .mark-as-read {
    position: absolute;
    height: 10px;
    width: 10px;
    border: 1px solid #007791;
    border-radius: 50%;
    top: 2px;
    right: -3px;
    background: #007791;
}

.notification-list .notification .mark-as-read.marked {
    border-color: rgba(41, 48, 59, .25);
    background-color: transparent;
}

.user-box.menu-icon-box .icon a img {
    border-radius: 50%;
    height: 45px;
    width: 45px;
    margin-top: -5px;
}

.user-dropdown-menu {
    margin: 0;
    padding: 0;
    padding-top: 10px;
    list-style: none;
}

.user-dropdown-menu li a {
    display: block;
    color: #29303b;
    font-size: 15px;
    font-weight: 400;
    padding: 10px 22px;
}

.user-dropdown-menu li a:hover {
    color: #007791;
    background: #f2f3f5;
}

.user-dropdown-menu li a i {
    font-size: 16px;
    width: 20px;
    text-align: center;
    margin: 0 19px 0 10px;
    color: #a1a7b3;
}

.dropdown-user-info .user-image img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #f2f3f5;
}

.dropdown-user-info .user-details {
    padding-left: 50px;
}

.dropdown-user-info .user-details .user-name {
    color: #29303b;
}

.dropdown-user-info .user-details .user-email {
    color: #686f7a;
    font-size: 13px;
}

.dropdown-user-info .user-details .user-name .hi,
.dropdown-user-info .user-details .user-email .welcome {
    display: none;
}

.user-dropdown-menu .dropdown-user-logout {
    padding: 10px 0;
    background: #f7f8fa;
}

.sign-in-box > .btn {
    padding: 11px 12px;
    font-size: 15px;
    border-radius: 2px;
    line-height: 1.35135;
    font-weight: 600;
    margin-left: 5px !important;
    border-radius: 2px !important;
}

.sign-in-box .btn-sign-in {
    color: #686f7a;
    background-color: #fff;
    border: 1px solid #505763;
}

.sign-in-box .btn-sign-in:hover,
.sign-in-box .btn-sign-in:focus {
    background-color: #f2f3f5;
}

.sign-in-box .btn-sign-up {
    color: #fff;
    background-color: #ec5252;
    border: 1px solid #ec5252;
}

.sign-in-box .btn-sign-up:hover,
.sign-in-box .btn-sign-up:focus {
    background-color: #992337;;
    border-color: #992337;;
}

.sign-in-box .modal-dialog {
    max-width: 400px;
}

.sign-in-modal .modal-title {
    color: #29303b;
    font-weight: 700;
    font-size: 15px;
}

.sign-in-modal .close {
    font-size: 2rem;
    padding: 0.5rem 1rem;
}

.sign-in-modal .modal-header {
    border-bottom: 1px solid rgba(41, 48, 59, .1);
    background-color: #f2f3f5;
}

.sign-in-modal .modal-header,
.sign-in-modal .modal-body {
    padding: 20px 25px;
}

.sign-in-modal .social-btn {
    box-shadow: 0 2px 2px 0 rgba(41, 48, 59, .24), 0 0 2px 0 rgba(41, 48, 59, .12);
    border-radius: 2px;
    margin-bottom: 10px;
    padding: 0 20px 0 0;
    font-size: 16px;
    font-weight: 700;
    background-color: #fff;
}

.sign-in-modal .social-btn a {
    display: block;
}

.sign-in-modal .icon {
    display: inline-block;
    font-size: 20px;
    font-weight: 400;
    margin-right: 10px;
    padding: 15px 0 15px 5px;
    text-align: center;
    width: 50px;
}

.sign-in-modal .icon.google-icon {
    background: url(../img/icons/google_icon.svg) no-repeat 50%;
    background-size: 24px;
    color: #fff;
    color: rgba(0, 0, 0, 0);
}

.sign-in-modal .social-btn.fb-sign-up {
    background-color: #1a538a;
}

.sign-in-modal .social-btn.fb-sign-up a {
    color: #fff;
}

.sign-in-modal .social-btn.google-sign-up a {
    color: #686f7a;
}

.sign-in-modal .sign-in-separator {
    font-size: 11px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 10px;
    padding-top: 3px;
    position: relative;
}

.sign-in-modal .sign-in-separator:after,
.sign-in-modal .sign-in-separator:before {
    position: absolute;
    height: 1px;
    background-color: #dedfe0;
    content: "";
    top: 10px;
    width: calc(50% - 20px);
}

.sign-in-modal .sign-in-separator:before {
    left: 0
}

.sign-in-modal .sign-in-separator:after {
    right: 0
}

.sign-in-modal .input-group {
    margin-bottom: 10px;
    position: relative;
}

.sign-in-modal .input-group .input-field-icon {
    position: absolute;
    top: 15px;
    height: 20px;
    width: 20px;
    text-align: center;
    line-height: 20px;
    z-index: 10;
    left: 10px;
    color: #dedfe0;
    font-size: 18px;
}

.sign-in-modal .input-group .form-control {
    border-radius: 5px;
    color: #29303b;
    font-size: 18px;
    height: auto;
    padding: 11px 10px 12px 40px;
    background-color: #fff;
    border: 1px solid #cacbcc;
}

.sign-in-modal .input-group .form-control:focus {
    border-color: #76c5d6;
}

.sign-in-modal .deal-checkbox {
    margin-bottom: 10px;
    font-size: 15px;
    cursor: pointer;
}

.sign-in-modal .custom-checkbox .custom-control-label::before {
    border-radius: 1px;
    border: 1px solid #cacbcc;
    background-color: transparent;
}

.sign-in-modal .custom-control-input:hover ~ .custom-control-label::before,
.sign-in-modal .custom-control-input:focus ~ .custom-control-label::before {
    box-shadow: 0 0 0 0px #fff, 0 0 0 0 rgba(0, 123, 255, .25);
    border-color: #007791;
}

.sign-in-modal .custom-checkbox .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #007791;
    border-color: #007791;
}

.sign-in-modal form button[type="submit"] {
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
    font-size: 16px;
    font-weight: 700;
    height: 50px;
    width: 100%;
    padding: 11px 12px;
    border-radius: 2px;
}

.sign-in-modal form button[type="submit"]:hover,
.sign-in-modal form button[type="submit"]:focus {
    background-color: #521822 !important;
    border-color: #521822 !important;
}

.sign-in-modal .forgot-pass {
    text-align: center;
    font-size: 15px;
}

.sign-in-modal .agreement-text {
    text-align: center;
    font-size: 10px;
    margin: 10px 0;
}

.sign-in-modal .account-have {
    text-align: center;
    font-size: 15px;
    padding-top: 15px;
    border-top: 1px solid #dedfe0;
}

.sign-in-modal .account-have a {
    font-weight: 700;
}

.sign-in-modal .forgot-email.form-control {
    font-size: 16px;
    padding: 10px 12px;
    border-radius: 2px;
}

.sign-in-modal .forgot-pass-btn {
    text-align: center;
    margin-top: 15px;
    font-size: 15px;
}

.sign-in-modal .forgot-pass-btn .btn {
    width: auto;
    height: auto;
    padding: 11px 12px;
    font-size: 15px;
}

.sign-in-modal .forgot-pass-btn span {
    margin: 0 5px;
}

.sign-in-modal .forgot-recaptcha {
    margin: 25px 0 15px;
}

.course-preview-modal .modal-header {
    border-color: #000;
}

.course-preview-modal {
    background-color: #29303b;
    color: #fff;
}

.course-preview-modal .modal-title {
    font-size: 18px;
}

.course-preview-modal .modal-title span {
    color: #76c5d6;
    margin-right: 5px;
}

.course-preview-modal .close {
    color: #fff;
    text-shadow: 0 0 0 #fff;
    opacity: 1;
    font-size: 27px;
}

.course-preview-modal .modal-body {
    padding: 0;
}

.course-preview-modal .course-preview-video-list .title {
    font-size: 18px;
    color: #dedfe0;
    padding: 7px 15px;
}

.course-preview-modal .course-preview-video-list ul {
    margin: 0;
    padding: 0;
    list-style: none;
    margin-bottom: 10px;
}

.course-preview-modal .course-preview-video-list .course-preview-free-video {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

.course-preview-modal .course-preview-video-list .course-preview-free-video .course-image {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 18%;
    flex: 0 0 18%;
    max-width: 18%;
}

.course-preview-modal .course-preview-video-list .course-preview-free-video .course-name {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 82%;
    flex: 0 0 82%;
    max-width: 82%;
    padding-left: 15px;
    font-size: 13px;
}

.course-preview-modal .course-preview-video-list .course-preview-free-video .course-name i {
    font-size: 12px;
    margin-right: 7px;
}

.course-preview-modal .course-preview-video-list li {
    padding: 7px 15px;
    cursor: pointer;
}

.course-preview-modal .course-preview-video-list li.active {
    background-color: #505763;
}

/*
    homepage styles
*/
.home-banner-area {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    padding: 130px 0 120px;
    color: #fff;
    background-image:linear-gradient(50deg,  #0000007e, #0000007e), url(https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889039/OjaFunnel-Images/5e66494d-7bdd-4c76-8eba-8d6efbb924b3_nppuwu.jpg);
}

.home-banner-wrap {
    max-width: 500px;
}

.home-banner-wrap h2 {
    font-size: 44px;
    font-weight: 600;
    line-height: 1;
    margin-bottom: 10px;
    text-shadow: 0 2px 4px rgba(41, 48, 59, .55);
}

.home-banner-wrap p {
    font-size: 18px;
    line-height: 34px;
    margin-bottom: 30px;
    text-shadow: 0 2px 4px rgba(41, 48, 59, .55);
}

.home-banner-wrap input[type="text"] {
    font-size: 20px;
    height: 50px;
    padding: 11px 17px;
    border: none;
    border-radius: 3px 0 0 3px;
    font-weight: 300
}

.home-banner-wrap .btn {
    padding: 10px 14px;
    font-size: 20px;
    background: #fff;
    border: 0;
    border-radius: 0 3px 3px 0;
    color: #ec5252;
}

.home-banner-wrap .btn:hover {
    background: #ec5252;
    color: #fff;
}

.home-fact-area {
    background: linear-gradient(50deg,  #0000007e, #0000007e);
    background: -moz-linear-gradient(-45deg, #ec5252 0, #6e1a52 100%);
    background: -ms-linear-gradient(-45deg, #ec5252 0, #6e1a52 100%);
    background: -o-linear-gradient(-45deg, #ec5252 0, #6e1a52 100%);
    background: linear-gradient(-45deg, #ec5252, #6e1a52);
    color: #fff;
    padding: 15px 0;
    margin-bottom: 50px
}

.home-fact-box .text-box {
    padding: 10px 0 10px 63px;
}

.home-fact-box i {
    font-size: 47px;
    margin-top: 8px;
}

.home-fact-box .text-box h4 {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 0;
}

.home-fact-box .text-box p {
    font-size: 15px;
    margin-bottom: 0;
}

.course-carousel-area {
    margin-bottom: 20px;
    overflow-x: hidden;
}

.course-carousel-area .course-carousel-title {
    font-size: 20px;
    color: #505763;
    margin: 0 0 10px;
}

.course-carousel-area .slick-slider {
    width: calc(100% + 16px);
    margin-left: -8px;
}

.course-carousel-area .slick-list:before,
.course-carousel-area .slick-list:after {
    position: absolute;
    content: "";
    top: 0;
    right: 0;
    height: 100%;
    width: 8px;
    background: #f7f8fa;
    z-index: 1;
}

.course-carousel-area .slick-list:after {
    right: auto;
    left: 0
}

.course-carousel .slick-prev:hover,
.course-carousel .slick-next:hover {
    box-shadow: 0 2px 8px 2px rgba(20, 23, 28, .15);
}

.course-carousel .slick-prev:focus,
.course-carousel .slick-next:focus {
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1) !important;
}

.course-carousel .slick-prev,
.course-carousel .slick-next {
    width: 47px;
    height: 47px;
    border-radius: 50%;
    background-color: #fff;
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    z-index: 1;
    top: calc(50% - 25px);
}

.course-carousel .slick-prev {
    left: -28px;
}

.course-carousel .slick-prev.slick-disabled,
.course-carousel .slick-next.slick-disabled {
    opacity: 0;
}

.course-carousel .slick-prev:before {
    content: url(../img/icons/prev_arrow.png);
    line-height: 0;
    opacity: 1
}

.course-carousel .slick-next {
    right: -15px
}

.course-carousel .slick-next:before {
    content: url(../img/icons/next_arrow.png);
    line-height: 0;
    opacity: 1;
}

.course-box-wrap:focus {
    outline: none;
}

.course-box-wrap {
    padding: 0 8px;
    margin-bottom: 20px;
}

.course-box-wrap a {
    color: #fff;
}

.course-box-wrap a:hover {
    text-decoration: none;
}

.course-box {
    position: relative;
    background: #fff;
}

.course-box:before,
.course-box:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    will-change: opacity;
    transition: .2s ease;
    -webkit-transition: .2s ease;
    -ms-webkit-transition: .2s ease;
    z-index: -1;
}

.course-box:before {
    opacity: 1;
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    -webkit-box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    -ms-webkit-box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
}

.course-box:after {
    opacity: 0;
    box-shadow: 0 2px 8px 2px rgba(20, 23, 28, .15);
    -webkit-box-shadow: 0 2px 8px 2px rgba(20, 23, 28, .15);
    -ms-webkit-box-shadow: 0 2px 8px 2px rgba(20, 23, 28, .15);
}

.course-box:hover:before {
    opacity: 0;
}

.course-box:hover:after {
    opacity: 1;
}

.course-box .play-btn {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background: url(../img/icons/icon-play.svg) no-repeat;
    background-size: auto 40%;
    background-position: 50%;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: .2s;
    -moz-transition: .2s;
    -o-transition: .2s;
    transition: .2s;
    z-index: 1
}

.course-box .course-image:hover > .play-btn {
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
    visibility: visible;
    opacity: 1;
}

.course-box .course-details {
    padding: 15px 10px 0px 15px;
    position: relative;
}

.course-box .course-details .title {

    font-weight: 600;
    font-size: 15px;
    color: #29303b;
}

.course-box .course-details .instructors {
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 1;
    -moz-line-clamp: 1;
    -ms-line-clamp: 1;
    -o-line-clamp: 1;
    line-clamp: 1;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    margin-top: 5px;
    font-size: 15px;
    color: #000;
    margin-bottom: 5px;
}

.course-box .course-details .rating {
    margin-top: 15px;
}

.course-box .course-details .rating i {
    font-size: 11px;
}

.course-box .course-details .rating .rating-number {
    color: #29303b;
    margin-bottom: 0;
    font-size: 12px;
}

.course-box .course-details .rating .rating-number span {
    font-weight: 600;
    color: #a1a7b3;
    margin-left: 5px;
}

.course-box .course-details .price {
    padding-bottom: 15px;
    color: #29303b;
    font-size: 18px;
    font-weight: 600;
    margin-right: 10px;
}

.course-box .course-details .price small {
    color: #686f7a;
    font-weight: 400;
    font-size: 13px;
    margin-right: 5px;
    text-decoration: line-through;
}

.course-box .course-details .completed-percent .progress-bar {
    background: #007791;
}

.course-box .course-details .completed-percent .progress {
    border-radius: 0;
    height: 2px;
    background-color: rgba(41, 48, 59, .25);
}

.course-box .course-details .completed-percent {
    margin-top: 10px;
    padding-bottom: 30px;
}

.course-box .course-details .completed-percent .text {
    width: 50%;
    color: #686f7a;
    font-size: 13px;
}

.course-box .course-details .your-rating-box {
    position: absolute;
    right: 10px;
    bottom: 3px;
    margin-bottom: 0;
    z-index: 1;
    text-align: right;
}

.course-box .course-details .your-rating-box .your-rating-text {
    margin-bottom: 0;
    font-size: 13px;
    color: #29303b;
    margin-top: 2px;
}

.course-box .course-details .your-rating-box:hover .your-rating-text {
    color: #ec5252;
}

.course-box .course-details .your-rating-box .your-rating-text .edit {
    display: none;
}

.course-box .course-details .your-rating-box:hover .your-rating-text .edit {
    display: unset;
}

.course-box .course-details .your-rating-box:hover .your-rating-text .your {
    display: none;
}

.course-box .course-details .your-rating-box i {
    color: transparent;
    text-stroke: 1px #eaeaea;
    -webkit-text-stroke: 1px #eaeaea;
    font-size: 17px;
    letter-spacing: -0.1em;
}

.course-box .course-details .your-rating-box i.filled {
    color: #f4c150;
}

.course-badge {
    color: #29303b;
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    pointer-events: none;
    border-radius: 3px;
    font-size: 9px;
    padding: 1px 8px;
    font-weight: 700;
    position: relative;
    line-height: 1.5;
    text-align: center;
    text-transform: uppercase;
    display: inline-block;
}

.course-badge:after {
    border-radius: 3px;
    right: -4px;
    background: inherit;
    content: "";
    height: 11px;
    position: absolute;
    top: 2px;
    transform: rotate(45deg);
    width: 11px;
    z-index: 0;
    display: block;
}

.course-badge.best-seller {
    background: #f4c150
}

.course-badge.hot-new {
    background: #ec5252;
    color: #fff;
}

.course-badge.position {
    position: absolute;
    top: 12px;
    left: 0;
    border-bottom-left-radius: 0;
    border-top-left-radius: 0;
}

.course-box .course-image {
    position: relative;
}

.course-box .course-image:before {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    content: "";
    background-color: rgba(0, 0, 0, 0.3);
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    transition: 0.2s;
    -webkit-transition: 0.2s;
    -ms-webkit-transition: 0.2s;
}

.course-box .wishlist-add,
.course-box .favorite-add {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
}

.course-box .wishlist-add button,
.course-box .favorite-add button {
    margin: 0;
    padding: 0;
    border: 0;
    background: none;
    cursor: pointer;
}

.course-box .wishlist-add button:hover i,
.course-box .wishlist-add.wishlisted button i,
.course-box .favorite-add button:hover i,
.course-box .favorite-add.added button i {
    color: #ec5252;
}

.course-box .wishlist-add button i,
.course-box .favorite-add button i {
    text-stroke: 1px #fff;
    -webkit-text-stroke: 1px #fff;
    font-size: 16px;
    color: #686f7a;
}

.course-box .instructor-img-hover {
    position: absolute;
    display: flex;
    flex-direction: column;
    text-align: left;
    top: 10px;
    left: 10px;
    z-index: 1;
    opacity: 0;
    visibility: hidden;
    transition: 0.2s;
    -webkit-transition: 0.2s;
    -ms-webkit-transition: 0.2s;
}

.course-box .instructor-img-hover img {
    border: 3px solid #fff;
    width: 48px;
    height: 48px;
    margin-bottom: 8px;
}

.course-box .instructor-img-hover span {
    color: #fff;
    font-weight: 600;
    font-size: 13px;
    text-stroke: .4px #fff;
    -webkit-text-stroke: .4px #fff
}

.course-box:hover .instructor-img-hover,
.course-box:hover .course-image:before {
    opacity: 1;
    visibility: visible;
}

.webui-popover {
    box-shadow: 0 4px 16px rgba(20, 23, 28, .25);
    border-color: transparent;
    border-radius: 2px;
}

.course-popover-content .last-updated {
    margin: 10px 0;
    font-size: 13px;
}

.course-popover-content .course-title a {
    visibility: visible;
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 3;
    -moz-line-clamp: 3;
    -ms-line-clamp: 3;
    -o-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    font-size: 18px;
    font-weight: 600;
    line-height: 1.33;
    letter-spacing: -.3px;
    color: #505763;
}

.course-popover-content .course-title a:hover {
    text-decoration: underline;
}

.course-popover-content .course-category {
    color: #686f7a;
    font-size: 11px;
    margin-top: 7px;
}

.course-popover-content .course-category .course-badge {
    margin-right: 10px;
    box-shadow: 0 0 0;
}

.course-popover-content .course-meta span {
    margin-right: 10px;
    font-size: 13px;
    color: #7a7d82;
}

.course-popover-content .course-meta span i {
    font-size: 12px;
    margin-right: 5px;
}

.course-popover-content .course-meta {
    padding: 5px 0;
}

.course-popover-content .course-subtitle {
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 3;
    -moz-line-clamp: 3;
    -ms-line-clamp: 3;
    -o-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    visibility: visible;
    font-size: 15px;
    line-height: 1.53;
    letter-spacing: -.2px;
    color: #686f7a;
    padding-top: 10px;
}

.course-popover-content .what-will-learn {
    margin-top: 15px;
}

.course-popover-content .what-will-learn ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.course-popover-content .what-will-learn ul li {
    position: relative;
    padding-left: 20px;
    margin-bottom: 10px;
    max-height: 54px;
    visibility: visible;
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 3;
    -moz-line-clamp: 3;
    -ms-line-clamp: 3;
    -o-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    font-size: 13px;
    letter-spacing: -.2px;
    color: #686f7a;
}

.course-popover-content .what-will-learn ul li:before {
    content: ".";
    font-weight: 900;
    position: absolute;
    left: 0;
    top: 2px;
    font-size: 30px;
    line-height: 0;
    color: #dedfe0;
}

.course-popover-content .popover-btns {
    margin-top: 40px;
    padding-right: 65px;
    position: relative;
    margin-bottom: 15px;
}

.course-popover-content .popover-btns .add-to-cart-btn {
    width: 100%;
    padding: 14px 12px;
}

.addedToCart {
    color: #000;
    background-color: #ffffff;
    border-color: #EFD7FF;
    border-radius: 5px;
}

.addedToCart:hover {
    color: #fff;
    background-color: #713F93;
    border-color: #713F93;
}

.course-popover-content .popover-btns .wishlist-btn {
    position: absolute;
    right: 8px;
    top: 8px;
    border: none;
    background: none;
    font-size: 24px;
}

.course-popover-content .popover-btns .wishlist-btn i {
    color: transparent;
    text-stroke: 1px #000;
    -webkit-text-stroke: 1px #000;
}

.course-popover-content .popover-btns .wishlist-btn.active i,
.course-popover-content .popover-btns .wishlist-btn:hover i {
    color: #000;
}

.webui-popover.left > .webui-arrow,
.webui-popover.left-top > .webui-arrow,
.webui-popover.left-bottom > .webui-arrow {
    border-left-color: rgba(20, 23, 28, .1);
}

.webui-popover.right > .webui-arrow,
.webui-popover.right-top > .webui-arrow,
.webui-popover.right-bottom > .webui-arrow {
    border-right-color: #999;
    border-right-color: rgba(20, 23, 28, .1);
}

/*
    course page style
*/

/*
    course header
*/
section.course-header-area {
    background-color: #29303b;
    color: #fff;
    padding: 60px 0;
}

.course-header-area.duplicated {
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 9;
    background-color: rgba(41, 48, 59, .8);
    padding: 10px 0;
}

.course-header-area.duplicated .title {
    font-size: 20px;
    font-weight: 600;
    line-height: 28px;
    margin-bottom: 0;
}

.course-header-area.duplicated .subtitle,
.course-header-area.duplicated .course-badge,
.course-header-area.duplicated .created-row {
    display: none;
}
.course-header-wrap{
    margin-top: 50px;
}

.course-header-wrap .title {
    font-size: 36px;
    line-height: 41px;
    font-weight: 600;
    margin-bottom: 10.5px;
}

.course-header-wrap .subtitle {
    font-size: 21px;
    line-height: 27px;
    margin-bottom: 7px;
}

.course-header-wrap > div > span {
    margin-right: 12px;
    margin-bottom: 7px;
    font-size: 15px;
}

.course-header-wrap .rating p {
    margin-bottom: 0;
}

.course-header-wrap .rating i {
    font-size: 14px;
    color: #f4c150;
}

.course-header-wrap a {
    color: #fff;
}

.course-header-wrap .course-badge {
    font-size: 9px !important;
}

.course-header-wrap .comment i {
    margin-right: 7px;
    font-size: 13px;
}

/*
    course sidebar
*/
.course-sidebar {
    background-color: #fff;
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, .1), 0 3px 1px 0 rgba(20, 23, 28, .1);
    border-radius: 4px;
    color: #505763;
    padding: 3px;
    margin-top:10px;
    z-index: 10;
}

.course-sidebar.fixed {
    position: fixed;
    margin-top: 0;
    width: 350px;
}

.course-sidebar.fixed .preview-video-box,
.course-sidebar.bottom .preview-video-box {
    display: none;
}

.course-sidebar.bottom {
    margin-top: 0;
}

.preview-video-box a {
    display: block;
    color: #fff;
    overflow: hidden;
    position: relative;
}

.preview-video-box .preview-text {
    position: absolute;
    width: 100%;
    bottom: 10px;
    left: 0;
    text-align: center;
    height: auto;
    font-size: 15px;
    font-weight: 700;
}

.preview-video-box .play-btn {
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    position: absolute;
    background: url('../img/icons/icon-play.svg') no-repeat;
    background-size: auto 50%;
    background-position: 50%;
    visibility: visible;
    -webkit-transition: -webkit-transform .15s ease-in-out;
    -moz-transition: -moz-transform .15s ease-in-out;
    -o-transition: -o-transform .15s ease-in-out;
    transition: transform .15s ease-in-out;
}

.preview-video-box a:hover > .play-btn {
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}

.course-sidebar-text-box {
    padding: 15px 30px;
}

.course-sidebar-text-box .price .current-price {
    color: #505763;
    font-size: 36px;
    font-weight: 700;
    line-height: 40px;
    margin-right: 10px;
}

.course-sidebar-text-box .price span {
    vertical-align: middle;
    color: #a1a7b3;
    margin-right: 10px;
}

.course-sidebar-text-box .price .original-price {
    text-decoration: line-through;
}

.course-sidebar-text-box .offer-time {
    color: #208058;
    font-size: 14px;
    margin-bottom: 10px;
}

.course-sidebar-text-box .offer-time i {
    margin-right: 7px;
}

.course-sidebar-text-box .buy-btns .btn {
    display: block;
    width: 100%;
    margin: 0;
    border-radius: 2px;
    margin-top: 13px;
    padding: 15px 12px;
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 10px;
}

.course-sidebar-text-box .buy-btns .btn-buy-now {
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
}

.course-sidebar-text-box .buy-btns .btn-buy-now:hover, .course-sidebar-text-box .buy-btns .btn-buy-now:focus {
    background-color: #992337;
    border-color: #992337;
}

.course-sidebar-text-box .buy-btns .btn-add-cart {
    background: transparent;
    border-color: #505763;
    color: #686f7a;
}

.course-sidebar-text-box .buy-btns .btn-add-cart:hover, .course-sidebar-text-box .buy-btns .btn-add-cart:focus {
    background-color: #f2f3f5;
}

.course-sidebar-text-box .money-back {
    display: block;
    font-size: 12px;
    font-weight: 400;
    margin-bottom: 12px;
    margin-top: 10px;
}

.course-sidebar-text-box .includes {
    margin-bottom: 15px;
}

.course-sidebar-text-box .includes ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.course-sidebar-text-box .includes ul li {
    font-size: 13px;
    padding: 3px;
}

.course-sidebar-text-box .includes ul li i {
    width: 19px;
    font-size: 12px;
}

/*
    course content
*/
.view-more-parent {
    position: relative;
    overflow: hidden;
}

.view-more {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: linear-gradient(hsla(0, 0%, 100%, 0), hsla(0, 0%, 100%, .95), #fff);
    display: block;
    padding: 30px 3px 3px 3px;
    color: #000;
    cursor: pointer;
    z-index: 5;
    font-size: 12px;
}

.view-less {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    display: block;
    padding: 3px 3px 3px 3px;
    color: #000;
    cursor: pointer;
}

.view-more-parent.expanded {
    max-height: none;
    overflow: visible;
}

.view-more-parent.has-hide {
    padding-bottom: 30px;
}

.description-box {
    max-height: 260px;
    margin-top: 40px;
    margin-bottom: 40px;
}

.description-box ul {
    list-style: disc;
}

.description-box .description-title {
    font-size: 17px;
    font-weight: 500;
    color: #000 !important;
    margin: 0 0 10px;
}

.description-box .audience {
    margin-top: 20px;
}

.description-box .audience .audience-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 10px;
}

.description-box .audience ul {
    margin-bottom: 0;
}

.what-you-get-box {
    background-color: #fff;
    border: 1px solid #EFD7FF;
    padding: 10px 15px;
    margin-top: 40px;
}

.what-you-get-box .what-you-get-title {
    font-size: 17px;
    font-weight: 600;
    margin: 0 0 10px;
    color: #000;
}

.what-you-get-box ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
}

.what-you-get-box ul li {
    display: flex;
    margin-bottom: 10px;
    width: 45%;
    padding-left: 26px;
    font-size: 13px;
    position: relative;
}

.what-you-get-box ul li:before {
    font-family: Font Awesome\ 5 Free;
    font-weight: 900;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f00c";
    color: #a1a7b3;
    font-size: 14px;
    position: absolute;
    left: 0;
    top: 4px;
}

.requirements-box {
    margin-top: 40px;
}

.requirements-box .requirements-title {
    font-size: 17px;
    font-weight: 600;
    margin: 0 0 10px;
}

.requirements-box .requirements__list {
    list-style: disc;
    margin-left: 10px;
    padding-left: 10px;
    margin-bottom: 0;
    font-size: 13px !important;
}

.requirements-box .requirements__list li:not(:last-child) {
    margin-bottom: 10px;
}

.compare-box {
    max-height: 580px;
    margin-bottom: 40px;
}

.compare-box .compare-title {
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 15px;
}

.course-comparism-item .item-image {
    height: auto;
    width: 18%;
    position: relative;
}

.course-comparism-item {
    color: #29303b;
    padding: 15px;
}

.course-comparism-item-container {
    border-top: 1px solid #dedfe0;
}

.course-comparism-item-container a {
    display: block;
    transition: .1s;
    -webkit-transition: .1s;
    -ms-webkit-transition: .1s;
}

.course-comparism-item-container a:hover {
    background-color: #dedfe0;
}

.course-comparism-item-container.this-course {
    border-bottom: 2px solid #dedfe0;
}

.course-comparism-item-container.this-course .course-comparism-item-this-text {
    font-size: 11px;
    margin-left: 15px;
    text-transform: uppercase;
    margin-bottom: -5px;
    margin-top: 5px;
}

.course-comparism-item .item-image .item-duration {
    position: absolute;
    width: 100%;
    bottom: 0;
    text-align: center;
    left: 0;
    background-color: hsla(0, 0%, 100%, .95);
}

.course-comparism-item .item-title {
    padding-left: 15px;
    width: 39%;
}

.course-comparism-item .item-title .title {
    font-size: 15px;
    font-weight: 700;
    word-break: break-word;
}

.course-comparism-item .item-title .updated-time {
    color: #686f7a;
    font-size: 13px;
    margin-top: 3px;
}

.course-comparism-item .item-details {
    position: relative;
    width: 43%;
    padding-left: 15px;
}

.course-comparism-item .item-details .wishlist-btn {
    position: absolute;
    right: 0;
    top: 0;
}

.course-comparism-item .item-details .item-rating i {
    color: #f4c150;
    margin-right: 4px;
    font-size: 14px;
}

.course-comparism-item .item-details .wishlist-btn button {
    padding: 0;
    margin: 0;
    border: 0;
    background: 0;
    font-size: 17px;
    color: #ec5252;
    cursor: pointer;
}

.course-comparism-item .item-details .wishlist-btn button:hover > i:before {
    font-weight: 900;
}

.course-comparism-item .item-details .item-price {
    position: absolute;
    top: 0;
    right: 38px;
    display: flex;
    flex-direction: column-reverse;
    text-align: right;
}

.course-comparism-item .item-details .item-price .current-price {
    color: #29303b;
    font-size: 18px;
    font-weight: 600;
}

.course-comparism-item .item-details .item-price .original-price {
    color: #686f7a;
    font-weight: 400;
    font-size: 13px;
    text-decoration: line-through;
}

.course-comparism-item .item-details .enrolled-student {
    margin-left: 25px;
}

.course-comparism-item .item-details .enrolled-student i {
    margin-right: 2px;
    color: #cacbcc;
    font-size: 14px;
}

.more-by-instructor-box {
    background-color: #f9f9f9;
    border: 1px solid #dedfe0;
    margin-bottom: 50px;
    padding: 10px 8px;
}

.more-by-instructor-box .more-by-instructor-title {
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 10px 7px;
}

.about-instructor-box .about-instructor-title {
    display: block;
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 20px;
}

.about-instructor-box .about-instructor-image img {
    width: 96px;
    height: 96px;
    border-radius: 50%;
}

.about-instructor-box .about-instructor-image ul {
    padding: 0;
    margin: 0;
    list-style: none;
    margin-top: 15px;
}

.about-instructor-box .about-instructor-image ul b {
    font-weight: 600;
}

.about-instructor-box .about-instructor-image ul i {
    width: 26px;
    font-size: 13px;
}

.about-instructor-box .about-instructor-image ul li {
    margin-bottom: 5px;
}

.about-instructor-details {
    max-height: 380px;
}

.about-instructor-box {
    margin-bottom: 40px;
}

.about-instructor-details .instructor-name {
    font-size: 18px;
    font-weight: 600;
    line-height: 1.33;
    margin-bottom: 10px;
}

.about-instructor-details .instructor-title {
    font-size: 16px;
    font-weight: 600;
    line-height: 1.33;
    margin-bottom: 10px;
}

.student-feedback-box {
    margin: 50px 0;
}

.student-feedback-box .student-feedback-title {
    font-size: 22px;
    font-weight: 600;
    margin: 0 0 15px;
}

.student-feedback-box .average-rating {
    text-align: center;
    margin-top: 10px;
}

.student-feedback-box .average-rating .num {
    font-size: 72px;
    font-weight: 500;
    line-height: 1;
    margin-bottom: 10px;
}

.student-feedback-box .average-rating .rating i {
    font-size: 20px;
    color: #f4c150;
    margin-bottom: 5px;
}

.student-feedback-box .individual-rating ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.student-feedback-box .individual-rating ul li {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    margin-bottom: 10px;
}

.student-feedback-box .individual-rating ul li .progress {
    width: 70%;
    height: 20px;
    border-radius: 3px;
    background-color: #f2f3f5
}

.student-feedback-box .individual-rating ul li .progress-bar {
    border-radius: 3px;
    background-color: #a1a7b3;
}

.student-feedback-box .individual-rating .rating i {
    font-size: 14px;
    color: #dedfe0;
}

.student-feedback-box .individual-rating .rating i.filled {
    color: #f4c150;
}

.student-feedback-box .individual-rating li > div:not(.progress) {
    padding-left: 15px;
}

.student-feedback-box .individual-rating li > div:not(.progress) span:not(.rating) {
    text-align: center;
    padding-left: 10px;
    color: #007791;
}

.student-feedback-box .reviews .reviews-title {
    font-size: 18px;
    font-weight: 600;
    padding: 0 0 20px;
}

.student-feedback-box .reviews ul {
    list-style: none;
    padding: 0;
    margin: 0;
    padding-bottom: 30px;
}

.student-feedback-box .reviews .reviewer-details img {
    height: 46px;
    width: 46px;
    border-radius: 50%;
    margin-right: 20px;
}

.student-feedback-box .reviews .reviewer-details .review-time .time {
    color: #686f7a;
}

.student-feedback-box .reviews ul li {
    padding: 30px 0;
    border-top: 1px solid #dedfe0;
}

.student-feedback-box .reviews ul li:last-child {
    border-bottom: 1px solid #dedfe0;
}

.student-feedback-box .reviews .review-details .rating i {
    color: #dedfe0;
    margin-bottom: 15px;
}

.student-feedback-box .reviews .review-details .rating i.filled {
    color: #f4c150;
}

.student-feedback-box .reviews .review-details .review-text {
    color: #505763;
    margin-bottom: 10px;
    font-size: 16px;
}

.student-feedback-box .reviews {
    margin-top: 30px;
}

.reviews .more-reviews-btn {
    text-align: center;
}

.reviews .more-reviews-btn button {
    border-radius: 2px;
    border: 2px solid #007791;
    color: #007791;
    background: #fff;
    padding: 11px 12px;
    font-size: 15px;
    font-weight: 600;
}

.reviews .more-reviews-btn button:hover,
.reviews .more-reviews-btn button:focus {
    background-color: #e6f2f5;
}

.course-curriculum-box {
    margin-bottom: 40px;
}

.course-curriculum-box .course-curriculum-title .title {
    font-size: 17px;
    font-weight: 500;
    color: #000;
    margin: 0 0 10px;
}

.course-curriculum-box .course-curriculum-title .total-time {
    width: 130px;
    display: inline-block;
    text-align: right;
}

.course-curriculum-accordion .lecture-group-title .total-time {
    width: 130px;
    display: inline-block;
    text-align: right;
    font-weight: 500;
    font-size: 12px !important;
}

.course-curriculum-accordion .lecture-group-title .title {
    max-width: 60%;
    font-weight: 500;
    font-size: 12px !important;
}

.course-curriculum-accordion .lecture-group-title {
    position: relative;
    padding: 10px 30px 10px 45px;
    background: #fff;
    border: 1px solid #efd7ff;
    cursor: pointer;
    height: auto;
    margin-top: 3px;
    color: #000;
}

.course-curriculum-box .course-curriculum-title {
    padding-right: 31px;
}

.course-curriculum-accordion .lecture-group-title:before {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    font-family: Font Awesome\ 5 Free;
    font-weight: 900;
    position: absolute;
    left: 22px;
    font-size: 10px;
    top: 16px;
    color: #000;
}
.lecture-group-wrappe .title{
    font-size: 15px;
}
.course-curriculum-accordion .lecture-group-title[aria-expanded="false"]:before {
    content: "\f067";
}

.course-curriculum-accordion .lecture-group-title[aria-expanded="true"]:before {
    content: "\f068";
}

.course-curriculum-accordion .lecture-group-title[aria-expanded="true"] .total-lectures {
    display: none;
}

.course-curriculum-accordion .lecture-list ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.course-curriculum-accordion .lecture-list .lecture {
    padding: 12px 30px 12px 73px;
    position: relative;
    border-bottom: 1px solid #e8e9eb;
    border-left: 1px solid #e8e9eb;
    border-right: 1px solid #e8e9eb;
    color: #686f7a;
}

.course-curriculum-accordion .lecture-list .lecture .lecture-title {
    width: 50%;
    display: inline-block;
    transition: 0.3s;
    -webkit-transition: 0.3s;
    -ms-webkit-transition: 0.3s;
    color: #000 !important;
    font-size: 12px;
    font-weight: 500;
}

.course-curriculum-accordion .lecture-list .lecture .lecture-time {
    width: 100px;
    text-align: right;
    color: #000 !important;
    font-size: 12px;
    font-weight: 500;
}

.course-curriculum-accordion .lecture-list .lecture:before {
    font-family: Font Awesome\ 5 Free;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
    content: "\f144";
    position: absolute;
    left: 45px;
    opacity: 0.3;
    font-weight: 900;
    font-size: 13px;
    top: 17px;
    color: #000;
}

.course-curriculum-accordion .lecture-list .lecture.has-preview {
    color: #000;
}

.course-curriculum-accordion .lecture-list .lecture.has-preview .lecture-title,
.course-curriculum-accordion .lecture-list .lecture.has-preview .lecture-preview {
    cursor: pointer;
}

.course-curriculum-accordion .lecture-list .lecture.has-preview .lecture-title:hover {
    color: #003845;
}

/*
        category page
*/

section.category-header-area {
    padding: 40px 0 30px;
    background: #29303b;
    color: #fff;
}

section.category-header-area .category-name {
    font-size: 30px;
    font-weight: 400;
    line-height: 1.287;
    margin: 0;
}

.breadcrumb {
    padding: 0;
    margin: 0;
    background: none;
    margin-bottom: 5px;
}

.breadcrumb .breadcrumb-item a, .breadcrumb .breadcrumb-item {
    color: #fff;
}

.breadcrumb .breadcrumb-item a:hover {
    color: #dedfe0;
}

.breadcrumb .breadcrumb-item a i {
    color: #a1a7b3;
    font-size: 13px;
}

.breadcrumb-item + .breadcrumb-item::before {
    color: #fff;
}

section.category-course-list-area {
    padding-bottom: 50px;
}

.category-filter-box {
    padding: 35px 0;
    border-bottom: 1px solid #e8e9eb;
    margin-bottom: 30px;
}

.filter-box .btn {
    border-radius: 2px;
    border-color: #007791;
    color: #007791;
    font-weight: 600;
    font-size: 15px;
    padding: 10px 12px;
    min-width: 60px;
    background: transparent;
}

.filter-box .btn:not(.all-btn) {
    margin-left: 10px;
}

.filter-box .btn:hover,
.filter-box .btn:focus {
    background: #fff !important;
    color: #007791 !important;
    border-color: #007791 !important;
}

.filter-box .btn[aria-expanded="true"] {
    background-color: #76c5d6 !important;
}

.filter-box .dropdown-menu {
    box-shadow: 0 4px 16px rgba(20, 23, 28, .25);
    border-color: #fff;
    border-radius: 2px;
    max-height: 365px;
    overflow-y: auto;
}

.filter-box .dropdown-menu .dropdown-item {
    color: #505763;
    padding: 5px 12px;
    font-weight: 400;
    line-height: 1.43;
    font-size: 15px;
}

.filter-box .dropdown-menu .dropdown-item:hover,
.filter-box .dropdown-menu .dropdown-item:focus {
    background-color: #f2f3f5;
    color: inherit;
}

.filter-box .reset-btn {
    background-color: transparent;
    border-color: transparent;
}

.filter-box .reset-btn:hover {
    background-color: transparent !important;
    border-color: transparent !important;
}

.filter-box .reset-btn:disabled {
    color: #a1a7b3 !important;
    cursor: not-allowed;
}

.category-course-list ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.course-box-2 {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    border: 1px solid #dedfe0;
    border-radius: 2px 2px 0 0;
    min-height: 148px;
}

.course-box-2 .course-image {
    width: 26%;
}

.course-box-2 .course-details {
    width: 50%;
    padding: 10px 30px;
}

.course-box-2 .course-price-rating {
    width: 24%;
    text-align: right;
    -ms-flex-item-align: end;
    align-self: flex-end;
    padding: 10px 25px 15px;
}

.category-course-list ul li {
    margin-bottom: 30px;
}

.course-box-2 .course-price-rating .current-price {
    font-size: 18px;
    font-weight: 700;
    color: #29303b;
}

.course-box-2 .course-price-rating .original-price {
    color: #686f7a;
    font-size: 15px;
    font-weight: 400;
    margin-left: 5px;
    text-decoration: line-through;
}

.course-box-2 .course-price-rating .rating i {
    /* color: #f4c150; */
    font-size: 13px;
}

.course-box-2 .course-price-rating .rating .average-rating {
    font-size: 13px;
    color: #686f7a;
}

.course-box-2 .course-price-rating .rating-number {
    font-size: 13px;
    color: #686f7a;
}

.course-box-2 .course-details .course-title {
    color: #29303b;
    display: block;
    font-weight: 700;
    margin-bottom: 4px;
}

.course-box-2 .course-details a:hover {
    text-decoration: underline;
}

.course-box-2 .course-details .course-instructor {
    display: block;
    color: #686f7a;
    font-size: 11px;
    margin-bottom: 6px;
}

.course-box-2 .course-details .course-subtitle {
    color: #505763;
    font-size: 13px;
    margin-bottom: 20px;
}

.course-box-2 .course-details .course-meta span {
    font-size: 13px;
    margin-right: 10px;
    color: #686f7a;
}

.course-box-2 .course-details .course-meta {
    padding-top: 5px;
}

.course-box-2 .course-details .course-meta span i {
    opacity: 0.5;
    font-size: 14px;
    margin-right: 4px;
}

/*
        Instructor page
*/
section.instructor-header-area {
    background-color: #007791;
    color: #fff;
    padding: 34px 0;
}

section.instructor-header-area .instructor-name {
    font-size: 30px;
    font-weight: 400;
    line-height: 1.287;
    margin: 0;
}

section.instructor-header-area .instructor-title {
    font-size: 18px;
    font-weight: 400;
    line-height: 1.287;
    margin: 7px 0 0;
}

section.instructor-details-area {
    padding: 30px 0;
}

.instructor-left-box .instructor-image img {
    border-radius: 50%;
    height: 120px;
    width: 120px;
}

.instructor-left-box .instructor-social ul {
    margin: 0;
    padding: 0;
    margin-top: 25px;
    list-style: none;
}

.instructor-left-box .instructor-social ul li {
    display: inline-block;
    padding: 0 6px;
    font-size: 19px;
}

.biography-content-box {
    max-height: 400px;
    margin-bottom: 40px;
}

.instructor-right-box .instructor-stat-box ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.instructor-right-box .instructor-stat-box ul li {
    display: inline-block;
    border-left: 1px solid rgba(41, 48, 59, .25);
    padding: 0 15px;
    text-align: left;
}

.instructor-right-box .instructor-stat-box ul li .small {
    font-size: 86%;
}

.instructor-right-box .instructor-stat-box ul li .num {
    font-size: 24px;
    font-weight: 300;
}

section.instructor-course-list-area {
    background-color: #f7f8fa;
    padding: 40px 0;
}

section.instructor-course-list-area .section-title {
    font-size: 18px;
    margin-bottom: 20px;
}

section.instructor-course-list-area .container {
    max-width: 940px;
}

ul.pagination {
    margin-top: 25px;
}

ul.pagination .page-item.disabled .page-link {
    color: #a1a7b3;
}

ul.pagination .page-item.active a,
ul.pagination .page-item.active .page-link {
    background-color: #007791;
    border-color: #007791;
    color: #fff;
}

ul.pagination .page-item a,
ul.pagination .page-item .page-link {
    color: #007791;
    padding: 10px 15px;
    font-size: 17px;
    position: relative;
    display: block;
    margin-left: -1px;
    line-height: 1.25;
    background-color: #fff;
    border: 1px solid #dee2e6;
}

ul.pagination .page-item a:hover,
ul.pagination .page-item .page-link:hover {
    background-color: #e6f2f5;
    border-color: #007791;
    position: relative;
    z-index: 1;
}

/*
    Notifications page
*/

section.page-header-area {
    padding: 40px 0 30px;
    background: #505763;
    color: #fff;
}

section.page-header-area .page-title {
    font-size: 30px;
    font-weight: 400;
    line-height: 1.287;
    margin: 0;
}

section.page-header-area .page-subtitle {
    font-size: 18px;
    font-weight: 400;
    line-height: 1.287;
    margin: 7px 0 5px;
}

.notifications-list-area .notifications-footer .mark-all-read {
    border: 0;
    background: none;
    color: #007791;
}

.notifications-list-area .notifications-footer .mark-all-read:hover {
    color: #003845;
}

.notifications-list-area .notifications-footer {
    padding: 15px 0;
}

.notifications-list-area .notification-list {
    max-height: 415px;
    overflow-y: auto;
    margin-top: 40px;
}

.notifications-list-area .notification-list li {
    padding: 15px;
}

.notifications-list-area .notification-list .notification-details .notification-text {
    width: 100%;
}

.notifications-list-area .notification-list .notification-details {
    padding-right: 15px;
}

.notifications-list-area .notification-list .notification-details .notification-time {
    margin-top: 10px;
}

/*
    my courses - wishlist page
*/

section.page-header-area.my-course-area {
    padding-bottom: 0;
}

section.page-header-area.my-course-area ul {
    margin: 0;
    padding: 0;
    list-style: none;
    margin-top: 20px;
}

section.page-header-area.my-course-area ul li {
    display: inline-block;
    margin-right: 30px;
}

section.page-header-area.my-course-area ul li a {
    padding: 0 0 5px;
    border-bottom: 6px solid hsla(0, 0%, 100%, 0);
    color: #fff;
    display: block;
}

section.page-header-area.my-course-area ul li.active a,
section.page-header-area.my-course-area ul li a:hover {
    border-bottom-color: hsla(0, 0%, 100%, .7);
}

section.my-courses-area .my-course-search-bar .input-group {
    width: 220px;
    margin-left: auto;
}

section.my-courses-area {
    padding: 40px 0;
}

.my-courses-area .my-course-search-bar input {
    font-size: 16px;
    padding: 10px 12px;
    border-radius: 0;
    background-color: #fff;
    border: 1px solid #cacbcc;
}

.my-courses-area .my-course-search-bar .input-group-append button {
    background: #f2f3f5;
    border-color: #dedfe0;
    color: #a1a7b3;
    border-top-right-radius: 2px;
    border-bottom-right-radius: 2px;
}

.my-courses-area .my-course-search-bar .input-group-append button:hover,
.my-courses-area .my-course-search-bar .input-group-append button:focus,
.my-courses-area .my-course-search-bar input:focus + .input-group-append button {
    background: #007791;
    color: #fff;
    border-color: #007791;
}

.my-courses-area .row.no-gutters {
    margin-top: 50px;
    margin-left: -10px;
    margin-right: -10px;
}

.my-courses-area .course-box-wrap {
    padding: 0 10px;
}

.my-course-filter-bar.filter-box {
    position: relative;
    padding-top: 30px;
}

.my-course-filter-bar.filter-box > span {
    position: absolute;
    top: 0;
    left: 0;
    color: #686f7a;
    font-size: 13px;
}

.edit-rating-modal .m-progress-bar-wrapper {
    background: #e8e9eb;
}

.edit-rating-modal .m-progress-bar {
    height: 6px;
    background: #a1a7b3;
    border-radius: 0 3px 3px 0;
}

.edit-rating-modal .rating-title {
    font-weight: 300;
    font-size: 24px;
    color: #29303b;
}

.edit-rating-modal .modal-body {
    padding-top: 50px;
    padding-bottom: 50px;
}

.modal-course-preview-box {
    padding-left: 50px;
}

.modal-course-preview-box .card-title {
    line-height: 24px;
    height: 48px;
    color: #505763;
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2;
    -moz-line-clamp: 2;
    -ms-line-clamp: 2;
    -o-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    font-size: 18px;
}

.modal-course-preview-box .card-text {
    line-height: 24px;
    height: 48px;
    color: #505763;
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2;
    -moz-line-clamp: 2;
    -ms-line-clamp: 2;
    -o-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
}

.edit-rating-modal .modal-footer button {
    padding: 16px 12px;
    font-size: 15px;
    line-height: 1.35135;
    border-radius: 2px;
    background-color: #ec5252;
    border-color: #ec5252;
    font-weight: 600;
}

.edit-rating-modal .modal-footer button:hover, .edit-rating-modal .modal-footer button:focus {
    background-color: #992337 !important;
    border-color: #992337 !important;
}

.edit-rating-modal .modal-footer button.previous {
    color: #007791;
    background-color: #fff;
    border-color: #007791;
}

.edit-rating-modal .modal-footer button.previous:hover, .edit-rating-modal .modal-footer button.previous:focus {
    background-color: #e6f2f5 !important;
    border-color: #007791 !important;
}

.your-rating {
    border: none;
    float: left;
}

.your-rating > input {
    display: none;
}

.your-rating > label:before {
    margin: 8px;
    font-size: 40px;
    font-family: "Font Awesome 5 Free";
    display: inline-block;
    content: "\f005";
    font-weight: 900
}

.your-rating > .half:before {
    content: "\f089";
    position: absolute;
}

.your-rating > label {
    color: #dedfe0;
    float: right;
}

.your-rating > input:checked ~ label,
.your-rating:not(:checked) > label:hover,
.your-rating:not(:checked) > label:hover ~ label {
    color: #f4c150;
}

.your-rating > input:checked + label:hover,
.your-rating > input:checked ~ label:hover,
.your-rating > label:hover ~ input:checked ~ label,
.your-rating > input:checked ~ label:hover ~ label {
    color: #f4c150;
}

.edit-rating-modal .rating {
    margin-bottom: 30px;
    margin-top: 20px;
}

.edit-rating-modal .rating i {
    font-size: 30px;
}

.edit-rating-modal .modal-rating-comment-box textarea {
    width: 100%;
    height: 210px;
    resize: none;
    border-radius: 2px;
}

.edit-rating-modal .modal-rating-comment-box textarea:focus {
    border-color: #76c5d6;
}

/*
    cart page
*/

section.cart-list-area {
    margin-top: 50px;
    margin-bottom: 70px;
}

.in-cart-box > .title,
.wishlisted-box > .title {
    font-size: 18px;
    margin-bottom: 10px;
    color: #29303b;
}

.in-cart-box .cart-course-list,
.wishlisted-box .cart-course-list {
    padding: 0;
    margin: 0;
    list-style: none;
    -webkit-box-shadow: 0 0 2px #dedfe0;
    box-shadow: 0 0 2px #dedfe0;
    margin-bottom: 60px;
}

.in-cart-box .cart-course-list li:not( :first-child ),
.wishlisted-box .cart-course-list li:not( :first-child ) {
    border-top: 1px solid #f1f1f1;
}

.cart-course-wrapper {
    padding: 10px;
    display: flex;
    justify-content: space-between;
}

.cart-course-wrapper .image {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 17%;
    flex: 0 0 17%;
    max-width: 17%;
}

.cart-course-wrapper .details {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 53%;
    flex: 0 0 53%;
    max-width: 53%;
    padding-left: 10px;
}

.cart-course-wrapper .details .name {
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2;
    -moz-line-clamp: 2;
    -ms-line-clamp: 2;
    -o-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    margin-bottom: 0;
    max-height: 37px;
    color: #29303b;
    line-height: 1.2;
    font-weight: 700;
}

.cart-course-wrapper .details .instructor {
    display: block !important;
    display: -webkit-box !important;
    -webkit-line-clamp: 2;
    -moz-line-clamp: 2;
    -ms-line-clamp: 2;
    -o-line-clamp: 2;
    line-clamp: 2;
    -webkit-box-orient: vertical;
    -moz-box-orient: vertical;
    -ms-box-orient: vertical;
    -o-box-orient: vertical;
    box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: normal;
    max-height: 36px;
    font-size: 13px;
    color: #686f7a;
}

.cart-course-wrapper .move-remove {
    text-align: right;
    padding-left: 10px;
    -webkit-box-flex: 0;
    -ms-flex: 0 0 15%;
    flex: 0 0 15%;
    max-width: 15%;
}

.cart-course-wrapper .price {
    -webkit-box-flex: 0;
    -ms-flex: 0 0 15%;
    flex: 0 0 15%;
    max-width: 15%;
    text-align: right;
    padding-right: 25px;
    position: relative;
}

.cart-course-wrapper .move-remove div {
    color: #007791;
    cursor: pointer;
    font-size: 13px;
    margin-bottom: 3px;
}

.cart-course-wrapper .move-remove div:hover {
    color: #003845;
}

.cart-course-wrapper .price .current-price {
    color: #ec5252;
    font-weight: 900;
}

.cart-course-wrapper .price .original-price {
    text-decoration: line-through;
    color: #686f7a;
}

.cart-course-wrapper .price .coupon-tag {
    position: absolute;
    top: 2px;
    right: 0;
    color: #ec5252;
    font-size: 14px;
}

.cart-sidebar .total {
    color: #686f7a;
    font-size: 18px;
}

.cart-sidebar .total-price {
    font-size: 36px;
    line-height: 49px;
    color: #ec5252;
    font-weight: 600;
}

.cart-sidebar .total-original-price {
    color: #686f7a;
    margin-bottom: 12px;
}

.cart-sidebar .total-original-price .original-price {
    text-decoration: line-through;
    margin-right: 10px;
}

.cart-sidebar .checkout-btn {
    font-size: 15px;
    line-height: 1.35135;
    border-radius: 2px;
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
    font-weight: 600;
    padding: 16px 12px;
}

.cart-sidebar .checkout-btn:hover, .cart-sidebar .checkout-btn:focus {
    background-color: #992337 !important;
    border-color: #992337 !important;
}

.cart-sidebar .coupon-field input {
    padding: 14px 12px;
    font-size: 12px;
    border-radius: 2px;
}

.cart-sidebar .coupon-field input:focus {
    border-color: #76c5d6;
}

.cart-sidebar .coupon-field button {
    border-radius: 2px;
    background-color: #007791;
    border-color: #007791;
    color: #fff;
    font-weight: 600;
    font-size: 15px;
}

.cart-sidebar .coupon-field button:hover, .cart-sidebar .coupon-field button:focus {
    background-color: #00576b !important;
    border-color: #00576b !important;
}

.cart-sidebar .coupon-list ul {
    list-style: none;
    margin: 0;
    padding: 0;
    margin-top: 15px;
}

.cart-sidebar .coupon-list ul li {
    font-size: 13px;
    cursor: pointer;
    color: #686f7a;
}

.cart-sidebar .coupon-list ul li:hover {
    color: #ec5252;
}

.cart-sidebar .coupon-list ul li i {
    font-size: 11px;
}

/*
    user dashboard page
*/

section.user-dashboard-area {
    padding: 40px 0;
}

.user-dashboard-box {
    border: 1px solid #dedfe0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.user-dashboard-sidebar {
    width: 18%;
    border-right: 1px solid #dedfe0;
}

.user-dashboard-content {
    width: 82%;
}

section.user-dashboard-area {
    padding: 40px 0;
}

.user-dashboard-box {
    border: 1px solid #dedfe0;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.user-dashboard-sidebar .user-box {
    text-align: center;
    padding: 10px;
}

.user-dashboard-sidebar .user-box img {
    height: 118px;
    width: 118px;
    border-radius: 50%;
    margin-bottom: 15px;
}

.user-dashboard-sidebar .user-box .name {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 10px;
}

.user-dashboard-sidebar .user-dashboard-menu ul {
    padding: 0;
    margin: 0;
    list-style: none;
}

.user-dashboard-sidebar .user-dashboard-menu ul a {
    display: block;
    padding: 4px 15px;
}

.user-dashboard-sidebar .user-dashboard-menu ul .active a {
    background: #a1a7b3;
    color: #fff;
}

.user-dashboard-content .content-title-box {
    text-align: center;
    border-bottom: 1px solid #dedfe0;
    padding: 20px;
}

.user-dashboard-content .content-title-box .title {
    color: #29303b;
    font-size: 22px;
    font-weight: 700;
}

.user-dashboard-content .content-title-box .subtitle {
    font-size: 15px;
    line-height: 25px;
    font-weight: 300;
    color: #29303b;
}

.user-dashboard-content .content-update-box {
    border-top: 1px solid #dedfe0;
    padding: 20px;
    text-align: center;
}

.user-dashboard-content .content-update-box button {
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
    padding: 11px 12px;
    font-size: 15px;
    border-radius: 2px;
    line-height: 1.35135;
    font-weight: 600;
}

.user-dashboard-content .content-box .form-group {
    padding: 10px 142px;
    margin-bottom: 0;
}

.user-dashboard-content .content-box .form-group .input-group-text {
    border: 1px solid #cacbcc;
    border-radius: 2px;
}

.user-dashboard-content .content-box .form-group .custom-select {
    padding: 11px 12px;
    border-radius: 2px;
    height: auto;
}

.user-dashboard-content .content-box .form-group .form-control {
    font-size: 16px;
    padding: 10px 12px;
    border: 1px solid #cacbcc;
    border-radius: 2px;
}

.user-dashboard-content .content-box .input-group > .input-group-prepend:not(:first-child) > .input-group-text {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.user-dashboard-content .content-box .form-group .custom-select:focus,
.user-dashboard-content .content-box .form-group input:focus {
    border: 1px solid #76c5d6;
}

.user-dashboard-content .content-box .form-group small.form-text {
    margin-top: 5px;
    margin-bottom: 10px;
    color: #5d6d86;
    font-size: 11px;
}

.user-dashboard-content .content-box .mce-tinymce,
.user-dashboard-content .content-box .mce-panel,
.user-dashboard-content .content-box .mce-top-part::before {
    box-shadow: none;
    border-color: #cacbcc;
}

.user-dashboard-content .content-box .mce-edit-area.mce-container {
    border-right: 1px solid #cacbcc !important;
    cursor: text;
}

.user-dashboard-content .content-box .basic-group,
.user-dashboard-content .content-box .link-group,
.user-dashboard-content .content-box .email-group,
.user-dashboard-content .content-box .password-group {
    padding: 10px 0;
}

.user-dashboard-content .content-box .password-group {
    padding-bottom: 30px;
    border-top: 1px solid #dedfe0
}

/*
    my message page
*/

.message-sender-list-box {
    padding-top: 10px;
}

.message-sender-list-box .compose-btn {
    color: #007791;
    background-color: #fff;
    border-color: #007791;
    padding: 11px 12px;
    font-size: 15px;
    border-radius: 2px;
    line-height: 1.35135;
}

.message-sender-list-box .compose-btn:hover, .message-sender-list-box .compose-btn:focus {
    background-color: #e6f2f5;
}

.message-sender-list-box .message-sender-list {
    margin: 0;
    padding: 0;
    list-style: none;
    padding: 0 10px 10px 0;
    position: relative;
    min-height: 280px;
    height: calc(100vh - 380px);
    overflow: auto;
}

.message-sender-list-box .message-sender-list .sender-image img {
    height: 24px;
    width: 24px;
    border-radius: 50%;
}

.message-sender-list-box .message-sender-list li {
    cursor: pointer;
    transition: 0.3s;
    -webkit-transition: 0.3s;
    -ms-webkit-transition: 0.3s;
    border: 1px solid transparent;
    padding: 15px;
    border-radius: 3px;
}

.message-sender-list-box .message-sender-list li.active,
.message-sender-list-box .message-sender-list li:hover {
    border-color: #dedfe0;
    background-color: #fff;
}

.message-sender-list-box .message-sender-list .sender-name {
    font-size: 15px;
    font-weight: 700;
    color: #505763;
    margin-left: 15px;
}

.message-sender-list-box .message-sender-list .message-time {
    font-size: 13px;
    color: #686f7a;
}

.message-sender-list-box .message-sender-list .message-sender-head {
    margin-bottom: 10px;
}

.message-sender-list-box .message-sender-list .message-sender-body {
    padding: 0 43px;
    font-size: 13px;
    color: #686f7a;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.message-details-box {
    height: 100%;
    background: #fff;
    border-right: 1px solid #dedfe0;
    border-left: 1px solid #dedfe0;
}

.message-details-box .empty-box {
    padding-top: 55px;
}

.message-details-box .message-details .message-header a {
    display: block;
}

.message-details-box .message-details .message-header img {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    margin-right: 15px;
}

.message-details-box .message-details .message-header {
    min-height: 65px;
    padding: 10px;
    border-bottom: 1px solid #dedfe0;
}

.message-details-box .message-details .message-footer {
    padding: 10px;
    border-top: 1px solid #dedfe0;
    background: #fff;
}

.message-details-box .message-details .message-content {
    background: #fff;
    padding: 10px;
    overflow: auto;
    min-height: 200px;
    height: calc(100vh - 460px);
}

.message-details-box .message-details .message-content .message-box {
    max-width: 400px;
    min-width: 190px;
    padding: 15px;
    border-radius: 2px;
    margin-bottom: 10px;
    background: #f2f3f5;
    display: inline-block;
}

.message-details-box .message-details .message-content .message-box .message {
    white-space: pre-wrap;
    color: #505763;
    font-size: 15px;
    overflow-x: auto;
}

.message-details-box .message-details .message-content .message-box .time {
    color: #686f7a;
    font-size: 13px;
    margin-bottom: 10px;
}

.message-details-box .message-details .message-content .me .message-box {
    background: rgba(230, 242, 245, .5);
}

.message-details-box .message-details .message-content .me {
    display: flex;
    justify-content: flex-end;
}

.message-details-box .message-details .message-footer textarea {
    border-radius: 2px;
    min-height: 100px;
}

.message-details-box .message-details .message-footer textarea:focus {
    border-color: #76c5d6;
}

.message-details-box .message-details .message-footer .send-btn {
    color: #fff;
    background-color: #ec5252;
    border-color: #ec5252;
    padding: 11px 12px;
    font-size: 15px;
    border-radius: 2px;
    line-height: 1.35135;
    margin-top: 15px;
    margin-bottom: 25px;
    font-weight: 600;
}

.message-details-box .message-details .message-footer .send-btn:hover,
.message-details-box .message-details .message-footer .send-btn:focus {
    background-color: #992337;
    border-color: #992337;
}

.message-sender-list-box .message-sender-list .sender-image i {
    height: 24px;
    width: 24px;
    border-radius: 50%;
    font-size: 11px;
    line-height: 21px;
    text-align: center;
    border: 1px solid #adadad;
    color: #adadad;
}

.new-message-details .message-header {
    min-height: 65px;
    padding: 10px;
    border-bottom: 1px solid #dedfe0;
}

.new-message-details .message-header span {
    font-weight: 700;
    color: #29303b;
    vertical-align: middle;
}

.new-message-details .message-header i {
    font-size: 17px;
    height: 40px;
    width: 40px;
    line-height: 37px;
    text-align: center;
    border: 1px solid #adadad;
    border-radius: 50%;
    color: #adadad;
    margin-right: 15px;
    margin-left: 10px;
}

.new-message-details .message-body {
    padding: 10px;
}

.new-message-details .message-body .cancel-btn {
    border: none;
    background: no-repeat;
    color: #007791;
}

.new-message-details .message-body textarea {
    min-height: 100px;
    border-radius: 2px;
    border-color: #cacbcc;
}

.new-message-details .message-body textarea:focus {
    border-color: #76c5d6;
}

span.select2-selection.select2-selection--single {
    background-color: transparent;
    color: #32373c;
    border-color: #cacbcc;
    height: auto;
    border-radius: 2px;
}

.select2-container .select2-selection--single .select2-selection__rendered {
    padding: 10px;;
}

.select2-container .select2-selection--single .select2-selection__rendered:focus {
    outline: none;
}

span.select2-selection.select2-selection--single:focus {
    outline: none;
}

span.select2-selection.select2-selection--single[aria-expanded="true"] {
    background-color: #ffffff;
    border-color: #76c5d6;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    top: 12px;
    right: 7px;
}

span.select2-dropdown, .daterangepicker.dropdown-menu {
    border-color: #cacbcc;
}

span.select2-search.select2-search--dropdown {
    padding: 13px 15px;
}

span.select2-results ul li {
    padding: 6px 15px;
    color: #56666d;
}

span.select2-results ul li.select2-results__option--highlighted,
.select2-container--default .select2-results__option[aria-selected=true] {
    background: #e8e8e8;
    color: #32373c;
}

.select2-container--default .select2-results__option {
    padding: 12px 15px;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    border-color: #cacbcc;
    padding: 10px;
}

.select2-container--default .select2-search--dropdown .select2-search__field:focus {
    border-color: #76c5d6;
    outline: none;
    box-shadow: 0 0 0;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #007791;
    color: white;
}

/*
    purchase History page
*/
section.purchase-history-list-area {
    padding: 30px 0 50px;
}

.purchase-history-list {
    margin: 0;
    padding: 0;
    list-style: none;
}

.purchase-history-list li {
    border-bottom: 1px solid #f2f3f5;
    padding: 10px 0;
    font-size: 12px;
}

.purchase-history-list .purchase-history-list-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 0;
}

.purchase-history-list .purchase-history-course-img {
    float: left;
}

.purchase-history-list .purchase-history-course-img img {
    width: 135px;
    margin-right: 15px;
    height: auto;
}

.purchase-history-list .purchase-history-course-title {
    color: #505763;
    font-weight: 600;
    font-size: 14px;
}

.purchase-history-list .purchase-history-course-title:hover {
    color: #003845;
}

.purchase-history-list .purchase-history-detail .btn-receipt {
    color: #007791;
    background-color: #fff;
    border: 1px solid #007791;
    padding: 2px 8px;
    font-size: 13px;
    line-height: 1.35135;
    border-radius: 2px;
}

.purchase-history-list .purchase-history-detail .btn-receipt:hover,
.purchase-history-list .purchase-history-detail .btn-receipt:focus {
    background-color: #e6f2f5;
}

/*
    footer style
*/
.footer-top-widget-area {
    border-top: 1px solid #e8e9eb;
    padding: 40px 0;
    background-color: #fff;
}

.footer-widget.link-widget ul {
    margin: 0;
    padding: 0;
    list-style: none;
}

.footer-widget.link-widget ul li:not(:last-child) {
    margin-bottom: 8px;
}

.footer-widget.link-widget ul a {
    font-size: 13px
}

.language-widget button {
    padding: 9px 18px;
    font-size: 13px;
    font-weight: 600;
    line-height: 18px;
    min-width: 160px;
    text-align: left;
    color: #686f7a;
    background-color: #fff;
    border: 1px solid #505763;
    border-radius: 2px;
}

.language-widget button:hover,
.language-widget button:focus {
    color: #686f7a !important;
    background-color: #e8e9eb !important;
    border-color: #505763;
}

.language-widget button i {
    font-size: 11px;
    margin-right: 10px;
}

.language-widget .dropdown-menu {
    box-shadow: 0 4px 16px rgba(20, 23, 28, .25);
    border-radius: 2px;
    border: 0;
    margin-bottom: 2px;
    width: 160px;
}

.language-widget .dropdown-menu a {
    padding: 6px 14px;
    color: #505763;
    font-weight: 400;
    line-height: 1.43;
    font-size: 13px;
}

.language-widget .dropdown-menu a:hover,
.language-widget .dropdown-menu a:focus {
    background-color: #f2f3f5;
}

.language-widget .dropdown-toggle {
    position: relative;
}

.language-widget .dropdown-toggle::after {
    position: absolute;
    top: 17px;
    right: 14px;
    transform: rotate(180deg);
    -webkit-transform: rotate(180deg);
    -ms-webkit-transform: rotate(180deg);
}

.footer-area {
    background-color: #fff;
    padding: 30px 0;
    border-bottom: 6px solid #ec5252;
    border-top: 1px solid #e8e9eb;
}

.copyright-text {
    color: #686f7a;
    font-size: 13px;
    margin-bottom: 0;
}

.copyright-text img {
    margin-right: 20px
}

.footer-menu .nav-item:not(:last-child) {
    margin-right: 20px;
}

.footer-menu .nav-link {
    padding: 6px 0;
    font-size: 13px;
}

.payment-in-modal form .stripe {
    color: #fff;
    background-color: #008cde;
    border-color: #0698dc;
    font-size: 16px;
    font-weight: 700;
    height: 50px;
    width: 100%;
    padding: 11px 12px;
    border-radius: 2px;
}

.payment-in-modal form .paypal {
    color: #fff;
    background-color: #008cde;
    border-color: #0698dc;
    font-size: 16px;
    font-weight: 700;
    height: 50px;
    width: 100%;
    padding: 11px 12px;
    border-radius: 2px;
}

.purchased a {
    width: 100%;
    border: 0;
    color: #fff;
    background-color: #007791;
    padding: 11px 12px;
    font-size: 15px;
    line-height: 1.43;
    border-radius: 2px;
    font-weight: 600;
    margin-top: 20px;
    display: block;
    text-align: center;
}

.purchased a:hover,
.purchased a:focus {
    background: #003440;
}
.TopMontain{
    padding: 10px 0px;
    background-color: #fff;
}
.TopMontain .course-carousel-title{
    font-size: 20px;
    color: #000;
    margin: 0 0 10px;
}
.TopMontain .course-box{
    box-shadow: 0px 0px 20px rgba(136, 136, 136, 0.219);
    border-radius: 5px !important;
}
.TopMontain .course-image img{
    border-radius: 5px 5px 0 0;
    width: 100%;
    height: 180px;
}

</style>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/Logo-fav.png" type="image/x-icon">
    <title> Page Builder | {{config('app.name')}} </title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header>
        <nav style="background:linear-gradient(85.46deg, #A219D8 -3.83%, #E656DA 82.54%);" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
        <div class="container">
           <a href="{{route('index')}}" class="navbar-brand">
        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660222222/OjaFunnel-Images/lo_dwxa54.png" draggable="false" alt="OjaFunnel">
        </a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-100" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button data-bs-dismiss="offcanvas">
                        <i class="bi bi-x-square"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1">
                        <li class="nav-item">
                            <a href="{{route('index')}}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" class="routers">
                                Home
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->is('features*')) ? 'active' : '' }}" href="#">
                                Features
                            </a>
                            <div class="dropdown-content container desktop-dropdown">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/growth_pb0d7g.png" draggable="false">
                                            <span>MARKETING</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('emailmarketing')}}">
                                                        Email Marketing <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Affiliate Marketing <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Ecommerce <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/globe_wpfoop.png" draggable="false">
                                            <span>CREATE AND DESIGN</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Funnel Builder <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('pagebuilder')}}">
                                                        Page Builder <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/setting_kzwd29.png" draggable="false">
                                            <span>AUTOMATIONS</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('marketauto')}}">
                                                        Automations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('chatautomation')}}">
                                                        Chat Automations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254551/OjaFunnel-Images/plugin_g09fa1.png" draggable="false">
                                            <span>MORE</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        API Integrations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="dropdown-menu mobile-dropdown" aria-labelledby="navbarDropdown">
                                <li>
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Email Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Affiliate Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Ecommerce
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Funnel Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('pagebuilder')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Page Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Marketing Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('chatautomation')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Chat Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> API Integrations
                                        </a>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('faqs')}}" class="nav-link {{ (request()->is('faqs')) ? 'active' : '' }}" class="routers">
                                FAQs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" class="routers">
                                Resources
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}" class="routers">
                                Contact
                            </a>
                        </li>
                    </ul>
                    <div class="login-div">
                        <a href="{{route('login')}}" class="btn-login">Login</a>
                        <a href="{{route('signup')}}" class="btn-signup">Sign Up <i class="bi bi-box-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </nav>
        <div class="offcanvas offcanvas-end offcanvas-contact-hambuger" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <button data-bs-dismiss="offcanvas" aria-label="Close">
                    <i class="bi bi-x-square"></i>
                </button>
            </div>
            <div class="offcanvas-body text-center">
            </div>
        </div>
    </header>
    <!-- Header Ends -->

    <!-- Page-Builder -->
    <section class="page-builder">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="btn-text">
                        <h1>
                            Convert prospects with stunning pre built page templates
                        </h1>
                        <p>
                            Building landing pages, pre sales pages, sales page, opt-in page, thank you page, and more with ease.
                        </p>
                        <button style="background-color: #fff;color:#000">
                            Get Started
                        </button>
                        <button>
                            See Demo
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="context">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661267657/OjaFunnel-Images/banner_ajpxfj.png" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Builder  Ends-->

    <!-- Increasing -->
    <section class="Increasing">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="thread-text">
                        <h1>
                            Simplified Page Builder
                        </h1>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            Create and build
                        </h4>
                        <h2>
                            Build your landing pages easily with customizable templates
                        </h2>
                        <p>
                            Select a customizable template that best fits your business needs and the look you're going for or use our drag and drop editor to create a unique landing page from scratch.
                        </p>
                        <button>
                            Explore
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="assets/images/rect.png" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Increasing Ends -->

    <!-- Communication -->
    <section class="communication hide">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="el-icon-message">
                        <img class="pulse" src="assets/images/rect.png" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            SEGMENTATION
                        </h4>
                        <h2>
                            Grow your audience and keep it organized
                        </h2>
                        <p>
                            Landing pages make it easy to capture your visitors’ contact information and move them to the next stage of your funnel. Use segmentation to track your leads lifecycle and follow-up with relevant messaging.
                        </p>
                        <button>
                            Explore Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication Ends -->

    <!-- Communication -->
    <section class="communication display">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            SEGMENTATION
                        </h4>
                        <h2>
                            Grow your audience and keep it organized
                        </h2>
                        <p>
                            Landing pages make it easy to capture your visitors’ contact information and move them to the next stage of your funnel. Use segmentation to track your leads lifecycle and follow-up with relevant messaging.
                        </p>
                        <button>
                            Explore Now
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="el-icon-message">
                        <img class="pulse" src="assets/images/rect.png" draggable="false" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication Ends -->

    <!-- Editable  -->
    <section class="Editable">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            REPORTS AND ANALYSIS
                        </h4>
                        <h2>
                            Get reports on visitors, clicks, conversions and more
                        </h2>
                        <p>
                            Find what is high converting, ie visitors, clicks, conversions, and revenue, as well as track what content or offerings are most interesting to different audience segments.
                        </p>
                        <button>
                            Explore
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="assets/images/rect.png" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Editable Ends -->
    <!-- Footter -->
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="kit-font">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png">
                        <p>
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.
                        </p>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Quick Link
                        </h1>
                        <ul>
                            <li>
                                Products
                            </li>
                            <li>
                                Features
                            </li>
                            <li>
                                Pricing
                            </li>
                            <li>
                                Resources
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Contact
                        </h1>
                        <ul>
                            <li>
                                8, Address street
                            </li>
                            <li>
                                0815530260
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="quick">
                        <h1>
                            Newsletter
                        </h1>
                        <ul>
                            <li>
                                Get News & Updates
                            </li>
                        </ul>
                        <form class="search-bar">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your email Address">
                                <span class="input-group-text" id="basic-addon2">Subscribe</span>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="last-fot">
                        <h1>
                            Helping thousands of businesses succeed,<a href="sign-up">
                                join us
                            </a>
                        </h1>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="top">
                        <div class="logo-details">
                            <div class="media-icons">
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row paff">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3">
                            <li>
                                <a href="{{route('privacy')}}">
                                    Privacy Policy
                                </a>
                            </li>
                        </div>
                        <div class="col-sm-3">
                            <li>
                                <a href="Term">
                                    Terms & Condition
                                </a>
                            </li>
                        </div>
                        <div class="col-sm-3">

                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-12">
                    <div class="last-fott">
                        <h1>
                            Copyright © {{ date('Y') }} {{config('app.name')}}. All rights reserved
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footter Ends -->

    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js"')}}></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>
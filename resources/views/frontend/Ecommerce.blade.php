<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="shortcut icon" href="{{URL::asset('assets/images/Logo-fav.png')}}" type="image/x-icon">
    <title> Page Builder | {{config('app.name')}} </title>
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.min.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="market">
        <nav style="background: linear-gradient(100.67deg, #6734F8 10.04%, #9820F7 106%);" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
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
                                                            Email Marketing
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="">
                                                            Affiliate Marketing
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('ecommerce')}}">
                                                            Ecommerce
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
                                                            Funnel Builder
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('pagebuilder')}}">
                                                            Page Builder
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
                                                            Automations
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('chatautomation')}}">
                                                            Chat Automations
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
                                                            API Integrations
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

    <!-- Ecommerce Welcome -->
    <section class="Ecommerce">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="accelerate">
                        <h1>
                            Create A Smart Online Store To Sell Your Products Online
                        </h1>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h3>
                                    Get more sales and customers for your business by creating an online store for your business with Ojafunnel.

                                </h3>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="btn-curve">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div>
                                        <button style="background-color: #fff; "><a href="{{route('signup')}}" style="color: #000;">
                                                Get Started
                                            </a></button>
                                        <button>See Demo</button>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </section>
    <!-- Ecommerce Welcome Ends -->

    <!-- Ecommerce Build -->
    <section class="Build">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>
                            Build your brands online presence
                        </h1>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="bording">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674129297/OjaFunnel-Images/Rectangle_19420_rrulf4.png" draggable="false" alt=""> <span>Launch for free</span>
                        <p>
                            Create a website with a product catalog at no cost—you only pay when you make a sale.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  mb-4">
                    <div class="bording">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674129297/OjaFunnel-Images/Rectangle_19420_rrulf4.png" draggable="false" alt=""> <span>Find new customers</span>
                        <p>
                            Drive traffic and e-commerce sales with the free, powerful marketing tools that come with your store.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  mb-4">
                    <div class="bording">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674129297/OjaFunnel-Images/Rectangle_19420_rrulf4.png" draggable="false" alt=""> <span>Own your brand</span>
                        <p>
                            Create a seamless brand experience across the web with ojafunnel and with our intuitive design tools.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Ecommerce Build Ends -->


    <!-- Increasing -->
        <section class="Increasing" style="background: #FCFCFE !important;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="thread-text">
                            <h4>
                                UPSELLS
                            </h4>
                            <h2>
                                Double your sales by maximizing every order
                            </h2>
                            <p>
                                Significantly increase revenue by utilizing one-click upsells, added purchase options at checkout, abandoned cart recovery, and other advanced features.
                            </p>
                            <button>
                                Explore
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="imagess">
                            <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674133362/OjaFunnel-Images/Rectangle_18987_1_wvh6u2.png" draggable="false">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Increasing Ends -->

    <!-- Communication -->
        <section class="communication hide" style="background: #fff !important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="el-icon-message">
                            <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674133362/OjaFunnel-Images/Rectangle_18987_1_wvh6u2.png" draggable="false" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="thread-text">
                            <h4>
                                Payout Checkout
                            </h4>
                            <h2>
                                Integrated lightning-fast checkout
                            </h2>
                            <p>
                                Say “goodbye” to slow loading checkout pages! Enhance user experience with lightning-fast checkout pages, including instant and secure credit card processing.
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
                                Payout Checkout
                            </h4>
                            <h2>
                                Integrated lightning-fast checkout
                            </h2>
                            <p>
                                Say “goodbye” to slow loading checkout pages! Enhance user experience with lightning-fast checkout pages, including instant and secure credit card processing.
                            </p>
                            <button>
                                Explore Now
                            </button>
                        </div>
                    </div>
                    <div class="el-icon-message">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674133362/OjaFunnel-Images/Rectangle_18987_1_wvh6u2.png" draggable="false" alt="">
                    </div>
                </div>
            </div>
        </section>
    <!-- Communication Ends -->

    <!-- Increasing -->
        <section class="Increasing" style="background: #FCFCFE !important;">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="thread-text">
                            <h4>
                                PAGES AND PRODUCTS 
                            </h4>
                            <h2>
                                Boost conversions with a unique page for every product
                            </h2>
                            <p>
                                Set up your store easily by picking a template. Customize it with ease. Then publish. You’ll be ready to start accepting orders in minutes. 
                            </p>
                            <button>
                                Explore
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="imagess">
                            <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674133362/OjaFunnel-Images/Rectangle_18987_1_wvh6u2.png" draggable="false">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Increasing Ends -->

    <!-- Features -->
    <section class="Features">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="btn-text">
                        <h1>
                        Built-in features for your business
                        </h1>
                        <p>
                        Get more sales and customers for your business with our awesome features 
                        </p>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-4">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            Integrated checkout 
                            </h1>
                            <p>
                            Accept payments for your products from anywhere in the world   
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            Quizzes
                            </h1>
                            <p>
                            Create quizzes to test your students understanding of the material
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            1-click upsells
                            </h1>
                            <p>
                            Gives your students and customers an opportunity to buy more from you
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="aler"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            LMS Feature
                            </h1>
                            <p>
                            Use the platform for handle course management, quizzes and assessments.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="aler"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            Custom domain
                            </h1>
                            <p>
                            Get custom domain, or easily link your existing website to Ojafunnel 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="aler"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674143190/OjaFunnel-Images/Ellipse_910_ndx5ym.png" class="optic" alt="Picture" draggable="false">
                        <div class="drag">
                            <h1>
                            Abandoned cart recovery
                            </h1>
                            <p>
                            Triggered mails to give your lead another chance to buy from you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Ends -->

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="kit-font">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png">
                        <p>
                            Ojafunnel is an all-in-one marketing platform to acquire leads through lead generation forms and optin, engage web visitors through beautiful landing pages, nurture them through engaging emails, and automate your marketing funnel through marketing automation.
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
                            Helping thousands of businesses succeed,<a href="{{route('login')}}">
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
                </div>
                <div class="col-lg-12">
                    <div class="last-fott text-center">
                        <a href="{{route('privacy')}}">
                            Privacy Policy
                        </a>
                        |
                        <a href="{{route('terms')}}">
                            Terms & Condition
                        </a>
                        <h1>
                            Copyright © {{ date('Y') }} {{config('app.name')}}. All rights reserved
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>
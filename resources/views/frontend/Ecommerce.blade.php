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
                                                <p>Run email marketing campaign without the with 100% Delivery rate, track your customers activities and build unlimited lists.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('affiliate')}}">
                                                            Affiliate Marketing
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Fully-featured affiliate marketing module that allows you to create and manage affiliate campaigns efficiently.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('ecommerce')}}">
                                                            Ecommerce
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Create digital products, Courses,Training and members area.</p>
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
                                                        <a href="{{route('funnelbuilder')}}">
                                                            Funnel Builder
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Create many sales funnels to recapture your leads and optimise their lifetime value.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('pagebuilder')}}">
                                                            Page Builder
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Design beautiful pages in minutes with our beautiful templates readily made available for you.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('template')}}">
                                                            Template Designs
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>pre-made designs and documents that can be customized is available on Ojafunnel</p>
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
                                                <p>Automate or schedule SMS to your buyers' list, prospects list or individuals.</p>
                                            </div>
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('chatautomation')}}">
                                                            Chat Automations
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Chat Automate or schedule SMS to your buyers' list, prospects list or individuals.</p>
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
                                                        <a href="{{route('integrations')}}">
                                                            API Integrations
                                                        </a>
                                                    </h4>
                                                </div>
                                                <p>Track various statistics and metrics associated with all your email activities and campaigns.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="dropdown-menu mobile-dropdown" aria-labelledby="navbarDropdown">
                                    <li>
                                        <a href="{{route('marketauto')}}" class="dropdown-item">
                                            Email Marketing
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('affiliate')}}" class="dropdown-item">
                                            Affiliate Marketing
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('ecommerce')}}" class="dropdown-item">
                                            Ecommerce
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('funnelbuilder')}}" class="dropdown-item">
                                            Funnel Builder
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('pagebuilder')}}" class="dropdown-item">
                                            Page Builder
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('marketauto')}}" class="dropdown-item">
                                            Marketing Automations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('chatautomation')}}" class="dropdown-item">
                                            Chat Automations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('integrations')}}" class="dropdown-item">
                                            API Integrations
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('template')}}" class="dropdown-item">
                                            Template Designs
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('pricing')}}" class="nav-link {{ (request()->is('pricing')) ? 'active' : '' }}" class="routers">
                                    Pricing
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('faqs')}}" class="nav-link {{ (request()->is('faqs')) ? 'active' : '' }}" class="routers">
                                    FAQs
                                </a>
                            </li>
                            <!-- -->
                            <li class="nav-item">
                                <a href="{{route('contact')}}" class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}" class="routers">
                                    Contact
                                </a>
                            </li>
                        </ul>
                        @auth
                        <div class="login-div">
                            <a href="{{route('user.dashboard', Auth::user()->username)}}" class="btn-signup">Dashboard <i class="bi bi-box-arrow-right"></i></a>
                        </div>
                        @else
                        @if(Auth::guard('admin')->user())
                        <div class="login-div">
                            <a href="{{route('adminDashboard')}}" class="btn-signup">Dashboard <i class="bi bi-box-arrow-right"></i></a>
                        </div>
                        @else
                        <div class="login-div">
                            <a href="{{route('login')}}" class="btn-login">Login</a>
                            <a href="{{route('signup')}}" class="btn-signup">Sign Up <i class="bi bi-box-arrow-right"></i></a>
                        </div>
                        @endif
                        @endauth
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
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679414663/OjaFunnel-Images/Launch_for_free_wqz2fo.png" draggable="false" alt=""> <span>Launch for free</span>
                        <p>
                            Create a website with a product catalog at no cost—you only pay when you make a sale.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  mb-4">
                    <div class="bording">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679414937/OjaFunnel-Images/Find_new_customers_nt7bqb.png" draggable="false" alt=""> <span>Find new customers</span>
                        <p>
                            Drive traffic and e-commerce sales with the free, powerful marketing tools that come with your store.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4  mb-4">
                    <div class="bording">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679414937/OjaFunnel-Images/Own_your_brand_dr2vnq.png" draggable="false" alt=""> <span>Own your brand</span>
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679415261/OjaFunnel-Images/UPSELLS_hlrvvx.jpg" draggable="false">
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679414659/OjaFunnel-Images/INTEGRATED_CHECKOUT_fy4kh6.jpg" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            Payout Checkout
                        </h4>
                        <h2>
                            Integrated lightning-fast checkou
                        </h2>
                        <p>
                            Say “goodbye” to slow loading checkout pages! Enhance user experience with lightning-fast checkout pages, including instant and secure credit card processing.
                        </p>
                        <button>
                            Explore
                        </button>
                    </div>
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679415774/OjaFunnel-Images/PAGES_AND_PRODUCTS_zg0tue.jpg" draggable="false">
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Communication Ends -->

    <!-- Communication -->
    <section class="communication display">
        <div class="container">
            <div class="col-lg-6">
                <div class="el-icon-message">
                    <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679414659/OjaFunnel-Images/INTEGRATED_CHECKOUT_fy4kh6.jpg" draggable="false" alt="">
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
                        Explore
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication Ends -->

    <!-- Features -->
    <section class="offer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="what">
                        <h1>
                            Enjoy All-In-One features
                        </h1>
                    </div>
                </div>
                <div class="what"></div>
                <div class="col-lg-3">
                    <a href="{{route('pagebuilder')}}">
                        <div class="card" data-aos="zoom-in-right">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669720/OjaFunnel-Images/page_kunfbn.png" draggable="false" alt="">
                            <h1>
                                Page Builder
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('funnelbuilder')}}">
                        <div class="card" data-aos="zoom-in-right">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669823/OjaFunnel-Images/landing-page_moq46w.png" draggable="false" alt="">
                            <h1>
                                Funnel Builder
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('marketauto')}}">
                        <div class="card" data-aos="zoom-in-left">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669907/OjaFunnel-Images/email-marketing_o5cvun.png" draggable="false" alt="">
                            <h1>
                                Email Marketing
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('chatautomation')}}">
                        <div class="card" data-aos="zoom-in-left">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670000/OjaFunnel-Images/automation_n9hir4.png" draggable="false" alt="">
                            <h1>
                                SMS Automation
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('affiliate')}}">
                        <div class="card" data-aos="zoom-in-right">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670161/OjaFunnel-Images/seo-report_rltbqw.png" draggable="false" alt="">
                            <h1>
                                Analysis and Reporting
                            </h1>

                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('ecommerce')}}">
                        <div class="card" data-aos="zoom-in-right">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670372/OjaFunnel-Images/shopping_seidhl.png" draggable="false" alt="">
                            <h1>
                                Ecommerce
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('affiliate')}}">
                        <div class="card" data-aos="zoom-in-left">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670416/OjaFunnel-Images/affiliate-marketing_cycnqk.png" draggable="false" alt="">
                            <h1>
                                Affiliate Module
                            </h1>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3">
                    <a href="{{route('integrations')}}">
                        <div class="card" data-aos="zoom-in-left">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670479/OjaFunnel-Images/gateway_durgdd.png" draggable="false" alt="">
                            <h1>
                                Payment Integration
                            </h1>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Ends -->

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="quick">
                        <ul>
                            <li>
                                <div class="force">
                                    <a href="#">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="">
                                    </a>
                                </div>
                            </li>
                            <li>
                                Ojafunnel is an all-in-one marketing platform to acquire leads through lead generation forms and optin, engage web visitors through beautiful landing pages, nurture them through engaging emails, and automate your marketing funnel through marketing automation.
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Features
                        </h1>
                        <ul>
                            <li>
                                <a href="{{route('pagebuilder')}}">Page Builder</a>
                            </li>
                            <li>
                                <a href="{{route('funnelbuilder')}}">Funnel Builder</a>
                            </li>
                            <li>
                                <a href="{{route('marketauto')}}">Automation</a>
                            </li>
                            <li>
                                <a href="{{route('ecommerce')}}">Ecommerce</a>
                            </li>
                            <li>
                                <a href="{{route('emailmarketing')}}">Email Marketing</a>
                            </li>
                            <li>
                                <a href="{{route('affiliate')}}">Affiliate Marketing</a>
                            </li>
                            <li>
                                <a href="{{route('chatautomation')}}">Chat Automation</a>
                            </li>
                            <li>
                                <a href="{{route('integrations')}}">API Integration</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Quick Link
                        </h1>
                        <ul>
                            <li>
                                <a href="{{route('index')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('pricing')}}"> Pricing</a>
                            </li>
                            <li>
                                <a href="{{route('faqs')}}">FAQs</a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Account
                        </h1>
                        <ul>
                            <li>
                                <a href="{{route('signup')}}">Register</a>
                            </li>
                            <li>
                                <a href="{{route('login')}}">Login</a>
                            </li>
                        </ul>
                        <h1>
                            Resources
                        </h1>
                        <ul>
                            <li>
                                <a href="{{route('privacy')}}">Privacy Policy</a>
                            </li>
                            <li>
                                <a href="{{route('terms')}}">Terms & Condition</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="quick">
                        <h1>
                            Follow Us
                        </h1>
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678779/OjaFunnel-Images/facebook_n5uvff.png" draggable="false" title="Follow" alt="">
                                </a>
                                <a href="#">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678781/OjaFunnel-Images/twitter_kd7mew.png" draggable="false" alt="">
                                </a>
                                <a href="#">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678783/OjaFunnel-Images/instagram_zf1kco.png" draggable="false" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="last-fott text-center">
                        <!-- <a href="{{route('privacy')}}">
                            Privacy Policy
                        </a>
                        |
                        <a href="{{route('terms')}}">
                            Terms & Condition
                        </a> -->
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

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
        <nav style="background: linear-gradient(101.28deg, #6997DD -7.37%, #39B7C5 142.82%);" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
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
<<<<<<< HEAD
                                                        Page Builder 
=======
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
>>>>>>> e004fe4 (update)
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>pre-made designs and documents that can be customized is available on Ojafunnel</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="#">
                                                       Template Designs
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
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                             Email Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('affiliate')}}" class="routers">
                                        <a class="dropdown-item">
                                             Affiliate Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('ecommerce')}}" class="routers">
                                        <a class="dropdown-item">
                                             Ecommerce
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('funnelbuilder')}}" class="routers">
                                        <a class="dropdown-item">
                                             Funnel Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('pagebuilder')}}" class="routers">
                                        <a class="dropdown-item">
                                             Page Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                             Marketing Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('chatautomation')}}" class="routers">
                                        <a class="dropdown-item">
                                             Chat Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('integrations')}}" class="routers">
                                        <a class="dropdown-item">
                                             API Integrations
                                        </a>
                                    </a>
                                </li>
<<<<<<< HEAD
<<<<<<< HEAD
=======
                                <li>
                                    <a href="{{route('template')}}" class="routers">
=======
                                <li>
                                    <a href="#" class="routers">
>>>>>>> 40fc05a (Update)
                                        <a class="dropdown-item">
                                            Template Designs
                                        </a>
                                    </a>
                                </li>
<<<<<<< HEAD
>>>>>>> e004fe4 (update)
=======
>>>>>>> 40fc05a (Update)
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

    <!-- Email-Section -->
    <section class="email-section" style="background: linear-gradient(101.28deg, #6997DD -7.37%, #39B7C5 142.82%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="btn-text">
                        <h1>
                            Integrate your favourite tools to do more with Ojafunnel
                        </h1>
                        <p>
                            Take your marketing further when you connect to your favorite apps and web services
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
    <!-- Email-Section Ends -->

    <!-- Increasing -->
    <section class="Increasing">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="thread-text">
                        <h1>
                            Integration to make you market smarter and grow faster
                        </h1>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            MAKE PAYMENT
                        </h4>
                        <h2>
                            Payment gateway integration for easier and faster payment
                        </h2>
                        <p>
                            Integrate payment gateways into your website or e-commerce platform to allow customers to make payments directly on your site from anywhere
                        </p>
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177008/OjaFunnel-Images/Group_46934_b7i8ji.png" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Increasing" style="background-color: #FCFCFE;">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 mb-4">
                    <div class="thread-text text-center">
                        <h4>
                            communication
                        </h4>
                        <h2>
                            Emails and SMS gateway integrations
                        </h2>
                        <p>
                            Mass email and sms integrations to deliver your mailing campaigns to your users. We integrate with sendgrid, twilo, and more.
                        </p>
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-3" style="margin-top: 30px;">
                    <div>
                        <img width="100%" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19429_dkzil0.png" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 30px;">
                    <div>
                        <img width="100%" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19430_xwwm2k.png" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 30px;">
                    <div>
                        <img width="100%" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19431_abdoih.png" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-3" style="margin-top: 30px;">
                    <div>
                        <img width="100%" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176680/OjaFunnel-Images/Group_46931_kbs6gz.png" draggable="false" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Increasing Ends -->

    <!-- Communication -->
    <section class="communication hide" style="background-color: #fff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="el-icon-message">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177012/OjaFunnel-Images/Group_46933_rmafev.png" draggable="false" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            REPORTS AND ANALYSIS
                        </h4>
                        <h2>
<<<<<<< HEAD
                        Reach customers and enhance sales 
=======
                            Reach customers and enhance sales
>>>>>>> e004fe4 (update)
                        </h2>
                        <p>
                            Integrate tools that help you market smarter, and also give you the ability to scale faster and stay ahead of the competition.
                        </p>
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
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
                            REPORTS AND ANALYSIS
                        </h4>
                        <h2>
<<<<<<< HEAD
                        Reach customers and enhance sales 
=======
                            Reach customers and enhance sales
>>>>>>> e004fe4 (update)
                        </h2>
                        <p>
                            Integrate tools that help you market smarter, and also give you the ability to scale faster and stay ahead of the competition.
                        </p>
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="el-icon-message">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177012/OjaFunnel-Images/Group_46933_rmafev.png" draggable="false" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication Ends -->


    <!-- Features -->
    <section class="Features">
        <div class="container">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="btn-text mb-4">
                        <h1>
<<<<<<< HEAD
                        Do more with our Integrations 
=======
                            Do more with our Integrations
>>>>>>> e004fe4 (update)
                        </h1>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177279/OjaFunnel-Images/Rectangle_19433_bn7ycr.png" alt="Picture" draggable="false">
                        
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177280/OjaFunnel-Images/Rectangle_19439_ekkfnx.png" alt="Picture" draggable="false">
                        
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675177279/OjaFunnel-Images/Rectangle_19438_dzmrce.png" alt="Picture" draggable="false">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19431_abdoih.png" alt="Picture" draggable="false">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19429_dkzil0.png" alt="Picture" draggable="false">
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="alert"></div>
                    <div class="Amet">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675176410/OjaFunnel-Images/Rectangle_19430_xwwm2k.png" alt="Picture" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Ends -->

    <!-- Digital -->
<<<<<<< HEAD
        <section class="digital">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mount">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h1>
                                    Engage customers and grow your business with emails marteting features! 
                                    </h1>
                                    <div class="level"></div>
                                    <a href="{{route('signup')}}">
                                        <button>
                                            Sign up
                                        </button>
                                    </a>
                                    <button style="background-color: #527EEB; color: #fff;">
                                        See Demo
=======
    <section class="digital">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mount">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h1>
                                    Engage customers and grow your business with emails marteting features!
                                </h1>
                                <div class="level"></div>
                                <a href="{{route('signup')}}">
                                    <button>
                                        Sign up
>>>>>>> e004fe4 (update)
                                    </button>
                                </a>
                                <button style="background-color: #527EEB; color: #fff;">
                                    See Demo
                                </button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Digital Ends -->
    <!-- Footter -->
    <section class="footer">
<<<<<<< HEAD
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
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('emailmarketing')}}">Features</a>
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
                            <input type="email" class="form-control" placeholder="Your email Address" required>
                            <span class="input-group-text" id="basic-addon2" type="submit" required>Subscribe</span>
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
=======
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="quick">
                        <h1>
                            Company
                        </h1>
                        <ul>
                            <li style="text-align:justify">
                                Ojafunnel is an all-in-one marketing platform to acquire leads through lead generation forms and optin, engage web visitors through beautiful landing pages, nurture them through engaging emails, and automate your marketing funnel through marketing automation.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-1"></div>
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
                                <a href="{{route('login')}}">Register</a>
                            </li>
                            <li>
                                <a href="{{route('signup')}}">Login</a>
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
>>>>>>> e004fe4 (update)
                </div>
            </div>
        </div>
    </section>
    <!-- Footter Ends -->

    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>
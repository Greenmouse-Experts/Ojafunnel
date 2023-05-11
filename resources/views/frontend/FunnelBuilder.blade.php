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
        <nav style="background: linear-gradient(101.28deg, #3C40A5 -7.37%, #208FF7 142.82%);" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
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
    <section class="Ecommerce" style="background: linear-gradient(101.28deg, #3C40A5 -7.37%, #208FF7 142.82%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="accelerate">
                        <h1>
                            Increase revenue by converting your visitors into paying customers
                        </h1>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h3>
                                    Design and launch automated, sales-driving funnels to attract customers online, generate leads, and more
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
                                        <a href="{{route('demo')}}">
                                            <button style="background: #2F63CA; color: #fff;">
                                                See Demo
                                            </button>
                                        </a>
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
    <!-- <section class="Build">
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
        </section> -->
    <!--Ecommerce Build Ends -->


    <!-- Increasing -->
    <section class="Increasing" style="background: #FCFCFE !important;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h1>
                            Maximum your online potential with our funnels
                        </h1>

                    </div>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674210493/OjaFunnel-Images/Group_46926_1_bq9n0d.png" draggable="false">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            automated flow
                        </h4>
                        <h2 class="mb-4">
                            Do more with our funnel builder
                        </h2>
                        <div class="bording mb-4">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679416280/OjaFunnel-Images/drag-and-drop_sjeler.png" draggable="false" alt=""> <span>Drag, drop and connect</span>
                            <p>
                                Easily drag the different events into the canvas and connect the flow with arrows.
                            </p>
                        </div>
                        <div class="bording mb-4">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679416311/OjaFunnel-Images/autopilot_vz24hz.png" draggable="false" alt=""> <span>Runs on autopilot for you, 24-7-365</span>
                            <p>
                                Ojafunnel automates your sales funnels, running 24/7 for maximum conversion
                            </p>
                        </div>
                        <div class="bording mb-4">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679416285/OjaFunnel-Images/Funnel_Template_qlgliz.png" draggable="false" alt=""> <span>Funnel Templates </span>
                            <p>
                                We have pre-build funnels for different businesses already set for you
                            </p>
                        </div>
                        <div class="bording mb-4">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679416286/OjaFunnel-Images/mind-map_ac5zvf.png" draggable="false" alt=""> <span>Flow mapping</span>
                            <p>
                                Set the flow of your funnel, ie set the page that comes first, second and third.
                            </p>
                        </div>
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
                    <div class="thread-text">
                        <h4>
                            generate LEADS
                        </h4>
                        <h2>
                            Move leads through your funnel with emails , whatsApp & sms .
                        </h2>
                        <p>
                            Set funnels to take your customer engagement to the next level by using automated emails to send personalized follow-ups for your leads
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674210058/OjaFunnel-Images/Rectangle_19421_lfrihj.png" draggable="false" alt="">
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
                            generate LEADS
                        </h4>
                        <h2>
                            Move leads through your funnel with emails
                        </h2>
                        <p>
                            Set funnels to take your customer engagement to the next level by using automated emails to send personalized follow-ups for your leads
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674210058/OjaFunnel-Images/Rectangle_19421_lfrihj.png" draggable="false" alt="">
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
                    <div class="imagess">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1679416257/OjaFunnel-Images/Share_your_built_funnels_with_others_qcq8l0.jpg" draggable="false">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thread-text">
                        <h4>
                            Funnel cloning
                        </h4>
                        <h2>
                            Share your built funnels with others
                        </h2>
                        <p>
                            With our funnel cloning ability, we allow you to clone other users funnel if the funnel is shared with other users.
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
    <!-- Increasing Ends -->
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
                                SMS & WhatsApp Automation
                            </h1>
                        </div>
                    </a>
                </div>
                 <div class="col-lg-3">
                <a href="{{route('demo')}}">
                    <div class="card" data-aos="zoom-in-right">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670161/OjaFunnel-Images/seo-report_rltbqw.png" draggable="false" alt="">
                        <h1>
                            Template Design
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

    <!-- Digital -->
    <section class="digital">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mount">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h1>
                                    Enhance your marketing by sending the right message at the right time
                                </h1>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="level"></div>
                                <a href="signup">
                                    <button>
                                        Sign up
                                    </button>
                                </a>
                                <a href="{{route('demo')}}">
                                    <button style="background-color: #527EEB; color: #fff;">
                                        See Demo
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
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
                <div class="col-lg-3">
                    <div class="quick">
                        <h1>
                            Newsletter
                        </h1>
                        <form class="search-bar mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your email Address">
                                <span class="input-group-text" id="basic-addon2">Subscribe</span>
                            </div>
                        </form>
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

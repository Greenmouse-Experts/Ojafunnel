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
        <nav style="background: linear-gradient(101.28deg, #BF69DD -7.37%, #39B7C5 142.82%);" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
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
    <section class="Ecommerce" style="background: linear-gradient(101.28deg, #BF69DD -7.37%, #39B7C5 142.82%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="accelerate">
                        <h1>
                            Become an Ojafunnel affiliate today
                        </h1>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <h3>
                                    Earn some percentages % on any refers. We are growing fast. Let us share our success with you!
                                </h3>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        <div class="btn-curve">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-8">
                                    <div>
                                        <button style="background-color: #fff; display: block !important; margin:auto  !important; "><a href="{{route('signup')}}" style="color: #000;">
                                                Join the Affiliate program
                                            </a></button>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>
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
                            Enjoy different tiers of Affiliate System
                        </h1>
                    </div>
                </div>
                <div class="col-lg-6 mb-4 text-center">
                    <div class="bond"></div>
                    <div class="Affilate">
                        <h4>
                            1 tier Affiliate
                        </h4>
                        <h1>
                            Merchant to System
                        </h1>
                        <p>
                            Earn commission on every user that registers using your referral link with Ojafunnel
                        </p>
                        <a href="#">
                            <button>
                                Sign up
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4  text-center">
                    <div class="bond" style="background-color: #A648E4;"></div>
                    <div class="Affilate">
                        <h4>
                            2 tier Affiliate
                        </h4>
                        <h1>
                            Merchant to Customers
                        </h1>
                        <p>
                            Earn commission through a downline of the referrals on your created website
                        </p>
                        <a href="#">
                            <button>
                                Sign up
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Ecommerce Build Ends -->

    <!-- Fear -->
    <section class="Fear">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h4>
                        Affiliate
                    </h4>
                    <h1>
                        Build your passive income with Ojafunnel
                    </h1>
                </div>
                <div class="col-lg-6">
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        Get lifetime commission for each customer you refer.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        Get 30% lifetime recurring commission.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        15% DISCOUNT for your referrals' first purchase.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        We have extended 60 days cookies
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Fear -->
    <!-- Fear -->
    <section class="Fear" style="background-color: #FCFCFE;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        Top class industry solution for online marketing.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        High converting Free Forever plans.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        Competitively priced paid plans & flexibility.
                    </div>
                    <div><img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674572502/OjaFunnel-Images/Vector_juubcp.png" draggable="false" alt=""></div>
                    <div class="child">
                        Special Discounts for Affiliates integrating Ojafunnel plans
                    </div>
                </div>
                <div class="col-lg-6 hide">
                    <h4>
                        Affiliate
                    </h4>
                    <h1>
                        Reasons to become affiliate
                        & promote GetResponse
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Fear -->

    <!--FAQ Page-->
    <main class="faqPage">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2>You have questions ? We've got answers</h2>
                </div>
                <div class="col-lg-10">
                    <div class="faq-box">
                        <details>
                            <summary>What is an affiliate marketing program ?</summary>
                            <div class="faq-content">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores magnam totam illo perspiciatis nemo asperiores similique voluptatem maiores qui voluptas?</p>
                            </div>
                        </details>
                        <details>
                            <summary>How much can I earn? </summary>
                            <div class="faq-content">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores magnam totam illo perspiciatis nemo asperiores similique voluptatem maiores qui voluptas?</p>
                            </div>
                        </details>
                        <details>
                            <summary>How to get commissions with your affiliate link? </summary>
                            <div class="faq-content">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores magnam totam illo perspiciatis nemo asperiores similique voluptatem maiores qui voluptas?</p>
                            </div>
                        </details>
                        <details>
                            <summary>Can anyone join the affiliate program ? </summary>
                            <div class="faq-content">
                                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores magnam totam illo perspiciatis nemo asperiores similique voluptatem maiores qui voluptas?</p>
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Page-Content -->
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
                <a href="#">
                    <div class="card" data-aos="zoom-in-right">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669720/OjaFunnel-Images/page_kunfbn.png" draggable="false" alt="">
                        <h1>
                            Page Builder
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-right">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669823/OjaFunnel-Images/landing-page_moq46w.png" draggable="false" alt="">
                        <h1>
                            Funnel Builder
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-left">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677669907/OjaFunnel-Images/email-marketing_o5cvun.png" draggable="false" alt="">
                        <h1>
                            Email Marketing
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-left">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670000/OjaFunnel-Images/automation_n9hir4.png" draggable="false" alt="">
                        <h1>
                            SMS Automation
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-right">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670161/OjaFunnel-Images/seo-report_rltbqw.png" draggable="false" alt="">
                        <h1>
                            Analysis and Reporting
                        </h1>

                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-right">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670372/OjaFunnel-Images/shopping_seidhl.png" draggable="false" alt="">
                        <h1>
                            Ecommerce
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
                    <div class="card" data-aos="zoom-in-left">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677670416/OjaFunnel-Images/affiliate-marketing_cycnqk.png" draggable="false" alt="">
                        <h1>
                            Affiliate Module
                        </h1>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="#">
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

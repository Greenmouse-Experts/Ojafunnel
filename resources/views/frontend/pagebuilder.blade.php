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
                                <li>
                                    <a href="{{route('template')}}" class="routers">
                                        <a class="dropdown-item">
                                            Template Designs
                                        </a>
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
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1674489037/OjaFunnel-Images/Group_46928_ohy9gs.png" draggable="false">
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675090835/OjaFunnel-Images/Group_46907_qxujq8.png" draggable="false" alt="">
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
                            SEGMENTATION
                        </h4>
                        <h2>
                            Grow your audience and keep it organized
                        </h2>
                        <p>
                            Landing pages make it easy to capture your visitors’ contact information and move them to the next stage of your funnel. Use segmentation to track your leads lifecycle and follow-up with relevant messaging.
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675090835/OjaFunnel-Images/Group_46907_qxujq8.png" draggable="false" alt="">
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
                        <a href="{{route('signup')}}">
                            <button>
                                Explore Now
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="imagess">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675090834/OjaFunnel-Images/Group_46930_bdtlan.png" draggable="false">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Editable Ends -->
     <!-- Communication -->
     <section class="communication hide">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="el-icon-message">
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675090834/OjaFunnel-Images/Rectangle_18983_pz6pti.png" draggable="false" alt="">
                    </div>
                </div>
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
                            Get reports on visitors, clicks, conversions and more
                        </h2>
                        <p>
                            Find what is high converting, ie visitors, clicks, conversions, and revenue, as well as track what content or offerings are most interesting to different audience segments.
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
                        <img class="pulse" src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675090834/OjaFunnel-Images/Rectangle_18983_pz6pti.png" draggable="false" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Communication Ends -->


    <section class="digital">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mount">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h1>
                                    Effortlessly create impressive pages to help grow your audience
                                </h1>
                                <div class="level"></div>
                                <a href="{{route('signup')}}">
                                    <button>
                                        Sign up
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


    <!-- Footter -->
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
</section>    <!-- Footter Ends -->
    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>
    <script src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('assets/js/main.js')}}"></script>
        <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>

</html>

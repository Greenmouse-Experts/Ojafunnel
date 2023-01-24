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
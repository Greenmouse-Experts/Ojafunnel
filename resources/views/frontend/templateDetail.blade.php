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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <!-- Header -->
    <!-- linear-gradient(101.28deg, #3C40A5 -7.37%, #208FF7 142.82%) -->
    <header class="market">
        <nav class="navbar navbar-expand-lg fixed-top" id="header">
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
                                                        <a href="{{route('affiliate')}}">
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
                                                        <a href="{{route('funnelbuilder')}}">
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
                                            <div>
                                                <div class="btn-area">
                                                    <h4>
                                                        <a href="{{route('template')}}">
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
                                                        <a href="{{route('integrations')}}">
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
                                        <a href="#" class="routers">
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
    <!-- hero -->
    <div class="template-hero-banner">
        <div class="container h-100">
            <div class="hero-container">
                <div class="template-hero-div">
                    <p class="template-head-text">{{$page->folder}} Page</p>
                </div>
            </div>
        </div>
    </div>
    <!-- hero ends -->
    <!-- page contents -->
    <div class="template-content mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 template-img-col">
                    <div class="w-100">
                         @if($page->thumbnail)
                        <img src="{{$page->thumbnail}}" alt="{{$page->name}}" width="100%" height="100%" />
                        @else
                        <img src="http://via.placeholder.com/640x1000" alt="template" width="100%" height="100%" />
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5 template-text-col">
                    <div class="details-text">
                        <p class="text-header">Do you like this template?</p>

                        <a href="
                            @if (env('APP_ENV') == 'local')
                                {{ $page->file_location }}
                            @else
                                @if ($page->name == 'index.html')
                                    {{ "https://$page->slug-page.ojafunnel.com"}}
                                @else
                                    {{ "https://$page->slug-page.ojafunnel.com/" . explode('.', $page->name)[0] }}
                                @endif 
                            @endif
                        " class="btn btn-primary mt-4">View Template</a><br>
                        <a href="{{ route('signup') }}" class="btn btn-primary mt-4">Use Template</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page contents ends -->
    <script>
        window.addEventListener('scroll', function() { 
            var scroll = $(window).scrollTop();
            let header = document.getElementById("header")

            if (scroll.scrollTop() > 50) {
            $('#header').style.backgroundColor = "#3383e6 !important";
            } else {
                $('#header').style.backgroundColor = "inherit !important";
            }
        
        })
    </script>
</body>
</html>
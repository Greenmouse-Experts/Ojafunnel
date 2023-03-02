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
<<<<<<< HEAD
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
=======
>>>>>>> 40fc05a (Update)
</head>
<body>
    <!-- Header -->
    <!-- linear-gradient(101.28deg, #3C40A5 -7.37%, #208FF7 142.82%) -->
    <header class="market">
<<<<<<< HEAD
        <nav class="navbar navbar-expand-lg fixed-top" id="header">
=======
        <nav style="background: inherit;" class="navbar navbar-expand-lg fixed-top" id="header-scroll">
>>>>>>> 40fc05a (Update)
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
<<<<<<< HEAD
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
=======
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
                        <div class="login-div">
                            <a href="{{route('login')}}" class="btn-login">Login</a>
                            <a href="{{route('signup')}}" class="btn-signup">Sign Up <i class="bi bi-box-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
>>>>>>> 40fc05a (Update)
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
    <!-- hero -->
    <div class="template-hero-banner">
        <div class="container h-100">
            <div class="hero-container">
                <div class="template-hero-div">
                    <p class="template-head-text">Free Page Builder Templates</p>
                    <p class="template-mid-text">Choose a template and get started</p>
                    <div class="template-search-div">
                        <input type="search" placeholder="Search template" />
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- hero ends -->
    <!-- page contents -->
    <div class="template-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 pe-lg-5 template-side">
                    <div class="license-div">
                        <p><i class="bi bi-check2-square pe-2 text-warning fs-4"></i>License</p>
                        <ul class="license-radio">
                            <li>
                                <input type="radio" name="license" />
                                <span>Any</span>
                            </li>
                            <li>
                                <input type="radio" name="license" />
                                <span>Free</span>
                            </li>
                            <li>
                                <input type="radio" name="license" />
                                <span>Premium</span>
                            </li>
                        </ul>
                    </div>
                    <div class="sort-div">
                        <p><i class="bi bi-sort-down fs-4 pe-2 text-warning"></i>Sort by</p>
                        <ul class="sort-radio">
                            <li>
                                <input type="radio" name="sort" />
                                <span>Recent</span>
                            </li>
                            <li>
                                <input type="radio" name="sort" />
                                <span>Popular</span>
                            </li>
                            <li>
                                <input type="radio" name="sort" />
                                <span>Top Rated</span>
                            </li>
                            <li>
                                <input type="radio" name="sort" />
                                <span>Editor's Pick</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10">
                    <!-- category -->
                    <div class="choose-category">
                        <p>Choose Category</p>
                        <div class="category-list">
                            <ul>
                                <li class="bg-success text-white">Eccommerce</li>
                                <li class="bg-warning text-white">Easter</li>
                                <li class="bg-primary text-white">Business</li>
                                <li class="bg-danger text-white">Finance</li>
                                <li class="bg-info text-white">Crypto</li>
                                <li class="bg-secondary text-white">Logistics</li>
                                <li class="bg-success text-white">Eccommerce</li>
                                <li class="bg-warning text-white">Easter</li>
                                <li class="bg-primary text-white">Business</li>
                                <li class="bg-danger text-white">Finance</li>
                                <li class="bg-info text-white">Crypto</li>
                                <li class="bg-secondary text-white">Logistics</li>
                            </ul>
                        </div>
                    </div>
                    <!-- category content -->
                    <div class="template-listing">
                        <div class="template-listing-grid">
                            <div class="single-template">
                                <div class="inner first-grid">
                                    <div  class="text-center">
                                        <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                        <button class="btn btn-primary d-block mt-2">New Template</button>
                                    </div>
                                </div>
                            </div>
                            <div class="single-template">
                                <div class="inner second-grid">
                                    <img src="https://templatemo.com/screenshots-720/template-562-space-dynamic.jpg" alt="templates" width="100%" height="100%"/>
                                    <div  class="start-template">
                                        <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                        <button class="btn btn-primary d-block mt-2">Use Template</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page contents ends -->
<<<<<<< HEAD
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
=======
</body>
</html>
>>>>>>> 40fc05a (Update)

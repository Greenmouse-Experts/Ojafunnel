<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> Oja Funnel | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.webui-popover.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- Bootstrap Css -->
   <!-- Font Css-->
   <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body>
    <section class="menu-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <ul class="mobile-header-buttons">
                            <li><a class="mobile-search-trigger" href="#mobile-search">Search<span></span></a></li>
                        </ul>
                        <a class="navbar-brand" href="{{route('user.dashboard', Auth::user()->username)}}">
                            Ojafunnel Shop
                        </a>
                        <form class="inline-form mt-3" style="width: 80%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="user-box menu-icon-box">
                            <div class="icon">
                                <a href="">
                                    <img src="{{ asset('dash/assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid">
                                </a>
                            </div>
                            <div class="dropdown user-dropdown corner-triangle top-right">
                                <ul class="user-dropdown-menu">
                                    <li class="dropdown-user-info">
                                        <a href="">
                                            <div class="clearfix">
                                                <div class="user-details">
                                                    <div class="user-name">
                                                        <span class="hi">hi,</span>
                                                    </div>
                                                    <div class="user-email">
                                                        <span class="welcome">Welcome back</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="user-dropdown-menu-item">
                                        <a href="#">
                                            <i class="far fa-gem"></i>My Courses
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="course-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="course-header-wrap mb-4git">
                        <h1 class="title">Html and CSS and Javascript</h1>
                        <p class="subtitle">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vitae omnis eaque necessitatibus nulla, quaerat ea ut eius alias esse deleniti!</p>
                        <div class="rating-row">
                            <span class="course-badge best-seller">Best seller</span>
                            <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                            <i class="fas fa-star"></i>
                            <span class="d-inline-block average-rating"></span>
                            <span>(20 ratings)</span>
                            <span class="enrolled-num">
                                100 students enrolled
                            </span>
                        </div>
                        <div class="created-row">
                            <!-- {{--<span class="created-by">--}}
                            {{--Created by--}}
                            {{--<a href="">first_name last_name</a>--}}
                            {{--</span>--}} -->
                            <span class="last-updated-date">Created on 01/02/2023</span>
                            <span class="last-updated-date">Last updated on 01/02/2023</span>
                            <span class="comment">
                                <i class="fas fa-comment"></i>English
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <div class="course-sidebar-text-box">
                            <div class="buy-btns">
                                    <a href="" class="btn btn-buy-now" id="course_2" onclick="handleBuyNow(this)">Buy
                                        now</a>
                                    <form>
                                        <input type="hidden" value="1" name="course_id">
                                        <input type="hidden" value="Html and Css" name="name">
                                        <input type="hidden" value="100" name="price">
                                        <input type="hidden" value="1" name="quantity">
                                        <button class="btn btn-add-cart" type="submit">Add to
                                            cart
                                        </button>
                                    </form>
                            </div>

                            <div class="includes">
                                <div class="title"><b>Includes:</b></div>
                                <ul>
                                    <li>
                                        <i class="far fa-file-video"></i>
                                        on_demand_videos
                                    </li>
                                    <li>
                                        <i class="far fa-file"></i> 2 lessons
                                    </li>
                                    <li><i class="far fa-compass"></i>Full lifetime access
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="course-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="what-you-get-box">
                        <div class="what-you-get-title">What i will learn?</div>
                        <ul class="what-you-get__items">
                            <li>You will create a portfolio of 15 apps to be able apply for junior developer jobs at a technology company</li>
                            <li>You will learn Xcode, UIKit and SwiftUI, ARKit, CoreML and CoreData.</li>
                        </ul>

                    </div>
                    <br>
                    <div class="course-curriculum-box">
                        <div class="course-curriculum-title clearfix">
                            <div class="title float-left">Lessons for this course</div>
                        </div>
                        <div class="course-curriculum-accordion">
                            <div class="lecture-group-wrapper">
                                <div class="lecture-group-title clearfix" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
                                    <div class="title float-left">
                                        Lessons
                                    </div>
                                    <div class="float-right">
                                        <span class="total-time">
                                            2 lessons
                                        </span>
                                        <span class="total-time">
                                            12: 30 minute
                                        </span>
                                    </div>
                                </div>
                                <div id="collapse" class="lecture-list collapse">
                                    <ul>
                                        <li class="lecture has-preview">
                                            <span class="lecture-title">Vue Js</span>
                                            <span class="lecture-time float-right">12: 30 minute</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="requirements-box">
                        <div class="requirements-title">Requirements</div>
                        <div class="requirements-content">
                            <ul class="requirements__list">
                                <li>No programming experience needed - I'll teach you everything you need to know</li>
                                <li>A Mac computer running macOS 10.15 (Catalina) or a PC running macOS.</li>
                                <li>No paid software required - all apps will be created in Xcode 11 (which is free to download)</li>
                                <li>
                                I'll walk you through, step-by-step how to get Xcode installed and set up
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="description-box view-more-parent">
                        <div class="view-more" onclick="viewMore(this,'hide')">
                            + View More
                        </div>
                        <div class="description-title">Description</div>
                        <div class="description-content-wrap">
                            <div class="description-content">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, quisquam?
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 mb-2 mt-5">
                    <div class="text-center text-dark">Copyright ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{config('app.name')}} | All Right Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Button trigger modal -->
    <!-- JAVASCRIPT -->
    <!-- Code injected by live-server -->
    <script src="{{ asset('frontend/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <script src="{{ asset('frontend/js/vendor/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tinymce.min.js') }}"></script>
    <script src="{{ asset('frontend/js/multi-step-modal.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.webui-popover.min.js') }}"></script>
    <script src="https://content.jwplatform.com/libraries/O7BMTay5.js"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>


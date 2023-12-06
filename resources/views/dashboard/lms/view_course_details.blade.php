<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{$shop->name}} | Oja Funnel | Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="title" name="{{$shop->name}} | Oja Funnel | Shop" />
    <meta content="description" name="{{$shop->description}} | Oja Funnel | Shop" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{$shop->logo}}" />
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
                        <a class="navbar-brand" href="{{$shop->link}}">
                            {{$shop->name}}
                        </a>
                        <form class="inline-form mt-3" style="width: 100%;">
                            <div class="input-group search-box mobile-search">
                                <input type="text" name='search_string' class="form-control" placeholder="Search for courses">
                                <div class="input-group-append">
                                    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="cart-box menu-icon-box" id="cart_items">
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="dropdown">
                                <a class="btn btn-success dropdown-toggle" style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <div class="row total-header-section">
                                        <div class="col-lg-6 col-sm-6 col-6">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                                        </div>
                                        @php $total = 0 @endphp
                                        @foreach((array) session('cart') as $id => $details)
                                        @php $total += $details['price'] @endphp
                                        @endforeach
                                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                                            <p>Total: <span class="text-info">{{ number_format($total, 2) }}</span></p>
                                        </div>
                                    </div>
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                    <div class="row cart-detail">
                                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                            <img style="width: 70px" src="{{ $details['image'] ?? URL::asset('dash/assets/image/store-logo.png') }}" />
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                            <p>{{ $details['title'] }}</p>
                                            <span class="price text-info"> {{ $details['currency'] }}{{ number_format($details['price'], 2) }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                                            <a href="
                                                @if($isvalid)
                                                    {{
                                                        route('course.cart', [
                                                            'shopname' => $shop->name,
                                                            'promotion_id' => Request::get('promotion_id'),
                                                            'course_id' => Request::get('course_id')
                                                        ])
                                                    }}
                                                @else
                                                    {{ route('course.cart', ['shopname' => $shop->name]) }}
                                                @endif
                                            " style="background-color: {{$shop->theme}}; border-color: {{$shop->theme}};" class="btn btn-primary btn-block">View all</a>
                                        </div>
                                    </div>
                                </ul>
                            </div>
                            <div class="user-box menu-icon-box">
                                <div class="icon">
                                    <a href="#">
                                        <img src="{{$shop->logo ?? URL::asset('dash/assets/image/shop-logo.png')}}" alt="" class="img-fluid" />
                                    </a>
                                </div>
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
                        <h1 class="title">{{$course->title}}</h1>
                        <p class="subtitle">{{$course->subtitle}}</p>
                        <div class="rating-row">
                            <!-- <span class="course-badge best-seller">Best seller</span>
                            <i class="fas fa-star filled" style="color: #f5c85b;"></i>
                            <i class="fas fa-star"></i>
                            <span class="d-inline-block average-rating"></span>
                            <span>(20 ratings)</span> -->
                            <span class="last-updated-date">Created By {{App\Models\User::find($course->user_id)->first_name}} {{App\Models\User::find($course->user_id)->last_name}}</span>
                            <span class="enrolled-num">
                                {{\App\Models\ShopOrder::where('course_id', $course->id)->get()->count()}} Students Enrolled
                            </span>
                        </div>
                        <div class="created-row">
                            <!-- {{--<span class="created-by">--}}
                            {{--Created by--}}
                            {{--<a href="">first_name last_name</a>--}}
                            {{--</span>--}} -->
                            <span class="last-updated-date">Last updated on {{$course->updated_at->toFormattedDateString()}}</span>
                            <span class="comment">
                                <i class="fas fa-comment"></i>{{$course->language}}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="course-sidebar">
                        <div class="course-sidebar-text-box">
                            <div class="buy-btns">
                                <a href="{{ route('add.course.to.cart', $course->id) }}" class="btn btn-add-cart">Add to cart</a>
                            </div>

                            <div class="includes">
                                <div class="title"><b>Includes:</b></div>
                                <ul>
                                    <li>
                                        <i class="far fa-file"></i> {{\App\Models\Lesson::where('course_id', $course->id)->get()->count()}} lessons
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
                            @foreach(App\Models\Learn::where('course_id', $course->id)->get() as $learn)
                            <li>{{$learn->description}}</li>
                            @endforeach
                        </ul>

                    </div>
                    <br>
                    <div class="course-curriculum-box">
                        <div class="course-curriculum-title clearfix">
                            <div class="title float-left">Lessons for this course</div>
                        </div>
                        @foreach(App\Models\Section::where('course_id', $course->id)->get() as $section)
                        <div class="course-curriculum-accordion">
                            <div class="lecture-group-wrapper">
                                <div class="lecture-group-title clearfix" data-toggle="collapse" data-target="#collapse-{{$section->id}}" aria-expanded="false">
                                    <div class="title float-left">
                                        {{$section->title}}
                                    </div>
                                    <div class="float-right">
                                        <span class="total-time">
                                            {{App\Models\Lesson::where('section_id', $section->id)->get()->count()}} lessons
                                        </span>
                                        <span class="total-time">
                                            {{App\Models\Lesson::where('section_id', $section->id)->sum('duration')}} minutes
                                        </span>
                                    </div>
                                </div>
                                <div id="collapse-{{$section->id}}" class="lecture-list collapse">
                                    <ul>
                                        @foreach(App\Models\Lesson::where('section_id', $section->id)->get() as $lesson)
                                        <li class="lecture has-preview">
                                            <span class="lecture-title">{{$lesson->title}}</span>
                                            <span class="lecture-time float-right">{{$lesson->duration}} minutes</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="requirements-box">
                        <div class="requirements-title">Requirements</div>
                        <div class="requirements-content">
                            <ul class="requirements__list">
                                @foreach(App\Models\Requirement::where('course_id', $course->id)->get() as $requirement)
                                <li>{{$requirement->description}}</li>
                                @endforeach
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
                                {{$course->description}}
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

<style>
    .dropdown button.btn-info {
        color: {
                {
                $shop->color
            }
        }

        ;

        background: {
                {
                $shop->theme
            }
        }

        ;
    }

    .dropdown .dropdown-menu {
        padding: 20px;
        width: 310px !important;
        box-shadow: 0px 4px 7px #a8a7a7;
    }

    .total-header-section {
        border-bottom: 1px solid #d2d2d2;
    }

    .total-section p {
        margin-bottom: 20px;
    }

    .cart-detail {
        padding: 15px 0px;
    }

    .cart-detail-img img {
        width: 100%;
        height: 100%;
        padding-left: 15px;
    }

    .cart-detail-product p {
        margin: 0px;
        color: #000;
        font-weight: 500;
    }

    span.text-info {
        color: {
                {
                $shop->theme
            }
        }

        !important;
    }

    .cart-detail .price {
        font-size: 12px;
        margin-right: 10px;
        font-weight: 500;
    }

    .cart-detail .count {
        color: #C2C2DC;
    }

    .checkout {
        border-top: 1px solid #d2d2d2;
        padding-top: 15px;
    }

    .checkout .btn-primary {
        color: {
                {
                $shop->color
            }
        }

        ;

        background: {
                {
                $shop->theme
            }
        }

        ;
    }

    .dropdown-menu:before {
        content: " ";
        position: absolute;
        top: -20px;
        right: 50px;
        border: 10px solid transparent;
        border-bottom-color: #fff;
    }
</style>

</html>

@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Courses By Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Courses By Category</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <section class="category-course-list-area">
                <div class="row">
                    <div class="col card account-head">
                        <div class="card-body border-bottom mb-4">
                            <div class="d-flex align-items-center">
                                <div class="col-lg-4">
                                    <input type="search" class="form-control" id="searchInput" placeholder="Search for Courses ...">
                                </div>
                                <div class="col-lg-6"></div>
                                <div class="col-lg-2">
                                    <div class="flex-shrink-0">
                                        <a href="{{route('user.create.course.start', Auth::user()->username)}}" class="btn" style="background-color: #714091;color:#fff;">New Course <i class="bi bi-arrow-right-circle"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="category-course-list">
                            <ul>
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="#">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="" class="course-title">Course Title</a>
                                            <a href="" class="course-instructor">
                                                <span class="instructor-name">Course Instructor</span>
                                            </a>
                                            <div class="course-subtitle">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, natus? Cum, iste labore. Fugit ab pariatur vitae. Rem, maxime. Autem rerum recusandae facere voluptas, nam quas sit soluta corrupti ea.
                                            </div>
                                            <div class="course-meta">
                                                <span class="">
                                                    <i class="fas fa-play-circle"></i>
                                                    Lessons
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    3 hours
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>English
                                                </span>
                                                <span class="">
                                                <i class="fas fa-play-circle"></i>Draft or publish
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price">$500</span>
                                            </div>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">5</span>
                                            </div>
                                            <div class="rating-number">
                                                Ratings
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="category-course-list">
                            <ul>
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="#">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="" class="course-title">Course Title</a>
                                            <a href="" class="course-instructor">
                                                <span class="instructor-name">Course Instructor</span>

                                            </a>
                                            <div class="course-subtitle">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, natus? Cum, iste labore. Fugit ab pariatur vitae. Rem, maxime. Autem rerum recusandae facere voluptas, nam quas sit soluta corrupti ea.
                                            </div>
                                            <div class="course-meta">
                                                <span class="">
                                                    <i class="fas fa-play-circle"></i>
                                                    Lessons
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    3 hours
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>English
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price">$500</span>
                                            </div>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">5</span>
                                            </div>
                                            <div class="rating-number">
                                                Ratings
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="category-course-list">
                            <ul>
                                <li>
                                    <div class="course-box-2">
                                        <div class="course-image">
                                            <a href="#">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%">
                                            </a>
                                        </div>
                                        <div class="course-details">
                                            <a href="" class="course-title">Course Title</a>
                                            <a href="" class="course-instructor">
                                                <span class="instructor-name">Course Instructor</span>

                                            </a>
                                            <div class="course-subtitle">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Unde, natus? Cum, iste labore. Fugit ab pariatur vitae. Rem, maxime. Autem rerum recusandae facere voluptas, nam quas sit soluta corrupti ea.
                                            </div>
                                            <div class="course-meta">
                                                <span class="">
                                                    <i class="fas fa-play-circle"></i>
                                                    Lessons
                                                </span>
                                                <span class="">
                                                    <i class="far fa-clock"></i>
                                                    3 hours
                                                </span>
                                                <span class="">
                                                    <i class="fas fa-closed-captioning"></i>English
                                                </span>
                                            </div>
                                        </div>
                                        <div class="course-price-rating">
                                            <div class="course-price">
                                                <span class="current-price">$500</span>
                                            </div>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">5</span>
                                            </div>
                                            <div class="rating-number">
                                                Ratings
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
<style>
    .rating i {
        color: #dedfe0;
    }

    .rating i.filled {
        color: #f4c150;
    }

    .rating i.half-filled {
        position: relative;
    }

    .rating i.half-filled:after {
        position: absolute;
        content: "\f089";
        top: 0;
        left: 0;
        font-size: inherit;
        color: #f4c150;
        z-index: 1;
    }

    section.category-course-list-area {
        padding-bottom: 50px;
    }

    .category-filter-box {
        padding: 35px 0;
        margin-bottom: 30px;
    }

    .filter-box .btn {
        border-radius: 2px;
        border-color: #007791;
        color: #007791;
        font-weight: 600;
        font-size: 15px;
        padding: 10px 12px;
        min-width: 60px;
        background: transparent;
    }

    .filter-box .btn:not(.all-btn) {
        margin-left: 10px;
    }

    .filter-box .btn:hover,
    .filter-box .btn:focus {
        background: #fff !important;
        color: #007791 !important;
        border-color: #007791 !important;
    }

    .filter-box .btn[aria-expanded="true"] {
        background-color: #76c5d6 !important;
    }

    .filter-box .dropdown-menu {
        box-shadow: 0 4px 16px rgba(20, 23, 28, .25);
        border-color: #fff;
        border-radius: 2px;
        max-height: 365px;
        overflow-y: auto;
    }

    .filter-box .dropdown-menu .dropdown-item {
        color: #505763;
        padding: 5px 12px;
        font-weight: 400;
        line-height: 1.43;
        font-size: 15px;
    }

    .filter-box .dropdown-menu .dropdown-item:hover,
    .filter-box .dropdown-menu .dropdown-item:focus {
        background-color: #f2f3f5;
        color: inherit;
    }

    .filter-box .reset-btn {
        background-color: transparent;
        border-color: transparent;
    }

    .filter-box .reset-btn:hover {
        background-color: transparent !important;
        border-color: transparent !important;
    }

    .filter-box .reset-btn:disabled {
        color: #a1a7b3 !important;
        cursor: not-allowed;
    }

    .category-course-list ul {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .course-box-2 {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        border: 1px solid #dedfe0;
        border-radius: 2px 2px 0 0;
        min-height: 148px;
    }

    .course-box-2 .course-image {
        width: 50%;
    }

    .course-box-2 .course-details {
        width: 50%;
        padding: 10px 30px;
    }

    .course-box-2 .course-price-rating {
        width: 24%;
        text-align: right;
        -ms-flex-item-align: end;
        align-self: flex-end;
        padding: 10px 25px 15px;
    }

    .category-course-list ul li {
        margin-bottom: 30px;
    }

    .course-box-2 .course-price-rating .current-price {
        font-size: 18px;
        font-weight: 700;
        color: #29303b;
    }

    .course-box-2 .course-price-rating .original-price {
        color: #686f7a;
        font-size: 15px;
        font-weight: 400;
        margin-left: 5px;
        text-decoration: line-through;
    }

    .course-box-2 .course-price-rating .rating i {
        /* color: #f4c150; */
        font-size: 13px;
    }

    .course-box-2 .course-price-rating .rating .average-rating {
        font-size: 13px;
        color: #686f7a;
    }

    .course-box-2 .course-price-rating .rating-number {
        font-size: 13px;
        color: #686f7a;
    }

    .course-box-2 .course-details .course-title {
        color: #000;
        display: block;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 3px;
    }

    .course-box-2 .course-details a:hover {
        text-decoration: underline;
    }

    .course-box-2 .course-details .course-instructor {
        display: block;
        color: #000;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .course-box-2 .course-details .course-subtitle {
        color: #000;
        font-size: 13px;
        margin-bottom: 20px;
    }

    .course-box-2 .course-details .course-meta span {
        font-size: 13px;
        margin-right: 10px;
        color: #000;
    }

    .course-box-2 .course-details .course-meta {
        padding-top: 5px;
    }

    .course-box-2 .course-details .course-meta span i {
        opacity: 0.5;
        font-size: 14px;
        margin-right: 4px;
    }

    /*
</style>
@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Course Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('viewCourse')}}" >User Courses</a></li>
                                <li class="breadcrumb-item active">Course Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
                                </script> Ojafunnel | All Right Reserved
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</div>
@endsection

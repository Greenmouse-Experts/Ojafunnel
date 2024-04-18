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
                        <h4 class="mb-sm-0 font-size-18">Courses</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Courses</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Create Course</h4>
                            <p>
                                Connect the tools that power your business with our courses
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('user.create.course.start', Auth::user()->username)}}" class="btn" style="background-color: #714091;color:#fff;">New Course <i class="bi bi-arrow-right-circle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Learning-Management')->exists())
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <section class="category-course-list-area">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead class="tread">
                                            <tr>
                                                <th>Course Thumbnail</th>
                                                <th>Course Details</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($courses as $course)
                                            <tr>
                                                <td>
                                                    <div class="course-image">
                                                        <a href="{{route('user.course.content', [Auth::user()->username, Crypt::encrypt($course->id)])}}">
                                                            @if($course->image)
                                                            <img src="{{$course->image}}" alt="{{$course->title}}" style="    max-width: 100%; width: 600px;">
                                                            <!-- <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%"> -->
                                                            @else
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%">
                                                            @endif
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="course-details-container">
                                                        <div class="mb-5">
                                                            <span>{{$course->title}}</span>
                                                        </div>
                                                        <div style="white-space: normal;">
                                                            {{$course->description}}
                                                        </div>
                                                        <div class="flex-end">
                                                            <span class="">
                                                                <i class="fas fa-play-circle"></i>
                                                                {{App\Models\Lesson::where('course_id', $course->id)->get()->count()}} Lessons
                                                            </span>
                                                            <span class="">
                                                                <i class="far fa-clock"></i>
                                                                @php
                                                                    $durationDecimal = App\Models\Lesson::where('course_id', $course->id)->sum('duration') / 3600; // Example duration in hours
                                                                    $seconds = round($durationDecimal * 3600); // Convert hours to seconds
                                                                    $hours = floor($seconds / 3600);
                                                                    $minutes = floor(($seconds / 60) % 60);
                                                                    $seconds = $seconds % 60;
                                                                    $durationString = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                                                                @endphp
                                                                {{$durationString}}
                                                            </span>
                                                            <span class="">
                                                                <i class="fas fa-closed-captioning"></i>{{$course->language}}
                                                            </span>
                                                            <span class="">
                                                                <i class="fas fa-play-circle"></i>@if($course->published == false)
                                                                Unpublish
                                                                @else
                                                                Published
                                                                @endif
                                                            </span>
                                                            <span class="">
                                                                @if($course->approved == false)
                                                                <i class="bi bi-eye-slash-fill"></i>
                                                                <span class="badge badge-pill badge-soft-danger text-danger font-size-11">Inactive</span>
                                                                @else
                                                                <i class="bi bi-check2-all"></i>
                                                                <span class="badge badge-pill badge-soft-success text-success font-size-11">Active</span>
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="course-price-rating mb-3" style="display:grid;align-items:space-between;min-height:148px">
                                                        <div>
                                                            <a href="{{route('user.view.course.details', [Auth::user()->username, $course->id])}}" class="block"><strong><u>View Course Details</u></strong></a>
                                                        </div>

                                                        <div>
                                                            <a href="{{route('view-quiz', [Auth::user()->username, $course->id])}}" class="block"><strong><u>View / Create Quiz</u></strong></a>
                                                        </div>

                                                        <div>
                                                            <!-- <a href="{{route('view-scores', [Auth::user()->username, $course->id])}}" class="block"><strong><u>View User Scores</u></strong></a> -->
                                                        </div>

                                                        <div class="course-price">
                                                            <span class="current-price">{{number_format($course->price, 2)}}</span>
                                                        </div>

                                                        <div class="mt-5">
                                                        @if($course->approved == true)
                                                            <a href="{{route('user.course.status.toggle', $course->id)}}" class="btn btn-sm btn-soft-danger">Deactivate</a>
                                                        @else
                                                            <a href="{{route('user.course.status.toggle', $course->id)}}" class="btn btn-sm btn-soft-success">Activate</a>
                                                        @endif
                                                        </div>
                                                        <div class="mt-1">
                                                            <a href="javascript:;" ids="{{ $course->id }}" class="block deleteCourse" style="color:red"><strong>Delete Course</strong></a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@if(App\Models\ExplainerContent::where('menu', 'Learning-Management')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Learning-Management')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                {{App\Models\ExplainerContent::where('menu', 'Learning-Management')->first()->text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
@endsection
<style>
    .course-details-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding-bottom: 10px; /* Adjust the padding as needed */
    }

    .course-details-container > * {
        margin-bottom: 10px;
    }
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


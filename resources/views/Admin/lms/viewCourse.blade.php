@extends('layouts.admin-frontend')

@section('page-content')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
@endpush
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{$course->title}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Course</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="video">
                        <div class="card">
                            <div class="card-body">
                                @if($course->image)
                                <img src="{{$course->image}}" alt="{{$course->title}}" style="    max-width: 100%; width: 600px;">
                                @else
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1675677866/OjaFunnel-Images/learning_tkmdue.jpg" alt="" width="100%">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled categories-list">
                                <div class="border-bottom">
                                    <h5 class="card-title mb-3">Course Content</h5>
                                </div>
                                @foreach(App\Models\Section::where('course_id', $course->id)->get() as $section)
                                <li class="border-bottom">
                                    <div class="custom-accordion mt-2">
                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse-{{$section->id}}" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                            Section {{$loop->iteration}}: {{$section->title}} <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                        </a>
                                        <div class="collapse" id="categories-collapse-{{$section->id}}">
                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                <ul class="list-unstyled mb-0">
                                                    @foreach(App\Models\Lesson::where('section_id', $section->id)->get() as $lesson)
                                                        <li>
                                                            <a href="javascript: void(0);" class="d-flex align-items-center"  data-bs-toggle="modal" data-bs-target="#show-{{$lesson->id}}">
                                                            @if($lesson->content_type == 'video')
                                                            <i class="mdi mdi-video-high-definition"></i>
                                                            @else
                                                            <i class="mdi mdi-youtube"></i>
                                                            @endif    
                                                            <span class="me-auto">{{$lesson->title}}</span> 
                                                            <i class="mdi mdi-pin ms-auto"></i></a>
                                                        </li>
                                                        <div class="modal fade" id="show-{{$lesson->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content pb-3">
                                                                    <div class="modal-header border-bottom-0">
                                                                        <h5 class="modal-title">{{$lesson->title}}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="video">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    @if($lesson->content_type == 'video')
                                                                                    <div id="carouselExample" class="carousel slide">
                                                                                        <div class="carousel-inner">
                                                                                            <iframe src="{{App\Models\Video::where('lesson_id', $lesson->id)->first()->original_filename}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen></iframe>
                                                                                        </div>
                                                                                    </div>
                                                                                    @else
                                                                                    <div id="carouselExample" class="carousel slide">
                                                                                        @php
                                                                                            $youTubeURL = App\Models\Video::where('lesson_id', $lesson->id)->first()->youtube_link;
                                                                                            $convertedURL = str_replace("watch?v=", "embed/", $youTubeURL);
                                                                                        @endphp
                                                                                        <div class="carousel-inner">
                                                                                        <iframe src="{{$convertedURL}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen></iframe>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Overview</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
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
                                                        <!-- <div class="course-curriculum-accordion">
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
                                                        </div> -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="list-unstyled categories-list">
                                                                    <li class="border-bottom">
                                                                        <div class="custom-accordion mt-2">
                                                                            <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse-{{$section->id}}" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                                                                
                                                                                Section {{$loop->iteration}}: {{$section->title}} 
                                                                                <i class="accor-down-icon ms-auto">
                                                                                    <div class="float-right">
                                                                                        <span class="total-time">
                                                                                            {{App\Models\Lesson::where('section_id', $section->id)->get()->count()}} lessons - 
                                                                                        </span>
                                                                                        <span class="total-time">
                                                                                            {{App\Models\Lesson::where('section_id', $section->id)->sum('duration')}} minutes
                                                                                        </span>
                                                                                    </div>
                                                                                </i>
                                                                            </a>
                                                                            <div class="collapse" id="categories-collapse-{{$section->id}}">
                                                                                <div class="card border-0 shadow-none ps-2 mb-0">
                                                                                    <ul class="list-unstyled mb-0">
                                                                                        @foreach(App\Models\Lesson::where('section_id', $section->id)->get() as $lesson)
                                                                                            <li>
                                                                                                <a href="javascript: void(0);" class="d-flex align-items-center" style="font-weight: 600;" data-bs-toggle="modal" data-bs-target="#show-{{$lesson->id}}">
                                                                                                @if($lesson->content_type == 'video')
                                                                                                <i class="mdi mdi-video-high-definition"></i>
                                                                                                @else
                                                                                                <i class="mdi mdi-youtube"></i>
                                                                                                @endif
                                                                                                <span class="me-auto" style="margin-left: .1rem;">{{$lesson->title}} - {{$lesson->duration}} minutes</span>
                                                                                                <i class="mdi mdi-pin ms-auto"></i></a>
                                                                                            </li>
                                                                                            <div class="modal fade" id="show-{{$lesson->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                                                                <div class="modal-dialog modal-dialog-centered">
                                                                                                    <div class="modal-content pb-3">
                                                                                                        <div class="modal-header border-bottom-0">
                                                                                                            <h5 class="modal-title">{{$lesson->title}}</h5>
                                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                        </div>
                                                                                                        <div class="modal-body">
                                                                                                            <div class="video">
                                                                                                                <div class="card">
                                                                                                                    <div class="card-body">
                                                                                                                        @if($lesson->content_type == 'video')
                                                                                                                        <div id="carouselExample" class="carousel slide">
                                                                                                                            <div class="carousel-inner">
                                                                                                                                <iframe src="{{App\Models\Video::where('lesson_id', $lesson->id)->first()->original_filename}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen style="width: 100%;"></iframe>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        @else
                                                                                                                        <div id="carouselExample" class="carousel slide">
                                                                                                                            @php
                                                                                                                                $youTubeURL = App\Models\Video::where('lesson_id', $lesson->id)->first()->youtube_link;
                                                                                                                                $convertedURL = str_replace("watch?v=", "embed/", $youTubeURL);
                                                                                                                            @endphp
                                                                                                                            <div class="carousel-inner">
                                                                                                                                <iframe src="{{$convertedURL}}" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture;" allowfullscreen style="width: 100%;"></iframe>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
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
                                                        <div class="description-box view-more-parent">
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
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/select2.min.js') }}"></script>
<script src="{{ asset('frontend/js/tinymce.min.js') }}"></script>
<script src="{{ asset('frontend/js/multi-step-modal.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.webui-popover.min.js') }}"></script>
@endsection

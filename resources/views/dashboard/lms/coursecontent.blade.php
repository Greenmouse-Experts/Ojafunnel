@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">New Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">New Course</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="checkout-tabs">
                <div class="row">
                    <div class="col-xl-2 col-sm-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-curriculum-tab" data-bs-toggle="pill" href="#v-pills-curriculum" role="tab" aria-controls="v-pills-curriculum" aria-selected="true">
                                <i class="bi bi-card-checklist d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Curriculum</p>
                            </a>
                            <a class="nav-link" id="v-pills-landingpage-tab" data-bs-toggle="pill" href="#v-pills-landingpage" role="tab" aria-controls="v-pills-landingpage" aria-selected="false">
                                <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Course Landing Page</p>
                            </a>
                            <a class="nav-link" id="v-pills-pricing-tab" data-bs-toggle="pill" href="#v-pills-pricing" role="tab" aria-controls="v-pills-pricing" aria-selected="false">
                                <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Pricing</p>
                            </a>
                            <a class="nav-link" id="v-pills-promotion-tab" data-bs-toggle="pill" href="#v-pills-promotion" role="tab" aria-controls="v-pills-promotion" aria-selected="false">
                                <i class="bi bi-person-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Promotions</p>
                            </a>
                            <a class="nav-link" id="v-pills-message-tab" data-bs-toggle="pill" href="#v-pills-message" role="tab" aria-controls="v-pills-message" aria-selected="false">
                                <i class="bi bi-envelope-check d-block check-nav-icon mt-4 mb-2"></i>
                                <p class="fw-bold mb-4">Course messages</p>
                            </a>
                            <a class="nav-link" style="background-color: #70418F; color:#fff;">
                                <p class="fw-bold mb-1 mt-2">Submit for Review</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-sm-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-curriculum" role="tabpanel" aria-labelledby="v-pills-curriculum-tab">
                                        <div>
                                            <h4 class="card-title mb-4">Curriculum</h4>
                                            <div id="appera">
                                                <div class="card-body" style="box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);  line-height: 1.8;">
                                                    <p class="card-title-desc text-dark font-600">
                                                        <i class="bi bi-info-circle" style="padding-right: 15px;"></i>Start putting together your course by creating sections, lectures and practice activities (quizzes, and assignments). Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                        <button type="button" style="float: right;" onclick="myFunct()" class="btn btn-danger mt-3">Dismiss</button>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="font-500 mt-5">
                                                <p>
                                                Start putting together your course by creating sections, lectures and practice <a href="#">
                                                (quizzes,and assignments)
                                                </a>.
                                                </p>
                                                <p>
                                                Start putting together your course by creating sections, lectures and practice activities <a href="#">
                                                (quizzes,and assignments)
                                                </a>. Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                </p>
                                            </div>
                                            <div class="assets">
                                                <h1><b>Section 1:</b> <a href="javascript: void(0);" id="inline-username" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-type="text" class="text-dark" data-pk="1" data-title="Enter username">Introduction</a></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-landingpage" role="tabpanel" aria-labelledby="v-pills-landingpage-tab">
                                        <div>
                                            <h4 class="card-title">Course Landing Page</h4>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-pricing" role="tabpanel" aria-labelledby="v-pills-pricing-tab">
                                        <div>
                                            <h4 class="card-title">Pricing</h4>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-promotion" role="tabpanel" aria-labelledby="v-pills-promotion-tab">
                                        <div>
                                            <h4 class="card-title">Promotions</h4>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-message" role="tabpanel" aria-labelledby="v-pills-message-tab">
                                        <div>
                                            <h4 class="card-title">Course messages</h4>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-sm-6">
                                <a href="{{route('user.create.course', Auth::user()->username)}}" class="btn text-muted d-none d-sm-inline-block btn-link">
                                    <i class="mdi mdi-arrow-left me-1"></i> Previous </a>
                            </div> <!-- end col -->
                        </div> <!-- end row -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>


    <!-- jquery step -->
    <script type="text/javascript" src="{{URL::asset('dash/assets/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>

    <!-- form wizard init -->
    <script>
        function myFunct() {
            document.getElementById("appera").style.display = "none";
        }
    </script>
     <!-- Init js-->
     <script  type="text/javascript" src="{{URL::asset('dash/assets/js/pages/form-xeditable.init.js')}}"></script>
     <!-- Plugins js -->
     <script  type="text/javascript" src="{{URL::asset('dash/assets/libs/bootstrap-editable/js/index.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('dash/assets/libs/moment/min/moment.min.js')}}"></script>
    <!-- Bootstrap Toasts Js -->
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/bootstrap-toastr.init.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/form-wizard.init.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/app.js')}}"></script>
    @endsection

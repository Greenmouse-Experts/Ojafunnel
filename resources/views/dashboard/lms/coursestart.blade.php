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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="basic-example">
                                <!-- Seller Details -->
                                <section>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <form>
                                                <div class="curriculom mt-3">
                                                    <h1>
                                                    How about a working title?
                                                    </h1>
                                                    <p class="mb-3">It's ok if you can't think of a good title now. You can change it later.</p>
                                                    <div class="write">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-4">
                                                                        <input type="text" placeholder="e.g. Learn API Integration Using Vuejs and Laravel" name="title" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                    
                                                    </div>
                                                </div>
                                                <div class="curriculom mt-3">
                                                    <h1>
                                                        What Category best fits the knowledge you will share ?
                                                    </h1>
                                                    <p class="mb-3">If you're not sure about the category, you can change it later.</p>
                                                    <div class="write">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-md-12 mb-4">
                                                                        <select>
                                                                            <option>Choose a category</option>
                                                                            <option>Finance & Accounting</option>
                                                                            <option>Development </option>
                                                                            <option>I don't know yet</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="appera">
                                                        <div class="card-body" style="box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);">
                                                            <p class="card-title-desc text-dark font-600">
                                                                <i class="bi bi-info-circle" style="padding-right: 15px;"></i>Start putting together your course by creating sections, lectures and practice activities (quizzes, and assignments). Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                                <button type="button" style="float: right; background:#000; color:#fff;" onclick="myFunct()" class="btn-btn-danger">Dismiss</button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mt-4">
                                                    
                                                    </div>
                                                </div>
                                                <button type="button" style="float: right; background:#713F93 !important; color:#fff;" class="btn btn-btn-primary">Continue</button>
                                            </form>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
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
    <!-- Bootstrap Toasts Js -->
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/bootstrap-toastr.init.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/pages/form-wizard.init.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/app.js')}}"></script>
    @endsection

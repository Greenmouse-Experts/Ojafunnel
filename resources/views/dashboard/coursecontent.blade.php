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
                            <h4 class="card-title mb-4">Plan Your Course</h4>
                            <div id="basic-example">
                                <!-- Seller Details -->
                                <h3>Curriculum</h3>
                                <section>
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <div class="curriculom mt-3">
                                                <h1>
                                                    What Category best fits the knowledge you will share ?
                                                </h1>
                                                <p class="mb-3">If you're not sure about the category, you can change it later</p>
                                                <div class="write">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row">
                                                                <div class="col-md-12 mb-4">
                                                                    <select>
                                                                        <option>
                                                                            Choose a category
                                                                        </option>
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
                                                            <i class="bi bi-info-circle" style="padding-right: 15px;"></i>Here’s where you add course content—like lectures, course sections, assignments, and more. Click a + icon on the left to get started.
                                                            <button type="button" style="float: right; background:#000; color:#fff;" onclick="myFunct()" class="btn-btn-danger">Dismiss</button>
                                                        </p>
                                                    </div>
                                                </div>
                                                <p class="mt-4">
                                                    Start putting together your course by creating sections, lectures and practice (quizzes, and assignments).
                                                </p>
                                                <p>
                                                Start putting together your course by creating sections, lectures and practice activities <a href="#">(quizzes, and assignments)</a>. Use your course outline to structure your content and label your sections and lectures clearly. If you’re intending to offer your course for free, the total length of video content must be less than 2 hours.
                                                </p>
                                                <div class="mt-4">
                                                
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </section>

                                <!-- Company Document -->
                                <h3>Course Landing Page</h3>
                                <section>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-pancard-input">PAN Card</label>
                                                    <input type="text" class="form-control" id="verticalnav-pancard-input" placeholder="Enter Your PAN Card No.">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-vatno-input">VAT/TIN No.</label>
                                                    <input type="text" class="form-control" id="verticalnav-vatno-input" placeholder="Enter Your VAT/TIN No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-cstno-input">CST No.</label>
                                                    <input type="text" class="form-control" id="verticalnav-cstno-input" placeholder="Enter Your CST No.">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-servicetax-input">Service Tax No.</label>
                                                    <input type="text" class="form-control" id="verticalnav-servicetax-input" placeholder="Enter Your Service Tax No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-companyuin-input">Company UIN</label>
                                                    <input type="text" class="form-control" id="verticalnav-companyuin-input" placeholder="Company UIN No.">
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="verticalnav-declaration-input">Declaration</label>
                                                    <input type="text" class="form-control" id="verticalnav-Declaration-input" placeholder="Declaration Details">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </section>

                                <!-- Bank Details -->
                                <h3>Pricing</h3>
                                <section>
                                    <div>
                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="verticalnav-namecard-input">Name on Card</label>
                                                        <input type="text" class="form-control" id="verticalnav-namecard-input" placeholder="Enter Your Name on Card">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label>Credit Card Type</label>
                                                        <select class="form-select">
                                                            <option selected>Select Card Type</option>
                                                            <option value="AE">American Express</option>
                                                            <option value="VI">Visa</option>
                                                            <option value="MC">MasterCard</option>
                                                            <option value="DI">Discover</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="verticalnav-cardno-input">Credit Card Number</label>
                                                        <input type="text" class="form-control" id="verticalnav-cardno-input" placeholder="Enter Your Card Number">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="verticalnav-card-verification-input">Card Verification Number</label>
                                                        <input type="text" class="form-control" id="verticalnav-card-verification-input" placeholder="Card Verification Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="verticalnav-expiration-input">Expiration Date</label>
                                                        <input type="text" class="form-control" id="verticalnav-expiration-input" placeholder="Card Expiration Date">
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </section>

                                <!-- Confirm Details -->
                                <h3>Promotions</h3>
                                <section>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                </div>
                                                <div>
                                                    <h5>Confirm Detail</h5>
                                                    <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <!-- Confirm Details -->
                                <h3>Course Messages</h3>
                                <section>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                                </div>
                                                <div>
                                                    <h5>Confirm Detail</h5>
                                                    <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                                </div>
                                            </div>
                                        </div>
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

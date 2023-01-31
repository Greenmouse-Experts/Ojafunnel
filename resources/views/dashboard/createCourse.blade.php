@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Create Course</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create Course</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-1">
                            <h4 class="font-600">Create Course</h4>
                            <p>
                                Create courses to publish on your store
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8 account-head">
                                <div class="campaign-nav mt-3">
                                    <ul class="list-unstyled">
                                        <li class="px-3 py-2 text-white bg-purp">Course Details >></li>
                                        </li>
                                        </li>
                                        <li>
                                            <a href="#" class="text-decoration-none text-dark">Course Content >></a>
                                        </li>
                                        <li>
                                            <a href="" class="text-decoration-none text-dark">Summary >></a>
                                        </li>
                                        <li>
                                            <a href="" class="text-decoration-none text-dark">Publish >></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1">

                </div>
            </div>
            <div class="row cut">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Tell us about your course
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <label>Course Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your course name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Course Description </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" placeholder="Enter your course name" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label> Course Image</label>
                                    <div class="mt-2 mb-4">
                                        <div class="logo-input border-inn w-full px-5 py-4 pb-5">
                                            <div class="logo-input2 border-in py-5 px-3">
                                                <div class="avatar">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                </div>
                                                <div class="logo-file">
                                                    <input type="file" accept="image" name="logo" id="" class="mt-4 w-100" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="boding">
                                                <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-3">
                                            <div class="boding">
                                                <button>
                                                    <a href="{{route('user.course.content', Auth::user()->username)}}" style="color: #fff;">
                                                        Proceed
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
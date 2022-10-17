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
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div>
                        <h4 class="font-500">My Account</h4>
                        <p>View and edit your details here</p>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">General</p>
                        <p>
                            <a href="{{route('user.security')}}" class="text-decoration-none text-dark">Security</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="account-con">
                    <div>
                        <h4>Profile Photo</h4>
                        <p>You can upload and change your profile picyure</p>
                    </div>
                    <div class="d-flex mt-5 align-items-center">
                        <div class="account-img overflow-hidden">
                            <img src="{{URL::asset('dash/assets/image/no-img.jpg')}}" alt="" width="100%" />
                        </div>
                        <div class="upload-img ps-5">
                            <button class="btn btn-outline-dark">Upload Photo</button>
                        </div>
                    </div>
                    <div class="account-border"></div>
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div>
                                    <h4>Basic Information</h4>
                                    <p>Personal info about your account</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>First Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your first name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Last Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your last name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-border"></div>
                                <div>
                                    <h4>Login Details</h4>
                                    <p>Your email and password for your account</p>
                                </div>
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Enter your email address" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="Enter your password" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-10"></div>
                                <div class="col-lg-3">
                                    <button class="btn" style="color: #714091; border: 1px solid #714091" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="account-border"></div>
                    <div class="text-end">
                        <button class="btn" style="color: #ffffff; background-color: #714091">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->

    <!-- subscribeModal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pb-3">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Old Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="Enter your current password" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>New Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="Enter your new password" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Confirm Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="password" placeholder="Re-enter your new password" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button class="btn" style="color: #ffffff; background-color: #714091">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
@endsection
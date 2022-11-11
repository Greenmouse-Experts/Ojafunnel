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
                            <a href="{{route('user.security', Auth::user()->username)}}" class="text-decoration-none text-dark">Security</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="account-con">
                    <form method="POST" action="{{ route('user.profile.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <h4>Profile Photo</h4>
                            <p>You can upload and change your profile picyure</p>
                        </div>
                        <div class="d-flex mt-5 align-items-center">
                            <div class="account-img overflow-hidden">
                                @if(Auth::user()->photo)
                                <img id="file-ip-1-preview" src="{{Auth::user()->photo}}" alt="{{Auth::user()->first_name}}" width="100%">
                                @else
                                <img id="file-ip-1-preview" src="{{URL::asset('dash/assets/image/no-img.jpg')}}" alt="" width="100%" />
                                <!-- <span id="img-avatar" style="font-size: 3rem; width: 140px; height: 140px; vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr(Auth::user()->first_name, 0, 1)) }} {{ ucfirst(substr(Auth::user()->last_name, 0, 1)) }}</span>   -->
                                @endif
                            </div>
                            <div class="upload-img ps-5">
                                <input type="file" class="btn btn-outline-dark" id="file-ip-1" accept="image/*" name="photo" onchange="showPreview(event);">
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
                                                <input type="text" placeholder="Enter your first name" name="first_name" value="{{Auth::user()->first_name}}" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Last Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter your last name" name="last_name" value="{{Auth::user()->last_name}}" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="tel" placeholder="Enter your phone number" name="phone_number" value="{{Auth::user()->phone_number}}" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Username</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" value="{{Auth::user()->username}}" class="input" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="account-border"></div>
                                    <div>
                                        <h4>Login Details</h4>
                                        <p>Your email and password for your account</p>
                                    </div>
                                    <div class="col-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="email" placeholder="Enter your email address" name="email" value="{{Auth::user()->email}}" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="password" value="{{Auth::user()->password}}" class="input" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <a class="btn" style="margin-top: 0.6rem; height: 45px; width: 100%; color: #714091; border: 1px solid #714091" data-bs-toggle="modal" data-bs-target="#passwordModal">
                                                    Change Password
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-border"></div>
                        <div class="text-end">
                            <button type="submit" class="btn" onclick="this.classList.toggle('button--loading')" style="color: #ffffff; background-color: #714091">
                                <span class="button__text">Save Changes</span><span class="spinner"></span>
                            </button>
                        </div>
                    </form>
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
                        <h3>Update Password</h3>
                        <form method="POST" action="{{ route('user.password.update')}}" enctype="multipart/form-data">
                        @csrf
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Old Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="password" placeholder="Enter your current password" value="{{Auth::user()->password}}" readonly class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>New Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="password" placeholder="Enter your new password" name="new_password" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Confirm Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="password" placeholder="Re-enter your new password" name="new_password_confirmation" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn" style="color: #ffffff; background-color: #714091">
                                            Change Password
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
@endsection
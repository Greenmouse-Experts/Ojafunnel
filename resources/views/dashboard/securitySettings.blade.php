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
                        <p class="ps-0 me-3">
                            <a href="{{route('user.general', Auth::user()->username)}}" class="text-decoration-none text-dark">General</a>
                        </p>
                        <p class="active ps-0 ms-5">Security</p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="account-con">
                    <div class="Edit">
                    <form method="POST" action="{{ route('user.password.update')}}">
                    @csrf
                        <div class="form">
                            <div class="row">
                                <h4>Password</h4>
                                <p>Update the password to your account</p>
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
                                <div class="col-lg-10"></div>
                                <div class="col-lg-3">
                                    <button class="form-btn btn" style="color: #714091; border: 1px solid #714091" type="submit">
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
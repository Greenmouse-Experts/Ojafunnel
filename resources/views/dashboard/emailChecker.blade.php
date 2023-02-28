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
                        <h4 class="mb-sm-0 font-size-18">Email Checker</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Checker</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- start page title -->
            <div class="row begin">
                <div class="col-12 card account-head">
                    <div class="py-2">
                        <h4 class="font-500">Email Checker</h4>
                        <p>
                            Check if your mailing list contains invalid email addresses
                        </p>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <form">

                    <div class="account-con">
                        <div class="account-input-div mb-5">
                            <input type="email" name="email" placeholder="enter your email address" class="rounded" />
                            <div class="label-text">Email Address</div>
                        </div>
                        <div class="text-end">
                            <button class="btn px-4 my-2" style="color: #ffffff; background-color: #714091">
                                Verify Email
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection

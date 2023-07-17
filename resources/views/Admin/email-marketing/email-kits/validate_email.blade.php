@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Validate Email Addresses</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Validate Emails</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Add Plans</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div> -->

            <div class="row">
                <!-- <div class="col-lg-2"></div> -->
                <div class="col-lg-10">
                    <div class="Edit"> 
                        <form method="POST">
                            @csrf
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4 mt-n3">
                                        <b>Provide Us Your Details to add Plans</b>
                                    </p>
                                    <div class="col-lg-12">
                                        <label>Email Addresses</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea type="text" placeholder="Enter email addresses" name="emails" class="input emails" required></textarea>
                                                <p class="text-danger">Please seperate the emails separated by comma (,)</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-9"></div>
                                            <div class="col-md-3">
                                                <div class="boding">
                                                    <button type="button" class="validateEmail">
                                                        Validate
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-4">
                                        <div class="row display_email_data">

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection


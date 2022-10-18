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
                        <div class="col-lg-12">
                            <div class="card account-head">
                                <div class="py-2">
                                    <h4 class="font-500">Add Contact ; <span style="color:#2E59F3;"> Student List</span>
                                    </h4>
                                    <p>
                                        Add emails & phone numbers to your created mailing list
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="sms">
                                <ul>
                                    <li class="text-purpp">
                                        <a href="{{route('user.up.load')}}">
                                            Upload Files
                                        </a>
                                    </li>
                                    <li class="text-purpp">
                                        <a href="{{route('user.copy.paste')}}">
                                            Copy & Paste
                                        </a>
                                    </li>
                                    <li class="text-purp">
                                        <a href="#">
                                            Add Individualy
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row cut">
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="Edit">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Contact Name</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="Enter the contacts name" name="name"
                                                        class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Email Address </label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="Enter contacts email " name="email"
                                                        class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Phone Number</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="tel" placeholder="Enter contacts phone number"
                                                        name="email" class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-4">
                                            <div class="name">
                                                <ul>
                                                    <li>
                                                        Email Verification :
                                                    </li>
                                                    <li>
                                                        <input type="checkbox">
                                                    </li>
                                                    <li>
                                                        Verify uploaded addresses
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="boding">
                                                        <button class="btn px-3"
                                                            style="color: #714091; background:#fff; border: 1px solid #714091;">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="boding">
                                                        <button>
                                                            Proceed
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
        </div>
<!-- END layout-wrapper -->
@endsection
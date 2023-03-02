@extends('layouts.dashboard-email-frontend')

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
                    <div class="row py-3 align-items-center">
                        <div class="col-md-6">
                            <h4>Email Automation</h4>
                            <p>
                                Impact your business with automated emails for your
                                customers
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn text-purp border-purp">
                                <a href="{{route('user.email.automation', Auth::user()->username)}}">
                                    Create Custom Automation
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Abandoned Cart</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Product Purchase</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Anniversary</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Welcome Message</span>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="card-title mt-4 mb-4">Abandoned Cart</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead class="tread">
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Course Name</th>
                                                            <th>Course Category</th>
                                                            <th>Status</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="card-title mt-4 mb-4">Product Purchase</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead class="tread">
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Course Name</th>
                                                            <th>Course Category</th>
                                                            <th>Status</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="card-title mt-4 mb-4">Abandoned Cart</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead class="tread">
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Course Name</th>
                                                            <th>Course Category</th>
                                                            <th>Status</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings1" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="card-title mt-4 mb-4">Abandoned Cart</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered dt-responsive nowrap w-100">
                                                    <thead class="tread">
                                                        <tr>
                                                            <th>S/N</th>
                                                            <th>Course Name</th>
                                                            <th>Course Category</th>
                                                            <th>Status</th>
                                                            <th>Date Created</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <!-- <div class="row card begin">
                <div class="template-con">
                    <div class="row justify-content-between">
                        <div class="col-lg-6 mt-5">
                            <div class="p-3 shadows rounded bg-white">
                                <p class="fs-me">
                                    Abandoned Cart
                                </p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-5 rounded bg-white">
                                <p class="fs-me">
                                    Product Purchase
                                </p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-5 rounded bg-white">
                                <p class="fs-me">Anniversary</p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-5 rounded bg-white last">
                                <p class="fs-me">Welcome Message</p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                        </div>
                        <div class="col-lg-6 bg-white rounded">
                            <div class="abandon-cart">
                                <p class="opacity-75">Automation Starts</p>
                                <p>Trigger - Customer adds product to cart</p>
                            </div>
                            <div class="abandon-cart">
                                <p>Condition - Customer does not checkout</p>
                            </div>
                            <div class="abandon-cart">
                                <p class="opacity-75">Wait</p>
                                <p>Action - Wait for customer for 2 days</p>
                            </div>
                            <div class="abandon-cart">
                                <p class="opacity-75">Email</p>
                                <p>Action - Wait for customer for 2 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection

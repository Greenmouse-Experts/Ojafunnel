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
                        <h4 class="mb-sm-0 font-size-18">All Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminwelcome')}}">Home</a></li>
                                <li class="breadcrumb-item active">All Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">User Details</h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Overview User</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">User Details</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">LMS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">E-commerce</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Affiliate Marketing</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-start mb-3">
                                                    <div class="flex-grow-1">
                                                        <span class="badge badge-soft-success">Active</span>
                                                    </div>
                                                </div>
                                                <div class="text-center mb-3">
                                                    <img src="assets/images/users/avatar-1.jpg" alt="" class="avatar-sm rounded-circle" />
                                                    <h6 class="font-size-15 mt-3 mb-1">Hamzat Abdulazeez</h6>
                                                    <p class="mb-0 text-muted">greenmousetest@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">User Personal Information</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">First Name :</th>
                                                                <td>Hamzat</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Name :</th>
                                                                <td>Abdulazeez Adeleke</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Username:</th>
                                                                <td>Hamzat</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">E-mail :</th>
                                                                <td>greenmousetest@gmail.com</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile :</th>
                                                                <td>(123) 123 1234</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Referral Code :</th>
                                                                <td>None</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Subscribers:</th>
                                                                <td>Free</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
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
                            <div class="tab-pane" id="messages1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead class="tread">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Store Name</th>
                                                                <th>Number of Product</th>
                                                                <th>Sales</th>
                                                                <th>Store Link</th>
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
                            <div class="tab-pane" id="settings1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead class="tread">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Affiliate Type</th>
                                                                <th>Names of Referral</th>
                                                                <th>Level</th>
                                                                <th>Commission</th>
                                                                <th>Joined Created</th>
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
            </div>
        </div>
    </div>
</div>
@endsection

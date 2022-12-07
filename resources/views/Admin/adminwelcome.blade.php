@extends('layouts.admin-frontend')

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
                    <div class="start">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="start-main">
                                    <h1>Welcome, Adeleke Money 👋</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">All Users</p>
                                            <h4 class="mb-0">100</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                <span class="avatar-title">
                                                    <i class="bi bi-people font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Subscriptions</p>
                                            <h4 class="mb-0">1</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Active Users</p>
                                            <h4 class="mb-0">30</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bi bi-person-check font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Total Wallet</p>
                                            <h4 class="mb-0">1000</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bi bi-wallet2 font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body card">
                                <h4 class="card-title mb-4">View All Mailing List</h4>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                        <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                            <table class="table align-middle table-nowrap">
                                                <thead class="tread">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Mailing List Name </th>
                                                        <th>No of Contacts </th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Status</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
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
                        <div class="col-md-6">
                            <div class="card-body card">
                                <h4 class="card-title mb-4">View Users</h4>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                                        <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                            <table class="table align-middle table-nowrap">
                                                <thead class="tread">
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>User Name </th>
                                                        <th>Email</th>
                                                        <th>Phone Number</th>
                                                        <th>Status</th>
                                                        <th>Date Created</th>
                                                        <th>Action</th>
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
                        <div class="col-md-6">
                            <div class="card-body card">
                                <div class="d-sm-flex flex-wrap">
                                    <h4 class="card-title mb-4">Email Sent</h4>
                                    <div class="ms-auto">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Month</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#">Year</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="stacked-column-chart" class="apex-charts" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]' dir="ltr"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body card">
                                <h4 class="card-title mb-4">Recent Messages</h4>
                                <div data-simplebar style="max-height: 376px;">
                                    <div class="vstack gap-4">
                                        <div class="d-flex">
                                            <img src="assets/images/companies/airbnb.svg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">NodeJs Developer</a></h6>
                                                <p class="text-muted mb-0">Skote Themes, Louisiana - <b>2</b> hrs ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-1.jpg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">NodeJs Developer</a></h6>
                                                <p class="text-muted mb-0">Skote Themes, Louisiana - <b>2</b> hrs ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="assets/images/companies/flutter.svg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">Digital Marketing</a></h6>
                                                <p class="text-muted mb-0">Web Technology pvt.Ltd, Danemark - <b>8</b> hrs ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="assets/images/companies/mailchimp.svg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">Marketing Director</a></h6>
                                                <p class="text-muted mb-0">Skote Technology, Dominica - <b>1</b> days ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="assets/images/companies/spotify.svg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">Business Associate</a></h6>
                                                <p class="text-muted mb-0">Themesbrand, Russia - <b>2</b> days ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <img src="assets/images/companies/reddit.svg" alt="" height="40" class="rounded">
                                            <div class="ms-2 flex-grow-1">
                                                <h6 class="mb-1 font-size-15"><a href="job-details.html" class="text-body">Backend Developer</a></h6>
                                                <p class="text-muted mb-0">Adobe Agency, Malaysia - <b>3</b> days ago</p>
                                            </div>
                                            <div class="dropdown">
                                                <button class="btn btn-light" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton8">
                                                    <li><a class="dropdown-item" href="job-details.html">View Details</a></li>
                                                    <li><a class="dropdown-item" href="#">Apply Now</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recent Transaction</h4>
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check font-size-16 align-middle">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                                    <label class="form-check-label" for="transactionCheck01"></label>
                                                </div>
                                            </th>
                                            <th class="align-middle">Order ID</th>
                                            <th class="align-middle">Billing Name</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Total</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">View Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck02">
                                                    <label class="form-check-label" for="transactionCheck02"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                                            <td>Neal Matthews</td>
                                            <td>
                                                07 Oct, 2019
                                            </td>
                                            <td>
                                                $400
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck03">
                                                    <label class="form-check-label" for="transactionCheck03"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2541</a> </td>
                                            <td>Jamal Burnett</td>
                                            <td>
                                                07 Oct, 2019
                                            </td>
                                            <td>
                                                $380
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-danger font-size-11">Chargeback</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-visa me-1"></i> Visa
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck04">
                                                    <label class="form-check-label" for="transactionCheck04"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2542</a> </td>
                                            <td>Juan Mitchell</td>
                                            <td>
                                                06 Oct, 2019
                                            </td>
                                            <td>
                                                $384
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-paypal me-1"></i> Paypal
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck05">
                                                    <label class="form-check-label" for="transactionCheck05"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2543</a> </td>
                                            <td>Barry Dick</td>
                                            <td>
                                                05 Oct, 2019
                                            </td>
                                            <td>
                                                $412
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck06">
                                                    <label class="form-check-label" for="transactionCheck06"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2544</a> </td>
                                            <td>Ronald Taylor</td>
                                            <td>
                                                04 Oct, 2019
                                            </td>
                                            <td>
                                                $404
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-warning font-size-11">Refund</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-visa me-1"></i> Visa
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="transactionCheck07">
                                                    <label class="form-check-label" for="transactionCheck07"></label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2545</a> </td>
                                            <td>Jacob Hunter</td>
                                            <td>
                                                04 Oct, 2019
                                            </td>
                                            <td>
                                                $392
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                            </td>
                                            <td>
                                                <i class="fab fa-cc-paypal me-1"></i> Paypal
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Active Users</p>
                                            <h4 class="mb-0">30</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-success">
                                                    <i class="bi bi-person-check font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Vendor List</p>
                                            <h4 class="mb-0">50</h4>
                                        </div>
                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-warning">
                                                    <i class="bi bi-bag-check font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Affiliate List</p>
                                            <h4 class="mb-0">80</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-dark">
                                                    <i class="bi bi-patch-check font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Sales Analytics</p>
                                            <h4 class="mb-0">10</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bi bi-bag-plus font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Affiliate Payment</p>
                                            <h4 class="mb-0">21</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-success">
                                                    <i class="bi bi-wallet2 font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">Birthday Modules</p>
                                            <h4 class="mb-0">25</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-info">
                                                    <i class="bi bi-box2-heart font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">List Management</p>
                                            <h4 class="mb-0">100</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-secondary">
                                                    <i class="bi bi-bag-plus font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">View Users</h4>
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
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
                                                    <tr>

                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#11</a> </td>
                                                        <td>Hamzat</td>
                                                        <td>
                                                            greenmousetest@gmail.com
                                                        </td>
                                                        <td>
                                                            1234567890
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                        </td>
                                                        <td>
                                                            Dec 10 2022
                                                        </td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                                    <a href="{{route('users.details')}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                    <a href="#" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                    <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#12</a> </td>
                                                        <td>Promise</td>
                                                        <td>
                                                            greenmousetest@gmail.com
                                                        </td>
                                                        <td>
                                                            1234567890
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                        </td>
                                                        <td>
                                                            Dec 10 2022
                                                        </td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                                    <a href="{{route('users.details')}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                    <a href="#" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                    <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#13</a> </td>
                                                        <td>Adeleke</td>
                                                        <td>
                                                            greenmousetest@gmail.com
                                                        </td>
                                                        <td>
                                                            1234567890
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                        </td>
                                                        <td>
                                                            Dec 10 2022
                                                        </td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                                    <a href="{{route('users.details')}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                    <a href="#" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                    <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>

                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#14</a> </td>
                                                        <td>Fuad</td>
                                                        <td>
                                                            greenmousetest@gmail.com
                                                        </td>
                                                        <td>
                                                            1234567890
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                        </td>
                                                        <td>
                                                            Dec 10 2022
                                                        </td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                                    <a href="{{route('users.details')}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                    <a href="#" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                    <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">#15</a> </td>
                                                        <td>Daneil</td>
                                                        <td>
                                                            greenmousetest@gmail.com
                                                        </td>
                                                        <td>
                                                            1234567890
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                        </td>
                                                        <td>
                                                            Dec 10 2022
                                                        </td>
                                                        <td>
                                                            <ul class="list-unstyled hstack gap-1 mb-0">
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                                    <a href="{{route('users.details')}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                    <a href="#" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                                </li>
                                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                    <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recent Transaction</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>

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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>

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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>

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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>

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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>

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
                                                <a href="{{route('trans.details')}}">
                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light" >
                                                    View Details
                                                </button>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- Modal -->
<div class="modal fade" id="jobDelete" tabindex="-1" aria-labelledby="jobDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body px-4 py-5 text-center">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently erase the job.</p>

                <div class="hstack gap-2 justify-content-center mb-0">
                    <button type="button" class="btn btn-danger">Delete Now</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

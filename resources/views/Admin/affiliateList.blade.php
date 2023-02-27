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
                        <h4 class="mb-sm-0 font-size-18">Affiliate list</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Affiliate List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Affiliate Program</h4>
                            <p>View and edit your mailing list</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Affiliate List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Earning</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Paid Referrals</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Hamzat Abdul</td>
                                            <td>1000</td>
                                            <td>1%</td>
                                            <td>500</td>
                                            <td>
                                                <span class="badge bg-success font-size-10">active</span>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="View List">
                                                        <a href="#" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li> -->
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Adeleke Money</td>
                                            <td>2000</td>
                                            <td>2%</td>
                                            <td>1000</td>
                                            <td>
                                                <span class="badge bg-success font-size-10">active</span>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="View List">
                                                        <a href="#" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li> -->
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Promise</td>
                                            <td>4000</td>
                                            <td>5%</td>
                                            <td>1000</td>
                                            <td>
                                                <span class="badge bg-danger font-size-10">pending</span>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="View List">
                                                        <a href="#" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li> -->
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
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
@endsection
<!-- ============================================================== -->
<!-- Start right Content Ends -->
<!-- ============================================================== -->

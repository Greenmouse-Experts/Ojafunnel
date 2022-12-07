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
                        <h4 class="mb-sm-0 font-size-18">Subscriptions</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Subscriptions</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Subscriptions</h4>
                            <div class="table-responsive mt-2">
                                <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Trade No</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Balance</th>
                                            <th scope="col">Status</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>06 Dec, 2022</td>
                                            <td>Paid</td>
                                            <td>Bitcoin</td>
                                            <td>1.00952 BTC</td>
                                            <td>$ 9067.62</td>
                                            <td>
                                                <span class="badge bg-success font-size-10">Completed</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>06 Dec, 2022</td>
                                            <td>Paid</td>
                                            <td>Ethereum</td>
                                            <td>0.00413 ETH</td>
                                            <td>$ 2123.01</td>
                                            <td>
                                                <span class="badge bg-success font-size-10">Completed</span>
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
<!-- END layout-wrapper -->
@endsection
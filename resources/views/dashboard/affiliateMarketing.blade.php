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
            <div class="row begin">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="">
                            <h4 class="font-500">
                                Affiliate Program
                            </h4>
                            <p>
                                View and edit your mailing list
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="">
                                    <div style="margin-bottom: 10px;">
                                        Your Affiliate Link
                                    </div>
                                    <div class="d-flex border-in align-items-center">
                                        <div class="w-50 d-flex ps-3 pt-2" style="color: #714091; background: #efd7ff">
                                            <p class="mb-2">https://chuka.ojafunnel.cc/store</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="affliate">
                                <h2>
                                    2
                                </h2>
                                <p>
                                    No Of Affiliates
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="affliate">
                                <h2>
                                    0
                                </h2>
                                <p>
                                    No Of Refferals
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-purpp"><a href="">
                                    Affiliates
                                </a> <span style="float: right;"><a href="">
                                        My Affiliate Link
                                    </a></span></h4>
                            <p class="card-title-desc">

                            </p>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Affiliate</th>
                                            <th>Type</th>
                                            <th>Commission (%)</th>
                                            <th>Affiliate Link</th>
                                            <th>Status </th>
                                            <th>Sales</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Hamzat</td>
                                            <td>Level 1</td>
                                            <td>10%</td>
                                            <td>chukka/affiliatelink</td>
                                            <td>Active</td>
                                            <td>Active</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Edit/a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Hamzat</td>
                                            <td>Level 2</td>
                                            <td>10%</td>
                                            <td>chukka/affiliatelink</td>
                                            <td>Active</td>
                                            <td>Active</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="#">Edit</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
@endsection
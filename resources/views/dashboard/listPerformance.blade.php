@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">List performance</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">List performance</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">List performance </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card all-create account-head">
                        <nav aria-label="Page navigation example normal float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{route('user.view.list', Auth::user()->username)}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#"><i class="bi bi-graph-up"></i> Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-gear"></i> Setting</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-person-check"></i> Subscribers <i class="bi bi-caret-up"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                          <li><a class="dropdown-item" href="#">View all</a></li>
                                          <li><a class="dropdown-item" href="#">Add</a></li>
                                          <li><a class="dropdown-item" href="#">Import</a></li>
                                          <li><a class="dropdown-item" href="#">Export</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-layout-three-columns"></i> Segment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-card-checklist"></i> Manage list fields</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-columns"></i> Form / Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-envelope-check"></i> Email Verifications</a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Average open rate <span style="float: right">0.00%</span></h4>
                            <div class="">
                                <div>
                                    <div class="progress progress-xl">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 20%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Average click rate  <span style="float: right">0.00%</span></h4>
                            <div class="">
                                <div>
                                    <div class="progress progress-xl">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 30%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
                <div class="col-xl-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">0.00%</h4>
                            <p>Avg subscribe rate</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">0.00%</h4>
                            <p>Avg unsubscribe rate</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">0</h4>
                            <p>Total unsubscribers</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title">0</h4>
                            <p>Total unconfirmed</p>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">List growth</h4>

                            <div id="line_chart_datalabel" data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Pie Chart</h4>
                            <div id="pie-chart" data-colors='["--bs-primary","--bs-warning", "--bs-danger","--bs-info", "--bs-success"]' class="e-charts"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

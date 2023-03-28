@extends('layouts.dashboard-frontend')

@section('page-content')
@inject('uc', 'App\Http\Controllers\DashboardController')
@php
$array = \App\Models\User::all();
$usr = Auth::user()->id;
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row aminn">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Affiliate Program</h4>
                            <p>
                                View and edit your mailing list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="Editt">
                                <div class="form">
                                    <label>Your Affiliate Link</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" value=" {{ route('signup', ['ref' => Auth::user()->affiliate_link]) }}" name="name" id="myInput" class="input mov" readonly required>
                                        </div>
                                        <div class="col-md-1">
                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
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
                                    {{$referrals->count()}}
                                </h2>
                                <p>
                                    No of Direct Affiliates
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
                                    ₦{{number_format(Auth::user()->ref_bonus, 2)}}
                                </h2>
                                <p>
                                    Referral Bonus
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
                                    Affiliates</h4>
                            <p class="card-title-desc">
                            </p>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Affiliate Type</th>
                                            <th>Level</th>
                                            <th>Commission (%)</th>
                                            <th>Referred By</th>
                                            <th>Status</th>
                                            <th>Joined Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        {!! $uc->getdownlines($array,$usr) !!}
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
</div>
<!-- END layout-wrapper -->
@endsection

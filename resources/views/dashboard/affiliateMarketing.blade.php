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
                                <div>
                                    <div class="">
                                        <div style="margin-bottom: 10px;">
                                            Your Affiliate Link
                                        </div>
                                        <div class="d-flex border-in align-items-center">
                                            <div class="d-flex ps-3 pt-2" style="color: #714091; background: #efd7ff">
                                                <p class="mb-2">
                                                    {{ route('signup', ['ref' => Auth::user()->affiliate_link]) }}
                                                </p>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="affliate">
                                <h2>
                                    {{$referrals->count()}}
                                </h2>
                                <p>
                                    No of Affiliates
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
                                <table class="table mb-0">
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
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
@endsection
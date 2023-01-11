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
                        <div class="Editt">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label>Your Affiliate Link</label>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text" value=" {{ route('signup', ['ref' => Auth::user()->affiliate_link]) }}" name="name" id="myInput" class="input mov" readonly
                                                    required>
                                            </div>
                                            <div class="col-md-1">
                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Copy" onclick="myFunction()" class="btn btn-secondary push"><i
                                                    class="mdi mdi-content-copy"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-5">
                                <div>
                                    <div class="">
                                        <div style="margin-bottom: 10px;">
                                            Your Affiliate Link
                                        </div>
                                        <div class="d-flex border-in align-items-center">
                                            <div class="d-flex ps-3 pt-2" style="color: #714091; background: #efd7ff">
                                                <p class="mb-2" id="myInput" onclick="copyFunction()">
                                                   
                                                </p>
                                            </div>
                                            <div class="vr"></div>
                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Copy" class="btn btn-secondary"><i
                                                    class="mdi mdi-content-copy"></i></button>
                                            <div class="vr"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
                                    No Of Refferals
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
                                    No Of Affiliates
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
                                            <!-- <th>Actions</th> -->
                                        </tr>
                                    </thead>
                                    @foreach($referrals as $referral)
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>{{$referral->first_name}} {{$referral->last_name}}</td>
                                            <td>Tier 1</td>
                                            <td>10%</td>
                                            <td>{{ route('signup', ['ref' => Auth::user()->affiliate_link]) }}</td>
                                            <!-- <td>
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
                                            </td> -->
                                        </tr>
                                    </tbody>
                                    @endforeach
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
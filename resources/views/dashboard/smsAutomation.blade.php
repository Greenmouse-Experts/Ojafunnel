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
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-2 justify-content-between align-items-center">
                        <div class="col">
                            <h4 class="font-60">My SMS Campaigns</h4>
                            <p>View your sent and scheduled sms to your customers</p>
                        </div>
                        <div class="col text-end">
                            <a href="{{route('user.new.sms', Auth::user()->username)}}"><button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                    Create New Campaign
                                </button></a>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">Sent SMS</p>
                        <p>
                            <a href="#" class="text-decoration-none text-dark">Scheduled SMS</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->
            <div class="container">
                <div class="store-table">
                    <div class="table-head row pt-4">
                        <div class="col-lg-6">
                            <h4>Sent SMS</h4>
                        </div>
                        <!-- <div class="col-lg-6 search-item">
                            <div class="bg-light search-store border-in flex">
                                <input class="bg-light" type="search" placeholder="search by name" name="store" id="" />
                                <button><i class="bi bi-search"></i></button>
                            </div>
                        </div> -->
                    </div>
                    <div class="table-body mt-5 table-responsive">
                        <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                            <thead class="fw-bold bg-light rounded-pill ">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Campaign Name</th>
                                    <th scope="col">Date Sent</th>
                                    <th scope="col">SMS Sent</th>
                                    <th scope="col">Delivered</th>
                                    <th scope="col">Not Delivered</th>
                                    <!-- <th scope="col">Opens</th> -->
                                    <th scope="col">Unsubscribed</th>
                                </tr>
                            </thead>
                            @if($smsAutomations->isEmpty())
                                <tbody>
                                    <tr>
                                        <td class="align-enter text-dark font-15" colspan="8">No sms campaign added.</td>
                                    </tr>
                                </tbody>
                            @else
                            @foreach($smsAutomations as $key => $smsAutomation)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$smsAutomation->campaign_name}}</td>
                                    <td>{{$smsAutomation->created_at->toDayDateTimeString()}}</td>
                                    <td>{{$smsAutomation->sms_sent}}</td>
                                    <td>{{$smsAutomation->delivered}}</td>
                                    <td>{{$smsAutomation->not_delivered}}</td>
                                    <!-- <td>{{$smsAutomation->opens}}</td> -->
                                    <td>{{$smsAutomation->unsubscribed}}</td>
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
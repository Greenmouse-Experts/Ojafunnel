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
                    <div class="row justify-content-between align-items-center">
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
<<<<<<< HEAD
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-custom">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Sent SMS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Scheduled SMS</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- store data information-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title mb-2">Sent SMS</h4>
                            <div class="table-body table-responsive">
                                <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
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
=======

                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->
            <div class="">
                <div class="store-table">
                    <div class="table-head row pt-4">
                        <div class="col-lg-12">
                            <h4>Campaigns</h4>
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
                                    <th scope="col">Contact</th>
                                    <th scope="col">Sent</th>
                                    <th scope="col">Failed</th>
                                    <th scope="col">Campaign Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                    <!-- <th scope="col">Opens</th> -->
                                    {{-- <th scope="col">Unsubscribed</th> --}}
                                </tr>
                            </thead>
                            @if($smsAutomations->isEmpty())
                                <tbody>
                                    <tr>
                                        <td class="align-enter text-dark font-15" colspan="8">No sms campaign added.</td>
                                    </tr>
                                </tbody>
                            @else
                            @foreach($smsAutomations as $key => $campaign)
                            <tbody>
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>
                                        <p class='text-bold-600'> {{$campaign->title}} </p>
                                        <p class='text-muted'>Created at: {{$campaign->created_at->toDayDateTimeString()}}</p>
                                    </td>
                                    <td>
                                        {{ $campaign->readCache('ContactCount') }}
                                    </td>
                                    <td>
                                        {{ $campaign->readCache('DeliveredCount') }}
                                    </td>
                                    <td>
                                        {{ $campaign->readCache('FailedDeliveredCount') }}
                                    </td>
                                    <td>
                                        {!!$campaign->getCampaignType()!!}
                                    </td>
                                    <td>
                                        {!!$campaign->getStatus()!!}
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        Overview
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button" >
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button" >
                                                        Pause
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    {{-- <td>{{$smsAutomation->created_at->toDayDateTimeString()}}</td>
                                    <td>{{$smsAutomation->sms_sent}}</td>
                                    <td>{{$smsAutomation->delivered}}</td>
                                    <td>{{$smsAutomation->not_delivered}}</td>
                                    <!-- <td>{{$smsAutomation->opens}}</td> -->
                                    <td>{{$smsAutomation->unsubscribed}}</td> --}}
                                </tr>
                            </tbody>
                            @endforeach
                            @endif
                        </table>
>>>>>>> 7207286e5441ec516159c115bbccc604a6c73443
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection
=======

<style>
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
</style>
<!-- END layout-wrapper -->
@endsection
>>>>>>> 7207286e5441ec516159c115bbccc604a6c73443

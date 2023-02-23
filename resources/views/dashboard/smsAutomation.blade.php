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
                        <h4 class="mb-sm-0 font-size-18">SMS Campaigns</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">SMS Campaigns</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row card account-head">
                <div class="col-12 ">
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
                    <div class="table-body mt-1 table-responsive">
                        <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                            <thead  class="fw-bold dark" style="background:#F5E6FE;">
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
                        </table>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>

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

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
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">My SMS Campaigns</h4>
                            <p>
                                View your sent and scheduled sms to your customers
                            </p>
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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                                <a href="{{route('user.new.sms', Auth::user()->username)}}">
                                    <button  data-bs-toggle="modal" data-bs-target="#template">
                                        Create New Campaign
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- store data information-->
             <!-- store data information-->
             <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-sliders2"></i> All</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
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
<!-- end modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, ducimus iste. Consequuntur doloremque voluptatem officia, quos laborum delectus atque distinctio reprehenderit earum iure. Sequi voluptate architecto libero, repellat neque deserunt assumenda sunt in sit ipsam delectus nostrum qui ratione. Laboriosam aliquid obcaecati vitae voluptatum ea minus quidem! Pariatur soluta quasi modi harum aut quas veritatis et. Necessitatibus fuga illo ipsa dicta aut nisi laborum nam at, id eveniet consectetur praesentium enim, cum dignissimos ipsum rem odio. Atque, eaque magni aut incidunt quo laudantium repudiandae quae modi officiis in, iusto suscipit fugiat rem inventore non dolorum adipisci rerum dolorem. Nulla, vero!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<!-- END layout-wrapper -->
@endsection

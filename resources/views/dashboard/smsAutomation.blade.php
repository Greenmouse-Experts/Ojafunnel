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
                            @if(App\Models\ExplainerContent::where('menu', 'Automation')->exists())
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @endif
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
                                        <sapn class="Type">{!!$campaign->getCampaignType()!!}</sapn>
                                    </td>
                                    <td>
                                        {!!$campaign->getStatus()!!}
                                    </td>
                                    <td>
                                        <div class="dropdown dropstart">
                                            <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                            Options
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <!-- <li>
                                                    <a class="dropdown-item" href="#">
                                                        Overview
                                                    </a>
                                                </li> -->
                                                <li>
                                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#edit-{{$campaign->id}}">
                                                        Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button" >
                                                        Pause
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#delete-{{$campaign->id}}">
                                                        Delete
                                                    </a>
                                                </li>
                                            </ul>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="edit-{{$campaign->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Provide Us Your Amount Below
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="row">
                                                                <div class="Editt">
                                                                    <form method="POST" action="{{ route('user.update.sms.campaign', Crypt::encrypt($campaign->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Campaign Name</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter Campaign Name" name="campaign_name" value="{{$campaign->title}}" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Sender Name</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter Sender Name" name="sender_name" value="{{$campaign->sender_name}}" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>SMS Message</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below" value="{{$campaign->message}}" maxlength="160">{{$campaign->message}}</textarea>
                                                                                            <div class="messageCounter"><span id="chars">160</span> characters</div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- <div class="row mt-3 mb-4 justify-content-between">
                                                                                    <div class="col-4">
                                                                                        <p class="font-500 fs-6">Recipients:</p>
                                                                                    </div>
                                                                                    <div class="col-8">
                                                                                        <select name="mailinglist_id" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                                                            <option value="">Choose from mailing list</option>
                                                                                            @if(\App\Models\ContactList::where('user_id', Auth::user()->id)->get()->isEmpty())
                                                                                            <option value="">No Mailing List</option>
                                                                                            @else
                                                                                            @foreach(\App\Models\ContactList::where('user_id', Auth::user()->id)->get() as $contact_list)
                                                                                            <option value="{{$contact_list->id}}">{{$contact_list->name}}</option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div> -->
                                                                                <div class="col-lg-12">
                                                                                    <div class="row">
                                                                                        @if(\App\Models\Integration::where('user_id', Auth::user()->id)->get()->isEmpty())
                                                                                        <div class="col-12">
                                                                                            <div class="circle" style="padding: 20px 20px 20px 2px; text-align: center;">
                                                                                                <span class="text-dark">No SMS Integration Gateway Added</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        @else
                                                                                        @foreach(\App\Models\Integration::where('user_id', Auth::user()->id)->get() as $integration)
                                                                                        <div class="col-md-6">
                                                                                            <div class="circle" style="padding: 20px 20px 20px 20px;">
                                                                                                <span class="text-dark">{{$integration->type}}</span>
                                                                                            </div>
                                                                                            <div class="zazu">
                                                                                                <input type="radio" name="integration" value="{{$integration->type}}" {{ ($campaign->integration == $integration->type)? "checked" : "" }} style="margin-top: -70px !important;">
                                                                                            </div>
                                                                                        </div>
                                                                                        @endforeach
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12">
                                                                                    <label>Opt Out Message </label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter opt out message eg text stop to 12344" name="optout_message" class="input">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-6"></div>
                                                                                <div class="col-6">
                                                                                    <div class="row">
                                                                                        <div class="boding">
                                                                                            <button type="submit">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal -->
                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="delete-{{$campaign->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <div class="row">
                                                                <div class="Editt">
                                                                    <form method="POST" action="{{ route('user.delete.sms.campaign', Crypt::encrypt($campaign->id))}}">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <p><b>Delete Sms Campaign</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <p>This action cannot be undone. <br>This will permanently delete this sms campaign.</p>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button type="submit" class="form-btn">
                                                                                            I understand this consquences, Delete Sms Campaign
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end modal -->
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
    .Type span {
        color: #000 !important;
    }
</style>
@if(App\Models\ExplainerContent::where('menu', 'Automation')->exists())
<!-- end modal -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="{{App\Models\ExplainerContent::where('menu', 'Automation')->first()->video}}" title="Explainer Video" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                {{App\Models\ExplainerContent::where('menu', 'Automation')->first()->text}}
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
@endif
@endsection

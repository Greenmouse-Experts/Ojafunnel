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
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">WhatsApp Automation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">WhatsApp Automation</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">WhatsApp Automation</h4>
                                    <p>
                                        Send instant, scheduled or automated messages to your contact
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="{{route('user.send.broadcast', Auth::user()->username)}}">
                                            <button>
                                                Send Broadcast Messsage
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="d-flex account-nav">
                            {{-- <p class="ps-0">New Campaign</p> --}}
                            {{-- <p>
                                <a href="#" class="text-decoration-none text-dark">Recieved Messages</a>
                            </p> --}}
                            <p class="ps-0 active">
                                <a href="#" class="text-decoration-none text-dark">Campaign Lists</a>
                            </p>
                            {{-- <p>
                                <a href="#" class="text-decoration-none text-dark">Auto Reply</a>
                            </p> --}}
                            {{-- <p>

                            </p> --}}
                            {{-- <p class="ps-0 active">
                                <a href="#" class="text-decoration-none text-dark">Settings</a>
                            </p> --}}
                        </div>
                        <div class="acc-border"></div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="">
                    <div class="store-table">
                        <div class="table-head row pt-4">
                            <div class="col-lg-12">
                                <h4>Whatsapp Campaigns</h4>
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
                                <thead class="fw-bold dark" style="background:#F5E6FE;">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Campaign Name</th>
                                        <th scope="col">Whatsapp Account</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Sent</th>
                                        <th scope="col">Failed</th>
                                        <th scope="col">Campaign Template</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <!-- <th scope="col">Opens</th> -->
                                        {{-- <th scope="col">Unsubscribed</th> --}}
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse ($whatsapp_campaigns as $whatsapp_campaign)
                                        <tr>
                                            <th scope="row">{{$whatsapp_campaign->id}}</th>
                                            <th scope="row" class="text-capitalize">{{$whatsapp_campaign->name}}</th>
                                            <td>
                                                <p class='text-bold-600'> {{$whatsapp_campaign->whatsapp_account}} </p> 
                                            </td>
                                            <td>
                                                {{ count($whatsapp_campaign->wa_queues) }}
                                            </td>
                                            <td>
                                                {{ count($whatsapp_campaign->wa_queues->where('status', 'Sent')) }}
                                            </td>
                                            <td>
                                                {{ count($whatsapp_campaign->wa_queues->where('status', 'Invalid')) }}
                                            </td>
                                            <td>
                                                @if ($whatsapp_campaign->template == 'template1')
                                                    {{ 'Template 1 (Text) '}}  
                                                @endif 

                                                @if ($whatsapp_campaign->template == 'template2')
                                                    {{ 'Template 2 (Text & File) '}}  
                                                @endif 

                                                @if ($whatsapp_campaign->template == 'template3')
                                                    {{ 'Template 3 (Header, Text, Footer, Link, & Call) '}}  
                                                @endif 
                                            </td>
                                            <td>  
                                                @if (count($whatsapp_campaign->wa_queues->where('status', 'Waiting')) > 0)
                                                    {{ 'Ongoing' }}
                                                @else
                                                    {{ 'Done' }}
                                                @endif 
                                            </td>
                                            <td>
                                                <div class="dropdown dropstart">
                                                    <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="true">
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('user.whatsapp.automation.campaign', ['username' => Auth::user()->id, 'campaign_id' => $whatsapp_campaign->id]) }}">
                                                                Overview
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#edit-{{ $whatsapp_campaign->id }}">
                                                                Edit
                                                            </a> 
                                                        </li>
                                                        {{-- <li>
                                                            <a class="dropdown-item" type="button" >
                                                                Pause
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#delete-{{ $whatsapp_campaign->id }}">
                                                                Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td> 
                                            
                                            {{-- modal --}}
                                            <div class="modal fade" id="edit-{{ $whatsapp_campaign->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <h4 class="card-title mb-4">Edit Campaign</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="Editt">
                                                                <form action="{{ route('user.wa.campaign.edit', ['username' => Auth::user()->username ]) }}" method="POST">
                                                                    @csrf
                                                                    <div class="form">
                                                                        <div class="row">
                                                                            <div class="col-lg-12 mb-4">
                                                                                <label for="Name">Campaign name</label>
                                                                                <input type="hidden" name="id" value="{{ $whatsapp_campaign->id }}">
                                                                                <input type="text" name="name" value="{{ $whatsapp_campaign->name }}" placeholder="Enter your Campaign name"/>
                                                                            </div>   
                                                                            <div class="text-end mt-2">
                                                                                <a href="#" class="text-decoration-none">
                                                                                    <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                                        Submit
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- modal --}}
                                            <div class="modal fade" id="delete-{{ $whatsapp_campaign->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content pb-3">
                                                        <div class="modal-header border-bottom-0">
                                                            <h4 class="card-title mb-4">Delete Campaign</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="Editt">
                                                                <form action="{{ route('user.wa.campaign.delete', ['username' => Auth::user()->username ]) }}" method="POST">
                                                                    @csrf 
                                                                    <div class="form">
                                                                        <div class="row">
                                                                            <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to delete this campaign?</h3>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button></a>
                                                                                </div>
                                                                                <div class="col-6 text-end">
                                                                                    <input type="hidden" name="id" value="{{ $whatsapp_campaign->id }}">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028"
                                                                                            >
                                                                                            Delete
                                                                                        </button>
                                                                                    </a>
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

                                        </tr>
                                    @empty
                                        No whatsapp automation yet!
                                    @endforelse 
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-2"></div>
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
@endsection

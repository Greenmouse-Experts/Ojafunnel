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
             <!-- start page title -->
             <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">WhatsApp Automation</h4>
                            <p>
                                Send instant, scheduled or automated messages to your contact
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
                                <a href="{{route('user.send.broadcast', Auth::user()->username)}}">
                                    <button>
                                        Send Broadcast Messsage
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- store data information-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-sliders2"></i>Campaign Lists</span>
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
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="">
                    <div class="store-table mb-4">
                        <div class="table-head row pt-4">
                            <div class="col-lg-12">
                                <h4>Whatsapp Campaigns</h4>
                            </div>
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
                                        <th scope="col">Created At</th>
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
                                                @if($whatsapp_campaign->message_timing == 'Series')
                                                    {{$whatsapp_campaign->total_contacts}}
                                                @else
                                                {{ count($whatsapp_campaign->wa_queues) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($whatsapp_campaign->message_timing == 'Series')
                                                    {{$whatsapp_campaign->total_delivered}}
                                                @else
                                                {{ count($whatsapp_campaign->wa_queues->where('status', 'Sent')) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($whatsapp_campaign->message_timing == 'Series')
                                                    {{$whatsapp_campaign->total_failed}}
                                                @else
                                                {{ count($whatsapp_campaign->wa_queues->where('status', 'Invalid')) }}
                                                @endif
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
                                                @if ($whatsapp_campaign->message_timing == 'Immediately')
                                                    @if (count($whatsapp_campaign->wa_queues->where('status', 'Waiting')) > 0)
                                                        <span class="badge bg-info font-size-10">{{ 'Ongoing' }}</span>
                                                    @else
                                                        <span class="badge bg-success font-size-10">{{ 'Completed' }}</span>
                                                    @endif
                                                @else
                                                    <span class="badge bg-success font-size-10">{{ 'Scheduled' }}</span>
                                                @endif
                                            </td>
                                            <td> {{$whatsapp_campaign->created_at->toDayDateTimeString()}} </td>
                                            <td>
                                                <div class="dropdown dropstart">
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Overview">
                                                            <a href="{{ route('user.whatsapp.automation.campaign', ['username' => Auth::user()->id, 'campaign_id' => $whatsapp_campaign->id]) }}" class="btn btn-sm btn-soft-info"><i class="mdi mdi-eye-outline"></i></a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                            <a href="#edit-{{ $whatsapp_campaign->id }}" data-bs-toggle="modal" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-pencil-outline"></i></a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                            <a href="#delete-{{ $whatsapp_campaign->id }}" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
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

                                                                            <div class="col-lg-12 mb-4">
                                                                                <label for="Name">Campaign Message</label>
                                                                                <textarea type="text" name="template1_message">{{ $whatsapp_campaign->template1_message }}</textarea>
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
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Automation')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
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

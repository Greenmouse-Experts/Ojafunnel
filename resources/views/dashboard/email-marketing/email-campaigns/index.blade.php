@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Email Campaigns</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Campaigns</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-lg-8 aminn">
                                <div class="py-2">
                                    <h4 class="font-500">Email Campaigns</h4>
                                    <p>
                                        All your Email Campaigns in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-1 aminn">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- <p class="cash">Explainer Video Here</p> -->
                                        @if(App\Models\ExplainerContent::where('menu', 'Email-Marketing')->exists())
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
                            <div class="col-lg-2 aminn">
                                <div class="card account-head">
                                    <div class="all-create">
                                        <a href="{{ route('user.email-marketing.email.campaigns.create', ['username' => Auth::user()->username]) }}">
                                            <button>
                                                + Add Email Campaigns
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Email Campaigns</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Kit</th>
                                            <th>Template</th>
                                            <th>List</th>
                                            <th>Replyto Email</th>
                                            <th>Replyto Name</th>
                                            <th>Attachment(s)</th>
                                            <th>Sent</th>
                                            <th>Bounced</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($email_campaigns as $email_campaign)
                                            <tr>
                                                <td>{{ $loop->index + 1}}</td>
                                                <td>{{ $email_campaign->name }}</td>
                                                <td>{{ $email_campaign->subject }}</td>
                                                <td>
                                                    @if (App\Models\EmailKit::where('id', $email_campaign->email_kit_id)->exists())
                                                        {{ App\Models\EmailKit::where('id', $email_campaign->email_kit_id)->first()->host }}
                                                    @else
                                                        <b>{{ 'DELETED' }}</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (App\Models\EmailTemplate::where('id', $email_campaign->email_template_id)->exists())
                                                        {{ App\Models\EmailTemplate::where('id', $email_campaign->email_template_id)->first()->name }}
                                                    @elseif($email_campaign->message_timing == 'Series')
                                                        @if (App\Models\SeriesEmailCampaign::where('email_campaign_id', $email_campaign->id)->exists())
                                                            @foreach(App\Models\SeriesEmailCampaign::where('email_campaign_id', $email_campaign->id)->get() as $index => $template)
                                                            {{ $index + 1 }}. {{ App\Models\EmailTemplate::where('id', $template->email_template_id)->first()->name }}
                                                            <br>
                                                            @endforeach
                                                        @else
                                                        <b>{{ 'DELETED' }}</b>
                                                        @endif
                                                    @else
                                                        <b>{{ 'DELETED' }}</b>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (App\Models\ListManagement::where('id', $email_campaign->list_id)->exists())
                                                        {{ App\Models\ListManagement::where('id', $email_campaign->list_id)->first()->name }}
                                                    @else
                                                        <b>{{ 'DELETED' }}</b>
                                                    @endif
                                                </td>
                                                <td>{{ $email_campaign->replyto_email }}</td>
                                                <td>{{ $email_campaign->replyto_name }}</td>
                                                <td>{{ $email_campaign->attachment_paths ? count(json_decode($email_campaign->attachment_paths)) : 'null' }}</td>
                                                <td>{{ $email_campaign->sent }}</td>
                                                <td>{{ $email_campaign->bounced }}</td>
                                                <td>{{ $email_campaign->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <ul class="list-unstyled hstack gap-1 mb-0">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                <a href="{{ route('user.email-marketing.email.campaigns.overview', ['username' => Auth::user()->username, 'id' => $email_campaign->id])}}" class="btn btn-sm btn-soft-info">
                                                                    <i class="mdi mdi-eye-outline"></i>
                                                                </a>
                                                            </li>
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                <a href="#delete-{{ $email_campaign->id }}" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                            </li>
                                                        </ul>

                                                        <div class="modal fade" id="delete-{{ $email_campaign->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" style="max-width: 35%">
                                                                <div class="modal-content pb-3">

                                                                    <div class="modal-header border-bottom-0">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="Editt">
                                                                            <form action="{{ route('user.email-marketing.email.campaigns.delete', ['username' => Auth::user()->username ])}}" method="POST">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to <br> delete this email campaign</h3>
                                                                                        <div class="row justify-content-between">
                                                                                            <div class="col-6">
                                                                                                <a href="#" class="text-decoration-none">
                                                                                                    <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                        Cancel
                                                                                                    </button></a>
                                                                                            </div>
                                                                                            <div class="col-6 text-end">
                                                                                                <input type="hidden" name="id" value="{{ $email_campaign->id }}">
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
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            {{ 'No email campaign at the moment '}}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(App\Models\ExplainerContent::where('menu', 'Email-Marketing')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Email-Marketing')->first()->video}}" type="video/mp4">
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
                           {{App\Models\ExplainerContent::where('menu', 'Email-Marketing')->first()->text}}
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

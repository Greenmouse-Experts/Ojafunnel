@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Email Campaigns / Gateways</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
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
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Email Campaigns</h4>
                                    <p>
                                        All your Email Campaigns in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        {{-- <a href="">
                                            <button>
                                                + Add Email Campaigns
                                            </button>
                                        </a> --}}
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
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        @forelse ($email_campaigns as $email_campaign)
                                            <tr>
                                                <td>{{ $loop->index + 1}}</td>
                                                <td>{{ $email_campaign->name }}</td>
                                                <td>{{ $email_campaign->subject }}</td> 
                                                <td> 
                                                    {{ App\Models\EmailKit::latest()->where('id', $email_campaign->email_kit_id)->first()->host }}
                                                </td> 
                                                <td> 
                                                    {{ 
                                                        App\Models\EmailTemplate::latest()
                                                        ->where('id', $email_campaign->email_template_id)->first()->name 
                                                    }}
                                                </td> 
                                                <td>
                                                    {{ 
                                                        App\Models\MailList::latest()->where('id', $email_campaign->list_id)
                                                        ->first()->name 
                                                    }}
                                                </td> 
                                                <td>{{ $email_campaign->replyto_email }}</td>
                                                <td>{{ $email_campaign->replyto_name }}</td>
                                                <td>{{ count(json_decode($email_campaign->attachment_paths)) }}</td>
                                                <td>{{ $email_campaign->sent }}</td>
                                                <td>{{ $email_campaign->bounced }}</td> 
                                                <td>{{ $email_campaign->created_at->toDayDateTimeString() }}</td>   
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
@endsection
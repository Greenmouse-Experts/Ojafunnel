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
                        <h4 class="mb-sm-0 font-size-18">Manage Integration</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Integration</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Manage Your Integrations</h4>
                            <p>
                                Connect the tools that power your business
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All SMS Gateways Created</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Integration Type</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach($sms_integrations as $key => $sms_integration)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$sms_integration->type}}</td>
                                            <td>
                                                @if($sms_integration->status == 'Active')
                                                <span class="text-success">{{$sms_integration->status}}</span>
                                                @else
                                                <span class="text-danger">{{$sms_integration->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$sms_integration->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#View-{{$sms_integration->id}}">View</a></li>
                                                        @if($sms_integration->status == 'Active')
                                                        <li><a class="dropdown-item" href="{{route('user.integration.disable', Crypt::encrypt($sms_integration->id))}}">Disable</a></li>
                                                        @else
                                                        <li><a class="dropdown-item" href="{{route('user.integration.enable', Crypt::encrypt($sms_integration->id))}}">Enable</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Edit-Update-{{$sms_integration->id}}">Edit/Update</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$sms_integration->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal VIEW START -->
                                                <div class="modal fade" id="View-{{$sms_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            @if($sms_integration->type == 'Twilio')
                                                                            <p><b>View Twilio Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>SID</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$sms_integration->sid}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Token</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$sms_integration->token}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>From</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$sms_integration->from}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="px-3" style="color: #fff; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'InfoBip')
                                                                            <p><b>View InfoBip Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>API KEY</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->api_key}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>API BASE URL</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" value="{{$sms_integration->api_base_url}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="px-3" style="color: #fff; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'NigeriaBulkSms')
                                                                            <p><b>View NigeriaBulkSms Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Username</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->username}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Password</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->password}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="px-3" style="color: #fff; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'Multitexter')
                                                                            <p><b>View Multitexter Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Username</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->email}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Password</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->password}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>API-KEY</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$sms_integration->api_key}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <div class="boding">
                                                                                        <button data-bs-dismiss="modal" aria-label="Close" class="px-3" style="color: #fff; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end VIEW modal -->
                                                <!-- Modal VIEW START -->
                                                <div class="modal fade" id="Edit-Update-{{$sms_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            @if($sms_integration->type == 'Twilio')
                                                                            <p><b>Update Your Twilio Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($sms_integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>SID</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->sid}}" name="sid" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Token</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->token}}" name="token" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>From</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->from}}" name="from" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'InfoBip')
                                                                            <p><b>Update Your InfoBip Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($sms_integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>API KEY</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->api_key}}" name="api_key" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>API BASE URL</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->api_base_url}}" name="api_base_url" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'NigeriaBulkSms')
                                                                            <p><b>Update Your NigeriaBulkSms Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($sms_integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>Username</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->username}}" name="username" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Password</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->password}}" name="password" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            @elseif($sms_integration->type == 'Multitexter')
                                                                            <p><b>Update Your Multitexter Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($sms_integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>Email</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="email" value="{{$sms_integration->email}}" name="email" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Password</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->password}}" name="password" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>API KEY</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$sms_integration->api_key}}" name="api_key" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                                Update
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end VIEW modal -->
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$sms_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.integration.delete', Crypt::encrypt($sms_integration->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. </p> <p>This will permanently delete {{$sms_integration->type}} integration.</p>
                                                                                        <label>Please type DELETE to confirm.</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" name="delete_field" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                I understand this consquences, Delete List
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
                                            </td>
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">All Email Gateways Created</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Host</th>
                                            <th>Port</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Encryption</th>
                                            <th>From-Email</th>
                                            <th>From-Name</th>
                                            <th>Replyto-Email</th>
                                            <th>Replyto-Name</th>
                                            <th>Sent</th>
                                            <th>Bounced</th>
                                            <th>Master</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @forelse ($email_integrations as $email_integration)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $email_integration->type }}</td>
                                                <td>{{ $email_integration->host }}</td>
                                                <td>{{ $email_integration->port }}</td>
                                                <td>{{ $email_integration->username }}</td>
                                                <td>{{ '**********************' }}</td>
                                                <td>{{ $email_integration->encryption }}</td>
                                                <td>{{ $email_integration->from_email }}</td>
                                                <td>{{ $email_integration->from_name }}</td>
                                                <td>{{ $email_integration->replyto_email }}</td>
                                                <td>{{ $email_integration->replyto_name }}</td>
                                                <td>{{ $email_integration->sent }}</td>
                                                <td>{{ $email_integration->bounced }}</td>
                                                <td>
                                                    @if ($email_integration->master)
                                                        {{ 'Yes' }}
                                                    @else
                                                        {{ 'No' }}
                                                    @endif
                                                </td>
                                                <td>{{ $email_integration->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$email_integration->id}}">Edit</a>
                                                            </li> 
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#master-{{$email_integration->id}}">Make Master</a>
                                                            </li> 
                                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$email_integration->id}}">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="modal fade" id="master-{{$email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.email-marketing.email.kits.master', ['username' => Auth::user()->username]) }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Email Kit Master</b></p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <p>You are about to make this kit <b>({{$email_integration->host}})</b><br>your master kit. Are you sure to continue?.</p> 
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4"> 
                                                                                                    <input type="hidden" name="id" value="{{ $email_integration->id }}" class="input">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <div class="boding">
                                                                                                <button type="submit" class="form-btn">
                                                                                                    Yes, Make Master
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

                                                    <div class="modal fade" id="edit-{{$email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.email-marketing.email.kits.update', ['username' => Auth::user()->username]) }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Update Email Kit</b></p>
                                                                                    <div class="row">
                                                                                        <input type="hidden" name="id" value="{{ $email_integration->id }}" class="input">
                                                                                        <div class="col-lg-12">
                                                                                            <label>Host</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$email_integration->type}} SMTP Host" name="host" class="input" value="{{$email_integration->host}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="col-lg-12">
                                                                                            <label>Username</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$email_integration->type}} SMTP Username" name="username" class="input" value="{{$email_integration->username}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Password</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$email_integration->type}} SMTP Password" name="password" class="input" value="{{$email_integration->password}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Port</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type=numbert" placeholder="Your {{$email_integration->type}} SMTP Port" name="port" class="input" value="{{$email_integration->port}}"> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Encryption</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$email_integration->type}} SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$email_integration->type}} SMTP MAIL FROM" name="from_email" class="input" value="{{$email_integration->from_email}}" required>
                                                                                                    <span style="color: green">Must be the verified domain on {{$email_integration->type}}</span>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM-NAME</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your Brand Name" name="from_name" class="input" value="{{$email_integration->from_name}}" required>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div> 
                                                                                        <div class="col-lg-12">
                                                                                            <label>Reply-TO Email</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="{{$email_integration->replyto_email}}" required>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Reply-TO Name</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="{{$email_integration->replyto_name}}" required>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div> 
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <div class="boding">
                                                                                                <button type="submit" class="form-btn">
                                                                                                    Update
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

                                                    <div class="modal fade" id="delete-{{$email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.email-marketing.email.kits.delete', ['username' => Auth::user()->username]) }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Delete Email Kit</b></p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <p>This action cannot be undone. This will permanently delete <br> <b>{{$email_integration->host}} ({{$email_integration->type}})</b>.</p>
                                                                                            <label>Please type DELETE to confirm.</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" name="delete" class="input" required>
                                                                                                    <input type="hidden" name="id" value="{{ $email_integration->id }}" class="input">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <div class="boding">
                                                                                                <button type="submit" class="form-btn">
                                                                                                    I understand this consquences, Delete
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
                                                </td>
                                            </tr>
                                        @empty
                                            {{ 'No email kit / gateway at the moment' }}
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
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
<!-- END layout-wrapper -->
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
@endsection

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
                <div class="col-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Manage Your Integrations </h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
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
                                    @if($integrations->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="4">No Integration Added.</td>
                                        </tr>
                                    </tbody>
                                    @else
                                    @foreach($integrations as $key => $integration)
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$integration->type}}</td>
                                            <td>
                                                @if($integration->status == 'Active')
                                                <span class="text-success">{{$integration->status}}</span>
                                                @else
                                                <span class="text-danger">{{$integration->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$integration->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#View-{{$integration->id}}">View</a></li>
                                                        @if($integration->status == 'Active')
                                                        <li><a class="dropdown-item" href="{{route('user.integration.disable', Crypt::encrypt($integration->id))}}">Disable</a></li>
                                                        @else
                                                        <li><a class="dropdown-item" href="{{route('user.integration.enable', Crypt::encrypt($integration->id))}}">Enable</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#Edit-Update-{{$integration->id}}">Edit/Update</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$integration->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal VIEW START -->
                                                <div class="modal fade" id="View-{{$integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            @if($integration->type == 'Twilio')
                                                                            <p><b>View Twilio Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>SID</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$integration->sid}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Token</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$integration->token}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>From</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input readonly value="{{$integration->from}}" class="input" readonly>
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
                                                                            @elseif($integration->type == 'InfoBip')
                                                                            <p><b>View InfoBip Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>API KEY</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->api_key}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>API BASE URL</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" value="{{$integration->api_base_url}}" class="input" readonly>
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
                                                                            @elseif($integration->type == 'NigeriaBulkSms')
                                                                            <p><b>View NigeriaBulkSms Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Username</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->username}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Password</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->password}}" class="input" readonly>
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
                                                                            @elseif($integration->type == 'Multitexter')
                                                                            <p><b>View Multitexter Integrations</b></p>
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <label>Username</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->email}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Password</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->password}}" class="input" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>API-KEY</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input value="{{$integration->api_key}}" class="input" readonly>
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
                                                <div class="modal fade" id="Edit-Update-{{$integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <div class="form">
                                                                            @if($integration->type == 'Twilio')
                                                                            <p><b>Update Your Twilio Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>SID</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->sid}}" name="sid" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Token</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->token}}" name="token" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>From</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->from}}" name="from" class="input" required>
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
                                                                            @elseif($integration->type == 'InfoBip')
                                                                            <p><b>Update Your InfoBip Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>API KEY</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->api_key}}" name="api_key" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>API BASE URL</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->api_base_url}}" name="api_base_url" class="input" required>
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
                                                                            @elseif($integration->type == 'NigeriaBulkSms')
                                                                            <p><b>Update Your NigeriaBulkSms Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>Username</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->username}}" name="username" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Password</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->password}}" name="password" class="input" required>
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
                                                                            @elseif($integration->type == 'Multitexter')
                                                                            <p><b>Update Your Multitexter Integrations</b></p>
                                                                            <div class="row">
                                                                                <form method="POST" action="{{ route('user.integration.update', Crypt::encrypt($integration->id))}}">
                                                                                    @csrf
                                                                                    <div class="col-lg-12">
                                                                                        <label>Email</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="email" value="{{$integration->email}}" name="email" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Password</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->password}}" name="password" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>API KEY</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" value="{{$integration->api_key}}" name="api_key" class="input" required>
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
                                                <div class="modal fade" id="delete-{{$integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.integration.delete', Crypt::encrypt($integration->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete {{$integration->type}} integration.</p>
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
                                                                                                I understand this consquences, Delete Mailing List
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
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
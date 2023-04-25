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
                        <h4 class="mb-sm-0 font-size-18">Email Kits / Gateways</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Kits</li>
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
                                    <h4 class="font-500">Email Kits</h4>
                                    <p>
                                        All your Email Kits in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="{{ route('user.integration', ['username' => Auth::user()->username]) }}#email">
                                            <button>
                                                + Add Email Kits
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
                            <h4 class="card-title mb-4">View My Email Kits</h4>
                            <div class="table-responsive"> 
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Host</th>
                                            <th>Port</th>
                                            <th>Userrname</th>
                                            <th>Password</th>
                                            <th>Encryption</th>
                                            <th>From-Email</th>
                                            <th>From-Name</th>
                                            <th>Sent</th>
                                            <th>Bounced</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @forelse ($user_email_integrations as $user_email_integration)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $user_email_integration->type }}</td>
                                                <td>{{ $user_email_integration->host }}</td>
                                                <td>{{ $user_email_integration->port }}</td>
                                                <td>{{ $user_email_integration->username }}</td>
                                                <td>{{ '**********************' }}</td>
                                                <td>{{ $user_email_integration->encryption }}</td>
                                                <td>{{ $user_email_integration->from_email }}</td>
                                                <td>{{ $user_email_integration->from_name }}</td>
                                                <td>{{ $user_email_integration->sent }}</td>
                                                <td>{{ $user_email_integration->bounced }}</td>
                                                <td>{{ $user_email_integration->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$user_email_integration->id}}">Edit</a>
                                                            </li> 
                                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$user_email_integration->id}}">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="modal fade" id="edit-{{$user_email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                                                                        <input type="hidden" name="id" value="{{ $user_email_integration->id }}" class="input">
                                                                                        <div class="col-lg-12">
                                                                                            <label>Host</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$user_email_integration->type}} SMTP Host" name="host" class="input" value="{{$user_email_integration->host}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="col-lg-12">
                                                                                            <label>Username</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$user_email_integration->type}} SMTP Username" name="username" class="input" value="{{$user_email_integration->username}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Password</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$user_email_integration->type}} SMTP Password" name="password" class="input" value="{{$user_email_integration->password}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Port</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type=numbert" placeholder="Your {{$user_email_integration->type}} SMTP Port" name="port" class="input" value="{{$user_email_integration->port}}"> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Encryption</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$user_email_integration->type}} SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$user_email_integration->type}} SMTP MAIL FROM" name="from_email" class="input" value="{{$user_email_integration->from_email}}" required>
                                                                                                    <span style="color: green">Must be the verified domain on {{$user_email_integration->type}}</span>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM-NAME</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your Brand Name" name="from_name" class="input" value="{{$user_email_integration->from_name}}" required>
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

                                                    <div class="modal fade" id="delete-{{$user_email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                                                                            <p>This action cannot be undone. This will permanently delete <br> <b>{{$user_email_integration->host}} ({{$user_email_integration->type}})</b>.</p>
                                                                                            <label>Please type DELETE to confirm.</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" name="delete" class="input" required>
                                                                                                    <input type="hidden" name="id" value="{{ $user_email_integration->id }}" class="input">
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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Admin Email Kits</h4>
                            <div class="table-responsive"> 
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Host</th>
                                            <th>Port</th>
                                            <th>Userrname</th>
                                            <th>Password</th>
                                            <th>Encryption</th>
                                            <th>From-Email</th>
                                            <th>From-Name</th>
                                            <th>Sent</th>
                                            <th>Bounced</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        @forelse ($admin_email_integrations as $admin_email_integration)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $admin_email_integration->type }}</td>
                                                <td>{{ $admin_email_integration->host }}</td>
                                                <td>{{ $admin_email_integration->port }}</td>
                                                <td>{{ '**********************' }}</td>
                                                <td>{{ '**********************' }}</td>
                                                <td>{{ $admin_email_integration->encryption }}</td>
                                                <td>{{ $admin_email_integration->from_email }}</td>
                                                <td>{{ $admin_email_integration->from_name }}</td>
                                                <td>{{ $admin_email_integration->sent }}</td>
                                                <td>{{ $admin_email_integration->bounced }}</td>
                                                <td>{{ $admin_email_integration->created_at->toDayDateTimeString() }}</td> 
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
</div>
@endsection
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
                        <h4 class="mb-sm-0 font-size-18">Email Kits / Gateways</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
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
                                        <a href="#add">
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
                            <h4 class="card-title mb-4">View Email Kits</h4>
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
                                        @forelse ($admin_email_integrations as $admin_email_integration)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $admin_email_integration->type }}</td>
                                                <td>{{ $admin_email_integration->host }}</td>
                                                <td>{{ $admin_email_integration->port }}</td>
                                                <td>{{ $admin_email_integration->username }}</td>
                                                <td>{{ '**********************' }}</td>
                                                <td>{{ $admin_email_integration->encryption }}</td>
                                                <td>{{ $admin_email_integration->from_email }}</td>
                                                <td>{{ $admin_email_integration->from_name }}</td>
                                                <td>{{ $admin_email_integration->replyto_email }}</td>
                                                <td>{{ $admin_email_integration->replyto_name }}</td>
                                                <td>{{ $admin_email_integration->sent }}</td>
                                                <td>{{ $admin_email_integration->bounced }}</td>
                                                <td>
                                                    @if ($admin_email_integration->master)
                                                        {{ 'Yes' }}
                                                    @else
                                                        {{ 'No' }}
                                                    @endif
                                                </td>
                                                <td>{{ $admin_email_integration->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$admin_email_integration->id}}">Edit</a>
                                                            </li> 
                                                            <li>
                                                                <a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#master-{{$admin_email_integration->id}}">Make Master</a>
                                                            </li> 
                                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$admin_email_integration->id}}">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="modal fade" id="master-{{$admin_email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.integration.email.admin_master') }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Email Kit Master</b></p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <p>You are about to make this kit <b>({{$admin_email_integration->host}})</b><br>your master kit. Are you sure to continue?.</p> 
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4"> 
                                                                                                    <input type="hidden" name="id" value="{{ $admin_email_integration->id }}" class="input">
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

                                                    <div class="modal fade" id="edit-{{$admin_email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.integration.email.admin_update') }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Update Email Kit</b></p>
                                                                                    <div class="row">
                                                                                        <input type="hidden" name="id" value="{{ $admin_email_integration->id }}" class="input">
                                                                                        <div class="col-lg-12">
                                                                                            <label>Host</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$admin_email_integration->type}} SMTP Host" name="host" class="input" value="{{$admin_email_integration->host}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> 
                                                                                        <div class="col-lg-12">
                                                                                            <label>Username</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$admin_email_integration->type}} SMTP Username" name="username" class="input" value="{{$admin_email_integration->username}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Password</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$admin_email_integration->type}} SMTP Password" name="password" class="input" value="{{$admin_email_integration->password}}" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Port</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type=numbert" placeholder="Your {{$admin_email_integration->type}} SMTP Port" name="port" class="input" value="{{$admin_email_integration->port}}"> 
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Encryption</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$admin_email_integration->type}} SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your {{$admin_email_integration->type}} SMTP MAIL FROM" name="from_email" class="input" value="{{$admin_email_integration->from_email}}" required>
                                                                                                    <span style="color: green">Must be the verified domain on {{$admin_email_integration->type}}</span>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Mail FROM-NAME</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Your Brand Name" name="from_name" class="input" value="{{$admin_email_integration->from_name}}" required>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div> 
                                                                                        <div class="col-lg-12">
                                                                                            <label>Reply-TO Email</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="{{$admin_email_integration->replyto_email}}" required>
                                                                                                </div>
                                                                                            </div> 
                                                                                        </div>
                                                                                        <div class="col-lg-12">
                                                                                            <label>Reply-TO Name</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="{{$admin_email_integration->replyto_name}}" required>
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

                                                    <div class="modal fade" id="delete-{{$admin_email_integration->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.integration.email.admin_delete') }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Delete Email Kit</b></p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <p>This action cannot be undone. This will permanently delete <br> <b>{{$admin_email_integration->host}} ({{$admin_email_integration->type}})</b>.</p>
                                                                                            <label>Please type DELETE to confirm.</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" name="delete" class="input" required>
                                                                                                    <input type="hidden" name="id" value="{{ $admin_email_integration->id }}" class="input">
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
            <div class="Edit" id="add">
                <div class="form">
                    <div class="row">
                        <p class="tell mb-4">
                            <b>
                                Email Gateways - Your integration starter kit
                            </b>
                        </p>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="circle">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076174/OjaFunnel-Images/download_2_ynzs6z.jpg" draggable="false" alt="">
                                        <span class="text-dark">AWS SES</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailAWS">
                                        <input type="radio" name="sms_gateways" value="EmailAWS">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="circle">
                                        <img src="{{URL::asset('assets/images/sendgrid.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                        <span class="text-dark">SendGrid</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendgrid">
                                        <input type="radio"  name="sms_gateways" value="EmailSendgrid">
                                    </div>
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="circle">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668075784/OjaFunnel-Images/images_fwr3hr.jpg" draggable="false" alt="">
                                        <span class="text-dark">Mandrill</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#InfoBip">
                                        <input type="radio" name="sms_gateways" value="InfoBip">
                                    </div>
                                </div> --}}
                                <div class="col-md-4">
                                    <div class="circle">
                                        <img src="{{URL::asset('assets/images/sendinblue.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                        <span class="text-dark">Sendinblue</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendinblue">
                                        <input type="radio" name="sms_gateways" value="EmailSendinblue">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="circle">
                                        <img src="{{URL::asset('assets/images/sendpulse.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                        <span class="text-dark">SendPulse</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendPulse">
                                        <input type="radio" name="sms_gateways" value="EmailSendPulse">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="circle"> 
                                        <img src="{{URL::asset('assets/images/mailjet.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                        <span class="text-dark">Mailjet</span>
                                    </div>
                                    <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailMailjet">
                                        <input type="radio" name="sms_gateways" value="EmailMailjet">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Emails modal -->
<div class="modal fade" id="EmailAWS" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your AWS SES integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.admin_create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typnumberext" placeholder="Your AWS SES SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on AWS SES</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-lg-12">
                                    <label>Reply-TO Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Reply-TO Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" name="type" value="AWS SES" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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

<div class="modal fade" id="EmailSendgrid" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your SendGrid integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.admin_create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typenumberxt" placeholder="Your SendGrid SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on SendGrid</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-lg-12">
                                    <label>Reply-TO Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Reply-TO Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" name="type" value="Sendgrid" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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

<div class="modal fade" id="EmailSendinblue" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Sendinblue integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.admin_create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="Your Sendinblue SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on Sendinblue</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-lg-12">
                                    <label>Reply-TO Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Reply-TO Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" name="type" value="Sendinblue" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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

<div class="modal fade" id="EmailSendPulse" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your SendPulse integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.admin_create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type=numbert" placeholder="Your SendPulse SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on SendPulse</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-lg-12">
                                    <label>Reply-TO Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Reply-TO Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" name="type" value="SendPulse" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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

<div class="modal fade" id="EmailMailjet" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Mailjet integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.admin_create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typnumberext" placeholder="Your Mailjet SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on Mailjet</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                 <div class="col-lg-12">
                                    <label>Reply-TO Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Replyto email" name="replyto_email" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Reply-TO Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Replyto name" name="replyto_name" class="input" value="" required>
                                        </div>
                                    </div> 
                                </div>
                                <input type="hidden" name="type" value="Mailjet" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
                                        </button>
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
@endsection
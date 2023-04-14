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
                                        <a href="">
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
                                            <th>Sent</th>
                                            <th>Bounced</th>
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
                                                <td>{{ $admin_email_integration->sent }}</td>
                                                <td>{{ $admin_email_integration->bounced }}</td>
                                                <td>{{ $admin_email_integration->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    ...
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
</div>
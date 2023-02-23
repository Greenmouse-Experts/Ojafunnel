@extends('layouts.admin-frontend')

@section('page-content')
@php
    $admin = auth()->guard('admin')->user();
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Bounce handlers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Bounce Handlers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                        <div class="py-2">
                            <h4 class="font-400">Bounce handlers</h4>
                            <p>
                            Bounce/feedback handler is a mailbox used for receiving bounced messages or spam/abuse feedback. The application checks the mailbox to keep track of email delivery issue.
                            </p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head" style="padding-top: 25px;">
                        <div class="all-create py-2">
                            <a href="{{route('new.bounce')}}">
                                <button>+ New Bounce Handler </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Sending List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Hostname</th>
                                            <th scope="col">Port</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Protocol</th>
                                            <th scope="col">Encryption</th>
                                        </tr>
                                    </thead>
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

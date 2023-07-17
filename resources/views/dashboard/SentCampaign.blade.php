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
                <div class="col-lg-12">
                    <div class="card begin account-head mb-4">
                        <div class="">
                            <h4 class="font-500">WhatsApp Automation</h4>
                            <p>
                                Send instant, scheduled or automated messages to your contact
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-tabs-custom">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.whatsapp.automation', Auth::user()->username)}}">New Campaign</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Recieved Messages</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">Sent Campaigns</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Auto Reply</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('user.sent.campaigns', Auth::user()->username)}}">View Broadcast </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Campaign(s)</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Campaign Name </th>
                                            <th>Date Sent </th>
                                            <th>SMS Sent </th>
                                            <th>Delivered</th>
                                            <th>Not Delivered</th>
                                            <th>Unsubscribed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="7">No Campaign Added Yet.</td>
                                        </tr>
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

<!-- END layout-wrapper -->
@endsection

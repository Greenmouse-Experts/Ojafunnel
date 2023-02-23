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
                        <h4 class="mb-sm-0 font-size-18">Email verification servers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Email verification servers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Email Verification Server</h4>
                            <p>
                            This feature allows you to connect to 3rd email verification servers. you can go to the Mail List's setting page to manage verification processes
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card account-head" style="padding-top: 25px;">
                        <div class="all-create py-2">
                            <a href="{{route('create.new')}}">
                                <button>+ Create New  </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Email List</h4>
                            <div class="table-responsive">
                            <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Service type</th>
                                            <th scope="col">Limit value </th>
                                            <th scope="col">Limit base</th>
                                            <th scope="col">Limit time unit</th>
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

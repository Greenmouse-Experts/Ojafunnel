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
                        <h4 class="mb-sm-0 font-size-18">Import</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Backlist Log</li>
                                <li class="breadcrumb-item active">Import</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Upload your email blacklist</h4>
                            <p>
                            Upload known invalid email addresses to the application's master blacklist. Any email address in your customer' lists which matches a blacklisted one shall automatically be marked as `blacklisted`
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Import to Complete</h4>
                            <div class="Editt">
                                <form enctype="multipart/form-data">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <label for="Name">Upload</label>
                                                <input type="file" required />
                                            </div>

                                            <div class="text-end mt-3">
                                                <a href="#" class="text-decoration-none">
                                                    <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                        Import
                                                    </button>
                                                </a>
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
    </div>
</div>
@endsection

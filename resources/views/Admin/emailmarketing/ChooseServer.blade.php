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
                        <h4 class="mb-sm-0 font-size-18">New server</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Sending server</li>
                                <li class="breadcrumb-item active">Sending Type</li>
                                <li class="breadcrumb-item active">New server</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">New server</h4>
                            <p>
                                Obtain your Amazon SMTP settings and fill in the form below to get connected
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Fill in the form</h4>
                            <div class="Editt">
                                <form enctype="multipart/form-data">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">AWS region</label>
                                                <select name="" id="">
                                                    <option value="">Choose</option>
                                                    <option value="">US East (N. Virginia)</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Hostname</label>
                                                <input type="text" name="image" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">AWS access key</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">AWS secret</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">SMTP username</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">SMTP password</label>
                                                <input type="password" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">SMTP port</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Encryption method</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="text-end mt-3">
                                                <a href="#" class="text-decoration-none">
                                                    <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                        Save
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

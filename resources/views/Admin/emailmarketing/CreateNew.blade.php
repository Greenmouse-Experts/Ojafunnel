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
                        <h4 class="mb-sm-0 font-size-18">Create New</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Verification</li>
                                <li class="breadcrumb-item active">Create New</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Create New</h4>
                            <p>
                                Fill in the form to create New Bounce Handler
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Fill in the form to complete email verification server</h4>
                            <div class="Editt">
                                <form enctype="multipart/form-data">
                                    <div class="form">
                                        <div class="row">
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Name</label>
                                                <input type="text" name="image" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Service type</label>
                                                <select name="" id="">
                                                    <option value="">Choose</option>
                                                    <option value="">Emailable (recommended)</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">API key</label>
                                                <input type="text" required />
                                            </div>
                                            <h4 class="card-title">Checking limit</h4>
                                            <p>The configuration setting below allows you to set a limit on email verification speed. For example, to limit verification speed to 2,000 emails every 5 minutes, you can set Limit value = 2000, Limit base = 5, and Limit unit = minute accordingly</p>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Limit value</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Limit Base</label>
                                                <input type="text" required />
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <label for="Name">Limit time unit</label>
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

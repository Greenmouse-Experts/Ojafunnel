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
                        <h4 class="mb-sm-0 font-size-18">Blacklist</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Blacklist</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Blacklist</h4>
                            <p>
                                This feature allows you to Upload your email blacklist
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card account-head" style="padding-top: 25px;">
                        <div class="all-create py-2">
                            <a href="{{route('import.backlist')}}">
                                <button><i class="bi bi-upload"></i> Click To Import  </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View BlackList</h4>
                            <div class="padi">
                                <div class="text-center"><i class="bi bi-x-octagon"></i></div>
                                <p class="card-title text-center">Blacklist is empty!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

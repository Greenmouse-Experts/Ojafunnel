@extends('layouts.admin-frontend')

@section('page-content')

@php
    $user = $customer->user;
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
                        <h4 class="mb-sm-0 font-size-18">{{$user->username}} Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">{{$user->username}} Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">{{$user->username}} Details</h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Overview User</h4>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                    <span class="d-none d-sm-block">User Details</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                    <span class="d-none d-sm-block">LMS</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                    <span class="d-none d-sm-block">E-commerce</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                    <span class="d-none d-sm-block">Affiliate Marketing</span>
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="home1" role="tabpanel">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex align-start mb-3">
                                                    <div class="flex-grow-1">
                                                        <span class="badge badge-soft-success">Active</span>
                                                    </div>
                                                </div>
                                                <div class="text-center mb-3">
                                                    @if($user->photo)
                                                    <img class="avatar-sm rounded-circle" src="{{$user->photo}}" alt="{{$user->first_name}}" width="100%">
                                                    @else
                                                    <img  class="avatar-sm rounded-circle" src="{{URL::asset('dash/assets/image/no-img.jpg')}}" alt="" width="100%" />
                                                    @endif
                                                    <h6 class="font-size-15 mt-3 mb-1">{{$user->first_name}} {{$user->last_name}}</h6>
                                                    <p class="mb-0 text-muted">{{$user->email}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title mb-4">User Personal Information</h4>
                                                <div class="table-responsive">
                                                    <table class="table table-nowrap mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">First Name :</th>
                                                                <td>{{$user->first_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Last Name :</th>
                                                                <td>{{$user->last_name}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Username:</th>
                                                                <td>{{$user->username}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">E-mail :</th>
                                                                <td>{{$user->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Mobile :</th>
                                                                <td>{{$user->phone_number}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Referral Code :</th>
                                                                <td>{{$user->affiliate_link}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">Subscribers:</th>
                                                                <td>{{$user->planName($user->plan)}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="profile1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead class="tread">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Course Name</th>
                                                                <th>Course Category</th>
                                                                <th>Status</th>
                                                                <th>Date Created</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead class="tread">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Store Name</th>
                                                                <th>Number of Product</th>
                                                                <th>Sales</th>
                                                                <th>Store Link</th>
                                                                <th>Date Created</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->store as $item)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$item->name}}</td>
                                                                    <td>{{$item->product->count()}}</td>
                                                                    <td>{{$item->order->count()}}</td>
                                                                    <td>{{$item->link}}</td>
                                                                    <td>{{$item->created_at->format('D d M, Y')}}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings1" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                        <thead class="tread">
                                                            <tr>
                                                                <th>S/N</th>
                                                                <th>Affiliate Type</th>
                                                                <th>Names of Referral</th>
                                                                <th>Level</th>
                                                                <th>Commission</th>
                                                                <th>Joined Created</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

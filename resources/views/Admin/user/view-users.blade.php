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
                        <h4 class="mb-sm-0 font-size-18">All Users</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">All Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">View Users</h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">View Users</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>User Name </th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin->getAllCustomerLists() as $item)
                                            <tr>

                                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                                <td>{{$item->user->first_name}} {{$item->user->last_name}}</td>
                                                <td>
                                                    {{$item->user->email}}
                                                </td>
                                                <td>
                                                    {{$item->user->phone_number}}
                                                </td>
                                                <td>
                                                    @if ($item->status == 'active')
                                                        <span class="badge badge-pill badge-soft-success font-size-11">{{ trans('messages.user_status_' . $item->status) }}</span>
                                                    @endif

                                                    @if ($item->status == 'inactive')
                                                        <span class="badge badge-pill badge-soft-danger font-size-11">Banned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$item->user->created_at->format('d M, Y')}}
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                            <a href="{{route('users.details', $item->uid)}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                        </li>
                                                        @if ($item->status == 'inactive')
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                <a href="{{ route('enabled.user', ["uids" => $item->uid]) }}" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                            </li>
                                                        @endif
                                                        @if ($item->status == 'active')
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                <a href="{{ route('disable.user', ["uids" => $item->uid]) }}" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </td>

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
    </div>
</div>
@endsection

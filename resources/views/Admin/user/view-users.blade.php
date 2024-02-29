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
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="py-2">
                                    <h4 class="font-500">View Users</h4>
                                    <p>Connect the tools that power your business</p>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="mt-lg-4">
                                    <button data-bs-toggle="modal" data-bs-target="#add_users" class="btn btn-primary d-block">Add Users</button>
                                </div>
                            </div>
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
                                <table id="datatable-buttons" class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>User Name </th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Naira Wallet</th>
                                            <th>Dollar Wallet</th>
                                            <th>Priviledges</th>
                                            <th>Status</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_users as $user)
                                            @if($user->user_type == 'User')
                                            <tr>
                                                <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                                <td>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    {{ $user->phone_number != null ? $user->phone_number : "Not Specified"}}
                                                </td>
                                                <td>₦{{number_format($user->wallet, 2)}}</td>
                                                <td>${{number_format($user->dollar_wallet, 2)}}</td>
                                                <td>
                                                    @if(count($user->fts) > 0)
                                                        @php $fts1=""; @endphp
                                                        @foreach($user->fts as $fts)
                                                            @php $fts1 .= $fts->features.", "; @endphp
                                                        @endforeach
                                                        <div style="font-size:12px;line-height:16px;margin-bottom:5px">{{ substr($fts1,0,-2) }} <div style="color:red">features are disabled</div></div>
                                                    @endif
                                                    <div><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#assign_prv" class="assign_prv" user_id="{{ $user->id }}" user_name="{{ucwords($user->first_name.' '.$user->last_name)}}" style="font-size:12px;">Click to assign</a></div>
                                                </td>

                                                <td>
                                                    @if ($user->status == 'active')
                                                        <span class="badge badge-pill badge-soft-success font-size-11">{{ trans('messages.user_status_' . $user->status) }}</span>
                                                    @endif

                                                    @if ($user->status == 'inactive')
                                                        <span class="badge badge-pill badge-soft-danger font-size-11">Banned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$user->created_at->format('d M, Y')}}
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="Access User">
                                                            <a href="{{route('admin.user.login', $user->id)}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-login"></i></a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View User">
                                                            <!-- <a href="page/view_users/users-details/8383" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a> -->
                                                            <a href="{{ route('users.details', ['id' => $user->id]) }}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                        </li>
                                                        @if ($user->status == 'inactive')
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                                <a href="{{ route('enabled.user', ['uids' => $user->id]) }}" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                            </li>
                                                        @endif
                                                        @if ($user->status == 'active')
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                                <a href="{{ route('disable.user', ['uids' => $user->id]) }}" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endif
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



<div class="modal fade" id="add_users" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" class="form_add_users">
                            {{ csrf_field() }}
                            <div class="form">
                                <p class="mt-n4"><b>New New Users</b></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>User Full Names</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter user full names" name="fullname" class="input" required style="text-transform:capitalize">

                                                <input type="hidden" name="timezone" value="bbbbb">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>User Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter user email address" name="email" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>User Password</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="password" placeholder="Suggest a password for user" name="password" class="input" required>
                                                <div style="font-size:12px">Users can later change their passwords</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="button" class="addUsers">Add Users</button>
                                        </div>
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


<div class="modal fade" id="assign_prv" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" class="form_add_priv">
                            {{ csrf_field() }}
                            <div class="form">
                                <p class="mt-n4"><b class="assign_name"></b></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Enable / Disable Priviledge</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="user_privd_data"></div>
                                                <input type="hidden" name="user_id" class="user_id">
                                                <div style="margin-top:5px;font-size:12px">Hold ctrl to select multiple</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="button" class="saveUpdate">Save Update</button>
                                        </div>
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

@endsection

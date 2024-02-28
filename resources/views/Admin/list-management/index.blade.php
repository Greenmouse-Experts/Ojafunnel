@extends('layouts.admin-frontend')
@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">List Management</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">List Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">List Management</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Lists</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>User</th>
                                            <th>Name</th>
                                            <th>Display Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\ListManagement::latest()->get() as $key => $list)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{App\Models\User::find($list->user_id)->first_name}} {{App\Models\User::find($list->user_id)->last_name}}
                                                <p class='text-bold-600'> {{App\Models\User::find($list->user_id)->email}} </p>
                                            </td>
                                            <td>
                                                <p class='text-bold-600'> {{$list->name}} </p>
                                            </td>
                                            <td>
                                                {{$list->display_name}}
                                            </td>
                                            <td>
                                                {{ $list->slug }}
                                            </td>
                                            <td>
                                                <p class='text-bold-600'>{{ $list->description }}</p>
                                            </td>
                                            <td>{{App\Models\ListManagementContact::where('list_management_id', $list->id)->get()->count()}} Contact</td>
                                            <td>
                                                @if($list->status == true)
                                                <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger font-size-11">In-active</span>
                                                @endif
                                            </td>
                                            <td>{{ $list->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('admin.view.user.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">View</a></li>
                                                        <li><a class="dropdown-item" href="{{route('admin.edit.user.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">Edit</a></li>
                                                        @if($list->status == true)
                                                        <li><a class="dropdown-item" href="{{route('admin.user.disable.list', Crypt::encrypt($list->id))}}">Disactivate</a></li>
                                                        @else
                                                        <li><a class="dropdown-item" href="{{route('admin.user.enable.list', Crypt::encrypt($list->id))}}">Activate</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$list->id}}">Delete</a></li>
                                                    </ul>
                                                </div>

                                                 <!-- Modal START -->
                                                 <div class="modal fade" id="delete-{{$list->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('admin.user.delete.list', Crypt::encrypt($list->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete List</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. </p> <p>This will permanently delete this list and all contact attached to it.</p>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                I understand this consquences, Delete List
                                                                                            </button>
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
                                                <!-- end modal -->
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

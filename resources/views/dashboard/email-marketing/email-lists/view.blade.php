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
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{$mail_list->name}} List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">View list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="py-2">
                                    <h4>{{$mail_list->name}} List</h4>
                                    <p>
                                        View list
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="{{ route('user.email.marketing.create.list', ['username' => Auth::user()->username]) }}">
                                            <button>
                                                + Import Contact To List
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="{{route('user.email.edit.list', Crypt::encrypt($mail_list->id))}}">
                                            <button>
                                                Edit List
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-lg-12 mb-4">
                                    <label class="text-weight-500" for="">List Name</label>
                                    <input type="text" class="form-control"  value="{{$mail_list->name ?? ''}}" placeholder="Enter list name" readonly />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label class="text-weight-500" for="">Display Name</label>
                                    <input type="text" class="form-control" value="{{$mail_list->display_name}}" placeholder="Enter display name" readonly />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label class="text-weight-500" for="">URL Slug</label>
                                    <input type="text" class="form-control" value="{{$mail_list->slug}}" placeholder="Enter url slug" readonly />
                                </div>
                            </div>
                            <div class="col-md-6" style="border-left: 1px solid gainsboro; padding: 50px;">
                                <div class="col-lg-12 mb-4">
                                    <label class="text-weight-500" for="">Description</label>
                                    <textarea type="text" class="form-control" value="{{$mail_list->description}}" placeholder="Enter description" readonly>{{$mail_list->description}}</textarea>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label class="text-weight-500" for="">Status</label>
                                    @if($mail_list->status == true)
                                    <p class="badge badge-pill badge-soft-success font-size-11">Active</p>
                                    @else
                                    <p class="badge badge-pill badge-soft-danger font-size-11">In-active</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Contacts</h4>
                            <div class="table-responsive"> 
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Display Name</th> 
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        @foreach(App\Models\MailList::latest()->where('user_id', Auth::user()->id)->get() as $key => $list)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
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
                                            <td>
                                                @if($list->status == true)
                                                <span class="badge badge-pill badge-soft-success font-size-11">Active</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger font-size-11">In-active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.email.view.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">View</a></li>
                                                        <li><a class="dropdown-item" href="{{route('user.email.edit.list', Crypt::encrypt($list->id))}}" style="cursor: pointer;">Edit</a></li>
                                                        @if($list->status == true)
                                                        <li><a class="dropdown-item" href="{{route('user.email.disable.list', Crypt::encrypt($list->id))}}">Disactivate</a></li>
                                                        @else
                                                        <li><a class="dropdown-item" href="{{route('user.email.enable.list', Crypt::encrypt($list->id))}}">Activate</a></li>
                                                        @endif
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$list->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
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

@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">{{$list->name}} List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">View list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-9">
                            <div class="py-2">
                                <h4>{{$list->name}} List</h4>
                                <p>
                                    View list
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="">
                                <div class="all-create">
                                    <a href="{{route('admin.user.list')}}">
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-lg-12 mb-4">
                                        <label class="text-weight-500" for="">List Name</label>
                                        <input type="text" class="form-control"  value="{{$list->name ?? ''}}" placeholder="Enter list name" readonly />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label class="text-weight-500" for="">Display Name</label>
                                        <input type="text" class="form-control" value="{{$list->display_name}}" placeholder="Enter display name" readonly />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label class="text-weight-500" for="">URL Slug</label>
                                        <input type="text" class="form-control" value="{{$list->slug}}" placeholder="Enter url slug" readonly />
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-left: 1px solid gainsboro; padding: 50px;">
                                    <div class="col-lg-12 mb-4">
                                        <label class="text-weight-500" for="">Description</label>
                                        <textarea type="text" class="form-control" value="{{$list->description}}" placeholder="Enter description" readonly>{{$list->description}}</textarea>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label class="text-weight-500" for="">Status</label>
                                        @if($list->status == true)
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
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th>Tags</th>
                                            <th>Joined Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\ListManagementContact::latest()->where('list_management_id', $list->id)->get() as $key => $contact)
                                        <tr>
                                            <td scope="row">{{$loop->iteration}}</td>
                                            <td>
                                                <p class='text-bold-600'> {{$contact->name}}</p>
                                            </td>
                                            <td>
                                                {{$contact->email}}
                                            </td>
                                            <td>
                                                {{ $contact->address_1 }}, {{ $contact->state }}, {{ $contact->country }}
                                            </td>
                                            <td>
                                                @if($contact->subscribe == true)
                                                <span class="badge badge-pill badge-soft-success font-size-11">Subscribed</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger font-size-11">Unsubscribed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(count($tags1['tags']) > 0)
                                                    @foreach($tags1['tags'] as $tag)
                                                        <p class='text-bold-600' style="display:inline"><label style="background:#999;border-radius:30px;padding:1px 7px;color:#fff;font-size:12px;">{{ $tag }}</label></p>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $contact->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('admin.user.edit.contact', Crypt::encrypt($contact->id))}}" style="cursor: pointer;">View/Edit</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$contact->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$contact->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('admin.user.delete.contact', Crypt::encrypt($contact->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. </p> <p>This will permanently delete this contact.</p>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                I understand this consquences, Delete Contact
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

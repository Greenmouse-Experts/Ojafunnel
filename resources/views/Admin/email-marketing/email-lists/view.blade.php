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
                        <h4 class="mb-sm-0 font-size-18">View {{$mail_list->name}} Lists</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Lists</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">{{$mail_list->name}} Email Lists</h4>
                                    <p>
                                        {{$mail_list->name}}
                                    </p>
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
                                            <th>Email</th> 
                                            <th>Address</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        @foreach(App\Models\MailContact::latest()->where('mail_list_id', $mail_list->id)->get() as $key => $contact)
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
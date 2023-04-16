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
                                <li class="breadcrumb-item active">Edit list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4>{{$mail_list->name}} List</h4>
                                    <p>
                                        Edit list
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
                        <form method="post" action="{{ route('user.email.update.list', Crypt::encrypt($mail_list->id)) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-lg-12 mb-4">
                                        <label for="">List Name</label>
                                        <p class="text-xs text-gray-500">
                                            The name used for your own reference.
                                        </p>
                                        <input type="text" name="name" class="form-control"  value="{{$mail_list->name ?? ''}}" placeholder="Enter list name" required />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="">Display Name</label>
                                        <p class="text-xs text-gray-500">
                                            The name that will be shown to contacts.
                                        </p>
                                        <input type="text" name="display_name" class="form-control" value="{{$mail_list->display_name}}" placeholder="Enter display name" required />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="">URL Slug</label>
                                        <p class="text-xs text-gray-500">
                                            Used in the URLs for templates.
                                            If this is left empty the URL slug will be automatically generated from the display name.
                                        </p>
                                        <input type="text" name="slug" class="form-control" value="{{$mail_list->slug}}" placeholder="Enter url slug" required />
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-left: 1px solid gainsboro; padding: 50px;">
                                    <div class="col-lg-12 mb-4">
                                        <label for="">Description</label>
                                        <p class="text-xs text-gray-500">
                                            This will be shown to contacts to describe what kind of content
                                            they will receive.
                                        </p>
                                        <textarea type="text" name="description" class="form-control" value="{{$mail_list->description}}" placeholder="Enter description" required>{{$mail_list->description}}</textarea>
                                    </div>
                                    <div class="text-end mt-2">
                                        <a href="{{route('user.email-marketing.email.lists', Auth::user()->username)}}">
                                            <button type="button" class="btn px-4 py-1 btn-danger">
                                                Cancel
                                            </button>
                                        </a>
                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Update
                                        </button>
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

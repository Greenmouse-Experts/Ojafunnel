@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row card begin">
                    <div class="col-12 account-head">
                        <div class="row py-3 justify-content-between align-items-center">
                            <div class="col-md-8">
                                <h4 class="font-60">Choose A Template</h4>
                                <p>
                                    Pick a ready made template to begin building your pages
                                </p>
                            </div>
                        </div>
                        <div class="d-flex account-nav">
                            <ul class="list-unstyled d-flex justify-content-between w-100">
                                <li class="active">All</li>
                            </ul>
                        </div>
                        <div class="acc-border temp-border"></div>
                    </div>
                </div>
                <!-- store data information-->

                <div class="row">
                    <div class="col-md-3">
                        <div class="pageXX pageAdd">
                            <div class="small-circle">
                                <a data-bs-toggle="modal" data-bs-target="#template" class="text-white text-decoration-none" style="cursor: pointer;">
                                    <h5 class="pt-2">
                                        +
                                    </h5>
                                </a>
                            </div>
                            <div class="text-center mt-3 text-purp">
                                <h5>Blank Template</h5>
                            </div>
                        </div>
                    </div>
                    @foreach($pages as $page)
                    <div class="col-md-3">
                        <a href="{{route('user.page.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}" class="text-white text-decoration-none">
                            <div class="pageX" style="color:#000 !important;">
                                <div class="page-top" style="background-image: url({{$page->thumbnail}});"></div>
                                <div class="p-3 text-dark">
                                    @if($page->title)
                                    <p>{{$page->title}}</p>
                                    @else
                                    <p>Title</p>
                                    @endif
                                    <h6>{{$page->name}}</h6>
                                    <div class="list">
                                        <ul class="list-unstyled hstack gap-3 mb-0">
                                            <li title="Edit">
                                                <a data-bs-toggle="modal" data-bs-target="#Editing-{{$page->id}}" class="btn btn-sm btn-soft-info"><i class="mdi mdi-pencil-outline"></i></a>
                                            </li>
                                            <li title="Delete">
                                                <a data-bs-toggle="modal" data-bs-target="#Delete-{{$page->id}}" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Edit Input modal -->
                                    <div class="modal fade" id="Editing-{{$page->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header border-bottom-0">
                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                        Page Manager
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="Edit-level">
                                                            <form method="POST" action="{{ route('user.page.builder.update', Crypt::encrypt($page->id))}}" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form">
                                                                    <div class="col-lg-12">
                                                                        <label>Title</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-4">
                                                                                <input type="text" name="title" class="input" value="{{$page->title}}">
                                                                            </div>
                                                                        </div>
                                                                        <label>Page Name</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-4">
                                                                                <input type="text" name="name" class="input" value="{{preg_replace('/\\.[^.\\s]{3,4}$/', '', $page->name)}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <label>Add Thumbnail</label>
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-4">
                                                                                    <input type="file" name="thumbnail" class="input">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row justify-content-between">
                                                                            <div class="col-6">
                                                                                <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                    Cancel
                                                                                </button>
                                                                            </div>
                                                                            <div class="col-6 text-end">
                                                                                <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                                        <!--Edit Input end modal -->
                                    </div>
                                    <!-- Modal START -->
                                    <div class="modal fade" id="Delete-{{$page->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content pb-3">
                                                <div class="modal-header border-bottom-0">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <div class="row">
                                                        <div class="Editt">
                                                            <form method="POST" action="{{ route('user.page.builder.delete', Crypt::encrypt($page->id))}}">
                                                                @csrf
                                                                <div class="form">
                                                                    <p><b>Delete Contact</b></p>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <p>This action cannot be undone. This will permanently delete {{$page->name}} page.</p>
                                                                            <label>Please type DELETE to confirm.</label>
                                                                            <div class="row">
                                                                                <div class="col-md-12 mb-4">
                                                                                    <input type="text" name="delete_field" class="input" required>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-12 mb-4">
                                                                            <div class="boding">
                                                                                <button type="submit" class="form-btn">
                                                                                    I understand this consquences, Delete this page.
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
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- end page title -->
            </div>
        </div>
    </div>
<!-- END layout-wrapper -->


<!-- Modal START -->
<div class="modal fade" id="template" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('user.page.builder.create')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Page
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label> Title </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Title" name="title" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>File Folder</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="File Folder" name="file_folder" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>File Name </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="File Name" name="file_name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
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
@endsection
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
                            <div class="col text-end">
                                <select name="pageTemp" id="" class="px-3 py-2 bg-light rounded">
                                    <option value="top" disabled selected value>
                                        Select a category
                                    </option>
                                    <option value="tempOne">Option 1</option>
                                    <option value="tempTwo">Option 2</option>
                                </select>
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
                                <a href="{{route('user.page.builder.create')}}" class="text-white text-decoration-none">
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
                        <a href="{{route('user.page.builder.view.editor', [Auth::user()->username, $page->id])}}" class="text-white text-decoration-none">
                            <div class="pageX" style="color:#000 !important;">
                                <div class="page-top" style="background-image: url({{$page->thumbnail}});"></div>
                                <div class="p-3 text-dark">
                                    <h6>{{$page->name}}</h6>
                                    @if($page->title)
                                    <p>{{$page->title}}</p>
                                    @else
                                    <p>Title</p>
                                    @endif
                                    <div class="list">
                                        <ul class="list-unstyled hstack gap-3 mb-0">
                                            <li title="Contact">
                                                <a data-bs-toggle="modal" data-bs-target="#forming" class="btn btn-sm btn-soft-success"><i class="bi bi-person-circle"></i></a>
                                            </li>
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
                                                                        <label>Page Name</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-4">
                                                                                <input type="text" placeholder="Your Page Name" name="name" class="input" value="{{$page->name}}">
                                                                            </div>
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
                                                                    <div class="col-lg-12">
                                                                        <label>Title</label>
                                                                        <div class="row">
                                                                            <div class="col-md-12 mb-4">
                                                                                <textarea cols="5" rows="10" valu="{{$page->title}}" name="title">{{$page->title}}</textarea>
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
                                                                                    I understand this consquences, Delete Mailing List
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
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <!-- end page title -->
            </div>
        </div>
    </div>
<!-- END layout-wrapper -->

<!-- forming modal -->
<div class="modal fade" id="forming" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Fill all information below
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>First Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your First Name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Last Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Last Name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Your Email" name="email" class="input" required>
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
                                            Save
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
<!--forming end modal -->
@endsection
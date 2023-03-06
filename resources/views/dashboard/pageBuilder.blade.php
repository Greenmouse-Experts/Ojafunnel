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
            <div class="page-contentts">
                <div class="templatee-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10">
                                <!-- category content -->
                                <div class="template-listing">
                                    <div class="template-listing-grid">
                                        <div class="single-template">
                                            <div class="inner first-grid">
                                                <div class="text-center">
                                                    <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                    <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">New Template</button>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach($pages as $page)
                                        
                                        <div class="single-template">
                                            <h6 class="text-center">{{$page->name}}</h6>
                                            <div class="inner second-grid">
                                                @if($page->thumbnail)
                                                <img src="{{$page->thumbnail}}" alt="templates" width="100%" height="100%" />
                                                @else
                                                <img src="https://templatemo.com/screenshots-720/template-562-space-dynamic.jpg" alt="templates" width="100%" height="100%" />
                                                @endif
                                                <div class="start-template">
                                                    
                                                    <i class="bi bi-bookmark-plus-fill fs-1 text-primary"></i>
                                                    <a class="btn btn-primary d-block mt-2" href="{{route('user.page.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}">
                                                        Use Template
                                                    </a>
                                                    <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Editing-{{$page->id}}">
                                                        Edit Template
                                                    </a>
                                                    <a class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#Delete-{{$page->id}}">
                                                        Delete Template
                                                    </a>
                                                </div>
                                            </div>
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
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
<style>
    .page-contentts {
        background-color: white;
        padding: 40px 20px;
        margin: 10px 0px 30px;
    }

    .template-side {
        padding-top: 20px;
    }

    .license-div p,
    .sort-div p {
        border-bottom: 2px solid gray;
        font-size: 18px;
        font-weight: 600;
    }

    .license-radio,
    .sort-radio {
        list-style: none;
        position: relative;
        left: -20px;
    }

    .license-radio li,
    .sort-radio li {
        padding: 10px 0px;
    }

    .choose-category {
        padding: 20px;
        border-radius: 20px;
        background-color: #ebebeb;
    }

    .choose-category p {
        font-size: 17px;
        font-weight: 600;
        color: rgb(112, 65, 144);
    }

    .category-list {
        width: 100%;
        overflow-x: scroll;
    }

    .category-list ul {
        list-style: none;
        display: flex;
        width: 150%;
    }

    .category-list::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .category-list::-webkit-scrollbar-thumb {
        background-color: #70418F;
        border-radius: 12px;
    }

    .category-list ul li {
        padding: 5px 20px;
        border-radius: 20px;
        margin-right: 20px;
        font-weight: 500;
    }

    .template-listing {
        margin: 30px 0px;
    }

    .template-listing-grid {
        display: grid;
        grid-template-columns: 32% 32% 32%;
        justify-content: space-between;
    }

    .single-template .inner {
        border-radius: 20px;
        border: 2px solid rgb(175, 175, 175);
        min-height: 300px;
        max-height: 500px;
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    .start-template {
        position: absolute;
        top: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: none;
        place-content: center;
        transition: 2s ease-in-out;
    }

    .single-template .first-grid {
        display: grid;
        place-content: center;
    }

    .second-grid:hover>.start-template {
        display: grid;
    }
</style>
@endsection
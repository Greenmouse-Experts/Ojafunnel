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
                   <div class="page-contents">
                        <div class="template-content">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-2 pe-lg-5 template-side">
                                            <div class="license-div">
                                                <p><i class="bi bi-check2-square pe-2 text-warning fs-4"></i>License</p>
                                                <ul class="license-radio">
                                                    <li>
                                                        <input type="radio" name="license" />
                                                        <span>Any</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="license" />
                                                        <span>Free</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="license" />
                                                        <span>Premium</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="sort-div">
                                                <p><i class="bi bi-sort-down fs-4 pe-2 text-warning"></i>Sort by</p>
                                                <ul class="sort-radio">
                                                    <li>
                                                        <input type="radio" name="sort" />
                                                        <span>Recent</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="sort" />
                                                        <span>Popular</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="sort" />
                                                        <span>Top Rated</span>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="sort" />
                                                        <span>Editor's Pick</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <!-- category -->
                                            <div class="choose-category">
                                                <p>Choose Category</p>
                                                <div class="category-list">
                                                    <ul>
                                                        <li class="bg-success text-white">Ecommerce</li>
                                                        <li class="bg-warning text-white">Easter</li>
                                                        <li class="bg-primary text-white">Business</li>
                                                        <li class="bg-danger text-white">Finance</li>
                                                        <li class="bg-info text-white">Crypto</li>
                                                        <li class="bg-secondary text-white">Logistics</li>
                                                        <li class="bg-success text-white">Ecommerce</li>
                                                        <li class="bg-warning text-white">Easter</li>
                                                        <li class="bg-primary text-white">Business</li>
                                                        <li class="bg-danger text-white">Finance</li>
                                                        <li class="bg-info text-white">Crypto</li>
                                                        <li class="bg-secondary text-white">Logistics</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- category content -->
                                            <div class="template-listing">
                                                <div class="template-listing-grid">
                                                    <div class="single-template">
                                                        <div class="inner first-grid">
                                                            <div  class="text-center">
                                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                                <button class="btn btn-primary d-block mt-2">New Template</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-template">
                                                        <div class="inner second-grid">
                                                            <img src="https://templatemo.com/screenshots-720/template-562-space-dynamic.jpg" alt="templates" width="100%" height="100%"/>
                                                            <div  class="start-template">
                                                                <i class="bi bi-bookmark-plus-fill fs-1 text-primary"></i>
                                                                <a href="{{route('templateDetail')}}">
                                                                    <button class="btn btn-primary d-block mt-2">Use Template</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   </div>
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
<style>
    .page-contents{
        background-color: white;
        padding: 40px 20px;
        margin: 10px 0px 30px;
    }
    .template-content{
    }
    .template-side{
    padding-top: 20px;
    }
    .license-div p , .sort-div p{
    border-bottom: 2px solid gray;
    font-size: 18px;
    font-weight: 600;
    }
    .license-radio, .sort-radio{
    list-style: none;
    position: relative;
    left: -20px;
    }
    .license-radio li, .sort-radio li{
    padding: 10px 0px;
    }
    .choose-category{
    padding: 20px;
    border-radius: 20px;
    background-color: #ebebeb;
    }
    .choose-category p{
    font-size: 17px;
    font-weight: 600;
    color: rgb(112, 65, 144);
    }
    .category-list{
    width: 100%;
    overflow-x: scroll;
    }
    .category-list ul{
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
    .category-list ul li{
    padding: 5px 20px;
    border-radius: 20px;
    margin-right: 20px;
    font-weight: 500;
    }
    .template-listing{
    margin: 30px 0px;
    }
    .template-listing-grid{
    display: grid;
    grid-template-columns: 32% 32% 32%;
    justify-content: space-between;
    }
    .single-template .inner{
    border-radius: 20px;
    border: 2px solid rgb(175, 175, 175);
    min-height: 300px;
    max-height: 500px;
    overflow: hidden;
    position: relative;
    text-align: center;
    }
    .start-template{
    position: absolute;
    top: 0px;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
    place-content: center;    
    transition: 2s ease-in-out;
    }
    .single-template .first-grid{
    display: grid;
    place-content: center;
    }
    .second-grid:hover > .start-template{
    display: grid;
    }
</style>
@endsection
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
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-9">
                            <div class="all-create">
                                <button>
                                    Back
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="all-create">
                                <button data-bs-toggle="modal" data-bs-target="#template">
                                    + Create New Funnel Page
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">
                            <a href="#" class="text-decoration-none text-dark">All</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Page</h4>
                            <div class="table-responsive mt-2">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Thumbnail</th>
                                            <th scope="col">Folder Name</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Page Name</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pages as $page)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$page->created_at->toDayDateTimeString()}}</td>
                                            <td>{{$page->thumbnail}}</td>
                                            <td>{{\App\Models\Funnel::where('id', $page->folder_id)->first()->folder}}</td>
                                            <td>{{$page->title}}</td>
                                            <td>{{$page->name}}</td>
                                            <td>
                                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Options
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="{{route('user.funnel.builder.view.editor', [Auth::user()->username, Crypt::encrypt($page->id)])}}">View</a></li>
                                                    <li><a class="dropdown-item" href="{{route('user.view.funnel.pages', [Auth::user()->username, Crypt::encrypt($page->id)])}}">Edit</a></li>
                                                    <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$page->id}}">Delete</a></li>
                                                </ul>
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
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
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
                        <form method="POST" action="{{route('user.funnel.builder.create.page')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Page
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Title </label>
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
                                                <input value="{{$funnel->folder}}" class="input" readonly>
                                                <input value="{{$funnel->id}}" name="file_folder" hidden>
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
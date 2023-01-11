@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Segments List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">View List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Segments List</h4>
                            <p>Do more with our Segments list</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <a href=" {{route('user.create.segments', Auth::user()->username)}}">
                                <button class="btn btn-success"> + Create Segment</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.list.performance', Auth::user()->username)}}"><i class="bi bi-graph-up"></i> Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.list.setting', Auth::user()->username)}}"><i class="bi bi-gear"></i> Setting</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-person-check"></i> Subscribers <i class="bi bi-caret-up"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('user.list.subscribers', Auth::user()->username)}}">View all</a></li>
                                            <li><a class="dropdown-item" href="{{route('user.new.subscribers', Auth::user()->username)}}">Add</a></li>
                                          <li><a class="dropdown-item" href="{{route('user.import.subscribers', Auth::user()->username)}}">Import</a></li>
                                           <li><a class="dropdown-item" href="{{route('user.export.subscribers', Auth::user()->username)}}">Export</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('user.new.segments', Auth::user()->username)}}"><i class="bi bi-layout-three-columns"></i> Segment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-card-checklist"></i> Manage list fields</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-columns"></i> Form / Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-envelope-check"></i> Email Verifications</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div class="row g-3">
                                <div class="col-xxl-2 col-lg-6">
                                    <select class="form-control select2">
                                        <option>Created at</option>
                                        <option value="Active">Name</option>
                                        <option value="New">Uploaded at</option>
                                    </select>
                                </div>
                                <div class="col-xxl-3 col-lg-6">
                                    <input type="search" class="form-control" id="searchInput" placeholder="Type to Search ...">
                                </div>
                            </div>
                        </div>

                    </div><!--end card-->
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h4 class="card-title lie"><i class="bi bi-layout-three-columns"></i></h4>
                            <p>You have no segment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

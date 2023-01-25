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
                        <h4 class="mb-sm-0 font-size-18">Import Subscribers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Import Subscribers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Import Subscribers</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card all-create account-head">
                        <nav aria-label="Page navigation example normal float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{route('user.list.performance', Auth::user()->username)}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
                                        <a class="nav-link active" href="#" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <a class="nav-link" href="{{route('user.new.segments', Auth::user()->username)}}"><i class="bi bi-layout-three-columns"></i> Segment</a>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b class="mb-sm-0 font-size-15">Import subscribers</b>
                                </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="circle">
                                            <i class="bi bi-info-circle"></i>
                                            Server's max upload file size is limited to 1024M. Make sure your input file does not exceed this limit.
                                            Acceptable file type is CSV with a header row containing the column / field names like EMAIL, FIRST_NAME, LAST_NAME...
                                        </p>
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Choose upload file from your device <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="file" placeholder="Enter Names" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success">Save</button>
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
@endsection

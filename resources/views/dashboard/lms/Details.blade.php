@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Course Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Course Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="video">
                        <div class="card">
                            <div class="card-body">
                                <div id="carouselExample" class="carousel slide">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                        <div class="carousel-item">
                                            <iframe src="https://www.youtube.com/embed/D0UnqGm_miA" title="Dummy Video For Website" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                        <div class="carousel-item">
                                            <iframe src="https://www.youtube.com/embed/yAoLSRbwxL8" title="Dummy Video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-unstyled categories-list">
                                <div class="border-bottom">
                                    <h5 class="card-title mb-3">Course Content</h5>
                                </div>
                                <li class="border-bottom">
                                    <div class="custom-accordion mt-2">
                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                            Section 1:Introduction <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                        </a>
                                        <div class="collapse" id="categories-collapse">
                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                                <ul class="list-unstyled mb-0">
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Introduction Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="border-bottom">
                                    <div class="custom-accordion mt-2">
                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                            Section 2: Basic Concept <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                        </a>
                                        <div class="collapse" id="categories-collapse">
                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                               <ul class="list-unstyled mb-0">
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Introduction Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="border-bottom">
                                    <div class="custom-accordion mt-2">
                                        <a class="text-body fw-medium py-1 d-flex align-items-center" data-bs-toggle="collapse" href="#" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                            Section 2: Basic Concept <i class="mdi mdi-chevron-up accor-down-icon ms-auto"></i>
                                        </a>
                                        <div class="collapse" id="categories-collapse">
                                            <div class="card border-0 shadow-none ps-2 mb-0">
                                               <ul class="list-unstyled mb-0">
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Introduction Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                    <li><a href="javascript: void(0);" class="d-flex align-items-center"><span class="me-auto">Development</span> <i class="mdi mdi-pin ms-auto"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Overview</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block">Q & A</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Note</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Announcement</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Reveiws" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Reveiws</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Learning" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block">Learning tools</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <p class="mb-0">
                                        Overview
                                    </p>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <p class="mb-0">
                                        Q & A
                                    </p>
                                </div>
                                <div class="tab-pane" id="messages1" role="tabpanel">
                                    <p class="mb-0">
                                        Note
                                    </p>
                                </div>
                                <div class="tab-pane" id="settings1" role="tabpanel">
                                    <p class="mb-0">
                                        Announcement
                                    </p>
                                </div>
                                <div class="tab-pane" id="Reveiws" role="tabpanel">
                                    <p class="mb-0">
                                        Reveiws
                                    </p>
                                </div>
                                <div class="tab-pane" id="Reveiws" role="tabpanel">
                                    <p class="mb-0">
                                        Learning
                                    </p>
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

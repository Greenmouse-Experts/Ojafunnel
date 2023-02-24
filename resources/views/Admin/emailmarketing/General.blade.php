@extends('layouts.admin-frontend')

@section('page-content')
@php
$admin = auth()->guard('admin')->user();
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">All Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">All Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Edit application settings</h4>
                            <p>
                                This feature allows you to see all setting available
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-sliders2"></i> General</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                        <span class="d-none d-sm-block"><i class="bi bi-envelope"></i> System Email</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#messages1" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#settings1" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                        <span class="d-none d-sm-block"></span>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="home1" role="tabpanel">
                                    <div class="row">
                                        <div class="Editt mt-4">
                                            <form enctype="multipart/form-data">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site name</label>
                                                            <input type="text" name="image" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site keyword</label>
                                                            <input type="text" name="image" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site description</label>
                                                            <input type="text" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site logo (small)</label>
                                                            <input type="file" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site logo (large)</label>
                                                            <input type="file" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Site favicon</label>
                                                            <input type="file" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Offline message</label>
                                                            <input value="Application currently offline. We will come back soon!" type="text" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Default language</label>
                                                            <input value="English" type="text" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Campaign view scheme</label>
                                                            <input value="Default" type="text" required />
                                                        </div>
                                                        <div class="text-end mt-3">
                                                            <a href="#" class="text-decoration-none">
                                                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                    Save
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="profile1" role="tabpanel">
                                    <div class="row">
                                        <p class="text-dark mt-3">Configure email service which is used by the system to send transactional emails like user verification, application notification, etc.</p>
                                        <div class="Editt">
                                            <form enctype="multipart/form-data">
                                                <div class="form">
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <label for="Name">Method for sending system mail</label>
                                                            <select name="" id="">
                                                                <option value="">Choose</option>
                                                                <option value="">Sendmail</option>
                                                                <option value="">SMTP</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 mb-3"></div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">From email</label>
                                                            <input type="email" name="image" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">From name</label>
                                                            <input type="email" required />
                                                        </div>
                                                        <div class="col-lg-4 mb-3">
                                                            <label for="Name">Sendmail path</label>
                                                            <input type="text" value="/usr/sbin/sendmail" required />
                                                        </div>
                                                        <div class="text-end mt-3">
                                                            <a href="#" class="text-decoration-none">
                                                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                    Save
                                                                </button>
                                                            </a>
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
                </div>
            </div>
        </div>
    </div>
    @endsection

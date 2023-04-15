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
                        <h4 class="mb-sm-0 font-size-18">Choose Templates</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Choose Templates</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Choose Templates</h4>
                                    <p>
                                        All your Choose Templates in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Choose Templates</h4>
                            <div class="template-listing">
                                <div class="template-listing-grid">
                                    <div class="single-template">
                                        <div class="inner first-grid">
                                            <div class="text-center">
                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                <a href="{{ route('user.email-marketing.email.templates.view-temp', ['id' => 0, 'username' => Auth::user()->username]) }}">
                                                    <button class="btn btn-primary d-block mt-2">
                                                        View Call To Action Template 1
                                                    </button>
                                                </a>  
                                                <button class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#template1">
                                                    Use Template
                                                </button>
                                            </div> 
                                        </div>
                                    </div>
                                    <div class="single-template">
                                        <div class="inner first-grid">
                                            <div class="text-center">
                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                <a href="{{ route('user.email-marketing.email.templates.view-temp', ['id' => 1, 'username' => Auth::user()->username]) }}">
                                                    <button class="btn btn-primary d-block mt-2">
                                                        View Call To Action Template 2
                                                    </button>
                                                </a> 
                                                <button class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#template2">
                                                    Use Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-template">
                                        <div class="inner first-grid">
                                            <div class="text-center">
                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                <a href="{{ route('user.email-marketing.email.templates.view-temp', ['id' => 2, 'username' => Auth::user()->username]) }}">
                                                    <button class="btn btn-primary d-block mt-2">
                                                        View Weekly Digest Template 1
                                                    </button>
                                                </a> 
                                                <button class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#template3">
                                                    Use Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="template-listing-grid mt-3">
                                    <div class="single-template">
                                        <div class="inner first-grid">
                                            <div class="text-center">
                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                <a href="{{ route('user.email-marketing.email.templates.view-temp', ['id' => 3, 'username' => Auth::user()->username]) }}">
                                                    <button class="btn btn-primary d-block mt-2">
                                                        View Warning Template 1
                                                    </button>
                                                </a> 
                                                <button class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#template4">
                                                    Use Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single-template">
                                        <div class="inner first-grid">
                                            <div class="text-center">
                                                <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                <a href="{{ route('user.email-marketing.email.templates.view-temp', ['id' => 4, 'username' => Auth::user()->username]) }}">
                                                    <button class="btn btn-primary d-block mt-2">
                                                        View Billing Template 1
                                                    </button>
                                                </a> 
                                                <button class="btn btn-primary d-block mt-2" data-bs-toggle="modal" data-bs-target="#template5">
                                                    Use Template
                                                </button>
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
    </div>
</div>

@foreach ([1,2,3,4,5] as $id)
<div class="modal fade" id="template{{ $id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('user.email-marketing.email.templates.create', ['username' => Auth::user()->username])}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        New Email Template
                                    </b> 
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="e.g Welcome campaign" name="name" class="input" required>
                                            </div>
                                        </div>
                                        <input value="{{ $id }}" name="id" hidden>
                                    </div> 
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Create
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
@endforeach

@endsection
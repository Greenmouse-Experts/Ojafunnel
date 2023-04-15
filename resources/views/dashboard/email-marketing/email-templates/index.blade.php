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
                        <h4 class="mb-sm-0 font-size-18">Email Templates</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Email Templates</li>
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
                                    <h4 class="font-500">Email Templates</h4>
                                    <p>
                                        All your Email Templates in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="{{ route('user.email-marketing.email.templates.choose-temp', ['username' => Auth::user()->username]) }}">
                                            <button>
                                                + Add Email Templates
                                            </button>
                                        </a>
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
                            <h4 class="card-title mb-4">View Email Templates</h4>
                            <div class="table-responsive"> 
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead> 
                                    <tbody> 
                                        @forelse ($email_templates as $email_template)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $email_template->name }}</td>
                                                <td>{{ $email_template->created_at->toDayDateTimeString() }}</td>
                                                <td>
                                                    <div class="dropdown-center">
                                                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            Options
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item" href="{{ route('user.email-marketing.email.templates.editor', ['username' => Auth::user()->username, 'id' => $email_template->id]) }}">
                                                                    Edit Template
                                                                </a>
                                                            </li> 
                                                            <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$email_template->id}}">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="modal fade" id="delete-{{$email_template->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content pb-3">
                                                                <div class="modal-header border-bottom-0">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body ">
                                                                    <div class="row">
                                                                        <div class="Editt">
                                                                            <form method="POST" action="{{ route('user.email-marketing.email.templates.delete', ['username' => Auth::user()->username]) }}">
                                                                                @csrf
                                                                                <div class="form">
                                                                                    <p><b>Delete Email Template</b></p>
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12">
                                                                                            <p>This action cannot be undone. This will permanently delete <br> <b>{{$email_template->name}}</b>.</p>
                                                                                            <label>Please type DELETE to confirm.</label>
                                                                                            <div class="row">
                                                                                                <div class="col-md-12 mb-4">
                                                                                                    <input type="text" name="delete" class="input" required>
                                                                                                    <input type="hidden" name="id" value="{{ $email_template->id }}" class="input">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <div class="boding">
                                                                                                <button type="submit" class="form-btn">
                                                                                                    I understand this consquences, Delete
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
                                                </td>
                                            </tr>
                                        @empty
                                            {{ 'No email template at the moment' }}
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
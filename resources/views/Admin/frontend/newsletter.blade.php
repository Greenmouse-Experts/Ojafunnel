@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Newsletter</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Newsletter</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class=''>
                <div class=''>
                    <div class="row align-items-center bg-white p-lg-3">
                        <div class="col-lg-9">
                            <div class="py-2">
                                <h4 class="font-500">Newsletter Subscribers</h4>
                                <p>
                                    List of users that subscribed for newsletter
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="mt-lg-4">
                                <button data-bs-toggle="modal" data-bs-target="#send" class="btn btn-primary d-block">Send Newsletter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table content of courses -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Newsletter Subscribers</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Email</th>
                                            <th>Subscribe</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Newsletter::latest()->get() as $newsletter)
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$newsletter->email}}
                                            </td>
                                            <td>
                                                @if($newsletter->subscribe == true)
                                                <span class="badge badge-pill badge-soft-success font-size-11">TRUE</span>
                                                @else
                                                <span class="badge badge-pill badge-soft-danger font-size-11">FALSE</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{$newsletter->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <!-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="Reply">
                                                        <a href="mailto:{{$newsletter->email}}" target="_blank" class="btn btn-sm btn-soft-success"><i class="bi bi-reply"></i></a>
                                                    </li> -->
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$newsletter->id}}" class="btn btn-sm btn-soft-danger"><i class="bi bi-x-circle"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <!-- delete conatct us modal -->
                                            <div class="modal fade" id="delete-{{$newsletter->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0 bg-light">
                                                            <h5 class="modal-title py-2" id="staticBackdropLabel">
                                                                Are you sure you want to delete this newsletter form?
                                                            </h5>
                                                        </div>
                                                        <div class='row justify-content-between p-3'>
                                                            <form method="post" action="{{route('deleteNewsletter', Crypt::encrypt($newsletter->id))}}">
                                                                @csrf
                                                                <div class='col'>
                                                                    <button type="button" class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091;">Cancel</button>
                                                                </div>
                                                                <div class='col text-end'>
                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">Delete</button>
                                                                </div>
                                                            </form>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </tr>
                                        @endforeach
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

<div class="modal fade" id="send" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('send.newsletter')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form">
                                <p class="mt-n4"><b>Broadcast</b></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Subject</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter subject" name="subject" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea id="editor" class="input" name="message"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <label>Attachment</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="file" placeholder="Attachment" rows="20" name="attachment" class="input"> 
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">Send</button>
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
<style>
    /* Add some basic styling for the editor */
    #editor {
        width: 100%;
        height: 200px;
        padding: 10px;
    }
</style>
@endsection
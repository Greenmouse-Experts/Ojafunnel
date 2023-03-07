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
                        <h4 class="mb-sm-0 font-size-18">Contact Us</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Contact Us</li>
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
                                <h4 class="font-500">Contact Us</h4>
                                <p>
                                    Do you have an issue we can help with ? Here’s how you can reach us.
                                </p>
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
                            <h4 class="card-title mb-4">All Contact Us Form</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Subject</th>
                                            <th>Message</th>
                                            <th>Date sent</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\ContactUs::latest()->get() as $contact)
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$contact->name}}
                                                <p>
                                                    {{$contact->email}}
                                                </p>
                                            </td>
                                            <td>
                                                {{$contact->phone_number}}
                                            </td>
                                            <td>
                                                {{$contact->subject}}
                                            </td>
                                            <td>
                                                {{$contact->message}}
                                            </td>
                                            <td>
                                                {{$contact->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$contact->id}}" class="btn btn-sm btn-soft-danger"><i class="bi bi-x-circle"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                            <!-- delete conatct us modal -->
                                            <div class="modal fade" id="delete-{{$contact->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0 bg-light">
                                                            <h5 class="modal-title py-2" id="staticBackdropLabel">
                                                                Are you sure you want to delete this contact form?
                                                            </h5>
                                                        </div>
                                                        <div class='row justify-content-between p-3'>
                                                            <form method="post" action="{{route('deleteContactUs', Crypt::encrypt($contact->id))}}">
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
@endsection
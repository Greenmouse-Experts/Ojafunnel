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
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{$mailinglist->mailinglist_name}} Mailing List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Mailing List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Mailing List ; <span style="color:#2E59F3;"> {{$mailinglist->mailinglist_name}}</span> </h4>
                            <p>
                                Create, view, edit and do many more with your contact list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <a class="btn" href="{{route('user.add.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])}}">
                                + Add Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Mailing List(s)</h4>
                            <p class="card-title-desc">

                            </p>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>First Name </th>
                                            <th>Last Name </th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Date Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @if($contacts->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="7">No Contact Added.</td>
                                        </tr>
                                    </tbody>
                                    @else
                                    <tbody>
                                        @foreach($contacts as $contact)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{$contact->first_name}}</td>
                                            <td>{{$contact->last_name}}</td>
                                            <td>{{$contact->email}}</td>
                                            <td>{{$contact->phone_number}}</td>
                                            <td>{{$contact->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#edit-{{$contact->id}}">Edit/Update</a></li>
                                                        <li><a class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#delete-{{$contact->id}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="edit-{{$contact->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.subscriber.mailing.contact.update', Crypt::encrypt($contact->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p>
                                                                                    <b>
                                                                                        Edit/Update
                                                                                    </b>
                                                                                </p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <label>First Name </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" placeholder="Enter Your First Name" name="first_name" value="{{$contact->first_name}}" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Last Name </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="text" placeholder="Enter Your Last Name" name="last_name" value="{{$contact->last_name}}" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Email </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="email" placeholder="Enter Your Email" name="email" value="{{$contact->email}}" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <label>Phone Number </label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="tel" placeholder="Enter Your Phone Number" name="phone_number" value="{{$contact->phone_number}}" class="input" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <div class="boding">
                                                                                            <button type="submit" class="form-btn">
                                                                                                Update
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
                                                <!-- Modal START -->
                                                <div class="modal fade" id="delete-{{$contact->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header border-bottom-0">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        <form method="POST" action="{{ route('user.subscriber.mailing.contact.delete', Crypt::encrypt($contact->id))}}">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <p><b>Delete Contact</b></p>
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <p>This action cannot be undone. This will permanently delete {{$contact->first_name}} {{$contact->last_name}} contact.</p>
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
                                                                                                I understand this consquences, Delete Contact
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
                                        @endforeach
                                    </tbody>
                                    @endif
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection

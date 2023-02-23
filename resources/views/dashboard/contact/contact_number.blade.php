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
                <div class="col-lg-12">
                    <div class="card account-head mb-4">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Contact Number</h4>
                                    <p>
                                        Sms and Whatsapp Contact List Numbers
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#addContact">
                                            Create Contact
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="py-2">
                            <h4 class="font-500">WhatsApp Automation</h4>
                            <p>
                                Send instant, scheduled or automated messages to your contact
                            </p>
                            <div class="">
                                <div class="all-create">
                                    <button>
                                        <a href="{{route('user.send.broadcast', Auth::user()->username)}}">
                                            Send Brodcast Messsage
                                        </a>
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-flex account-nav">
                            {{-- <p class="ps-0">New Campaign</p> --}}
                            {{-- <p>
                                <a href="#" class="text-decoration-none text-dark">Recieved Messages</a>
                            </p> --}}
                            <p class="ps-0 active">
                                <a href="#" class="text-decoration-none text-dark">Contacts</a>
                            </p>
                            {{-- <p>
                                <a href="#" class="text-decoration-none text-dark">Auto Reply</a>
                            </p> --}}
                            {{-- <p>

                            </p> --}}
                            {{-- <p class="ps-0 active">
                                <a href="#" class="text-decoration-none text-dark">Settings</a>
                            </p> --}}
                        </div>
                        <div class="acc-border"></div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="">
                    <div class="store-table">
                        <div class="table-head row pt-4">
                            <div class="col-lg-12">
                                <h4>Contact Numbers</h4>
                            </div>
                            <!-- <div class="col-lg-6 search-item">
                                <div class="bg-light search-store border-in flex">
                                    <input class="bg-light" type="search" placeholder="search by name" name="store" id="" />
                                    <button><i class="bi bi-search"></i></button>
                                </div>
                            </div> -->
                        </div>
                        <div class="table-body mt-5 table-responsive">
                            <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                                <thead class="fw-bold bg-light rounded-pill ">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                        <!-- <th scope="col">Opens</th> -->
                                        {{-- <th scope="col">Unsubscribed</th> --}}
                                    </tr>
                                </thead>
                                @if($contact->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="8">No contact list added.</td>
                                        </tr>
                                    </tbody>
                                @else
                                @foreach($contact as $key => $item)
                                <tbody>
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <p class='text-bold-600'> {{$item->phone_number}} </p>
                                        </td>
                                        <td>
                                            {{ $item->status }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('llll') }}
                                        </td>
                                        <td>

                                            <button class="btn-list" data-bs-toggle="modal" data-bs-target="#updateContact-{{$item->id}}">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Contact" class="material-icons-outlined">
                                                    edit
                                                </span>
                                            </button>

                                            <button class="btn-list" data-bs-toggle="modal" data-bs-target="#deleteContact-{{$item->id}}">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Contact" class="material-icons-outlined">
                                                    delete
                                                </span>
                                            </button>
                                            <div class="modal fade" id="updateContact-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Update Contact
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.automation.contact_num_update', ['username' => Auth::user()->username, 'contact_id' => $item->id])}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="col-lg-12">
                                                                                <label>Phone Number</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="tel" placeholder="+234 800 000 0000" value="{{$item->phone_number}}" name="phone_no" class="input"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Status</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <select name="status" id="">
                                                                                            <option value="subscribed" selected>Subscribed</option>
                                                                                            <option value="unsubscribed">Unsubscribed</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button></a>
                                                                                </div>
                                                                                <div class="col-6 text-end">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                                                            >
                                                                                            Update
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
                                            <div class="modal fade" id="deleteContact-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.automation.contact_num_delete', ['username' => Auth::user()->username, 'contact_id' => $item->id])}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to delete this  <br> Number ({{$item->phone_number}})</h3>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                            Cancel
                                                                                        </button></a>
                                                                                </div>
                                                                                <div class="col-6 text-end">
                                                                                    <a href="#" class="text-decoration-none">
                                                                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028"
                                                                                            >
                                                                                            Delete
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
                                        </td>
                                        {{-- <td>{{$smsAutomation->created_at->toDayDateTimeString()}}</td>
                                        <td>{{$smsAutomation->sms_sent}}</td>
                                        <td>{{$smsAutomation->delivered}}</td>
                                        <td>{{$smsAutomation->not_delivered}}</td>
                                        <!-- <td>{{$smsAutomation->opens}}</td> -->
                                        <td>{{$smsAutomation->unsubscribed}}</td> --}}
                                    </tr>
                                </tbody>
                                @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-8">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Sender Accounts
                                    </b> <br>
                                    <span>
                                        Add one or more whatsapp number to start your automation
                                    </span>
                                </p>
                                <div class="col-lg-12">
                                    <label>Whatsapp Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <div class="boding">
                                                <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                    Add New Number
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Sending Configuration
                                    </b> <br>
                                    <span>
                                        Reduce the chances of geting blocked by setting the speed for bulk
                                        messages
                                    </span>
                                </p>
                                <div class="col-lg-12">
                                    <label>Connection Speed :</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select>
                                                <option>
                                                    Fast
                                                </option>
                                                <option> Low </option>
                                                <option> Medium </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <div class="boding">
                                                <button>
                                                    <a href="" style="color: #fff;">
                                                        Update Setting
                                                    </a>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Page-content -->
<div class="modal fade" id="addContact" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add Contact
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form action="{{route('user.automation.contact_add', ['username' => Auth::user()->username, 'list_id' => $list_id])}}" method="post">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="phone_no" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="#" class="text-decoration-none">
                                            <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Cancel
                                            </button></a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
                                                Save Number
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
<style>
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
</style>
@endsection

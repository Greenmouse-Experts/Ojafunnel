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
                        <h4 class="mb-sm-0 font-size-18">Contact List</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Contact List</li>
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
                                    <h4 class="font-500">Contact List</h4>
                                    <p>
                                        Sms and Whatsapp Contact List
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#createContactList">
                                            Create List
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
                        <div class="table-head row">
                            <div class="col-lg-12">
                                <h4>Contact Lists</h4>
                            </div>
                            <!-- <div class="col-lg-6 search-item">
                                <div class="bg-light search-store border-in flex">
                                    <input class="bg-light" type="search" placeholder="search by name" name="store" id="" />
                                    <button><i class="bi bi-search"></i></button>
                                </div>
                            </div> -->
                        </div>
                        <div class="table-body mt-1 table-responsive">
                            <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                                <thead class="fw-bold dark" style="background:#F5E6FE;">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                        <!-- <th scope="col">Opens</th> -->
                                        {{-- <th scope="col">Unsubscribed</th> --}}
                                    </tr>
                                </thead>
                                @if($contact_lists->isEmpty())
                                    <tbody>
                                        <tr>
                                            <td class="align-enter text-dark font-15" colspan="8">No contact list added.</td>
                                        </tr>
                                    </tbody>
                                @else

                                <tbody>
                                    @foreach($contact_lists as $key => $item)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>
                                            <p class='text-bold-600'> {{$item->name}} </p>
                                        </td>
                                        <td>
                                            {{$item->contact_num->count()}}
                                        </td>
                                        <td>
                                            {{ $item->status }}
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('llll') }}
                                        </td>
                                        <td>

                                            <button class="btn-list" data-bs-toggle="modal" data-bs-target="#addContact-{{$item->id}}">
                                                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Add Contact" class="material-icons-outlined">
                                                    person
                                                </span>
                                            </button>

                                            <div class="modal fade" id="addContact-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                                                    <form action="{{route('user.automation.contact_add', ['username' => Auth::user()->username, 'list_id' => $item->id])}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="cfContactsol-lg-12">
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
                                            <div class="modal fade" id="updateContactList-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Add Contact List
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.automation.contact_list_update', ['username' => Auth::user()->username, 'list_id' => $item->id])}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="col-lg-12">
                                                                                <label>Name</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" placeholder="Contact List Name..." name="name" value="{{$item->name}}" class="input"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Status</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <select name="status" id="">
                                                                                            <option value="Active" selected>Active</option>
                                                                                            <option value="Suspend">Suspend</option>
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
                                            <div class="modal fade" id="deleteContactList-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">

                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.automation.contact_list_delete', ['username' => Auth::user()->username, 'list_id' => $item->id])}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to delete this list <br> ({{$item->name}})</h3>
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
                                            <div class="dropdown">
                                                <button class="btn-list dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('user.automation.contact_add', ['username' => Auth::user()->username, 'list_id' => $item->id])}}">
                                                            Contacts
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#updateContactList-{{$item->id}}">
                                                            Edit List
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#deleteContactList-{{$item->id}}">
                                                            Delete
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        {{-- <td>{{$smsAutomation->created_at->toDayDateTimeString()}}</td>
                                        <td>{{$smsAutomation->sms_sent}}</td>
                                        <td>{{$smsAutomation->delivered}}</td>
                                        <td>{{$smsAutomation->not_delivered}}</td>
                                        <!-- <td>{{$smsAutomation->opens}}</td> -->
                                        <td>{{$smsAutomation->unsubscribed}}</td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
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
<div class="modal fade" id="createContactList" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Add Contact List
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form action="{{route('user.automation.contact_list', Auth::user()->username)}}" method="post">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Contact List Name..." name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Status</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" id="">
                                                <option value="Active" selected>Active</option>
                                                <option value="Suspend">Suspend</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Cancel
                                            </button></a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
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
<!-- email confirm modal -->
    <div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Contact List
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Description</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" placeholder="Enter a description, eg for book sales" id=""
                                                cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Cancel
                                            </button></a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
                                                Save Number
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->
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

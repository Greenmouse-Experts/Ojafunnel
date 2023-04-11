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
                        <h4 class="mb-sm-0 font-size-18">Birthday Modules</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.main.list', Auth::user()->username)}}">Birthday</a></li>
                                <li class="breadcrumb-item active">Manage Birthday</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header -->
            <div class=''>
                <div class='row align-items-center birthday-contact'>
                    <div class='col-lg-9 main-text'>
                        <p class='topic'>Birthday Modules</p>
                        <p class='mt-2 p-0'> Create and manage birthday messages fowarded to customers.</p>
                    </div>
                    <div class='col-lg-3 text-end'>
                        <div class="">
                            <div class="all-create">
                                <a href="{{route('user.create.birthday', Auth::user()->username)}}">
                                    <button>
                                        <i class="bi bi-card-checklist pe-1"></i>Create Module
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Module Listing</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">List Name</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Automation</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Schedule Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bm as $b)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\App\Models\BirthdayContactList::where('id', $b->birthday_contact_list_id)->first()->name}}</td>
                                            <td>{{$b->title}}</td>
                                            <td>
                                                {{-- @php
                                                $bb = json_decode($b->automation, true);
                                                @endphp
                                                @foreach ($bb as $key => $value)
                                                <p style="text-transform:capitalize">{{$value}}</p>
                                                @endforeach --}}
                                                <p style="text-transform:capitalize">{{ $b->automation }}</p>
                                            </td>
                                            <td><span class="bg-success p-2" style="color: #fff;">{{$b->status}}</span></td>
                                            <td>{{$b->start_date}}</td>
                                            <td>{{$b->end_date}}</td>
                                            <td>
                                                @if($b->action == 'Play')
                                                <span class="bg-success p-2" style="color: #fff;">{{$b->action}}</span>
                                                @endif
                                                @if($b->action == 'Pause')
                                                <span class="bg-danger p-2" style="color: #fff;">{{$b->action}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="row fs-5">
                                                    <div class='col'><a data-bs-toggle="modal" data-bs-target="#editBirthdayList-{{$b->id}}"><i class="bi bi-eye-fill cursor-pointer"></i></a></div>
                                                    <div class='col'><i class="bi bi-trash3-fill text-danger cursor-pointer" data-bs-toggle="modal" data-bs-target="#deleteBirthdayList-{{$b->id}}"></i></div>
                                                </div>
                                            </td>
                                            <!-- End Page-content -->
                                            <div class="modal fade" id="editBirthdayList-{{$b->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0">
                                                            <h5 class="modal-title" id="staticBackdropLabel">
                                                                Edit {{$b->title}}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="Edit-level">
                                                                    <form action="{{route('user.update.birthday', Crypt::encrypt($b->id))}}" method="post">
                                                                        @csrf
                                                                        <div class="form">
                                                                            <div class="col-lg-12">
                                                                                <label>Message Title</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" placeholder="Enter the message title" value="{{$b->title}}" name="title" class="input"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Sender Name</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <input type="text" placeholder="Enter the message title" name="sender_name" value="{{$b->sender_name}}" class="input"
                                                                                            required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Select Recipient List</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <select name="birthday_list_id" id="" class='py-3 fs-6' required>
                                                                                            <option selected value="{{$b->birthday_contact_list_id}}">{{App\Models\BirthdayContactList::find($b->birthday_contact_list_id)->name}}</option>
                                                                                            <option disabled class='p-5'>Choose from birthday listing</option>
                                                                                            @if($birthlist->isEmpty())
                                                                                                <option disabled value="">No Birthday List</option>
                                                                                            @else
                                                                                                @foreach ($birthlist as $item)
                                                                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Select Automation Type</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <select name="sms_type" id="" class='py-3 fs-6'>
                                                                                            <option selected value="{{$b->sms_type}}">{{$b->sms_type}}</option>
                                                                                            <option disabled class='p-5'>Select Automation Type</option>
                                                                                            <option value="birthday">Birthday</option>
                                                                                            <option value="anniversary">Aniversary</option>
                                                                                            <!-- <option value="other">Other</option> -->
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Message Body</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <textarea placeholder="Enter the message here" value="{{$b->message}}" name="message">{{$b->message}}</textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class='row'>
                                                                                    <div class='col-lg-6'>
                                                                                        <label>Start Date</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="date" value="{{$b->start_date}}" name="start_date" class="input"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class='col-lg-6'>
                                                                                        <label>End Date</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-5">
                                                                                                <input type="date" value="{{$b->end_date}}" name="end_date" class="input"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <label>Select Action</label>
                                                                                <div class="row">
                                                                                    <div class="col-md-12 mb-4">
                                                                                        <select name="action" class='py-3 fs-6' required>
                                                                                            <option selected value="{{$b->action}}">{{$b->action}}</option>
                                                                                            <option disabled class='p-5'>Choose options</option>
                                                                                            <option value="Play">Play</option>
                                                                                            <option value="Pause">Pause</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row justify-content-between">
                                                                                <div class="col-6"></div>
                                                                                <div class="col-6 text-end">
                                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                                                        Update
                                                                                    </button>
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
                                            <!-- Edit contacts modal -->
                                            <div class="modal fade" id="deleteBirthdayList-{{$b->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-bottom-0 bg-light ">
                                                            <h5 class="modal-title py-2" id="staticBackdropLabel">
                                                                Are you sure you want to delete this module ?
                                                            </h5>
                                                        </div>
                                                        <form action="{{route('user.delete.birthday', ['username' => Auth::user()->username, 'id' => $b->id])}}" method="post">
                                                            @csrf
                                                            <div class='row justify-content-between p-3'>
                                                                <div class='col'>
                                                                    <button type="button" class="mybtnprimary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                </div>
                                                                <div class='col text-end'>
                                                                    <button type="submit" class="mybtncancel" data-bs-dismiss="modal" aria-label="Close">Delete</button>
                                                                </div>
                                                            </div>
                                                        </form>
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
<!-- END layout-wrapper -->
@endsection
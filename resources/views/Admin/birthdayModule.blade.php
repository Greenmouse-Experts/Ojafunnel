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
                        <h4 class="mb-sm-0">Birthday Modules</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Birthday Module</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Birthday Module</h4>
                            <p>
                                Browse through birthday automated modules created by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Module Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" >
                                <table class="table  table-nowrap" id="datatable-buttons">
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
                                        @foreach (App\Models\BirthdayAutomation::latest()->get() as $b)
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
                                                                    <form action="{{route('admin.update.birthday', Crypt::encrypt($b->id))}}" method="post">
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
                                                        <form action="{{route('admin.delete.birthday', $b->id)}}" method="post">
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

@endsection

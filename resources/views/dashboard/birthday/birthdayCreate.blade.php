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
                        <h4 class="mb-sm-0 font-size-18">Birthday Module</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.main.list', Auth::user()->username)}}">Birthday</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.manage.birthday', Auth::user()->username)}}">Manage Birthday</a></li>
                                <li  class="breadcrumb-item active">Create Module</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header -->
            <div class=''>
                <div class='row align-items-center birthday-contact'>
                    <div class='col-lg-9 main-text'>
                        <p class='topic'>Create New Birthday Module</p>
                        <p class='mt-2 p-0'> create a new birthday module and set automation to send messages.</p>
                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class='row my-4'>
                <div class='col-lg-2'></div>
                <div class='p-3 bg-white col-lg-8'>
                    <div>
                        <form action="{{route('user.create.birthday.automation', Auth::user()->username)}}" method="post">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Message Title</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter the message title" name="title" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Sender Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter the message title" name="sender_name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Select Recipient List</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="birthday_list_id" id="" class='py-3 fs-6'>
                                                <option selected disabled class='p-5'>Choose from birthday listing</option>
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
                                                <option selected disabled class='p-5'>Select Automation Type</option>
                                                <option value="birthday">Birthday</option>
                                                <option value="anniversary">Aniversary</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Message Body</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea placeholder="Enter the message here" name="message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class='fs-6 fw-bold'>Choose Automation</p>
                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                            <div class='d-flex mt-2 align-items-center'>
                                                <input type='checkbox' id="email_select" onchange="emailAuto()" value="email automation" name="automation[1]" class='w-auto mt-1 checkboxs' />
                                                <label class='w-auto '>Email Automation</label>
                                            </div>
                                            {{-- <div class="email_automation mt-2" style="display: none">
                                                <div class="col-lg-8">
                                                    <label>Select Email Sending Server</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="sending_server" id="" required class='py-3 fs-6'>
                                                                <option selected disabled class='p-5'>Choose from mail sending server</option>
                                                                @if($sendingServer->isEmpty())
                                                                    <option disabled value="">No Mail Sending Server</option>
                                                                @else
                                                                    @foreach ($sendingServer as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class='d-flex mt-3 align-items-center'>
                                                <input type='checkbox' id="sms_select" onchange="smsAuto()" value="sms automation" name="automation[2]" class='w-auto mt-1' />
                                                <label class='w-auto'>SMS Automation</label>
                                            </div>
                                            <div class="sms_automation mt-2" style="display: none">
                                                <div class="col-lg-8">
                                                    <label>Select SMS Server</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="integration" id="" required class='py-3 fs-6'>
                                                                <option selected disabled class='p-5'>Choose from sms sending server</option>
                                                                @if($smsServer->count() > 0)
                                                                    @foreach ($smsServer as $item)
                                                                        <option value="{{$item->id}}">{{$item->type}}</option>
                                                                    @endforeach
                                                                @else
                                                                    <option disabled value="">No Sms Sending Server</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class='d-flex mt-3 align-items-center'>
                                                <input type='checkbox' id="whatsapp" onchange="whatsAppAuto()" value="whatsapp automation" name="automation[3]" class='w-auto mt-1' />
                                                <label class='w-auto'>Whatsapp Automation</label>
                                            </div>
                                            <div class="whatsapp_automation mt-2" style="display: none">
                                                <div class="col-lg-8">
                                                    <label>Sending Account</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="phone" placeholder="Enter the Whatsapp Number e.g +2234666455454" name="sender_id" class="input"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class='row'>
                                        <div class='col-lg-6'>
                                            <label>Start Date</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="date"  name="start_date" class="input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-lg-6'>
                                            <label>End Date</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-5">
                                                    <input type="date"  name="end_date" class="input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="{{route('user.manage.birthday', Auth::user()->username)}}" class="text-decoration-none">
                                            <button type="button" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Return to Modules
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
                <div class='col-lg-2'></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection

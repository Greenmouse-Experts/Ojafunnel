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
                    <div class='col-lg-11 main-text'>
                        <p class='topic'>Create New Birthday Module</p>
                        <p class='mt-2 p-0'> create a new birthday module and set automation to send messages.</p>
                    </div>
                    <div class="col-lg-1">
                        <div class="card">
                            <div class="card-body">
                                <!-- <p class="cash">Explainer Video Here</p> -->
                                @if(App\Models\ExplainerContent::where('menu', 'Birthday')->exists())
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    <i class="bi bi-play-btn"></i>
                                </div>
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                @endif
                            </div>
                        </div>
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
                                                <!-- <option value="other">Other</option> -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Message Body</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea placeholder="Enter the message here" name="message"></textarea>
                                            <div class="messageCounter" id="the-count"><span id="characters">0</span></div>
                                            <span class="text-danger">160 characters length per message</span>
                                            <p>
                                                <b>$name</b> can be used for Email and WhatsApp automation in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class='fs-6 fw-bold'>Choose Automation</p>
                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                            <div class='d-flex mt-2 align-items-center'>
                                                <input type='checkbox' id="email_select" onchange="emailAuto()" value="email automation" name="automation[0]" class='w-auto mt-1 checkboxs' />
                                                <label class='w-auto '>Email Automation</label>
                                            </div>
                                            {{-- <div class="email_automation mt-2" style="display: none">
                                                <div class="col-lg-12">
                                                    <label>Email kit</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="email_kit" id="" class="input">
                                                                <option value="">
                                                                    Select email kit
                                                                </option>
                                                                @forelse ($email_integrations as $email_integration)
                                                                    <option value="{{ $email_integration->id }}">
                                                                        {{ $email_integration->host }} ({{  $email_integration->type }})
                                                                    </option>
                                                                @empty
                                                                    <option value="" disabled>
                                                                        No email kit yet
                                                                    </option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class='d-flex mt-3 align-items-center'>
                                                <input type='checkbox' id="sms_select" onchange="smsAuto()" value="SMS & WhatsApp Automation" name="automation[1]" class='w-auto mt-1' />
                                                <label class='w-auto'>SMS & WhatsApp Automation</label>
                                            </div>
                                            <div class="sms_automation mt-2" style="display: none">
                                                <div class="col-lg-12">
                                                    <label>Select SMS Server</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="integration" class='py-3 fs-6'>
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
                                                <input type='checkbox' id="whatsapp" onchange="whatsAppAuto()" value="whatsapp automation" name="automation[2]" class='w-auto mt-1' />
                                                <label class='w-auto'>Whatsapp Automation</label>
                                            </div>
                                            <div class="whatsapp_automation mt-2" style="display: none">
                                                <div class="col-lg-12">
                                                    <label>Sending Account</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="sender_id" id="" class="input">
                                                                <option value="">Choose from conneted WA Account list</option>
                                                                @forelse ($whatsapp_numbers as $whatsapp_number)
                                                                    <option value="{{ $whatsapp_number['id'] }}-{{ $whatsapp_number['phone_number'] }}-{{ $whatsapp_number['status'] }}-{{ $whatsapp_number['full_jwt_session'] }}">
                                                                        {{ $whatsapp_number['phone_number'] }} ({{ $whatsapp_number['status'] }})
                                                                    </option>
                                                                @empty
                                                                    <option value="">No WA account found</option>
                                                                @endforelse
                                                            </select>
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
@if(App\Models\ExplainerContent::where('menu', 'Birthday')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Birthday')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                {{App\Models\ExplainerContent::where('menu', 'Birthday')->first()->text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
<script>
    $('textarea').keyup(function() {

    var characterCount = $(this).val().length,
        current = $('#characters'),
        // maximum = $('#maximum'),
        theCount = $('#the-count');

    current.text(characterCount);


    /*This isn't entirely necessary, just playin around*/
    if (characterCount < 70) {
      current.css('color', '#666');
    }
    if (characterCount > 70 && characterCount < 90) {
      current.css('color', '#6d5555');
    }
    if (characterCount > 90 && characterCount < 100) {
      current.css('color', '#793535');
    }
    if (characterCount > 100 && characterCount < 120) {
      current.css('color', '#841c1c');
    }
    if (characterCount > 120 && characterCount < 139) {
      current.css('color', '#8f0001');
    }

    if (characterCount >= 140) {
    //   maximum.css('color', '#8f0001');
      current.css('color', '#713F93');
      theCount.css('font-weight','bold');
    } else {
    //   maximum.css('color','#666');
      theCount.css('font-weight','normal');
    }


  });
</script>
@endsection

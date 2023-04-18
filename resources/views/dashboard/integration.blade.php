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
                        <h4 class="mb-sm-0 font-size-18">Create Integration</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create Integration</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-11">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Create Integrations </h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <!-- <div class="col-lg-2">
                </div> -->
                <div class="col-12">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        SMS Gateways - Your integration starter kit
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/twilio-icon.png')}}" draggable="false" alt="">
                                                <span class="text-dark">Twillio</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Twillio">
                                                <input type="radio" name="sms_gateways" value="Twillio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668092970/OjaFunnel-Images/vikbooking-smslive247-300x300_xixgv5.jpg" draggable="false" alt="">
                                                <span class="text-dark">SMSlive247</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#SMSlive247">
                                                <input type="radio"  name="sms_gateways" value="SMSlive247">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668075784/OjaFunnel-Images/images_fwr3hr.jpg" draggable="false" alt="">
                                                <span class="text-dark">InfoBip</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#InfoBip">
                                                <input type="radio" name="sms_gateways" value="InfoBip">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076174/OjaFunnel-Images/download_2_ynzs6z.jpg" draggable="false" alt="">
                                                <span class="text-dark">AWS</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#AWS">
                                                <input type="radio" name="sms_gateways" value="AWS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076411/OjaFunnel-Images/download_3_egam8e.jpg" draggable="false" alt="">
                                                <span class="text-dark">NigeriaBulkSms</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#NigeriaBulkSms">
                                                <input type="radio" name="sms_gateways" value="NigeriaBulkSms">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076897/OjaFunnel-Images/download_4_1_jiimts.jpg" draggable="false" alt="">
                                                <span class="text-dark">Multitexter</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Multitexter">
                                                <input type="radio" name="sms_gateways" value="Multitexter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="Edit" id="email">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Email Gateways - Your integration starter kit
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076174/OjaFunnel-Images/download_2_ynzs6z.jpg" draggable="false" alt="">
                                                <span class="text-dark">AWS SES</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailAWS">
                                                <input type="radio" name="sms_gateways" value="EmailAWS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('assets/images/sendgrid.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                                <span class="text-dark">SendGrid</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendgrid">
                                                <input type="radio"  name="sms_gateways" value="EmailSendgrid">
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668075784/OjaFunnel-Images/images_fwr3hr.jpg" draggable="false" alt="">
                                                <span class="text-dark">Mandrill</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#InfoBip">
                                                <input type="radio" name="sms_gateways" value="InfoBip">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('assets/images/sendinblue.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                                <span class="text-dark">Sendinblue</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendinblue">
                                                <input type="radio" name="sms_gateways" value="EmailSendinblue">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('assets/images/sendpulse.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                                <span class="text-dark">SendPulse</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailSendPulse">
                                                <input type="radio" name="sms_gateways" value="EmailSendPulse">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle"> 
                                                <img src="{{URL::asset('assets/images/mailjet.png')}}" style="height: 50px; width: 100px" draggable="false" alt="">
                                                <span class="text-dark">Mailjet</span>
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#EmailMailjet">
                                                <input type="radio" name="sms_gateways" value="EmailMailjet">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-2">
                </div> -->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->
<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>SID</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="ACe75dc47f94c7f33f7dd6128843c532ce" name="sid" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Token</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="8198fe19c3a7a410790b731e1e29fafa" name="token" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>From</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="+15735333364" name="from" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!-- end modal -->

<!-- Twillio modal -->
<div class="modal fade" id="Twillio" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Twilio integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.create')}}">
                            @csrf
                            <input name="type" value="Twilio" hidden>
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>SID</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="ACe75dc47f94c7f33f7dd6128843c532ce" name="sid" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Token</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="8198fe19c3a7a410790b731e1e29fafa" name="token" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>From</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="+15735333364" name="from" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!--Twillio end modal -->

<!-- SMSlive247 modal -->
<div class="modal fade" id="SMSlive247" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your SMSlive247 integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="text-center">SMSlive247 Coming Soon</h1>
            </div>
        </div>
    </div>
</div>
<!--Getresponse end modal -->

<!-- InfoBip modal -->
<div class="modal fade" id="InfoBip" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your InfoBip integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.create')}}">
                            @csrf
                            <div class="form">
                                <input name="type" value="InfoBip" hidden>
                                <div class="col-lg-12">
                                    <label>API KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="3e299022a25c9eb6c26d79bc0850dca3-39356585-14ef-4e9b-8e89-23ea015a616c" name="api_key" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>API BASE URL</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="9r3xk3.api.infobip.com" name="api_base_url" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!--InfoBip end modal -->

<!-- AWS modal -->
<div class="modal fade" id="AWS" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your AWS integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h1 class="text-center">AWS Coming Soon</h1>
            </div>
        </div>
    </div>
</div>
<!--AWS end modal -->

<!-- NigeriaBulkSms modal -->
<div class="modal fade" id="NigeriaBulkSms" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your NigeriaBulkSms integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.create')}}">
                            @csrf
                            <div class="form">
                                <input name="type" value="NigeriaBulkSms" hidden>
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Nigeriabulksms username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Nigeriabulksms password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!--NigeriaBulkSms end modal -->

<!-- Multitexter modal -->
<div class="modal fade" id="Multitexter" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Multitexter integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.create')}}">
                            @csrf
                            <div class="form">
                            <input name="type" value="Multitexter" hidden>
                                <div class="col-lg-12">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your multitexter username" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your multitexter password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>API KEY</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your multitexter api-key" name="api_key" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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
<!--Multitexter end modal -->

<!-- Emails modal -->
<div class="modal fade" id="EmailAWS" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your AWS SES integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typnumberext" placeholder="Your AWS SES SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your AWS SES SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on AWS SES</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                <input type="hidden" name="type" value="AWS SES" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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

<div class="modal fade" id="EmailSendgrid" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your SendGrid integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typenumberxt" placeholder="Your SendGrid SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendGrid SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on SendGrid</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                <input type="hidden" name="type" value="Sendgrid" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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

<div class="modal fade" id="EmailSendinblue" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Sendinblue integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="Your Sendinblue SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Sendinblue SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on Sendinblue</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                <input type="hidden" name="type" value="Sendinblue" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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

<div class="modal fade" id="EmailSendPulse" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your SendPulse integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type=numbert" placeholder="Your SendPulse SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your SendPulse SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on SendPulse</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                <input type="hidden" name="type" value="SendPulse" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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

<div class="modal fade" id="EmailMailjet" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Mailjet integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.email.create')}}">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Host</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Host" name="host" class="input" required>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-lg-12">
                                    <label>Username</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Username" name="username" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Password</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Password" name="password" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Port</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input typnumberext" placeholder="Your Mailjet SMTP Port" name="port" class="input" value=""> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Encryption</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP Encryption" name="encryption" class="input" readonly value="tls">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Mailjet SMTP MAIL FROM" name="from_email" class="input" required>
                                            <span style="color: green">Must be the verified domain on Mailjet</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-lg-12">
                                    <label>Mail FROM-NAME</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Your Brand Name" name="from_name" class="input" required>
                                        </div>
                                    </div> 
                                </div> 
                                <input type="hidden" name="type" value="Mailjet" required>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                            Save
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

<!-- END layout-wrapper -->
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, ducimus iste. Consequuntur doloremque voluptatem officia, quos laborum delectus atque distinctio reprehenderit earum iure. Sequi voluptate architecto libero, repellat neque deserunt assumenda sunt in sit ipsam delectus nostrum qui ratione. Laboriosam aliquid obcaecati vitae voluptatum ea minus quidem! Pariatur soluta quasi modi harum aut quas veritatis et. Necessitatibus fuga illo ipsa dicta aut nisi laborum nam at, id eveniet consectetur praesentium enim, cum dignissimos ipsum rem odio. Atque, eaque magni aut incidunt quo laudantium repudiandae quae modi officiis in, iusto suscipit fugiat rem inventore non dolorum adipisci rerum dolorem. Nulla, vero!
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
@endsection

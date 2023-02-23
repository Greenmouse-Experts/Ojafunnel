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
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Create Integrations </h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row cut">
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
                                                Twillio
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Twillio">
                                                <input type="radio" name="sms_gateways" value="Twillio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668092970/OjaFunnel-Images/vikbooking-smslive247-300x300_xixgv5.jpg" draggable="false" alt="">
                                                SMSlive247
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#SMSlive247">
                                                <input type="radio"  name="sms_gateways" value="SMSlive247">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668075784/OjaFunnel-Images/images_fwr3hr.jpg" draggable="false" alt="">
                                                InfoBip
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#InfoBip">
                                                <input type="radio" name="sms_gateways" value="InfoBip">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076174/OjaFunnel-Images/download_2_ynzs6z.jpg" draggable="false" alt="">
                                                AWS
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#AWS">
                                                <input type="radio" name="sms_gateways" value="AWS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076411/OjaFunnel-Images/download_3_egam8e.jpg" draggable="false" alt="">
                                                NigeriaBulkSms
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#NigeriaBulkSms">
                                                <input type="radio" name="sms_gateways" value="NigeriaBulkSms">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076897/OjaFunnel-Images/download_4_1_jiimts.jpg" draggable="false" alt="">
                                                Multitexter
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
                                            <input type="email" placeholder="Your multitexter username" name="email" class="input" required>
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
@endsection
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
            <div class="row begin">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Integrations </h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row cut">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b>
                                        Essentials - Your integration starter kit
                                    </b>
                                </p>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <p class="tell mb-4">
                                            <b>
                                                Sync Contacts
                                            </b>
                                        </p>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 790.png')}}" draggable="false" alt="">
                                                Mailmunch
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 793.png')}}" draggable="false" alt="">
                                                Getresponse

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 794.png')}}" draggable="false" alt="">
                                                Zapier

                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                <input type="radio">
                                            </div>
                                        </div>
                                        <p class="tell mb-4">
                                            <b>
                                                SMS Gateways
                                            </b>
                                        </p>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/twilio-icon.png')}}" draggable="false" alt="">
                                                Twillio
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Twillio">
                                                <input type="radio" name="Twillio" value="Twillio">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 793.png')}}" draggable="false" alt="">
                                                Getresponse
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Getresponse">
                                                <input type="radio"  name="Getresponse" value="Getresponse">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668075784/OjaFunnel-Images/images_fwr3hr.jpg" draggable="false" alt="">
                                                InfoBip
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#InfoBip">
                                                <input type="radio" name="InfoBip" value="InfoBip">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076174/OjaFunnel-Images/download_2_ynzs6z.jpg" draggable="false" alt="">
                                                AWS
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#AWS">
                                                <input type="radio" name="AWS" value="AWS">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076411/OjaFunnel-Images/download_3_egam8e.jpg" draggable="false" alt="">
                                                NigeriaBulkSms
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#NigeriaBulkSms">
                                                <input type="radio" name="NigeriaBulkSms" value="NigeriaBulkSms">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="circle">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668076897/OjaFunnel-Images/download_4_1_jiimts.jpg" draggable="false" alt="">
                                                Multitexter
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#Multitexter">
                                                <input type="radio" name="Multitexter" value="Multitexter">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
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
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                    Provide Us Your Twillio integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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

<!-- Getresponse modal -->
    <div class="modal fade" id="Getresponse" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Getresponse integration Starter Kit
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                <div class="row">
                    <div class="Edit-level">
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
                        <form method="POST" action="{{ route('user.integration.twilio.create')}}">
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
                                        <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
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
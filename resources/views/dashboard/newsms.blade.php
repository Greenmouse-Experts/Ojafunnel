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
                        <h4 class="mb-sm-0 font-size-18">SMS Campaign</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">SMS Campaign</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- start page title -->
            <div class="row card account-head">
                <div class="col-lg-12">
                    <h4 class="font-500">New SMS Campaign</h4>
                    <p>
                        Send SMS to your new customer and those on your mailing list
                    </p>
                </div>
            </div>
            <!-- account container form -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="Edit">
                        <form method="POST" action="{{ route('user.sms.sendmessage.campaign')}}">
                            @csrf
                            <input type="hidden" name="sms_type" value="plain">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Campaign Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Campaign Name" name="campaign_name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sender Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Sender Name" name="sender_name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>SMS Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea name="message" id="message" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below " maxlength="160"></textarea>
                                                <div class="messageCounter"><span id="chars">160</span> characters</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-3 mb-4 justify-content-between">
                                        <div class="col-4">
                                            <p class="font-500 fs-6">Recipients:</p>
                                        </div>
                                        <div class="col-8">
                                            <select name="mailinglist_id" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                <option value="">Choose from mailing list</option>
                                                @if($contact_lists->isEmpty())
                                                <option value="">No Mailing List</option>
                                                @else
                                                @foreach($contact_lists as $contact_list)
                                                <option value="{{$contact_list->id}}">{{$contact_list->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea name="contacts" cols="30" rows="5" placeholder="Add phone number manually E.g: +234 8000 111 333 "></textarea>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <label>Opt Out Message </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter opt out message eg text stop to 12344" name="optout_message" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                Send SMS:
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timimg" value="Immediately" style="display: inline-block !important; width: auto;" onclick="show1();" /> Immediately</label>
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timimg" value="Schedule" style="display: inline-block !important; width: auto;" onclick="show2();" /> Schedule</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12" id="schedule" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Date</label>
                                                <input type="date" name="schedule_date" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Time</label>
                                                <input type="Time" name="schedule_time" />
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <label for="">Frequency</label>
                                                <select name="frequency_cycle" id="selectFrenquncy" onchange="frequencyChange()">
                                                    <option value="onetime">One time</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="monthly">Monthly</option>
                                                    <option value="yearly">Yearly</option>
                                                    <option value="custom">Custom</option>
                                                </select>
                                            </div>
                                            <div id="frq_custom" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6 mt-5" >
                                                        <label for="Frq_amount">Frequency Amount</label>
                                                        <input type="text" name="frequency_amount" />
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">Frequency Unit</label>
                                                        <select name="frequency_unit" >
                                                            <option value="day">Day</option>
                                                            <option value="week">Week</option>
                                                            <option value="month">Month</option>
                                                            <option value="year">Year</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="end_period" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6 mt-5" >
                                                        <label for="Time">End Date</label>
                                                        <input type="date" name="recurring_date" />
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">End Time</label>
                                                        <input type="Time" name="recurring_time" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="boding">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#chooseIntegrationGateway">
                                                    Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- email chooseGateway modal -->
                                <div class="modal fade" id="chooseIntegrationGateway" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header border-bottom-0">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    Provide Us Your Option For Integration
                                                </h5>
                                                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="Edit">
                                                        <div class="form">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        @if($integrations->isEmpty())
                                                                        <div class="col-12">
                                                                            <div class="circle" style="padding: 20px 20px 20px 2px; text-align: center;">
                                                                                No SMS Integration Gateway Added
                                                                            </div>
                                                                        </div>
                                                                        @else
                                                                        @foreach($integrations as $integration)
                                                                        <div class="col-md-6">
                                                                            <div class="circle" style="padding: 20px 20px 20px 20px;">
                                                                                {{$integration->type}}
                                                                            </div>
                                                                            <div class="zazu">
                                                                                <input type="radio" name="integration" value="{{$integration->type}}" style="margin-top: -70px !important;">
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                        @endif
                                                                        <div class="row">
                                                                            <div class="col-6 text-center">
                                                                                <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                    Cancel
                                                                                </a>
                                                                            </div>
                                                                            <div class="col-6 text-center">
                                                                                <button class="btn px-4" type="submit" style="color: #ffffff; background-color: #714091">
                                                                                    Send SMS
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
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
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <botton class="open" onclick="myFunction()">
                        Open Preview
                    </botton>
                    <div class="row" id="preview" style="display: none;">
                        <div class="Edit">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="master">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1669370587/OjaFunnel-Images/Frame_46722_vzkyft.png" draggable="false" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <div class="insert">
                                                        <textarea id="showMessage" cols="30" rows="10" placeholder="Enter Your Message" disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content ---->
</div>
<!-- END layout-wrapper -->


<!-- smsModal -->
<div class="modal fade" id="smsSuccess" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="assets/image/theme.png" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>
                        <b>
                            You’ve succesfully sent your SMS to the recipient(s)
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection

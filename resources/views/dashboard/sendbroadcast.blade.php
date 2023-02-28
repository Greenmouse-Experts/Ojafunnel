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
                    <div class="card begin account-head mb-4">
                        <div class="">
                            <h4 class="font-500">WhatsApp Automation</h4>
                            <p>
                                Send instant, scheduled or automated messages to your contact
                            </p>
                        </div>
                        <div class="d-flex account-nav">
                            <p class="ps-0 active">New Campaign</p>
                            {{-- <p>
                                <a href="#" class="text-decoration-none text-dark">Recieved Messages</a>
                            </p>
                            <p>
                                <a href="#" class="text-decoration-none text-dark">Sent Campaigns</a>
                            </p>
                            <p>
                                <a href="#" class="text-decoration-none text-dark">Auto Reply</a>
                            </p>
                            <p>

                            </p>
                            <p class="ps-0">
                                <a href="#" class="text-decoration-none text-dark">Settings</a>
                            </p> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <form method="POST" action="{{ route('user.sms.sendmessage.campaign')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sms_type" value="whatsapp">
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b>
                                            Send Brodcast Messsage
                                        </b>
                                    </p>
                                    <div class="col-lg-12">
                                        <label>Campaign Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Campaign Name" name="campaign_name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Senders Account :</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="text" placeholder="Enter Sender Name" name="sender_name" class="input">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sending List :</label>
                                        <div class="col-md-12 mb-4">
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
                                    <div class="col-lg-12">
                                        <label>Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea placeholder="Type in your message" name="message" id="" cols="30" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <p>
                                            Upload Attachment :
                                        </p>
                                    </div>
                                    <div class="logo-input w-full px-5 py-4 pb-5">
                                        <p>
                                            <b>
                                                Attach, images, videos, audios or files
                                            </b>
                                        </p>
                                        <div class="logo-input2 border-in py-5 px-2">
                                                <div class="avatar">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                </div>
                                            <div class="logo-file">
                                                <input type="file" accept="image" name="mms_file" id=""
                                                    class="mt-4 w-100" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                Send WhatsApp:
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
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#chooseIntegrationGateways">
                                                        Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="chooseIntegrationGateways" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                                                                        Send WhatsApp
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
                                    <!-- <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button>
                                                        <a href="" style="color: #fff;">
                                                            Update Setting
                                                        </a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>

<!-- END layout-wrapper -->

<!-- smsModal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Automate Message(s)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <div class="form">
                            <div class="col-lg-12">
                                <label>Message 1</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="tel" placeholder="+234 800 000 0000" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>When To Send</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="number" value="1" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Time (GMT)</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="datetime" placeholder="Hrs/Mins" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Edit-level">
                        <div class="form">
                            <div class="col-lg-12">
                                <label>Message 2</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="tel" placeholder="+234 800 000 0000" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Message Period</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="number" value="1" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <label>Time (GMT)</label>
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <input type="datetime" placeholder="Hrs/Mins" name="name" class="input" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-4">
                                    <a href="#" class="text-decoration-none">
                                        <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button></a>
                                </div>
                                <div class="col-8 text-end">
                                    <a href="#" class="text-decoration-none">
                                        <button class="btn px-4" style="color: #ffffff; background-color: #714091">
                                            Start Message Automation
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
<!-- end modal -->
@endsection

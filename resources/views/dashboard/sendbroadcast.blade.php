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
                        <form method="POST" action="{{ route('user.send.broadcast.create', ['username' => Auth::user()->username])}}" enctype="multipart/form-data">
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
                                                <input type="text" placeholder="Enter Campaign Name" name="campaign_name" value="{{ old('campaign_name') }}" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>WA Senders Account :</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="whatsapp_account" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                        <option value="">Choose from conneted WA Account list</option>
                                                        @forelse ($whatsapp_numbers as $whatsapp_number)
                                                            @php
                                                                $wa_account_val = $whatsapp_number['id'] . '-' . $whatsapp_number['phone_number'] . '-' . $whatsapp_number['status'] . '-' . $whatsapp_number['full_jwt_session'];
                                                            @endphp
                                                            @if (old('whatsapp_account') == $wa_account_val)
                                                                <option value="{{ $whatsapp_number['id'] }}-{{ $whatsapp_number['phone_number'] }}-{{ $whatsapp_number['status'] }}-{{ $whatsapp_number['full_jwt_session'] }}" selected>
                                                                    {{ $whatsapp_number['phone_number'] }} ({{ $whatsapp_number['status'] }})
                                                                </option>
                                                            @else
                                                                <option value="{{ $whatsapp_number['id'] }}-{{ $whatsapp_number['phone_number'] }}-{{ $whatsapp_number['status'] }}-{{ $whatsapp_number['full_jwt_session'] }}">
                                                                    {{ $whatsapp_number['phone_number'] }} ({{ $whatsapp_number['status'] }})
                                                                </option>
                                                            @endif
                                                        @empty
                                                            <option value="" disabled>No WA account found</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Sending List :</label>
                                        <div class="col-md-12 mb-4">
                                            <select name="contact_list" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                <option value="">Choose from contact list</option>
                                                @if($contact_lists->isEmpty())
                                                    <option value="">No Contact List</option>
                                                @else
                                                @foreach($contact_lists as $contact_list)
                                                    <option value="{{$contact_list->id}}"
                                                        {{ old('contact_list') == $contact_list->id ? "selected" : "" }}>
                                                        {{$contact_list->name}}
                                                    </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                Send WhatsApp:
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4 col-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" id="message_timing_immediately" value="Immediately" style="display: inline-block !important; width: auto;" onclick="show1();" {{ old('message_timing') == 'Immediately' ? "checked" : "" }} /> Immediately</label>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" id="message_timing_schedule" value="Schedule" style="display: inline-block !important; width: auto;" onclick="show2();" {{ old('message_timing') == 'Schedule' ? "checked" : "" }} /> Schedule</label>
                                            </div>
                                            <div class="col-md-4 col-4">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" id="message_timing_series" value="Series" style="display: inline-block !important; width: auto;" onclick="show3();" {{ old('message_timing') == 'Series' ? "checked" : "" }} /> Series</label>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Immediately --}}
                                    <div id="immediately" style="display: none">
                                        <div class="col-lg-12" id="select-template">
                                            <label>Message Template :</label>
                                            <div class="col-md-12 mb-4">
                                                <select class="bg-light w-100 py-2 rounded px-2 fs-6" id="template" name="template">
                                                    <option value="">Choose from template</option>
                                                    <option value="template1" {{ old('template') == 'template1' ? "selected" : "" }}>
                                                        Template 1 (Text)
                                                    </option>
                                                    <option value="template2" {{ old('template') == 'template2' ? "selected" : "" }}>
                                                        Template 2 (Text & File)
                                                    </option>
                                                    <option value="template3" {{ old('template') == 'template3' ? "selected" : "" }}>
                                                        Template 3 (Header, Text, Footer, Link & Call)
                                                    </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Template 1 -->
                                        <div id="template1" style="display: none;">
                                            <div class="col-lg-12">
                                                <label>Message</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <textarea placeholder="Type in your message" name="template1_msg" id="" cols="30" rows="4">{{ !is_array(old('template1_message')) ? old('template1_message') : '' }}</textarea>
                                                        <p>
                                                            <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="template2" style="display: none;">
                                            <div class="col-lg-12">
                                                <label>Message</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <textarea placeholder="Type in your message" name="template2_message" id="" cols="30" rows="4">{{ @old('template2_message') }}</textarea>
                                                        <p>
                                                            <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                        </p>
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
                                                        <input type="file" accept="image" name="template2_file" id=""
                                                            class="mt-4 w-100" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="template3" style="display: none;">
                                            <div class="col-lg-12">
                                                <label>Header</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" placeholder="Enter message header" name="template3_header" class="input" value="{{ @old('template3_header') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-4">
                                                <label>Message</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <textarea placeholder="Type in your message" name="template3_message" id="" cols="30" rows="4">{{ old('template3_message') }}</textarea>
                                                        <p>
                                                            <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <label>Footer</label>
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" placeholder="Enter message footer" name="template3_footer" class="input" value="{{ old('template3_footer') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <label>Link</label>
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <input type="text" placeholder="Enter link url" name="template3_link_url" class="input" value="{{ old('template3_link_url') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input type="text" placeholder="Enter link CTA" name="template3_link_cta" class="input" value="{{ old('template3_link_cta') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <label>Phone</label>
                                                <div class="row">
                                                    <div class="col-md-6 mb-4">
                                                        <input type="text" placeholder="Enter phone number" name="template3_phone_number" class="input" value="{{ old('template3_phone_number') }}">
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <input type="text" placeholder="Enter phone CTA" name="template3_phone_cta" class="input" value="{{ old('template3_phone_cta') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    {{-- Schedule --}}
                                    <div class="col-12" id="schedule" style="display: none;">
                                        <div class="col-lg-12">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <textarea placeholder="Type in your message" name="template1_msg" id="" cols="30" rows="4">{{ (!is_array(old('template1_message') )) ? old('template1_message') : ''}}</textarea>
                                                    <p>
                                                        <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Start Date</label>
                                                <input type="date" name="start_date" value="{{ old('start_date') }}" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Start Time</label>
                                                <input type="Time" name="start_time" value="{{ old('start_time') }}" />
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <label for="">Frequency</label>
                                                <select name="frequency_cycle" id="selectFrenquncy" onchange="frequencyChange()">
                                                    <option value="onetime" {{ old('frequency_cycle') == 'onetime' ? "selected" : "" }}>
                                                        One time
                                                    </option>
                                                    <option value="daily" {{ old('frequency_cycle') == 'daily' ? "selected" : "" }}>Daily</option>
                                                    <option value="weekly" {{ old('frequency_cycle') == 'weekly' ? "selected" : "" }}>Weekly</option>
                                                    <option value="monthly" {{ old('frequency_cycle') == 'monthly' ? "selected" : "" }}>
                                                        Monthly
                                                    </option>
                                                    <option value="yearly" {{ old('frequency_cycle') == 'yearly' ? "selected" : "" }}>Yearly</option>
                                                    <option value="custom" {{ old('frequency_cycle') == 'custom' ? "selected" : "" }}>Custom</option>
                                                </select>
                                            </div>
                                            <div id="frq_custom" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-6 mt-5" >
                                                        <label for="Frq_amount">Frequency Amount</label>
                                                        <input type="text" name="frequency_amount" value="{{ old('frequency_amount') }}"/>
                                                    </div>
                                                    <div class="col-md-6 mt-5">
                                                        <label for="Time">Frequency Unit</label>
                                                        <select name="frequency_unit" >
                                                            <option value="day" {{ old('frequency_unit') == 'day' ? "selected" : "" }}>Day</option>
                                                            <option value="week" {{ old('frequency_unit') == 'week' ? "selected" : "" }}>Week</option>
                                                            <option value="month" {{ old('frequency_unit') == 'month' ? "selected" : "" }}>
                                                                Month
                                                            </option>
                                                            <option value="year" {{ old('frequency_unit') == 'year' ? "selected" : "" }}>
                                                                Year
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <label>Notify Every new members</label>
                                                <select name="notify_every_newcontact">
                                                    <option value="false">No</option>
                                                    <option value="true">Yes</option>
                                                </select>
                                            </div>
                                            <div id="end_period" class="col-md-12" style="display: none;">
                                                <div class="row">
                                                    <div class="col-md-12 mt-5" >
                                                        <label for="Time">End Date</label>
                                                        <input type="date" name="end_date" value="{{ old('end_date') }}" />
                                                    </div>
                                                    {{-- <div class="col-md-6 mt-5">
                                                        <label for="Time">End Time</label>
                                                        <input type="Time" name="end_time" />
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Series --}}
                                    <div class="col-12" id="series" style="display: none;">
                                        <fieldset id="series-container" class="row series-row mb-2" style="border: 1px solid #cdd1dc;">
                                            {{-- <div class="col-md-6 mt-4">
                                                <label for="Time">Date</label>
                                                <input type="date" name="series_date[]" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Time</label>
                                                <input type="Time" name="series_time[]" />
                                            </div> --}}

                                            <div class="col-md-12 mt-4">
                                                <label for="days">Select Day</label>
                                                <select class="bg-light w-100 py-2 rounded px-2 fs-6" name="days[]">
                                                    <option value="immediately_joined">Immediately Joined</option>
                                                    <option value="sameday_joined">Same Day Joined</option>
                                                    @for($i=1; $i<1001; $i++)
                                                        <option value="{{$i}}"> Day {{$i}} </option>
                                                    @endfor
                                                </select>
                                            </div>

                                            {{-- <div class="col-lg-12" id="select-series-template">
                                                <label>Message Template :</label>
                                                <div class="col-md-12 mb-4">
                                                    <select class="bg-light w-100 py-2 rounded px-2 fs-6" id="template" name="template">
                                                        <option value="">Choose from template</option>
                                                        <option value="template1" {{ old('template') == 'template1' ? "selected" : "" }}>
                                                            Template 1 (Text)
                                                        </option>
                                                        <option value="template2" {{ old('template') == 'template2' ? "selected" : "" }}>
                                                            Template 2 (Text & File)
                                                        </option>
                                                        <option value="template3" {{ old('template') == 'template3' ? "selected" : "" }}>
                                                            Template 3 (Header, Text, Footer, Link & Call)
                                                        </option>
                                                    </select>
                                                </div>
                                            </div> --}}

                                            <!-- templates -->
                                                <div class="col-lg-12">
                                                    <label>Message</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <textarea placeholder="Type in your message" name="template1_message[]" id="" cols="30" rows="4">{{ (!is_array(old('template1_message') )) ? old('template1_message') : '' }}</textarea>
                                                            <p>
                                                                <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            <!-- end of templates -->


                                            <!-- <button class="mb-2 remove-series" style="width: 25%;" type="button">Remove</button> -->
                                        </fieldset>
                                        <!-- Additional Rows -->
                                        <div class="additional-rows"></div>
                                        <div style="display: flex; justify-content: space-between;">
                                            <button class="add-series" type="button">Add More</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <a href="#">
                                                        <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                            Cancel
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="boding">
                                                    <button type="submit" name="submit">
                                                        Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="modal fade" id="chooseIntegrationGateways" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                    </div> --}}
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
<script>
    const template = document.getElementById('template');

    const template1 = document.getElementById('template1');
    const template2 = document.getElementById('template2');
    const template3 = document.getElementById('template3');

    template.addEventListener('change', function handleChange(event) {
        if (event.target.value === 'template1') {
            template1.style.display = 'block';
            template2.style.display = 'none';
            template3.style.display = 'none';
        } else if (event.target.value === 'template2') {
            template1.style.display = 'none';
            template2.style.display = 'block';
            template3.style.display = 'none';
        } else if (event.target.value === 'template3') {
            template1.style.display = 'none';
            template2.style.display = 'none';
            template3.style.display = 'block';
        } else {
            template1.style.display = 'none';
            template2.style.display = 'none';
            template3.style.display = 'none';
        }
    });



    const addseriesField = document.getElementById('add-series');
    // addseriesField.addEventListener('click',  function handleClick(e) {
    //     console.log(e);
    //     const seriesFieldSet = document.getElementByClassName('series-row');
    //     console.log(seriesFieldSet[0]);
    // });

    // addseriesField.addEventListener('click', function() {
    //     const form = document.getElementById('series-container');
    //     document.getElementById('additional-rows').appendChild(form);
    // });

    $(document).ready(function() {
        // Add a new row when "Add More" button is clicked
        $('.add-series').click(function() {
            var clonedRow = $('.series-row:first').clone();
            // Clear the values in the cloned row
            clonedRow.find('input, textarea').val('');
            // Remove button for the cloned row
            clonedRow.find('.remove-series').remove();
            // Append the cloned row to the container
            $('.additional-rows').append(clonedRow);
            // Add the "Remove" button to the cloned row
            $('.additional-rows .row:last').append('<button class="mb-2 remove-series" style="width: 25%;" type="button">Remove</button>');
            // Show the cloned row
            clonedRow.show();
        });


        // Remove the corresponding row when "Remove" button is clicked
        $(document).on('click', '.remove-series', function() {
            $(this).closest('.series-row').remove();
        });

        // Update character count when typing in any series message textarea
        $(document).on('keyup', '.series-message', function() {
            var characterCount = $(this).val().length;
            var current = $(this).siblings('.messageCounter').find('.series-characters');
            current.text(characterCount);
            // Add your character count styling logic here if needed
        });
    });

    function templateToggle() {
        const template = document.getElementById('template')

        if (template.value === 'template1') {
            template1.style.display = 'block';
            template2.style.display = 'none';
            template3.style.display = 'none';
        } else if (template.value === 'template2') {
            template1.style.display = 'none';
            template2.style.display = 'block';
            template3.style.display = 'none';
        } else if (template.value === 'template3') {
            template1.style.display = 'none';
            template2.style.display = 'none';
            template3.style.display = 'block';
        } else {
            template1.style.display = 'none';
            template2.style.display = 'none';
            template3.style.display = 'none';
        }
    }

    function scheduleToggle() {
        let schedule = document.getElementById('message_timing_schedule');

        if (schedule.checked == true){
            document.getElementById('schedule').style.display = 'block';
        }
    }

    function frquencyToggle() {
       let selectFrenquncy = document.getElementById('selectFrenquncy')

       if(selectFrenquncy.value == 'daily' || selectFrenquncy.value == 'weekly' || selectFrenquncy.value == 'monthly' || selectFrenquncy.value == 'yearly' || selectFrenquncy.value == 'custom') {
        document.getElementById('end_period').style.display = 'block'
       }

       if(selectFrenquncy.value == 'custom'){
            document.getElementById('frq_custom').style.display = 'block';
       }
    }

    frquencyToggle()
    scheduleToggle()
    templateToggle()

    function show1() {
        document.getElementById('schedule').style.display=  'none';
        document.getElementById('series').style.display = 'none';
        document.getElementById('immediately').style.display = 'block';
    }

    function show2() {
        document.getElementById('schedule').style.display=  'block';
        document.getElementById('series').style.display = 'none';
        document.getElementById('immediately').style.display = 'none';
    }

    function show3() {
        document.getElementById('schedule').style.display=  'none';
        document.getElementById('series').style.display = 'block';
        document.getElementById('immediately').style.display = 'none';
    }
</script>
@endsection

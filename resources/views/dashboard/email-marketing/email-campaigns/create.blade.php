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
                            <h4 class="font-500">Email Campaign</h4>
                            <p>
                                Send instant, scheduled or automated email to your contact
                            </p>
                        </div>
                        <div class="d-flex account-nav">
                            <p class="ps-0 active">New Campaign</p> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <form method="POST" action="{{ route('user.email-marketing.email.campaigns.save', ['username' => Auth::user()->username ]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sms_type" value="whatsapp">
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b>
                                            Send Email Campaign
                                        </b>
                                    </p>
                                    <div class="col-lg-12">
                                        <label>Campaign Name:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign name" name="name" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Subject:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign subject" name="subject" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>ReplyTo Email:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign replyto email" name="replyto_email" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>ReplyTo Name:</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter campaign replyto name" name="replyto_name" class="input">
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <label>Email kit:</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="email_kit" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                        <option value="">Choose from email kit</option> 
                                                        @forelse ($email_integrations as $email_integration) 
                                                            <option value="{{ $email_integration->id }}">
                                                                {{  $email_integration->host }} ({{  $email_integration->type }}) {{ $email_integration->is_admin ? '[ADMIN KIT]': '' }}
                                                            </option> 
                                                        @empty
                                                            {{ 'No email kit at the moment. Please add new kit' }}
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <label>Email template:</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="email_template" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                        <option value="">Choose from email template</option> 
                                                        @forelse ($email_templates as $email_template) 
                                                            <option value="{{ $email_template->id }}">
                                                             {{  $email_template->name }} 
                                                            </option> 
                                                        @empty
                                                            {{ 'No email template at the moment. Please add new template' }}
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email list:</label>
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select name="email_list" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                                        {{-- mail_lists --}}
                                                        <option value="">Choose from email list</option>
                                                        @forelse ($mail_lists as $mail_list) 
                                                            <option value="{{ $mail_list->id }}">
                                                                {{  $mail_list->name }} 
                                                            </option> 
                                                        @empty
                                                            {{ 'No email list at the moment. Please add new mail list' }}
                                                        @endforelse 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12">
                                        <p>
                                            Upload Attachments:
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
                                                <input type="file" name="attachments[]" id="" multiple/>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="col-12 mb-4">
                                        <div class="row">
                                            <div class="col-md-4 col-12">
                                                Send Email:
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Immediately" style="display: inline-block !important; width: auto;" onclick="show1();" /> Immediately</label>
                                            </div>
                                            <div class="col-md-4 col-6">
                                                <label style="margin-left: 0px"><input type="radio" name="message_timing" value="Schedule" style="display: inline-block !important; width: auto;" onclick="show2();" /> Schedule</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-12" id="schedule" style="display: none;">
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Start Date</label>
                                                <input type="date" name="start_date" />
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="Time">Start Time</label>
                                                <input type="Time" name="start_time" />
                                            </div>
                                            <div class="col-md-12 mt-5">
                                                <label for="">Frequency</label>
                                                <select name="frequency_cycle" id="selectFrenquncy" onchange="frequencyChange()">
                                                    <option value="onetime">One time</option>
                                                    <option value="daily">Daily</option>
                                                    <option value="weekly">Weekly</option>
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
                                                    <div class="col-md-12 mt-5" >
                                                        <label for="Time">End Date</label>
                                                        <input type="date" name="end_date" />
                                                    </div>
                                                    {{-- <div class="col-md-6 mt-5">
                                                        <label for="Time">End Time</label>
                                                        <input type="Time" name="end_time" />
                                                    </div> --}}
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
                                                    <button type="submit" name="submit">
                                                        Proceed
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
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
@endsection

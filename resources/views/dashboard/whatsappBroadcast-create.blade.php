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
                            <h4 class="font-500">WhatsApp Broadcast</h4>
                            <p>
                                Send broacast messages to your contact
                            </p>
                        </div>
                        <div class="d-flex account-nav">
                            <p class="ps-0 active">New Broadcast</p>
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
                        <form method="POST" action="{{ route('wa-automation.broadcast.create', ['username' => Auth::user()->username])}}" enctype="multipart/form-data">
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

                                    <div class="col-lg-12">
                                        <label>Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea placeholder="Type in your message" name="template1_msg_series" id="" cols="30" rows="4">{{ (!is_array(old('template1_message') )) ? old('template1_message') : ''}}</textarea>
                                                <p>
                                                    <b>$name</b> can be used in this message. <b>NB:</b> Name must have been added in the contact list to use this feature.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="row">
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

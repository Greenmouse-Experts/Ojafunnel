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
                        <h4 class="mb-sm-0 font-size-18">Create List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Create List </h4>
                            <p>
                                Create and do many more with your mail list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <a href="#">
                                <button>+ Create List  </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="Edit">
                        <form action="{{route('user.create_list', Auth::user()->username)}}"" method="post">
                            {{ csrf_field() }}
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b class="mb-sm-0 font-size-15">Edit Your Mail List</b>
                                    </p>
                                    <p>
                                     <b> Identity  </b>
                                    </p>
                                    <div class="col-lg-6">
                                        <label>Name <span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Names" name="name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>From Email <span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="email" placeholder="From Email" name="from_email" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Default From name <span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Default from name" name="from_name" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Default Email subject <span>*</span> </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="email" placeholder="Default Email subject" name="default_subject" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                     <b> Contact Information  </b>
                                    </p>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[company]', 'placeholder' => 'Enter company name', 'label' => "Company / organization", 'value' => $list->contact->company, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[state]', 'placeholder' => 'Enter state', 'label' => 'State / Province / Region', 'value' => $list->contact->state, 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[address_1]', 'placeholder' => 'Enter address 1', 'label' => "Address 1", 'value' => $list->contact->address_1, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[city]', 'placeholder' => 'Enter city', 'label' => "City", 'value' => $list->contact->city, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[address_2]', 'placeholder' => 'Enter address 2', 'label' => 'Address 2', 'value' => $list->contact->address_2, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[zip]', 'placeholder' => 'Enter zip code', 'label' => "Zip / Postal code", 'value' => $list->contact->zip, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'select', 'name' => 'contact[country_id]', 'label' => 'Country', 'value' => $list->contact->country_id, 'options' => App\Models\Country::getSelectOptions(), 'include_blank' => "Choose country", 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[phone]', 'placeholder' => "Enter phone number", 'label' => "Phone Number", 'value' => $list->contact->phone, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[email]', 'label' => "Email", 'placeholder' => "Enter email", 'value' => $list->contact->email, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'contact[url]', 'label' => 'url', 'label' => "Home page", 'placeholder' => "Enter home page", 'value' => $list->contact->url, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <p class="tell mb-4">
                                        <b class="mb-sm-0 font-size-15">Settings</b>
                                    </p>
                                    <p>
                                        <b>Subscriptions</b>
                                    </p>

                                    <div class="col-md-6 hide">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'email_subscribe', 'value' => $list->email_subscribe, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'email_unsubscribe', 'value' => $list->email_unsubscribe, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                        <br />
                                    </div>

                                    <style>
                                        .hide{
                                            display: none;
                                        }
                                    </style>
                                    {{-- <input type="hidden" name="subscribe_confirmation" value="1" /> --}}
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <p class="send">
                                                Send subscription confirmation email (Double Opt-in)

                                                 @if ($allowedSingleOptin)
                                                    @include('helpers.form_control', [
                                                        'type' => 'checkbox',
                                                        'name' => 'subscribe_confirmation',
                                                        'value' => $list->subscribe_confirmation,
                                                        'options' => [false,true],
                                                        'help_class' => 'list',
                                                        'rules' => App\Models\MailList::$rules
                                                    ])
                                                    {{-- <input type="checkbox" name="subscribe_confirmation" value="{{$list->subscribe_confirmation}}"> --}}
                                                @else
                                                    <input type="hidden" name="subscribe_confirmation" value="1" />
                                                @endif
                                                 <div class="when">When people subscribe to your list, send them a subscription confirmation email.</div>
                                            </p>
                                            <p class="send">
                                                Send unsubscribe notification to subscribers
                                                @include('helpers.form_control', ['type' => 'checkbox', 'name' => 'unsubscribe_notification', 'value' => $list->unsubscribe_notification, 'options' => [false,true], 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                                 <div class="when">Send subscribers a final “Goodbye” email to let them know they have unsubscribed.</div>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="send">
                                                Send a final welcome email
                                                @include('helpers.form_control', ['type' => 'checkbox', 'name' => 'send_welcome_email', 'value' => $list->send_welcome_email, 'options' => [false,true], 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                                 <div class="when">When people opt-in to your list, send them an email welcoming them to your list. The final welcome email can be edited in the List -> Forms / Pages management</div>
                                            </p>
                                        </div>
                                    </div>
                                    @if (Auth::user()->customer->can('create', \App\Models\SendingServer::class))
                                    <div class="sub_section">
                                        <p class="tell mb-4">
                                            <b class="mb-sm-0 font-size-15">Sending servers</b>
                                        </p>
                                        <div class="row mb-20 form-groups-bottom-0">
                                            <div class="col-md-12">
                                                <p class="sending">
                                                @include('helpers.form_control', ['type' => 'checkbox2',
                                                    'class' => '',
                                                    'name' => 'all_sending_servers',
                                                    'value' => $list->all_sending_servers,
                                                    'label' => "Use all sending servers",
                                                    'options' => [false,true],
                                                    'help_class' => 'list',
                                                    'rules' => App\Models\MailList::$rules
                                                ])
                                                </p>
                                            </div>
                                        </div>
                                        @if(!\Auth::user()->customer->activeSendingServers()->count())
                                            <div class="alert alert-danger mt-3">
                                                {!! trans('messages.list.there_no_subaccount_sending_server') !!}
                                            </div>
                                        @else
                                            <div class="sending-servers">
                                                <hr>
                                                <div class="row text-muted text-semibold">
                                                    <div class="col-md-3">
                                                        <label>Select sending server</label>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>SMTP</label>
                                                    </div>
                                                </div>
                                                @foreach (\Auth::user()->customer->activeSendingServers()->orderBy("name")->get() as $server)
                                                    <div class="row mb-5 form-groups-bottom-0">
                                                        <div class="col-md-3">
                                                            @include('helpers.form_control', [
                                                                'type' => 'checkbox2',
                                                                'name' => 'sending_servers[' . $server->uid . '][check]',
                                                                'value' => $list->mailListsSendingServers->contains('sending_server_id', $server->id),
                                                                'label' => $server->name,
                                                                'options' => [false, true],
                                                                'help_class' => 'list',
                                                                'rules' => App\Models\MailList::$rules
                                                            ])
                                                        </div>
                                                        <div class="col-md-3" show-with-control="input[name='{{ 'sending_servers[' . $server->uid . '][check]' }}']">
                                                            @include('helpers.form_control', [
                                                                'type' => 'text',
                                                                'class' => 'numeric',
                                                                'name' => 'sending_servers[' . $server->uid . '][fitness]',
                                                                'label' => '',
                                                                'value' => (is_object($list->mailListsSendingServers()->where('sending_server_id', $server->id)->first()) ? $list->mailListsSendingServers()->where('sending_server_id', $server->id)->first()->fitness : "100"),
                                                                'help_class' => 'list',
                                                                'rules' => App\Models\MailList::$rules
                                                            ])
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <script>
                                        $(document).ready(function() {
                                            // all sending servers checking
                                            $(document).on("change", "input[name='all_sending_servers']", function(e) {
                                                if($("input[name='all_sending_servers']:checked").length) {
                                                    $(".sending-servers").find("input[type=checkbox]").each(function() {
                                                        if($(this).is(":checked")) {
                                                            $(this).parents(".form-group").find(".switchery").eq(1).click();
                                                        }
                                                    });
                                                    $(".sending-servers").hide();
                                                } else {
                                                    $(".sending-servers").show();
                                                }
                                            });
                                            $("input[name='all_sending_servers']").trigger("change");
                                        });
                                    </script>
                                @endif

                                <script>
                                    $(document).ready(function() {
                                        // auto fill
                                        // var box = $('#sender_from_input').autofill({
                                        //     messages: {
                                        //         header_found: '{{ trans('messages.sending_identity') }}',
                                        //         header_not_found: '{{ trans('messages.sending_identity.not_found.header') }}'
                                        //     }
                                        // });
                                        // box.loadDropbox(function() {
                                        //     $('#sender_from_input').focusout();
                                        //     box.updateErrorMessage();
                                        // });
                                    });
                                </script>

                                    <div class="row">
                                        <div class="col-lg-1">
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
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
@endsection

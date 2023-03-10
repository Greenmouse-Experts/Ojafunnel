@extends('layouts.dashboard-email-frontend')

@section('page-content')
@include('sweetalert::alert')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">List Setting</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">List Setting</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">List Setting </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card all-create account-head">
                        <nav aria-label="Page navigation example normal float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{route('user.list.performance', Auth::user()->username)}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('dashboard.list.list-layout')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="Edit">
                        <form action="{{route('user.update_list', ["username" => Auth::user()->username, "uid" => $list->uid])}}"" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form">
                                <div class="row">
                                    <p class="tell mb-4">
                                        <b class="mb-sm-0 font-size-15">Edit Your Mail List</b>
                                    </p>
                                    <p>
                                        <b> Identity  </b>
                                    </p>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'name', 'label' => 'Name', 'value' => $list->name, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <div class="hiddable-cond" data-control="[name=use_default_sending_server_from_email]" data-hide-value="1">
                                            @include('helpers.form_control', [
                                                'type' => 'autofill',
                                                'id' => 'sender_from_input',
                                                'name' => 'from_email',
                                                'label' => 'From Email',
                                                'value' => $list->from_email,
                                                'help_class' => 'list',
                                                'rules' => App\Models\MailList::$rules,
                                                'url' => action('SenderController@dropbox'),
                                                'empty' => trans('messages.sender.dropbox.empty'),
                                                'error' => trans('messages.sender.dropbox.error', [
                                                'sender_link' => route('user.sender.index', Auth::user()->username),
                                                ]),
                                                'header' => trans('messages.verified_senders'),
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'from_name', 'label' => "Default From name", 'value' => $list->from_name, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        @include('helpers.form_control', ['type' => 'text', 'name' => 'default_subject', 'label' => "Default Email subject", 'value' => $list->default_subject, 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
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
                                            </p>
                                            <p class="send">
                                                @include('helpers.form_control', ['type' => 'checkbox', 'name' => 'unsubscribe_notification', 'value' => $list->unsubscribe_notification, 'options' => [false,true], 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="send" style="color: initial">
                                                @include('helpers.form_control', ['type' => 'checkbox', 'name' => 'send_welcome_email', 'value' => $list->send_welcome_email, 'options' => [false,true], 'help_class' => 'list', 'rules' => App\Models\MailList::$rules])
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

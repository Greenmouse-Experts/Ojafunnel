@extends('layouts.dashboard-email-frontend')

@section('page-content')
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
                        <h4 class="mb-sm-0 font-size-18">{{ $campaign->name }}</h4>
                        {{-- @include('campaigns._steps', ['current' => 1]) --}}
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Edit">
                <div class="row">
                    <div class="col-md-10">
                        <form action="{{ route('user.campaign.setup.post', ['username' => Auth::user()->username ,'uid' =>$campaign->uid]) }}" method="POST" class="form-validate-jqueryz">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-md-6 list_select_box" target-box="segments-select-box" segments-url="{{ route('user.segment.selectBox', Auth::user()->username) }}">
                                    @include('helpers.form_control', ['type' => 'text',
                                        'name' => 'name',
                                        'label' => trans('messages.name_your_campaign'),
                                        'value' => $campaign->name,
                                        'rules' => $rules,
                                        'help_class' => 'campaign'
                                    ])

                                    @include('helpers.form_control', ['type' => 'text',
                                        'name' => 'subject',
                                        'label' => trans('messages.email_subject'),
                                        'value' => $campaign->subject,
                                        'rules' => $rules,
                                        'help_class' => 'campaign'
                                    ])

                                    @include('helpers.form_control', ['type' => 'text',
                                        'name' => 'from_name',
                                        'label' => trans('messages.from_name'),
                                        'value' => $campaign->from_name,
                                        'rules' => $rules,
                                        'help_class' => 'campaign'
                                    ])

                                    <div class="hiddable-box" data-control="[name=use_default_sending_server_from_email]" data-hide-value="1">
                                        @include('helpers.form_control', [
                                            'type' => 'autofill',
                                            'id' => 'sender_from_input',
                                            'name' => 'from_email',
                                            'label' => trans('messages.from_email'),
                                            'value' => $campaign->from_email,
                                            'rules' => $rules,
                                            'help_class' => 'campaign',
                                            'url' => route('user.segment.dropbox', Auth::user()->username),
                                            'empty' => trans('messages.sender.dropbox.empty'),
                                            'error' => trans('messages.sender.dropbox.error.' . Auth::user()->customer->allowUnverifiedFromEmailAddress(), [
                                                'sender_link' => route('user.segment.index', Auth::user()->username),
                                            ]),
                                            'header' => trans('messages.verified_senders'),
                                        ])
                                    </div>

                                    @include('helpers.form_control', ['type' => 'checkbox4',
                                        'name' => 'use_default_sending_server_from_email',
                                        'label' => trans('messages.use_sending_server_default_value'),
                                        'value' => $campaign->use_default_sending_server_from_email,
                                        'rules' => $rules,
                                        'help_class' => 'campaign',
                                        'options' => ['0','1'],
                                    ])

                                    @include('helpers.form_control', [
                                        'type' => 'autofill',
                                        'id' => 'sender_reply_to_input',
                                        'name' => 'reply_to',
                                        'label' => trans('messages.reply_to'),
                                        'value' => $campaign->reply_to,
                                        'url' => route('user.segment.index', Auth::user()->username),
                                        'rules' => $campaign->rules(),
                                        'help_class' => 'campaign',
                                        'empty' => trans('messages.sender.dropbox.empty'),
                                        'error' => trans('messages.sender.dropbox.reply.error.' . Auth::user()->customer->allowUnverifiedFromEmailAddress(), [
                                            'sender_link' => route('user.segment.dropbox', Auth::user()->username),
                                        ]),
                                        'header' => trans('messages.verified_senders'),
                                    ])

                                </div>
                                <div class="col-md-6 segments-select-box">
                                    <div class="form-group checkbox-right-switch">
                                        @if ($campaign->type != 'plain-text')
                                            @include('helpers.form_control', ['type' => 'checkbox',
                                                                        'name' => 'track_open',
                                                                        'label' => trans('messages.track_opens'),
                                                                        'value' => $campaign->track_open,
                                                                        'options' => [false,true],
                                                                        'help_class' => 'campaign',
                                                                        'rules' => $rules
                                                                    ])

                                            @include('helpers.form_control', ['type' => 'checkbox',
                                                                        'name' => 'track_click',
                                                                        'label' => trans('messages.track_clicks'),
                                                                        'value' => $campaign->track_click,
                                                                        'options' => [false,true],
                                                                        'help_class' => 'campaign',
                                                                        'rules' => $rules
                                                                    ])
                                        @endif

                                        @include('helpers.form_control', ['type' => 'checkbox',
                                                                        'name' => 'sign_dkim',
                                                                        'label' => trans('messages.sign_dkim'),
                                                                        'value' => $campaign->sign_dkim,
                                                                        'options' => [false,true],
                                                                        'help_class' => 'campaign',
                                                                        'rules' => $rules
                                                                    ])
                                        @include('helpers.form_control', [
                                            'type' => 'checkbox',
                                            'name' => 'custom_tracking_domain',
                                            'label' => trans('messages.custom_tracking_domain'),
                                            'value' => $campaign->tracking_domain_id,
                                            'options' => [false,true],
                                            'help_class' => 'campaign',
                                            'rules' => $rules
                                        ])

                                        <div class="select-tracking-domain">
                                            @include('helpers.form_control', [
                                                'type' => 'select',
                                                'name' => 'tracking_domain_uid',
                                                'label' => '',
                                                'value' => $campaign->trackingDomain? $campaign->trackingDomain->uid : null,
                                                'options' => Auth::user()->customer->getVerifiedTrackingDomainOptions(),
                                                'include_blank' => trans('messages.campaign.select_tracking_domain'),
                                                'help_class' => 'campaign',
                                                'rules' => $rules
                                            ])
                                        </div>

                                        @if ($campaign->type == 'plain-text')
                                            <div class="alert alert-warning">
                                                {!! trans('messages.campaign.plain_text.open_click_tracking_wanring') !!}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="text-end {{ Auth::user()->customer->allowUnverifiedFromEmailAddress() ? '' : 'unverified_next_but' }}">
                                <button class="btn btn-secondary">{{ trans('messages.save_and_next') }} <span  style="font-size: 17px; position: relative;top: 4px; color: #fff;" class="material-icons-outlined">
                    arrow_forward
                    </span> </button>
                            </div>

                        <form>

                        <script>
                            var CampaignsSetupNextButton = {
                                manager: null,

                                getManager: function() {
                                    if (this.manager == null) {
                                        this.manager = new GroupManager();
                                        this.manager.add({
                                            isError: function() {
                                                return $('.autofill-error:visible').length;
                                            },
                                            nextButton: $('.unverified_next_but'),
                                            inputs: $('[name=reply_to], [name=from_email]')
                                        });

                                        this.manager.bind(function(group) {
                                            group.check = function() {
                                                if (!group.isError()) {
                                                    group.nextButton.removeClass('pointer-events-none');
                                                    group.nextButton.removeClass('disabled');
                                                } else {
                                                    group.nextButton.addClass('pointer-events-none');
                                                    group.nextButton.addClass('disabled');
                                                }
                                            }

                                            group.check();

                                            group.inputs.on('change keyup', function() {
                                                group.check();
                                            });
                                        });
                                    }

                                    return this.manager;
                                },

                                check: function() {
                                    this.getManager().groups.forEach(function(group) {
                                        group.check();
                                    });
                                }
                            }



                            $(function() {
                                CampaignsSetupNextButton.check();





                                // @Legacy
                                // auto fill
                                var box = $('#sender_from_input').autofill({
                                    messages: {
                                        header_found: '{{ trans('messages.sending_identity') }}',
                                        header_not_found: '{{ trans('messages.sending_identity.not_found.header') }}'
                                    },
                                    callback: function() {
                                        CampaignsSetupNextButton.check();
                                    }
                                });
                                box.loadDropbox(function() {
                                    $('#sender_from_input').focusout();
                                    box.updateErrorMessage();
                                })

                                // auto fill 2
                                var box2 = $('#sender_reply_to_input').autofill({
                                    messages: {
                                        header_found: '{{ trans('messages.sending_identity') }}',
                                        header_not_found: '{{ trans('messages.sending_identity.reply.not_found.header') }}'
                                    },
                                    callback: function() {
                                        CampaignsSetupNextButton.check();
                                    }
                                });
                                box2.loadDropbox(function() {
                                    $('#sender_reply_to_input').focusout();
                                    box2.updateErrorMessage();
                                })

                                $('[name="from_email"]').blur(function() {
                                    $('[name="reply_to"]').val($(this).val()).change();
                                });
                                $('[name="from_email"]').change(function() {
                                    $('[name="reply_to"]').val($(this).val()).change();
                                });

                                // select custom tracking domain
                                $('[name=custom_tracking_domain]').change(function() {
                                    var value = $('[name=custom_tracking_domain]:checked').val();

                                    if (value) {
                                        $('.select-tracking-domain').show();
                                    } else {
                                        $('.select-tracking-domain').hide();
                                    }
                                });
                                $('[name=custom_tracking_domain]').change();

                                // legacy
                                $('.hiddable-box').each(function() {
                                    var box = $(this);
                                    var control = $(box.attr('data-control'));
                                    var hide_value = box.attr('data-hide-value');

                                    control.change(function() {
                                        var val;

                                        control.each(function() {
                                            if ($(this).is(':checked')) {
                                                val = $(this).val();
                                            }
                                        });

                                        if(hide_value == val) {
                                            box.addClass('hide');
                                        } else {
                                            box.removeClass('hide');
                                        }
                                    });

                                    control.change();
                                });
                            })
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var CampaignsIndex = {
                getList: function() {
                    return makeList({
                        url: '{{ route('user.campaign.list', ['username' => Auth::user()->username]) }}',
                        container: $('#CampaignsIndexContainer'),
                        content: $('#CampaignsIndexContent')
                    });
                }
            };

            $(document).ready(function() {
                console.log(CampaignsIndex.getList())
                CampaignsIndex.getList().load();
            });
        </script>
    </div>
</div>
@endsection

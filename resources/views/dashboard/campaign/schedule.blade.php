@extends('layouts.dashboard-email-frontend')

@section('page-content')
<script type="text/javascript" src="{{ URL::asset('core/datetime/anytime.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/pickadate/picker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/pickadate/picker.date.js') }}"></script>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content" style="height: 50em;">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.schedule') }} {{ $campaign->name }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-12">
                        <form id="CampaignScheduleForm" action="{{ route('user.campaign.schedule', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" method="POST" class="form-validate-jqueryz">
                            {{ csrf_field() }}

                            <input type="hidden" name="send_now" value="no" />
                            <div class="row">
                                <div class="col-md-3 list_select_box" target-box="segments-select-box" segments-url="{{ route('user.segment.selectBox', Auth::user()->username) }}">
                                    @include('helpers.form_control', [
                                        'type' => 'date',
                                        'class' => '_from_now',
                                        'name' => 'delivery_date',
                                        'label' => trans('messages.delivery_date'),
                                        'value' => $delivery_date,
                                        'rules' => $rules,
                                        'help_class' => 'campaign'
                                    ])
                                </div>
                                <div class="col-md-3 segments-select-box">
                                    @include('helpers.form_control', ['type' => 'time',
                                        'name' => 'delivery_time',
                                        'label' => trans('messages.delivery_time'),
                                        'value' => $delivery_time,
                                        'rules' => $rules,
                                        'help_class' => 'campaign'
                                    ])
                                </div>
                            </div>

                            <hr>
                            <div class="text-end">
                                <button class="btn btn-secondary me-1">
                                    <span style="font-size: 17px; position: relative;top: 4px;" class="material-icons-outlined me-1">
                                        alarm
                                        </span>
                                        {{ trans('messages.campaign.schedule') }}
                                </button>
                                <button type="button" class="btn btn-primary send-now">
                                    <span style="font-size: 17px; position: relative;top: 4px;" class="material-icons-outlined me-1">
                                        done_all
                                    </span>
                                    {{ trans('messages.campaign.send_now') }}
                                </button>
                            </div>
                        <form>

                        <script>
                            var CampaignSchedule = {
                                getForm: function() {
                                    return $('#CampaignScheduleForm');
                                },

                                schedule: function() {
                                    this.getForm().find('[name=send_now]').val('no');
                                    this.getForm().submit();
                                },

                                sendNow: function() {
                                    this.getForm().find('[name=send_now]').val('yes');
                                    this.getForm().submit();
                                }
                            }

                            $(function() {
                                $('.send-now').on('click', function() {
                                    CampaignSchedule.sendNow();
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

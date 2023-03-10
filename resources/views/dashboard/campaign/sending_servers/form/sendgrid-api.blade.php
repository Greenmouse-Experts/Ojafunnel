@if (!$server->id)
<form id="editServerForm" action="{{ route('user.sending-server.store', ['username' => Auth::user()->username, "type" => request()->type]) }}" method="POST" class="form-validate-jqueryz">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="{{ $server->type }}" />
@else
<form id="editServerForm" enctype="multipart/form-data" action="{{ route('user.sending-server.update', ['username' => Auth::user()->username, 'id' => $server->uid, 'type' => $server->type]) }}" method="POST" class="form-validate-jqueryz">
    <input type="hidden" name="_method" value="PATCH">
    {{ csrf_field() }}
@endif

    <div class="mc_section">
        <div class="row">
            <div class="col-md-6">
                <p>{!! trans('messages.sending_servers.sendgrid_api_key.intro') !!}</p>

                @include('helpers.form_control', [
                    'type' => 'password',
                    'class' => '',
                    'name' => 'api_key',
                    'value' => $server->api_key,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'eye' => true,
                    'disabled' =>($server->id && $errors->isEmpty()),
                ])
            </div>
        </div>
        <div class="text-left">
            {{-- @if ($server->id && Auth::user()->customer->can('test', $server) && $errors->isEmpty()) --}}
            @if ($server->id && $errors->isEmpty())
                <span class="edit-group">
                    <a
                        href="{{ route('user.sending-server.testConnection', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}"
                        role="button"
                        class="btn btn-secondary me-2 test-connection-button"
                        mask-title="{{ trans('messages.sending_server.testing') }}"
                    >
                    {{ trans('messages.sending_server.test_connection') }}
                    </a>
                        <a id="SendTestEmailButton"
                        href="{{ route('user.sending-server.test', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}"
                        role="button"
                        class="btn btn-secondary me-2 modal_link"
                        data-in-form="true"
                        link-method="GET"
                    >
                        {{ trans('messages.sending_server.send_a_test_email') }}
                    </a>
                    <a href="javascript:;" role="button" class="btn btn-link switch-form-toggle">
                            {{ trans('messages.edit') }}
                    </a>
                </span>
                <span class="cancel-group hide">
                    <button class="btn btn-secondary me-2">{{ trans('messages.save') }}</button>
                    <a href="javascript:;" role="button" class="btn btn-link switch-form-toggle">
                        {{ trans('messages.cancel') }}
                    </a>
                </span>
            @else
                <button class="btn btn-secondary me-2">{{ trans('messages.save') }}</button>
                <a href="{{ route('user.sending-server.index', Auth::user()->username) }}" role="button" class="btn btn-link">
                    {{ trans('messages.cancel') }}
                </a>
            @endif

        </div>
    </div>
</form>
@if ($server->id)
<form action="{{ route('user.sending-server.config', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}" method="POST" class="form-validate-jqueryz">
    {{ csrf_field() }}
    <div class="mc_section">
        <div class="row">
            <div class="col-md-6">
                <h2 class=" mt-20">{{ trans('messages.sending_servers.configuration_settings') }}</h2>
                <p>
                    {{ trans('messages.sending_servers.configuration_settings.sendgrid.intro') }}
                </p>

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'name',
                    'value' => $server->name,
                    'help_class' => 'sending_server',
                    'rules' => $server->getConfigRules(),
                ])

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'default_from_email',
                    'value' => $server->default_from_email,
                    'help_class' => 'sending_server',
                    'rules' => $server->getConfigRules(),
                ])

                <p>{!! trans('messages.sending_servers.sending_limit.mailgun.intro') !!}</p>

                <div class="sendind-limit-select-custom" data-url="{{ route('user.sending-server.sendingLimit', ['username' => Auth::user()->username, 'uid' => ($server->uid ? $server->uid : 0)]) }}">
                    @include ('dashboard.campaign.sending_servers.form._sending_limit', [
                        'quotaValue' => $server->quota_value,
                        'quotaBase' => $server->quota_base,
                        'quotaUnit' => $server->quota_unit,
                    ])
                </div>

            </div>
        </div>
    </div>

    @include('dashboard.campaign.sending_servers.form.sendgrid-sender-identity')

</form>
@endif

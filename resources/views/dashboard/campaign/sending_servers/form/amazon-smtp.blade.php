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
                <p>{!! trans('messages.sending_servers.amazon_smtp.intro') !!}</p>

                @include('helpers.form_control', [
                    'type' => 'select',
                    'class' => '',
                    'name' => 'aws_region',
                    'value' => $server->aws_region,
                    'help_class' => 'sending_server',
                    'options' => \App\Models\SendingServer::awsRegionSelectOptions(),
                    'rules' => $server->getRules(),
                    'disabled' => ($server->id && $errors->isEmpty()),
                ])

                <div class="ajax_box"
                    data-url="{{ route('user.sending-server.awsRegionHost', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}"
                    data-control="[name=aws_region]">
                </div>

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'aws_access_key_id',
                    'value' => $server->aws_access_key_id,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'disabled' => ($server->id && $errors->isEmpty()),
                ])

                @include('helpers.form_control', [
                    'type' => 'password',
                    'class' => '',
                    'name' => 'aws_secret_access_key',
                    'value' => $server->aws_secret_access_key,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'eye' => true,
                    'disabled' => ($server->id && $errors->isEmpty()),
                ])

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'smtp_username',
                    'value' => $server->smtp_username,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'disabled' =>($server->id && $errors->isEmpty()),
                ])

                @include('helpers.form_control', [
                    'type' => 'password',
                    'class' => '',
                    'name' => 'smtp_password',
                    'value' => $server->smtp_password,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'eye' => true,
                    'disabled' =>($server->id && $errors->isEmpty()),
                ])

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'smtp_port',
                    'value' => $server->smtp_port,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
                    'disabled' =>($server->id && $errors->isEmpty()),
                ])

                @include('helpers.form_control', [
                    'type' => 'text',
                    'class' => '',
                    'name' => 'smtp_protocol',
                    'value' => $server->smtp_protocol,
                    'help_class' => 'sending_server',
                    'rules' => $server->getRules(),
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
                    {{ trans('messages.sending_servers.configuration_settings.aws.intro') }}
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

                <p>{{ trans('messages.sending_servers.sending_limit.aws.intro') }}</p>

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

    @include('dashboard.campaign.sending_servers.form.amazon-sender-identity')

</form>
@endif
<script>
    $(function() {
        // Ajax box
        $('.ajax_box').each(function() {
            var box = $(this);
            var url = box.attr('data-url');
            var control = $(box.attr('data-control'));

            control.change(function() {
                $.ajax({
                    method: 'GET',
                    url: url,
                    data: box.closest('form').serialize(),
                })
                .done(function(response) {
                    box.html(response);
                });
            });
            control.trigger('change');
        });
    });
</script>

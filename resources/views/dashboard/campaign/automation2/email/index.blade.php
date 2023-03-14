@include('dashboard.campaign.automation2._back')

<h4 class="mb-20 mt-3"h5>
    {{ trans('messages.automation.action.send-an-email') }}
</h4>
<p class="mb-10">
    {{ trans('messages.automation.action.send-an-email.intro') }}
</p>

<form action="{{ route('user.automation.emailSetup', ['username' => Auth::user()->username, 'uid' => $automation->uid]) }}" method="POST" class="form-validate-jqueryz">
    {{ csrf_field() }}

    @include('dashboard.campaign.automation2.email._summary')

    <div class="trigger-action mt-4">
        <span class="btn btn-secondary email-settings-change mr-1"
        >
            {{ trans('messages.automation.email.settings') }}
        </span>
        <a onclick="popupwindow('{{ route('user.automation.templatePreview', [
                            'username' => Auth::user()->username,
                            'uid' => $automation->uid,
                            'email_uid' => $email->uid,
                        ]) }}', '{{ $automation->name }}', 800, 800)"
                        href="javascript:;"
                        class="btn btn-default"
                    >
                        {{ trans('messages.automation.template.preview') }}
                    </a>
    </div>

<form>

<div class="mt-4 d-flex py-3">
    <div>
        <h4 class="mb-2">
            {{ trans('messages.automation.dangerous_zone') }}
        </h4>
        <p class="">
            {{ trans('messages.automation.action.delete.wording') }}
        </p>
        <div class="mt-3">
            <a href="{{ route('user.automation.mailDelete', [
                'username' => Auth::user()->username,
                'uid' => $automation->uid,
                'email_uid' => $email->uid,
            ]) }}" data-confirm="{{ trans('messages.automation.action.delete.confirm') }}" class="btn btn-secondary email-action-delete">
                <span class="material-icons-outlined">
delete
</span> {{ trans('messages.automation.remove_this_action') }}
            </a>
        </div>
    </div>
</div>

<script>
    // Click on exist action
    $('.email-settings-change').click(function(e) {
        e.preventDefault();

        var url = '{{ route('user.automation.emailTemplate', ['username' => Auth::user()->username, 'uid' => $automation->uid, 'email_uid' => $email->uid]) }}';

        popup.load(url);
    });

    $('.email-action-delete').click(function(e) {
        e.preventDefault();

        var confirm = $(this).attr('data-confirm');
        var url = $(this).attr('href');

        var dialog = new Dialog('confirm', {
            message: confirm,
            ok: function(dialog) {
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN
                    },
                    globalError: false,
                    statusCode: {
                        // validate error
                        400: function (res) {
                            response = JSON.parse(res.responseText);
                            // notify
                            notify('notice', '{{ trans('messages.notify.warning') }}', response.message);
                        }
                    },
                    success: function (response) {
                        // remove current node
                        tree.getSelected().remove();

                        // save tree
                        saveData(function() {
                            // notify
                            notify({
    type: 'success',
    title: '{!! trans('messages.notify.success') !!}',
    message: response.message
});

                            // load default sidebar
                            sidebar.load('{{ route('user.automation.settings', ['username' => Auth::user()->username, 'uid' => $automation->uid]) }}');
                        });
                    }
                });
            },
        });
    });
</script>

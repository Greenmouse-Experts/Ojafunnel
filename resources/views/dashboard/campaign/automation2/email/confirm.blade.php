@extends('layouts.popup.large')

@section('content')

    @include('dashboard.campaign.automation2.email._tabs', ['tab' => 'confirm'])

    <h5 class="mb-3">{{ trans('messages.automation.email.you_are_set_to_send') }}</h5>
    <p>{{ trans('messages.automation.email.review_email_intro') }}</p>

    <form id="emailSetup" action="{{ route('user.automation.emailSetup', ['username' => Auth::user()->username, 'uid' => $automation->uid]) }}" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-7">
                @include('dashboard.campaign.automation2.email._summary')
            </div>
        </div>

        <a href="javascript:;" class="btn btn-secondary mt-4 me-2" onclick="sidebar.load(); popup.hide()">{{ trans('messages.close') }}</a>
        <a id="sendTestEmail" href="javascript:;" class="btn btn-secondary mt-4">
            {{ trans('messages.automation.send_test_email') }}
        </a>
    </form>

    <script>
        $(function() {
            // send a test email
            $('#sendTestEmail').on('click', function(e) {
                e.preventDefault();

                Automation2SendTestEmailPopup.load();
            });
        });

        var Automation2SendTestEmailPopup = {
            popup: null,

            url: '{{ route('user.automation.sendTestEmail', ['username' => Auth::user()->username,'email_uid' => $email->uid]) }}',

            load: function() {
                if (this.popup == null) {
                    this.popup = new Popup({
                        url: this.url
                    });
                }
                this.popup.load();
            }
        }
    </script>
@endsection

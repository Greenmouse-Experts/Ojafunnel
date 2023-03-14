@extends('layouts.popup.small')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <h2>{{ trans('messages.automation.template.builder.select') }}</h2>
            <p>{{ trans('messages.automation.template.builder.select.intro') }}</p>

            @if (in_array(\App\Models\Setting::get('builder'), ['both','pro']) && $email->template->builder)
                <a href="{{ route('user.automation.templateEdit', [
                        'username' => Auth::user()->username,
                        'uid' => $automation->uid,
                        'email_uid' => $email->uid,
                    ]) }}" class="btn btn-secondary mr-1 template-compose"
                >
                    {{ trans('messages.campaign.email_builder_pro') }}
                </a>
            @endif
            @if (in_array(\App\Models\Setting::get('builder'), ['both','classic']))
                <a href="{{ route('user.automation.templateEditClassic', [
                        'username' => Auth::user()->username,
                        'uid' => $automation->uid,
                        'email_uid' => $email->uid,
                    ]) }}" class="btn btn-secondary mr-1 template-compose-classic"
                >
                    {{ trans('messages.campaign.email_builder_classic') }}
                </a>
            @endif
        </div>
    </div>
    <script>
        $('.template-compose').click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            openBuilder(url);

            builderSelectPopup.hide();
        });

        $('.template-compose-classic').click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            openBuilderClassic(url);

            builderSelectPopup.hide();
        });
    </script>
@endsection

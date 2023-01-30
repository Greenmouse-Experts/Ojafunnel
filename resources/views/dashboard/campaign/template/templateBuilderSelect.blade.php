@extends('layouts.popup.small')

@section('content')
	<div class="row">
        <div class="col-md-12">
            <h2>{{ trans('messages.campaign.template.builder.select') }}</h2>
            <p>{{ trans('messages.campaign.template.builder.select.intro') }}</p>
            {{-- {{in_array(App\Models\Setting::get('builder'), ['both','pro'])}} --}}
            @if (in_array(App\Models\Setting::get('builder'), ['both','pro']) && $campaign->template->builder)
                <a href="{{ route('user.campaign.templateEdit', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-primary me-1 template-compose">
                    {{ trans('messages.campaign.email_builder_pro') }}
                </a>
            @endif
            @if (in_array(App\Models\Setting::get('builder'), ['both','classic']))
                <a href="{{ route('user.campaign.builderClassic', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-default template-compose-classic">
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
        });

        $('.template-compose-classic').click(function(e) {
            e.preventDefault();

            var url = $(this).attr('href');

            openBuilderClassic(url);
        });
    </script>
@endsection

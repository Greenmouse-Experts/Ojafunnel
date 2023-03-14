@extends('layouts.popup.medium')

@section('class')
full-height
@endsection

@section('content')
    <div class="popup-fullheight">
        @include('dashboard.campaign.automation2._tabs_timeline', ['tab' => 'statistics', 'sub' => trans('messages.automation.timeline')])

        <div class="timlines_list ajax-list"></div>

        <script>
            var listTimeline = makeList({
                url: '{{ route('user.automation.timelineList', [
                        'username' => Auth::user()->username,
                        'uid' => $automation->uid,
                    ]) }}',
                content: $('.timlines_list'),
                data: function() {
                    return {
                        from: $('[name=from]').val(),
                        sort_direction: 'asc',
                        sort_order: 'id',
                        per_page: 10
                    };
                }
            });

            listTimeline.load();
        </script>
    </div>
@endsection

@extends('layouts.popup.small')

@section('content')
	<div class="row">
        <div class="col-md-12">
			<form id="action-select" action="{{ route('user.automation.actionSelect', ['username' => Auth::user()->username, 'uid' => $automation->uid, 'key' => $key]) }}" method="POST" class="form-validate-jqueryz">
				{{ csrf_field() }}

				<input type="hidden" name="key" value="{{ $key }}" />

				@if(View::exists('dashboard.campaign.automation2.action.' . $key))
					@include('dashboard.campaign.automation2.action.' . $key)
				@endif

				<button class="btn btn-secondary select-action-confirm mt-2">
						{{ trans('messages.automation.trigger.select_confirm') }}
				</button>
			</form>
        </div>
    </div>
@endsection

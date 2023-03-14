@if ($total > 0)
	<table class="table table-box pml-table table-sub"
		current-page="{{ empty(request()->page) ? 1 : empty(request()->page) }}"
	>
		@foreach ($subscribers as $key => $subscriber)
			<tr>
				<td width="1%">
					<div class="text-nowrap">
						<div class="checkbox inline">
							<label>
								<input type="checkbox" class="node styled"
									name="uids[]"
									value="{{ $subscriber->uid }}"
								/>
							</label>
						</div>
					</div>
				</td>
				<td>
					<div class="d-flex">
						<div class="subscriber-avatar">
							<a href="{{ route('user.subscriber.edit', ['username' => Auth::user->username, 'list_uid' => $list->uid ,'uid' => $subscriber->uid]) }}">
								<img src="{{ (isSiteDemo() ? 'https://i.pravatar.cc/300?v=' . $key : route('user.subscriber.avatar',  $subscriber->uid)) }}" />
							</a>
						</div>
						<div class="no-margin text-bold">
							<a class="kq_search" href="{{ route('user.subscriber.edit', ['username' => Auth::user->username, 'list_uid' => $list->uid ,'uid' => $subscriber->uid]) }}">
								{{ $subscriber->email }}
							</a>
							<br />
							<span class="label label-flat bg-{{ $subscriber->status }}">{{ trans('messages.' . $subscriber->status) }}</span>
							<span class="label label-flat bg-{{ $subscriber->verification_status }}">{{ trans('messages.email_verification_result_' . $subscriber->verification_status) }}</span>
						</div>
					</div>
				</td>

				@foreach ($fields as $field)
					<?php $value = $subscriber->getValueByField($field); ?>
					<td>
						<span class="no-margin stat-num kq_search">{{ empty($value) ? "--" : $value }}</span>
						<br>
						<span class="text-muted2">{{ $field->label }}</span>
					</td>
				@endforeach

				@if (in_array("created_at", explode(",", request()->columns)))
					<td>
						<span class="no-margin stat-num">{{ Tool::formatDateTime($subscriber->created_at) }}</span>
						<br>
						<span class="text-muted2">{{ trans('messages.created_at') }}</span>
					</td>
				@endif

				@if (in_array("updated_at", explode(",", request()->columns)))
					<td>
						<span class="no-margin stat-num">{{ Tool::formatDateTime($subscriber->updated_at) }}</span>
						<br>
						<span class="text-muted2">{{ trans('messages.updated_at') }}</span>
					</td>
				@endif

				<td class="text-end text-nowrap">
					{{-- @if (\Gate::allows('update', $subscriber)) --}}
						<a href="{{ route('Automation2Controller@subscribersShow', [
                            'username' => Auth::user->username,
							'uid' => $automation->uid,
							'subscriber_uid' => $subscriber->uid
						]) }}" role="button" class="btn btn-secondary btn-icon">
							{{ trans('messages.automation.subscriber.view') }}
						</a>
					{{-- @endif --}}
					<div class="btn-group">
						<button role="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"></button>
						<ul class="dropdown-menu dropdown-menu-end">
							{{-- @if (\Gate::allows('subscribe', $subscriber)) --}}
								<li><a class="dropdown-item list-action-single" link-method="POST" href="{{ route('user.subscriber.subscribe', ['username' => Auth::user->username, 'list_uid' => $list->uid, "uids" => $subscriber->uid]) }}"><span class="material-icons-outlined">
mark_email_read
</span> {{ trans('messages.subscribe') }}</a></li>
							{{-- @endif --}}
							{{-- @if (\Gate::allows('unsubscribe', $subscriber)) --}}
								<li><a class="dropdown-item list-action-single" link-method="POST" href="{{ route('user.subscriber.unsubscribe', ['username' => Auth::user->username, 'list_uid' => $list->uid, "uids" => $subscriber->uid]) }}"><span class="material-icons-round">
logout
</span> {{ trans('messages.unsubscribe') }}</a></li>
							{{-- @endif --}}

							<li>
								<a href="#copy" class="dropdown-item copy_move_subscriber"
									data-url="{{ route('user.subscriber.copyMoveForm', [
                                        'username' => Auth::user->username,
										'uids' => $subscriber->uid,
										'from_uid' => $list->uid,
										'action' => 'copy',
									]) }}">
										<span class="material-icons-outlined">
copy_all
</span> {{ trans('messages.copy_to') }}
								</a>
							</li>
							<li>
								<a href="#move" class="dropdown-item copy_move_subscriber"
									data-url="{{ route('user.subscriber.copyMoveForm', [
                                        'username' => Auth::user->username,
										'uids' => $subscriber->uid,
										'from_uid' => $list->uid,
										'action' => 'move',
									]) }}">
									<span class="material-icons-outlined">
exit_to_app
</span> {{ trans('messages.move_to') }}
								</a>
							</li>
							{{-- @if (\Gate::allows('update', $subscriber)) --}}
								<li>
									<a class="dropdown-item list-action-single" link-method="POST" link-confirm="{{ trans('messages.subscribers.resend_confirmation_email.confirm') }}" href="{{ route('user.subscriber.resendConfirmationEmail', ['username' => Auth::user->username, 'list_uid' => $list->uid, "uids" => $subscriber->uid]) }}">
										<span class="material-icons-outlined">
mark_email_read
</span> {{ trans('messages.subscribers.resend_confirmation_email') }}
									</a>
								</li>
							{{-- @endif --}}
							{{-- @if (\Gate::allows('delete', $subscriber)) --}}
								<li><a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.delete_subscribers_confirm') }}" href="{{ route('user.subscriber.delete', ['username' => Auth::user->username, 'list_uid' => $list->uid, "uids" => $subscriber->uid]) }}"><span class="material-icons-outlined">
delete_outline
</span> {{ trans("messages.delete") }}</a></li>
							{{-- @endif	 --}}
						</ul>
					</div>
				</td>

			</tr>
		@endforeach
	</table>
	@include('elements/_per_page_select', ["items" => $subscribers])

@elseif (!empty(request()->keyword))
	<div class="empty-list">
		<span class="material-icons-outlined">
people
</span>
		<span class="line-1">
			{{ trans('messages.no_search_result') }}
		</span>
	</div>
@else
	<div class="empty-list">
		<span class="material-icons-outlined">
people
</span>
		<span class="line-1">
			{{ trans('messages.subscriber_empty_line_1') }}
		</span>
	</div>
@endif

                    <div class="sub_section">
						<div class="row">
							<div class="col-md-8">
								@include('helpers.form_control', ['type' => 'text', 'name' => 'name', 'value' => $segment->name, 'rules' => \App\Models\Segment::$rules])
							</div>
							<div class="col-md-4">
								@include('helpers.form_control', ['type' => 'select', 'name' => 'matching', 'label' => trans('messages.how_subscribers_matching'), 'value' => $segment->matching, 'help_class' => 'segment', 'options' => App\Models\Segment::getTypeOptions(), 'rules' => \App\Models\Segment::$rules])
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h4 class="text-semibold">{{ trans('messages.conditions') }}</h4>

								@if ($errors->has("segment_conditions_empty"))
									<div class="text-danger text-semibold">
										<strong>{{ $errors->first("segment_conditions_empty") }}</strong>
									</div>
								@endif

								<div class="segment-conditions-container">
									@foreach ($segment->segmentConditions as $condition)
										<div class="row condition-line" rel="{{ $condition->uid }}">
											<div class="col-md-4">
												<div class="form-group">
													<select class="select condition-field-select" name="conditions[{{ $condition->uid }}][field_id]">
														<optgroup label="{{ trans('messages.list_fields') }}">
															@foreach($list->getFields as $field)
																<option{{ $condition->field_id == $field->uid || $condition->field_id == $field->id ? " selected" : "" }} value="{{ $field->uid }}">{{ $field->label }}</option>
															@endforeach
														</optgroup>
														<optgroup label="{{ trans('messages.email_verification') }}">
															<option{{ strpos($condition->operator, 'verification') !== false ? " selected" : "" }} value="verification">{{ trans('messages.verification_result') }}</option>
														</optgroup>
														<optgroup label="{{ trans('messages.other') }}">
															<option{{ strpos($condition->operator, 'tag') !== false ? " selected" : "" }} value="tag">{{ trans('messages.segment.tag') }}</option>
														</optgroup>
														<optgroup label="{{ trans('messages.segment.activities') }}">
															<option{{ strpos($condition->operator, 'last_open_email') !== false ? " selected" : "" }} value="last_open_email">{{ trans('messages.segment.last_open_email') }}</option>
															<option{{ strpos($condition->operator, 'last_link_click') !== false ? " selected" : "" }} value="last_link_click">{{ trans('messages.segment.last_link_click') }}</option>
														</optgroup>
													</select>
												</div>
											</div>
											<div class="col-md-7 operator_value_col" data-url="{{ route('user.segment.conditionValueControl', Auth::user()->username) }}">
												@include('dashboard.campaign.segment._condition_value_control', [
													'field' => $field,
													'field_uid' => $condition->field_id,
													'operator' => $condition->operator,
													'index' => $condition->uid,
													'operator' => $condition->operator,
													'value' => $condition->value
												])
											</div>
											<div class="col-md-1">
												<a onclick="$(this).parents('.condition-line').remove()" href="#delete" class="btn bg-danger-400"><span class="material-icons-outlined">
delete_outline
</span></a>
											</div>
										</div>
									@endforeach
								</div>

								<br />
								<a sample-url="{{ route('user.segment.sample_condition', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}" href="#add_condition" class="btn btn-info bg-teal-800 add-segment-condition">
									<span class="material-icons-outlined">
										add
										</span> {{ trans('messages.add_condition') }}
								</a>

							</div>
						</div>
					</div>

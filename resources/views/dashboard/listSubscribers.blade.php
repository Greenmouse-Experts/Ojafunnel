@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Subscribers List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">View List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Subscribers List </h4>
                            <p>Do more with our Subscriber list</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <a href=" {{route('user.new.subscribers', ["username" => Auth::user()->username, "uid" => $list->uid])}}">
                                <button class="btn btn-success"> + New Subscribers</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @include('dashboard.list.list-layout')
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-xl-12">
                    <div class="card text-center">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            {{-- <div class="row g-3 mb-4">
                                <ul class="">

                                <ul class="dropdown-menu list-columns-checkbox dropdown-menu-end">
                                    @foreach ($list->getFields as $key => $field)
                                        @if ($field->tag != "EMAIL")
                                            <li>
                                                <a href="javascript:;" class="dropdown-item">
                                                    <label class="d-flex align-items-center">
                                                        <input {{ ($field->required || $key <= 3 ? "checked='checked'" : "") }} type="checkbox" id="{{ $field->tag }}" name="columns[]" value="{{ $field->uid }}" class="styled">
                                                        <span class="ms-2">{{ $field->label }}</span>
                                                    </label>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li>
                                        <a class="dropdown-item checkbox">
                                            <label class="d-flex align-items-center">
                                                <input checked="checked" type="checkbox" id="created_at" name="columns[]" value="created_at" class="styled">
                                                <span class="ms-2">{{ trans('messages.created_at') }}</span>
                                            </label>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item checkbox">
                                            <label class="d-flex align-items-center">
                                                <input checked="checked" type="checkbox" id="updated_at" name="columns[]" value="updated_at" class="styled">
                                                <span class="ms-2">{{ trans('messages.updated_at') }}</span>
                                            </label>
                                        </a>
                                    </li>
                                </ul>
                                {{}}
                                <div class="col-xxl-2 col-lg-6">
                                    <select class="form-control select2">
                                        <option>Email</option>
                                        <option value="Active">Created at</option>
                                        <option value="New">Uploaded at</option>
                                    </select>
                                </div>
                                <div class="col-xxl-2 col-lg-4">
                                    <select class="form-control select2">
                                        <option>All Subscribers </option>
                                        <option value="1">Subscribed</option>
                                        <option value="2">Unsubscribed</option>
                                        <option value="3">Unconfirmed</option>
                                        <option value="4">Span Reported</option>
                                        <option value="5">Blacklisted</option>
                                    </select>
                                </div>
                                <div class="col-xxl-2 col-lg-4">
                                    <select class="form-control select2">
                                        <option>All Verification</option>
                                        <option value="1">Deliverable</option>
                                        <option value="2">Undeliverable</option>
                                        <option value="3">Unknown</option>
                                        <option value="4">Unverified</option>
                                    </select>
                                </div>
                                <div class="col-xxl-4 col-lg-6">
                                    <input type="search" class="form-control" id="searchInput" placeholder="Type to Search ...">
                                </div>
                            </div> --}}
                            @if ($list->subscribers->count() > 0)
                                <div class="table-responsive mb-4">
                                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead class="tread">
                                            <tr>
                                                <th>S/N</th>
                                                <th>Email</th>
                                                <th>First Name</th>
                                                <th>Last Name </th>
                                                <th>Status</th>
                                                <th>Created at</th>
                                                <th>Updated at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list->subscribers as $item)
                                                <tr>
                                                    @php
                                                        $firstname = $list->getFieldByTag('FIRST_NAME');
                                                        $lastname = $list->getFieldByTag('LAST_NAME');

                                                        $firstnamefields = $list->getFields->whereIn('uid', $firstname->uid);
                                                        $lastnamefields = $list->getFields->whereIn('uid', $lastname->uid);
                                                        //dd($fields->label);
                                                        foreach ($firstnamefields as $key => $field) {

                                                            $FirstNameValue = $item->getValueByField($field);
                                                        }
                                                        foreach ($lastnamefields as $key => $lfield) {

                                                            $LastNameValue = $item->getValueByField($lfield);
                                                        }
                                                    @endphp
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>
                                                        <p>{{$item->email}}</p>
                                                    </td>

                                                    <td>
                                                        {{$FirstNameValue}}
                                                    </td>
                                                    <td>{{$LastNameValue}}</td>
                                                    <td>
                                                        <span class="label label-flat bg-{{ $item->status }}">{{ trans('messages.' . $item->status) }}</span>
							                            <span class="label label-flat bg-{{ $item->verification_status }}">{{ trans('messages.email_verification_result_' . $item->verification_status) }}</span>
                                                    </td>
                                                    <td>{{$item->created_at->toDayDateTimeString()}}</td>
                                                    <td>{{$item->updated_at->toDayDateTimeString()}}</td>
                                                    <td>
                                                        <a href="#" role="button" class="btn btn-secondary btn-icon" style="padding: 0.321em 0.75em; font-size: 12px;">
                                                            <span class="material-icons-outlined" style="font-size: 12px;">
                                                            edit
                                                            </span>
                                                        </a>
                                                        <div class="btn-group">
                                                            <button role="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" style="padding: 0.321em 0.75em; font-size: 12px;">
                                                                <span class="material-icons-outlined" style="font-size: 12px">
                                                                    keyboard_arrow_down
                                                                </span>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                @if (\Gate::allows('subscribe', $item))
                                                                    <li><a class="dropdown-item list-action-single"  link-method="POST" href="{{ action('SubscriberController@subscribe', ['list_uid' => $list->uid, "uids" => $item->uid]) }}"><span class="material-icons-outlined">
                                    mark_email_read
                                    </span> {{ trans('messages.subscribe') }}</a></li>
                                                                @endif
                                                                @if (\Gate::allows('unsubscribe', $item))
                                                                    <li><a class="dropdown-item list-action-single"  link-method="POST" href="{{ action('SubscriberController@unsubscribe', ['list_uid' => $list->uid, "uids" => $item->uid]) }}"><span class="material-icons-round">
                                    logout
                                    </span> {{ trans('messages.unsubscribe') }}</a></li>
                                                                @endif

                                                                <li>
                                                                    <a href="#copy" class="dropdown-item copy_move_subscriber"
                                                                        {{-- data-url="{{ action('SubscriberController@copyMoveForm', [
                                                                            'uids' => $item->uid,
                                                                            'from_uid' => $list->uid,
                                                                            'action' => 'copy',
                                                                        ]) }}--}}">
                                                                            <span class="material-icons-outlined" style="font-size: 12px;">
                                                                            copy_all
                                                                            </span> {{ trans('messages.copy_to') }}
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#move" class="dropdown-item copy_move_subscriber"
                                                                        {{--data-url="{{ action('SubscriberController@copyMoveForm', [
                                                                            'uids' => $item->uid,
                                                                            'from_uid' => $list->uid,
                                                                            'action' => 'move',
                                                                        ]) }}--}}">
                                                                        <span class="material-icons-outlined" style="font-size: 12px;">
                                    exit_to_app
                                    </span> {{ trans('messages.move_to') }}
                                                                    </a>
                                                                </li>
                                                                @if (\Gate::allows('update', $item))
                                                                    <li>
                                                                        <a class="dropdown-item list-action-single" link-method="POST" link-confirm="{{ trans('messages.subscribers.resend_confirmation_email.confirm') }}" href="{{ action('SubscriberController@resendConfirmationEmail', ['list_uid' => $list->uid, "uids" => $item->uid]) }}">
                                                                            <span class="material-icons-outlined">
                                    mark_email_read
                                    </span> {{ trans('messages.subscribers.resend_confirmation_email') }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                                @if (\Gate::allows('delete', $item))
                                                                    <li><a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.delete_subscribers_confirm') }}" href="{{ action('SubscriberController@delete', ['list_uid' => $list->uid, "uids" => $item->uid]) }}"><span class="material-icons-outlined">
                                    delete_outline
                                    </span> {{ trans("messages.delete") }}</a></li>
                                                                @endif
                                                                <li><a class="dropdown-item list-action-single" link-confirm="{{ trans('messages.delete_subscribers_confirm') }}" href="{{ route('user.subscriber.delete', ['username' => Auth::user()->username,'list_uid' => $list->uid, "uids" => $item->uid]) }}">
                                                                    <span class="material-icons-outlined" style="font-size: 12px;">
                                                                    delete_outline
                                                                    </span> {{ trans("messages.delete") }}</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center">
                                    <h4 class="card-title lie"><i class="bi bi-people"></i></h4>
                                    <p>You have 0 subscribers</p>
                                </div>
                            @endif

                        </div>
                        </div>

                    </div><!--end card-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

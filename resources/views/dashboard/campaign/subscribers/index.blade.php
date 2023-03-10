@extends('layouts.dashboard-email-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . ": " . trans('messages.subscribers') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("user.list.index", Auth::user()->username) }}">{{ trans('messages.lists') }}</a></li>
                                <li class="breadcrumb-item">
                                    <div class="btn-group other-lists" style="margin-top: -4px;">
                                        <button role="button" class="btn dropdown-toggle text-teal-600 change-list-button" data-bs-toggle="dropdown">{{ trans('messages.change_list') }} <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            @forelse ($list->otherLists() as $l)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.list.overview', ['username' => Auth::user()->username, 'uid' => $l->uid]) }}">
                                                        {{ $l->readCache('LongName', $l->name) }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li><a href="#">({{ trans('messages.empty') }})</a></li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span class="text-semibold">{{ $list->name }}</span>
                    </h1>
                    <span class="badge badge-info bg-info-800 badge-big">{{ number_with_delimiter($list->readCache('SubscriberCount')) }}</span> {{ trans('messages.subscribers') }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include("dashboard.campaign.lists._menu")

                    <div class="d-flex my-4">
                        <h2 class="text-primary me-auto"><span class="material-icons-outlined">
                            people
                            </span> {{ trans('messages.subscribers') }}</h2>
                        <div class="text-end">
                            <a href="{{ route("user.subscriber.create", ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" role="button" class="btn btn-secondary">
                                <span class="material-icons-round">
                add
                </span> {{ trans('messages.create_subscriber') }}
                            </a>
                        </div>
                    </div>


                    <div class="listing-form subscribers-list"
                        data-url="{{ route('user.subscriber.listing', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}"
                        per-page="{{ \App\Models\Subscriber::$itemsPerPage }}"
                    >
                        <div class="d-flex top-list-controls top-sticky-content">
                            <div class="me-auto">
                                <div class="filter-box">
                                    <span class="me-2 d-flex">
                                        <div class="mr-2">
                                            @include('helpers.select_tool', [
                                                'disable_all_items' => false
                                            ])
                                        </div>
                                        <div class="btn-group list_actions me-2" style="display:none">
                                            <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item assign-values-button"
                                                    href="{{ route('user.subscriber.assignValues', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                        <span class="material-icons-outlined">
                control_point_duplicate
                </span> {{ trans('messages.subscriber.assign_values') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"  link-method="POST" link-confirm="{{ trans('messages.subscribe_subscribers_confirm') }}"
                                                        href="{{ route('user.subscriber.subscribe', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                        <span class="material-icons-outlined">
                mark_email_read
                </span> {{ trans('messages.subscribe') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        link-method="POST"
                                                        link-confirm="{{ trans('messages.unsubscribe_subscribers_confirm') }}"
                                                        href="{{ route('user.subscriber.unsubscribe', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                        <span class="material-icons-round">
                logout
                </span> {{ trans('messages.unsubscribe') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item list-action-single"
                                                        link-method="POST"
                                                        link-confirm="{{ trans('messages.subscribers.resend_confirmation_email.confirm') }}" href="{{ route('user.subscriber.resendConfirmationEmail', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                        <span class="material-icons-outlined">
                mark_email_read
                </span> {{ trans('messages.subscribers.resend_confirmation_email') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item copy_move_subscriber"
                                                        data-url="{{ route('user.subscriber.copyMoveForm', [
                                                            'username' => Auth::user()->username,
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
                                                            'username' => Auth::user()->username,
                                                            'from_uid' => $list->uid,
                                                            'action' => 'move',
                                                        ]) }}">
                                                        <span class="material-icons-outlined">
                exit_to_app
                </span> {{ trans('messages.move_to') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item list-action-single"
                                                        link-confirm="{{ trans('messages.delete_subscribers_confirm') }}"
                                                        href="{{ route('user.subscriber.delete', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                        <span class="material-icons-outlined">
                delete_outline
                </span> {{ trans('messages.delete') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('user.subscriber.bulkDelete', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}"
                                                        class="dropdown-item bulk-delete">
                                                        <span class="material-icons-outlined">
                delete_outline
                </span> {{ trans('messages.subscriber.bulk_delete') }}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </span>
                                    <span class="filter-group">
                                        <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                                        <select class="select" name="sort_order">
                                            <option value="subscribers.email">{{ trans('messages.email') }}</option>
                                            <option value="subscribers.created_at">{{ trans('messages.created_at') }}</option>
                                            <option value="subscribers.updated_at">{{ trans('messages.updated_at') }}</option>
                                        </select>
                                        <input type="hidden" name="sort_direction" value="asc" />
                                        <button class="btn btn-xs sort-direction" rel="asc" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
                                            <span class="material-icons-outlined desc">
                sort
                </span>
                                        </button>
                                    </span>
                                    <span class="me-2">
                                        <select class="select" name="status">
                                            <option value="">{{ trans('messages.all_subscribers') }}</option>
                                            <option value="subscribed">{{ trans('messages.subscribed') }}</option>
                                            <option value="unsubscribed">{{ trans('messages.unsubscribed') }}</option>
                                            <option value="unconfirmed">{{ trans('messages.unconfirmed') }}</option>
                                            <option value="spam-reported">{{ trans('messages.spam-reported') }}</option>
                                            <option value="blacklisted">{{ trans('messages.blacklisted') }}</option>
                                        </select>
                                    </span>
                                    <span class="filter-group ml-10">
                                        <select class="select" name="verification_result">
                                            <option value="">{{ trans('messages.all_verification') }}</option>
                                            @foreach (\App\Models\Subscriber::getVerificationStates() as $option)
                                                <option value="{{ $option['value'] }}">
                                                    {{ $option['text'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </span>
                                    <div class="btn-group mr-2">
                                        <button role="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ trans('messages.columns') }} <span class="caret"></span>
                                        </button>
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
                                    </div>
                                    <span class="text-nowrap">
                                        <input type="text" name="keyword" class="form-control search" value="{{ request()->keyword }}" placeholder="{{ trans('messages.type_to_search') }}" />
                                        <span class="material-icons-round">
                search
                </span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div id="SubscribersIndexContent" class="pml-table-container">



                        </div>
                    </div>

                    <script>
                        var SubscribersIndex = {
                            list: null,
                            getList: function() {
                                if (this.list == null) {
                                    this.list = makeList({
                                        url: '{{ route('user.subscriber.listing', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}',
                                        container: $('.subscribers-list'),
                                        content: $('#SubscribersIndexContent')
                                    });
                                }

                                return this.list;
                            }
                        };

                        $(function() {
                            SubscribersIndex.getList().load();
                        });
                    </script>

                    <script>
                        var bulkDeletePopup = new Popup();

                        $(document).on('click', '.bulk-delete', function(e) {
                            e.preventDefault();

                            var url = $(this).attr('href');

                            bulkDeletePopup.load(url);
                        });

                        var assignValues;
                        $(document).on('click', '.assign-values-button', function(e) {
                            e.preventDefault();

                            var data = SubscribersIndex.getList().data();

                            var url = $(this).attr('href');

                            assignValues = new Popup();
                            assignValues.load({
                                url: url,
                                data: data
                            });
                        });

                        // Copy Move subscribers
                        var copyMovePopup;
                        $(document).on('click', '.copy_move_subscriber', function() {
                            var url = $(this).attr('data-url');
                            var data = {};
                            // Data list action
                            if ($(this).parents('.list_actions').length) {
                                var form = $(this).parents(".listing-form");
                                var vals = form.find("input[name='uids[]']:checked").map(function () {
                                    return this.value;
                                }).get();

                                data = {
                                    uids: vals.join(",")
                                };

                                // select_tool
                                var select_tool = '';
                                if (form.find('.select_tool').length && form.find('.select_tool').val() == 'all_items') {
                                    select_tool = form.find('.select_tool').val();
                                    arr = form.serializeArray();
                                    for (var i = 0; i < arr.length; i++){
                                        data[arr[i]['name']] = arr[i]['value'];
                                    }
                                }

                                if (form.find('.select_tool').length) {
                                    data.select_tool = form.find('.select_tool').val();
                                }

                            }

                            copyMovePopup = new Popup({
                                url: url,
                                data: data
                            });
                            copyMovePopup.load();
                        });

                        // Ajax copy list
                        $(document).on('submit', '#copy-move-subscribers-form form', function(e) {
                            e.preventDefault(); // avoid to execute the actual submit of the form.

                            var form = $(this);
                            var url = form.attr("action");

                            addMaskLoading();

                            $.ajax({
                                type: "POST",
                                url: url,
                                data: form.serialize()
                            }).done(function(msg) {
                                if(msg != '') {
                                    new Dialog('alert', {
                                        message: msg
                                    });
                                }
                                copyMovePopup.hide();

                                SubscribersIndex.getList().load();

                                removeMaskLoading();
                            });

                            copyMovePopup.hide();

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




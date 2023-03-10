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
                @include("dashboard.campaign.lists._menu")
                <div class="col-md-12">
                    <h2 class="text-bold text-primary mb-10"><span class="material-icons-outlined">
                        splitscreen
                    </span> {{ $segment->name }}</h2>
                        <h3><span class="material-icons-outlined">
                    people
                    </span> {{ trans('messages.subscribers') }}</h3>

                        <div class="listing-form" id="SegmentsSubscribersContainer"
                            data-url="{{ route('user.segment.listing_subscribers', ['username' => Auth::user()->username, 'list_uid' => $list->uid, 'uid' => $segment->uid]) }}"
                            per-page="{{ \App\Models\Subscriber::$itemsPerPage }}"
                        >
                            <div class="d-flex top-list-controls top-sticky-content">
                                <div class="me-auto">
                                    @if ($subscribers->count() >= 0)
                                        <div class="filter-box">
                                            <div class="btn-group list_actions me-2" style="display:none">
                                                <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a  link-method="POST" link-confirm="{{ trans('messages.subscribe_subscribers_confirm') }}" href="{{ route('user.subscriber.subscribe', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                            <span class="material-icons-outlined">
                    mark_email_read
                    </span> {{ trans('messages.subscribe') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a link-confirm="{{ trans('messages.unsubscribe_subscribers_confirm') }}" href="{{ route('user.subscriber.unsubscribe', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                            <span class="material-icons-round">
                    logout
                    </span> {{ trans('messages.unsubscribe') }}
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a link-confirm="{{ trans('messages.delete_subscribers_confirm') }}" href="{{ route('user.subscriber.delete', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}">
                                                            <span class="material-icons-outlined">
                    delete_outline
                    </span> {{ trans('messages.delete') }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="checkbox inline check_all_list">
                                                <label>
                                                    <input type="checkbox" name="page_checked" class="styled check_all">
                                                </label>
                                            </div>
                                            <span class="filter-group">
                                                <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                                                <select class="select" name="sort_order">
                                                    <option value="subscribers.created_at">{{ trans('messages.created_at') }}</option>
                                                    <option value="subscribers.updated_at">{{ trans('messages.updated_at') }}</option>
                                                    <option value="subscribers.email">{{ trans('messages.email') }}</option>
                                                </select>
                                                <input type="hidden" name="sort_direction" value="desc" />
                    <button type="button" class="btn btn-xs sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
                                                    <span class="material-icons-outlined desc">
                    sort
                    </span>
                                                </button>
                                            </span>
                                            <span class="ms-1">
                                                <select class="select" name="status">
                                                    <option value="">{{ trans('messages.all_subscribers') }}</option>
                                                    <option value="subscribed">{{ trans('messages.subscribed') }}</option>
                                                    <option value="unsubscribed">{{ trans('messages.unsubscribed') }}</option>
                                                </select>
                                            </span>
                                            <span class="filter-group ms-1">
                                                <select class="select" name="verification_result">
                                                    <option value="">{{ trans('messages.all_verification') }}</option>
                                                    @foreach (\App\Models\Subscriber::getVerificationStates() as $option)
                                                        <option value="{{ $option['value'] }}">
                                                            {{ $option['text'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </span>
                                            <div class="btn-group list_columns me-2">
                                                <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    {{ trans('messages.columns') }} <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    @foreach ($list->getFields as $field)
                                                        @if ($field->tag != "EMAIL")
                                                            <li>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input checked="checked" type="checkbox" id="{{ $field->tag }}" name="columns_[]" value="{{ $field->uid }}" class="styled">
                                                                        {{ $field->label }}
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                    <li>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input checked="checked" type="checkbox" id="created_at" name="columns_[]" value="created_at" class="styled">
                                                                {{ trans('messages.created_at') }}
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="checkbox">
                                                            <label>
                                                                <input checked="checked" type="checkbox" id="updated_at" name="columns_[]" value="updated_at" class="styled">
                                                                {{ trans('messages.updated_at') }}
                                                            </label>
                                                        </div>
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
                                    @endif
                                </div>
                                <div class="text-end">
                                    <a href="{{ route("user.subscriber.create", ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" role="button" class="btn btn-secondary">
                                        <span class="material-icons-round">
                    add
                    </span> {{ trans('messages.create_subscriber') }}
                                    </a>
                                </div>
                            </div>

                            <div class="pml-table-container" id="SegmentsSubscribersContent">



                            </div>
                        </div>

                        <script>
                            var SegmentsSubscribers = {
                                getList: function() {
                                    return makeList({
                                        url: '{{ route('user.segment.listing_subscribers', ['username' => Auth::user()->username, 'list_uid' => $list->uid, 'uid' => $segment->uid]) }}',
                                        container: $('#SegmentsSubscribersContainer'),
                                        content: $('#SegmentsSubscribersContent')
                                    });
                                }
                            };

                            $(document).ready(function() {
                                SegmentsSubscribers.getList().load();
                            });
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


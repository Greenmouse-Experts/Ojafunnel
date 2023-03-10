{{-- @extends('layouts.core.frontend')

@section('title', $list->name . ": " . trans('messages.segments'))

@section('page_header')

			@include("lists._header")

@endsection

@section('content')

	@include("lists._menu")



@endsection --}}


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
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . ": " . trans('messages.segments') }}</h4>
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
                    <h2 class="text-primary my-4"><span class="material-icons-outlined">
                        splitscreen
                        </span> {{ trans('messages.segments') }}</h2>
                            <div id="SegmentsIndexContainer" class="listing-form"
                                data-url="{{ route('user.segment.listing', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}"
                                per-page="{{ App\Models\Segment::$itemsPerPage }}"
                            >
                                <div class="d-flex top-list-controls top-sticky-content">
                                    <div class="me-auto">
                                        @if ($list->segmentsCount() >= 0)
                                            <div class="filter-box">
                                                <div class="checkbox inline check_all_list">
                                                    <label>
                                                        <input type="checkbox" name="page_checked" class="styled check_all">
                                                    </label>
                                                </div>
                                                <div class="btn-group list_actions me-2" style="display:none">
                                                    <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                        {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" link-confirm="{{ trans('messages.delete_segments_confirm') }}" href="{{ route('user.segment.delete', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}">
                                                                <span class="material-icons-outlined">
                        delete_outline
                        </span> {{ trans('messages.delete') }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <span class="filter-group">
                                                    <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                                                    <select class="select" name="sort_order">
                                                        <option value="segments.created_at">{{ trans('messages.created_at') }}</option>
                                                        <option value="segments.name">{{ trans('messages.name') }}</option>
                                                        <option value="segments.updated_at">{{ trans('messages.updated_at') }}</option>
                                                    </select>
                                                    <input type="hidden" name="sort_direction" value="desc" />
                        <button type="button" class="btn btn-xs sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
                                                        <span class="material-icons-outlined desc">
                        sort
                        </span>
                                                    </button>
                                                </span>
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
                                        <a href="{{ route("user.segment.create", ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" role="button" class="btn btn-secondary">
                                            <span class="material-icons-round">
                        add
                        </span> {{ trans('messages.create_segment') }}
                                        </a>
                                    </div>
                                </div>

                                <div id="SegmentsIndexContent" class="pml-table-container">



                                </div>

                            </div>

                            <script>
                                var SegmentsIndex = {
                                    getList: function() {
                                        return makeList({
                                            url: '{{ route('user.segment.listing', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}',
                                            container: $('#SegmentsIndexContainer'),
                                            content: $('#SegmentsIndexContent')
                                        });
                                    }
                                };

                                $(document).ready(function() {
                                    SegmentsIndex.getList().load();
                                });
                            </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

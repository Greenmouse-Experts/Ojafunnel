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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.my_lists') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span class="text-semibold"><span class="material-icons-round">
                            format_list_bulleted
                            </span> {{ trans('messages.my_lists') }}</span>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="listing-form" id="ListsIndexContainer">
                        <div class="d-flex top-list-controls top-sticky-content">
                            <div class="me-auto">
                                @if (Auth::user()->customer->listsCount() >= 0)
                                    <div class="filter-box">
                                        <div class="checkbox inline check_all_list">
                                            <label>
                                                <input type="checkbox" name="page_checked" class="styled check_all">
                                            </label>
                                        </div>
                                        <div class="dropdown list_actions" style="display: none">
                                            <button type="button"
                                                class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                            >
                                                {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a
                                                        class="dropdown-item"
                                                        link-confirm-url="{{ route('user.list.deleteConfirm', Auth::user()->username) }}"
                                                        link-method="POST"
                                                        href="{{ route('user.list.delete', Auth::user()->username) }}"
                                                    >
                                                        <span class="material-icons-outlined">
                                                            delete_outline
                                                        </span> {{ trans('messages.delete') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <span class="filter-group">
                                            <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                                            <select class="select" name="sort_order">
                                                <option value="created_at">{{ trans('messages.created_at') }}</option>
                                                <option value="name">{{ trans('messages.name') }}</option>
                                            </select>

                                            <input type="hidden" name="sort_direction" value="desc" />
                                            <button type="button" class="btn btn-light sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
                                                <span class="material-icons-outlined">
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
                                <a href="{{ route("user.list.create", Auth::user()->username) }}" role="button" class="btn btn-secondary">
                                    <span class="material-icons-round">
                                        add
                                    </span> {{ trans('messages.create_list') }}
                                </a>
                            </div>
                        </div>

                        <div id="ListsIndexContent"></div>
                    </div>

                    <script>
                        var ListsIndex = {
                            list: null,
                            getList: function() {
                                if (this.list == null) {
                                    this.list = makeList({
                                        url: '{{ route('user.list.listing', Auth::user()->username) }}',
                                        container: $('#ListsIndexContainer'),
                                        content: $('#ListsIndexContent')
                                    });
                                }
                                return this.list;
                            }
                        };

                        $(document).ready(function() {
                            ListsIndex.getList().load();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


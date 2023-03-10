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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.verified_senders') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.campaign.senders._menu')
                    <h2 class="text-semibold"><i class="icon-list2 me-2"></i> {{ trans('messages.email_addresses') }}</h2>

                        <p>{{ trans('messages.sender.wording') }}</p>

                        <div class="listing-form"
                            data-url="{{ route('user.sender.listing', Auth::user()->username) }}"
                            per-page="{{ App\Models\Sender::$itemsPerPage }}"
                        >

                            <div class="d-flex top-list-controls top-sticky-content">
                                <div class="me-auto">
                                    @if ($senders->count() >= 0)
                                        <div class="filter-box">
                                            <span class="me-2">@include('helpers.select_tool')</span>
                                            <div class="dropdown list_actions me-3" style="display: none">
                                                <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                                    {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" link-confirm="{{ trans('messages.remove_blacklist_confirm') }}" href="{{ route('user.sender.delete', Auth::user()->username) }}"><span class="material-icons-outlined">
                                                        delete_outline
                                                        </span> {{ trans('messages.delete') }}</a></li>
                                                </ul>
                                            </div>
                                            <span class="filter-group">
                                                <span class="title text-semibold text-muted">{{ trans('messages.sort_by') }}</span>
                                                <select class="select" name="sort_order">
                                                    <option value="senders.created_at">{{ trans('messages.created_at') }}</option>
                                                    <option value="senders.email">{{ trans('messages.email') }}</option>
                                                    <option value="senders.email">{{ trans('messages.name') }}</option>
                                                </select>
                                                <input type="hidden" name="sort_direction" value="desc" />
                    <button type="button" class="btn btn-light sort-direction" data-popup="tooltip" title="{{ trans('messages.change_sort_direction') }}" role="button" class="btn btn-xs">
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
                                <div class="">
                                    {{-- @if (Auth::user()->can('create', new App\Models\Sender())) --}}
                                        <div class="text-end">
                                            <a href="{{ route('user.sender.create', Auth::user()->username) }}" role="button" class="btn btn-secondary">
                                                <span class="material-icons-outlined">
                                                    file_upload
                                                </span> {{ trans('messages.sender.create') }}
                                            </a>
                                        </div>
                                    {{-- @endif --}}
                                </div>
                            </div>

                            <div class="pml-table-container">
                            </div>
                        </div>

                        <script>
                            var SendersIndex = {
                                getList: function() {
                                    return makeList({
                                        url: '{{ route('user.sender.listing', Auth::user()->username) }}',
                                        container: $('.listing-form'),
                                        content: $('.pml-table-container')
                                    });
                                }
                            };

                            $(function() {
                                SendersIndex.getList().load();
                            });
                        </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

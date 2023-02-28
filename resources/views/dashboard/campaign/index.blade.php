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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.campaigns') }}</h4>
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
                            <h4 class="font-500">{{ trans('messages.campaigns') }} List </h4>
                            <p>Do more with our {{ trans('messages.campaigns') }} list</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <a href="{{route('user.campaign.selectType', ["username" => Auth::user()->username])}}">
                                <button class="btn btn-success"> + {{ trans('messages.create_campaign') }}</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="CampaignsIndexContainer" class="listing-form top-sticky"
                        data-url="{{ route('user.campaign.list', ['username' => Auth::user()->username]) }}"
                        per-page="{{ App\Models\MailList::$itemsPerPage }}"
                    >
                        <div class="d-flex top-list-controls top-sticky-content">
                            <div class="me-auto">
                                @if ($campaigns->count() >= 0)
                                    <div class="filter-box">
                                        <div class="checkbox inline check_all_list">
                                            <label>
                                                <input type="checkbox" name="page_checked" class="styled check_all">
                                            </label>
                                        </div>
                                        <div class="dropdown list_actions" style="display: none">
                                            <button type="button"
                                                id="dropdownListActions"
                                                class="btn btn-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                            >
                                                {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownListActions">
                                                <li>
                                                    <a class="action dropdown-item"
                                                        link-method="POST"
                                                        link-confirm="{{ trans('messages.restart_campaigns_confirm') }}" href="{{ route('user.campaign.restart', Auth::user()->username) }}">
                                                        <span style="font-size: 17px; position: relative;top: 4px;" class="material-icons-outlined me-2">
                restore
                </span> {{ trans("messages.restart") }}</a></li>
                                                <li><a class="action dropdown-item"
                                                    link-method="POST"
                                                    link-confirm="{{ trans('messages.pause_campaigns_confirm') }}" href="{{ route('user.campaign.pause', Auth::user()->username) }}">
                                                    <span style="font-size: 17px; position: relative;top: 4px;" class="material-icons-outlined me-2">
                motion_photos_pause
                </span> {{ trans("messages.pause") }}</a></li>
                                                <li><a class="action dropdown-item"
                                                    link-method="POST"
                                                    link-confirm="{{ trans('messages.delete_campaigns_confirm') }}" href="{{ route('user.campaign.delete', Auth::user()->username) }}">
                                                    <span style="font-size: 17px; position: relative;top: 4px;" class="material-icons-outlined me-2">
                delete_outline
                </span> {{ trans('messages.delete') }}</a></li>
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
                                                <span class="material-icons-outlined desc">
                sort
                </span>
                                            </button>
                                        </span>
                                        <span class="text-nowrap">
                                            <input type="text" name="keyword" class="form-control search" value="{{ request()->keyword }}" value="{{ request()->keyword }}" placeholder="{{ trans('messages.type_to_search') }}" />
                                            <span class="material-icons-round">
                search
                </span>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="text-end">
                                <a href="#" role="button" class="btn btn-secondary">
                                    <span class="material-icons-round">
                add
                </span> {{ trans('messages.create_campaign') }}
                                </a>
                            </div> --}}
                        </div>

                        <div id="CampaignsIndexContent" class="pml-table-container">



                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var CampaignsIndex = {
                getList: function() {
                    return makeList({
                        url: '{{ route('user.campaign.list', ['username' => Auth::user()->username]) }}',
                        container: $('#CampaignsIndexContainer'),
                        content: $('#CampaignsIndexContent')
                    });
                }
            };

            $(document).ready(function() {
                console.log(CampaignsIndex.getList())
                CampaignsIndex.getList().load();
            });
        </script>
    </div>
</div>
@endsection

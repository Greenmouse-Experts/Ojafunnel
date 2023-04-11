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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.Automations') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span><span class="material-icons-round">
                                format_list_bulleted
                            </span> {{ trans('messages.Automations') }}</span>
                    </h1>
                    @if(config('queue.default') == 'async')
                    <div class="alert alert-warning">
                        {{ trans('messages.automation_not_work_with_async') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div id="Automation2IndexContainer" class="listing-form" data-url="{{ route('user.automation.listing', Auth::user()->username) }}" per-page="{{ \App\Models\Automation2::ITEMS_PER_PAGE }}">
                        <div class="d-flex top-list-controls top-sticky-content">
                            <div class="me-auto">
                                <div class="filter-box">
                                    <div class="checkbox inline check_all_list">
                                        <label>
                                            <input type="checkbox" name="page_checked" class="styled check_all">
                                        </label>
                                    </div>
                                    <div class="dropdown list_actions" style="display: none">
                                        <button role="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                                            {{ trans('messages.actions') }} <span class="number"></span><span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" link-method="PATCH" link-confirm="{{ trans('messages.enable_automations_confirm') }}" href="{{ route('user.automation.enable', Auth::user()->username) }}">
                                                    <span class="material-icons-outlined me-2">
                                                        play_arrow
                                                    </span> {{ trans('messages.enable') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" link-method="PATCH" link-confirm="{{ trans('messages.disable_automations_confirm') }}" href="{{ route('user.automation.disable', Auth::user()->username) }}">
                                                    <span class="material-icons-outlined me-2">
                                                        hide_source
                                                    </span> {{ trans('messages.disable') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" link-method='delete' link-confirm="{{ trans('messages.delete_automations_confirm') }}" href="{{ route('user.automation.delete', Auth::user()->username) }}">
                                                    <span class="material-icons-outlined me-2">
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
                            </div>
                            <div class="text-end">
                                <a href="{{ route("user.automation.wizard", Auth::user()->username) }}" role="button" class="btn btn-secondary create-automation2">
                                    <span class="material-icons-round">
                                        add
                                    </span> {{ trans('messages.automation.create') }}
                                </a>
                            </div>
                        </div>

                        <div id="Automation2IndexContent">



                        </div>
                    </div>

                    <script>
                        var Automation2Index = {
                            getList: function() {
                                return makeList({
                                    url: "{{ route('user.automation.listing', Auth::user()->username) }}",
                                    container: $('#Automation2IndexContainer'),
                                    content: $('#Automation2IndexContent')
                                });
                            }
                        };

                        $(document).ready(function() {
                            Automation2Index.getList().load();
                        });
                    </script>

                    <script>
                        var createAutomationPopup;

                        function showCreateCampaignPopup() {
                            var url = '{{ route("user.automation.wizardTrigger", Auth::user()->username) }}';

                            createAutomationPopup = new Popup();
                            createAutomationPopup.load(url);
                        }

                        $(document).ready(function() {

                            $('.create-automation2').click(function(e) {
                                e.preventDefault();

                                showCreateCampaignPopup();
                            });

                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
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
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . ": " . trans('messages.update_page', ['name' => trans('messages.' . $layout->alias)]) }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("user.list.index", Auth::user()->username) }}">{{ trans('messages.lists') }}</a></li>
                                <li class="breadcrumb-item">

                                </li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span class="text-semibold">{{ $list->name }}</span>
                    </h1>
                    <span class="badge badge-info bg-info-800 badge-big">{{ number_with_delimiter($list->readCache('SubscriberCount')) }}</span> {{ trans('messages.subscribers') }}
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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include("dashboard.campaign.lists._menu")

                    <h2 class="my-4">{{ trans('messages.' . $layout->alias) }}</h2>

                    @if ($layout->alias == 'sign_up_form')
                        <p class="alert alert-info mt-20 mb-20">{{ trans('messages.sign_up_form_url') }}<br />
                            <a target="_blank" href="{{ route('user.pages.signUpForm', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}" class="text-semibold">{{ route('user.pages.signUpForm', ['username' => Auth::user()->username, 'list_uid' => $list->uid]) }}</a>
                        </p>
                    @endif

                    <form id="update-page" action="{{ route('user.pages.update', ['username' => Auth::user()->username, 'list_uid' => $list->uid, 'alias' => $layout->alias]) }}" method="POST" class="form-validate-jqueryz">
                        {{ csrf_field() }}

                        @if ($page->canHasOutsideUrl())
                            <div class="form-group control-radio">
                                <div class="radio_box" data-popup='tooltip' title="">
                                    <label class="main-control">
                                        <input
                                            {{ ($page->use_outside_url ? 'checked' : '') }}
                                            checked type="radio"
                                            name="use_outside_url"
                                            value="1" class="styled" /><rtitle> {{ trans('messages.form_page.use_outside_url') }}</rtitle>
                                        <div class="desc text-normal mb-10">
                                            {{ trans('messages.form_page.use_outside_url.intro') }}
                                        </div>
                                    </label>
                                    <div class="radio_more_box">

                                        @include('helpers.form_control', [
                                            'type' => 'text',
                                            'name' => 'outside_url',
                                            'value' => $page->outside_url,
                                            'rules' => ['outside_url' => 'required'],
                                            'placeholder' => trans('messages.form_page.enter_outside_url'),
                                        ])
                                        <div class="">
                                            <button type="submit" class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save_change') }}</button>
                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="radio_box" data-popup='tooltip' title="">
                                    <label class="main-control">
                                        <input type="radio"
                                            {{ (!$page->use_outside_url ? 'checked' : '') }}
                                            name="use_outside_url"
                                            value="0" class="styled" /><rtitle> {{ trans('messages.form_page.use_built_in_page') }}</rtitle>
                                        <div class="desc text-normal mb-10">
                                            {{ trans('messages.form_page.use_built_in_page.intro') }}
                                        </div>
                                    </label>
                                    <div class="radio_more_box">
                                        @include('dashboard.campaign.pages._form')

                                        <hr />
                                        <div class="">
                                            <a page-url="{{ route('user.pages.preview', ['username' => Auth::user()->username, 'list_uid' => $list->uid, 'alias' => $layout->alias]) }}" class="btn btn-info me-1 preview-page-button" data-toggle="modal" data-target="#preview_page"><span class="material-icons-outlined">
    visibility
    </span> {{ trans('messages.preview') }}</a>
                                            <button type="submit" class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save_change') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @include('dashboard.campaign.pages._form')

                            <hr />
                            <div class="d-flex">
                                <a page-url="{{ route('user.pages.preview', ['username' => Auth::user()->username, 'list_uid' => $list->uid, 'alias' => $layout->alias]) }}"
                                    class="btn btn-info me-2 preview-page-button" data-toggle="modal" data-target="#preview_page"><span class="material-icons-outlined">
    visibility
    </span> {{ trans('messages.preview') }}</a>

                                <button type="submit" class="btn btn-secondary me-3"><i class="icon-check"></i> {{ trans('messages.save_change') }}</button>
                                <a href="{{ route('user.pages.restoreDefault', [
                                    'username' => Auth::user()->username,
                                    'list_uid' => $list->uid,
                                    'alias' => $layout->alias
                                ]) }}"
                                    link-method="POST"
                                    link-confirm="{{ trans('messages.page.restore.confirm') }}"
                                    class="btn btn-danger ms-auto">
                                    <span class="material-icons-outlined">
                                        restart_alt
                                    </span> {{ trans('messages.page.reset_default') }}</a>
                            </div>
                        @endif


                    </form>

                    <script>
                        var PagesUpdate = {
                            previewPopup: null,

                            getPreviewPopup: function() {
                                if (this.previewPopup == null) {
                                    this.previewPopup = new Popup();
                                }
                                return this.previewPopup;
                            },

                            showPreviewPopup: function(callback) {
                                this.getPreviewPopup().loadHtml(`
                                    <div class="modal-dialog shadow modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    <span class="material-icons-outlined me-1">
    visibility
    </span> {{ trans('messages.' . $layout->alias) }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center p-0">
                                                <iframe style="height: calc(100vh - 59px);
    margin-bottom: -10px;" scrolling="yes" name="preview_page_frame" class="preview_page_frame" src="/"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                `, callback);
                            }
                        }
                        $(function() {
                            // page preview action
                            $(".preview-page-button").on('click', function(e) {
                                var url = $(this).attr('page-url');
                                tinyMCE.triggerSave();
                                var formData = new FormData($("#update-page")[0]);
                                var frame = $('.preview_page_frame');
                                var current_action = $("#update-page").attr("action");

                                PagesUpdate.showPreviewPopup(function() {
                                    $("#update-page").attr('target', 'preview_page_frame');
                                    $("#update-page").attr('action', url);
                                    $("#update-page").submit();

                                    // after submit
                                    $("#update-page").removeAttr('target');
                                    $("#update-page").attr('action', current_action);
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




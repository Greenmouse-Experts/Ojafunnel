@extends('layouts.dashboard-frontend')
    <script type="text/javascript" src="{{ URL::asset('core/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/js/editor.js') }}"></script>

    <!-- Dropzone -->
	<script type="text/javascript" src="{{ URL::asset('core/dropzone/dropzone.js') }}"></script>
	<link href="{{ URL::asset('core/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
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
                        <h4 class="mb-sm-0 font-size-18">{{ $campaign->name }}</h4>
                        {{-- @include('campaigns._steps', ['current' => 1]) --}}
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mt-0 mb-3">{{ trans('messages.campaign.content_management') }}</h2>
                        <div class="sub-section d-flex">
                            <div class=" mr-auto pr-2">
                                <p>{{ trans('messages.campaign.email_content.intro') }}</p>

                                <div class="media-left">
                                    <div class="main">
                                        <label>{{ trans('messages.campaign.html_email') }}</label>
                                        <p>{{ trans('messages.campaign.html_email.last_edit', [
                                            'date' => App\Library\Tool::formatDateTime($campaign->updated_at),
                                        ]) }}</p>

                                        <p class="mt-20">
                                            @if (in_array(App\Models\Setting::get('builder'), ['both','pro']) && $campaign->template->builder)
                                                <a href="{{ route('user.campaign.templateEdit', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-primary me-1 template-compose">
                                                    {{ trans('messages.campaign.email_builder_pro') }}
                                                </a>
                                            @endif
                                            @if (in_array(App\Models\Setting::get('builder'), ['both','classic']))
                                                <a href="{{ route('user.campaign.builderClassic', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-default template-compose-classic">
                                                    {{ trans('messages.campaign.email_builder_classic') }}
                                                </a>
                                            @endif
                                            <a href="{{ route('user.campaign.templateCreate', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-link bg-grey-600 me-1">
                                                {{ trans('messages.campaign.change_template') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="template-thumb-container ml-4">
                                    <img class="automation-template-thumb" src="{{ $campaign->getThumbUrl() }}?v={{ Carbon\Carbon::now() }}" />
                                    <a
                                        onclick="popupwindow('{{ route('user.campaign.preview', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}', '{{ $campaign->name }}', 800, 800)"
                                        href="javascript:;"
                                        class="btn btn-primary" style="display:none"
                                    >
                                        {{ trans('messages.automation.template.preview') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($spamscore)
                            <div class="sub-section">
                                <h2 class="mt-0 mb-3">{{ trans('messages.campaign.spam_score') }}</h2>
                                <p>{!! trans('messages.campaign.score.intro') !!}</p>
                                <a href="#" id="calculate-score" class="btn btn-primary bg-grey-600 me-1">
                                    {{ trans('messages.campaign.check_spam_score') }}
                                </a>
                            </div>
                        @endif

                        <div class="sub-section">
                            <h2 class="mt-0 mb-3">{{ trans('messages.campaign.attachment') }}</h2>
                            <p>{{ trans('messages.campaign.attachment.intro') }}</p>

                            @include('dashboard.campaign._attachment')
                        </div>
                    </div>

                </div>
                <hr>
                <a href="{{ route('user.campaign.schedule', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}" class="btn btn-secondary">
                    {{ trans('messages.next') }} <span style="font-size: 17px; position: relative;top: 4px; color: #fff;" class="material-icons-outlined">
                    arrow_forward
                    </span>
                </a>

                <script>
                    var templatePopup = new Popup();

                    $(document).ready(function() {
                        $('.template-start').click(function() {
                            var url = $(this).attr('data-url');

                            templatePopup.load(url);
                        });

                        $('.template-compose').click(function(e) {
                            e.preventDefault();

                            var url = $(this).attr('href');

                            openBuilder(url);
                        });

                        $('.template-compose-classic').click(function(e) {
                            e.preventDefault();

                            var url = $(this).attr('href');

                            openBuilderClassic(url);
                        });
                    });

                    $('#calculate-score').click(function() {
                        spamPopup = new Popup("{{ route('user.campaign.spamScore', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}");
                        spamPopup.load();
                        return false;
                    });
                </script>
            </div>
        </div>

    </div>
</div>
@endsection

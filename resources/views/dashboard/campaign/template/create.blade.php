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
            <div class="Edit">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mt-0">{{ trans('messages.campaign.content_management') }}</h2>
                        <h3 class="mt-4">{{ trans('messages.campaign.email_content') }}</h3>
                        <p>{{ trans('messages.campaign.email_content.intro') }}</p>

                        <ul class="hover-list">
                            <li class="template-start" data-url="{{ route('user.campaign.templateLayout', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}">
                                <img width="35px" class="icon-img d-inline-block me-3" src="{{ url('images/icons/plus.svg') }}" />
                                <div class="list-body">
                                    <h4>{{ trans('messages.campaign.template.from_layout') }}</h4>
                                    <p>{{ trans('messages.campaign.template.from_layout.intro') }}</p>
                                </div>
                                <div class="list-action">
                                    <button
                                        class="btn btn-primary bg-grey-800"
                                    >
                                        {{ trans('messages.campaign.template.start') }}
                                    </button>
                                </div>
                            </li>
                            <li class="template-start" data-url="{{ route('user.campaign.templateUpload', ['username' => Auth::user()->username, 'uid' => $campaign->uid]) }}">
                                <img width="35px" class="icon-img d-inline-block me-3" src="{{ url('images/icons/upload.svg') }}" />
                                <div class="list-body">
                                    <h4>{{ trans('messages.campaign.template.upload') }}</h4>
                                    <p>{{ trans('messages.campaign.template.upload.intro') }}</p>
                                </div>
                                <div class="list-action">
                                    <button
                                        class="btn btn-primary bg-grey-800"
                                    >
                                        {{ trans('messages.campaign.template.start') }}
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    var templatePopup = new Popup();

    $(document).ready(function() {

        $('.template-start').click(function() {
            var url = $(this).attr('data-url');

            templatePopup.load(url);
        });

    });

    $(document).on('click', '.choose-theme', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        addMaskLoading();

        //
        $.ajax({
            url: url,
            method: 'POST',
            data: {
                _token: CSRF_TOKEN,
            },
            statusCode: {
                // validate error
                400: function (res) {
                    alert('Something went wrong!');
                }
            },
            success: function (response) {
                removeMaskLoading();

                // notify
                notify({
                    type: 'success',
                    title: '{!! trans('messages.notify.success') !!}',
                    message: response.message
                });

                builderSelectPopup.load(response.url);
                templatePopup.hide();
            }
        });
    });
</script>
@endsection

{{-- @extends('layouts.core.frontend')

@section('title', $server->name)

@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ action("HomeController@index") }}">{{ trans('messages.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ action("SenderController@index") }}">{{ trans('messages.verified_senders') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ action("SendingDomainController@index") }}">{{ trans('messages.domains') }}</a></li>
        </ul>
        <h1>
            <span class="text-semibold">{{ trans('messages.verified_senders') }}</span>
        </h1>
    </div>

@endsection

@section('content')

    @include('senders._menu')

    <div class="row">
        <div class="col-sm-12 col-md-10 col-lg-10">
            <h1>
                <span class="text-semibold"><span class="material-icons-outlined">
                public
                </span> {{ $server->name }}</span>
            </h1>
            <p>{!! trans('messages.sending_domain.wording') !!}</p>

            <h3>{{ trans('messages.sending_domain.dkim_title') }}</h3>
            <p>{!! trans('messages.sending_domain.dkim_wording') !!}</p>
            <p>{!! trans('messages.sending_domain.spf_wording') !!}</p>
        </div>

        <div class="col-sm-12 col-md-12 mt-20">
            <div class="scrollbar-boxx dim-box shadow-sm">
                <div class="listing-form"
					data-url="{{ action('SendingDomainController@records', $server->uid) }}"
					per-page="1">
                    <div class="pml-table-container">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr >
    <div class="text-left">
        <a href="javascript:;" class="btn btn-primary bg-teal verify-button">{{ trans('messages.sending_domain.verify') }}</a>
    </div>

    <script>
        var DomainDetails = {
            domainsList: null,
            getList: function() {
                if (this.domainsList == null) {
                    this.domainsList = makeList({
                        url: '{{ action('SendingDomainController@records', $server->uid) }}',
                        container: $('.listing-form'),
                        content: $('.pml-table-container')
                    });
                }

                return this.domainsList;
            }
        };

        $(function() {
            DomainDetails.getList().load();

            $('.verify-button').on('click', function() {
                var button = $(this);

                addButtonMask(button);
                DomainDetails.getList().masking();

                new Link({
                    type: 'ajax',
                    url: '{{ action('SendingDomainController@verify', $server->uid) }}',
                    method: 'POST',
                    data: {
                        _token: CSRF_TOKEN,
                    },
                    done: function() {
                        DomainDetails.getList().load();

                        removeButtonMask(button);
                    }
                });
            });

        });
    </script>

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
                        <h4 class="mb-sm-0 font-size-18">{{ $server->name }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sender.index', Auth::user()->username)}}">{{ trans('messages.verified_senders') }}</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sending-domain.index', Auth::user()->username)}}">{{ trans('messages.domains') }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.verified_senders') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.campaign.senders._menu')


                    <h1>
                        <span class="text-semibold"><span class="material-icons-outlined">
                        public
                        </span> {{ $server->name }}</span>
                    </h1>
                    <p>{!! trans('messages.sending_domain.wording') !!}</p>

                    <h3>{{ trans('messages.sending_domain.dkim_title') }}</h3>
                    <p>{!! trans('messages.sending_domain.dkim_wording') !!}</p>
                    <p>{!! trans('messages.sending_domain.spf_wording') !!}</p>

                    <div class="col-sm-12 col-md-12 mt-20">
                        <div class="scrollbar-boxx dim-box shadow-sm">
                            <div class="listing-form"
                                data-url="{{ route('user.sending-domain.records', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}"
                                per-page="1">
                                <div class="pml-table-container">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr >
                    <div class="text-left">
                        <a href="javascript:;" class="btn btn-primary bg-teal verify-button">{{ trans('messages.sending_domain.verify') }}</a>
                    </div>

                    <script>
                        var DomainDetails = {
                            domainsList: null,
                            getList: function() {
                                if (this.domainsList == null) {
                                    this.domainsList = makeList({
                                        url: '{{ route('user.sending-domain.records', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}',
                                        container: $('.listing-form'),
                                        content: $('.pml-table-container')
                                    });
                                }

                                return this.domainsList;
                            }
                        };

                        $(function() {
                            DomainDetails.getList().load();

                            $('.verify-button').on('click', function() {
                                var button = $(this);

                                addButtonMask(button);
                                DomainDetails.getList().masking();

                                new Link({
                                    type: 'ajax',
                                    url: '{{ route('user.sending-domain.verify', ['username' => Auth::user()->username, 'uid' => $server->uid]) }}',
                                    method: 'POST',
                                    data: {
                                        _token: CSRF_TOKEN,
                                    },
                                    done: function() {
                                        DomainDetails.getList().load();

                                        removeButtonMask(button);
                                    }
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




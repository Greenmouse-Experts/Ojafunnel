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
                        <h4 class="mb-sm-0 font-size-18">{{ $domain->name }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.tracking-domain.index', Auth::user()->username)}}">{{ trans('messages.tracking_domains') }}</a></li>
                                <li class="breadcrumb-item active">
                                    <span class="text-semibold"><span class="material-icons-outlined">
                                        public
                                        </span> {{ $domain->getUrl() }} </span>
                                        <span class="label label-primary bg-{{ $domain->status }}">
                                            {{ trans('messages.tracking_domain.status.' . $domain->status) }}
                                        </span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row sub_section">
                <div class="col-sm-12 col-md-8">
                    @if (!$domain->isVerified())
                        <h2>{{ trans('messages.tracking_domain.show.redirect_setup.title') }}</h2>
                        <p>{!! trans('messages.tracking_domain.show.redirect_setup.note', ['url' => $domain->getUrl() ]) !!}</p>
                        <p><button id="btnDownload" class="btn btn-link" style="padding:0" target="_blank">{{ trans('messages.tracking_domain.show.redirect_setup.download') }}</button></p>
                        <div class="alert alert-success" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                            <div style="display: flex; flex-direction: row; align-items: center;">
                                <div>
                                    <i class="lnr lnr-checkmark-circle"></i>
                                </div>
                                <div style="padding-right: 40px">
                                    <h4>{!! trans('messages.tracking_domain.show.redirect_setup.guide_title') !!}</h4>
                                    <p>{!! trans('messages.tracking_domain.show.redirect_setup.guide') !!}</p>
                                </div>
                            </div>
                        </div>
                        <p>{{ trans('messages.tracking_domain.show.redirect_setup.test') }}</p>
                        <a id="btnTest" href="#" class="btn btn-secondary mr-2" target="_blank">{{ trans('messages.tracking_domain.show.redirect_setup.test_button') }}</a>
                    @else
                        <div data-type="admin-notification" class="alert alert-success" style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                            <div style="display: flex; flex-direction: row; align-items: center;">
                                <div style="padding-right: 40px">
                                    <h4>{{ trans('messages.tracking_domain.show.verified_title') }}</h4>
                                    <p>{{ trans('messages.tracking_domain.show.verified_note') }}</p>
                                </div>
                            </div>
                        </div>
                        <a role="button" style="padding-left: 0" class="btn btn-link" href="{{ route('user.tracking-domain.index', Auth::user()->username) }}">{{ trans('messages.go_back') }}</a>
                    @endif
                </div>
            </div>

            <script>
                var TrackingDomainVerification = {
                    download: function() {
                        window.location.href = '{{ $download }}';
                    },

                    test: function() {
                        $.ajax({
                            url : "{{ route('user.tracking-domain.verify', ['username' => Auth::user()->username, 'uid' => $domain->uid]) }}",
                            type: "GET",
                            data: {
                                '_token': CSRF_TOKEN
                            },
                        }).done(function(result, textStatus, jqXHR) {
                            if (result.success == true) {
                                alert('{{ trans('messages.tracking_domain.verify.success') }}');
                                location.reload();
                            } else {
                                alert('{{ trans('messages.tracking_domain.verify.failed') }}');
                            }
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                            notify({
                                title: "{{ trans('messages.notify.error') }}",
                                message: errorThrown,
                            });
                        });
                    }
                }

                $(function() {
                    $('#btnTest').on('click', function(e) {
                        e.preventDefault();

                        TrackingDomainVerification.test();
                    });

                    $('#btnDownload').on('click', function(e) {
                        e.preventDefault();

                        TrackingDomainVerification.download();
                    });
                });



            </script>
        </div>
    </div>
</div>
@endsection





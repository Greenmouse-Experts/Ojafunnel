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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.tracking_domain.create') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.tracking-domain.index', Auth::user()->username)}}">{{ trans('messages.tracking_domains') }}</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.tracking_domain.create') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-10 col-lg-10">
                    <p>{!! trans('messages.tracking_domain.wording') !!}</p>
                </div>
            </div>

            <form action="{{ route('user.tracking-domain.store', Auth::user()->username) }}" method="POST" class="form-validate-jqueryz">
                @include('dashboard.campaign.tracking_domains._form')
            </form>
        </div>
    </div>
</div>
@endsection




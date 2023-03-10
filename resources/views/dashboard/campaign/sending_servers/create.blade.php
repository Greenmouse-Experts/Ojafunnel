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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.create_sending_server') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.sending-server.index', Auth::user()->username)}}">{{ trans('messages.sending_servers') }}</a></li>
                                <li class="breadcrumb-item active">
                                    <span class="text-semibold">{{ trans('messages.create_sending_server') }}</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

            </div>

            @include('dashboard.campaign.sending_servers.form.' . $server->type)
        </div>
    </div>
</div>
@endsection





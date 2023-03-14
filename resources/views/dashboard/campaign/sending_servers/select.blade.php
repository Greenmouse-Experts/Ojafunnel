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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.sending_servers') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <span class="text-semibold"><span class="material-icons-outlined">
                                        add
                                    </span> {{ trans('messages.select_sending_servers_type') }}</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <ul class="modern-listing big-icon no-top-border-list mt-0">
                        @foreach($more as $server)
                            <li>
                                <a href="{{ $server['create_url'] }}" class="btn btn-secondary">{{ trans('messages.choose') }}</a>
                                <a href="{{ $server['create_url'] }}">
                                    <span class="mc-server-avatar shadow-sm rounded server-avatar" style="background: url({{ $server['icon_url']  }}) top left/36px 36px no-repeat transparent;">
                                        <span class="material-icons-outlined">

                                        </span>
                                    </span>
                                </a>
                                <h4><a href="{{ $server['create_url'] }}">{{  $server['name']  }}</a> <span class="label label-flat bg-verified">
                                    {{ trans('messages.plugin') }}
                                </span> </h4>
                                <p>
                                    {{  $server['description']  }}
                                </p>
                            </li>
                        @endforeach

                        @foreach (\App\Models\SendingServer::types() as $key => $type)

                            <li>
                                <a href="{{ route('user.sending-server.create', ['username' => Auth::user()->username, "type" => $key]) }}" class="btn btn-secondary">{{ trans('messages.choose') }}</a>
                                <a href="{{ route('user.sending-server.create', ['username' => Auth::user()->username, "type" => $key]) }}">
                                    <span class="mc-server-avatar shadow-sm rounded server-avatar server-avatar-{{ $key }}">
                                        <span class="material-icons-outlined">

                                        </span>
                                    </span>
                                </a>
                                <h4><a href="{{ route('user.sending-server.create', ['username' => Auth::user()->username, "type" => $key]) }}">{{ trans('messages.' . $key) }}</a></h4>
                                <p>
                                    {{ trans('messages.sending_server_intro_' . $key) }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="">
                        <a href="{{ route('user.sending-server.index', Auth::user()->username) }}" role="button" class="btn btn-secondary">
                            <i class="icon-cross2"></i> {{ trans('messages.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




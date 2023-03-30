@extends('layouts.admin-mail-frontend')

@section('title', trans('messages.sending_servers'))


@section('page-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title">
                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li class="breadcrumb-item"><a href="{{ route("adminDashboard") }}">{{ trans('messages.home') }}</a></li>
                </ul>

                <h1>
                    <span class="text-semibold"><span class="material-icons-outlined">
        add
        </span> {{ trans('messages.select_sending_servers_type') }}</span>
                </h1>
            </div>
            <div class="row">
                <div class="col-md-12">
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

                        @foreach (App\Models\SendingServer::types() as $key => $type)

                            <li>
                                <a href="{{ route('sending.server.create', ["type" => $key]) }}" class="btn btn-secondary">{{ trans('messages.choose') }}</a>
                                <a href="{{ route('sending.server.create', ["type" => $key]) }}">
                                    <span class="mc-server-avatar shadow-sm rounded server-avatar server-avatar-{{ $key }}">
                                        <span class="material-icons-outlined">

        </span>
                                    </span>
                                </a>
                                <h4><a href="{{ route('sending.server.create', ["type" => $key]) }}">{{ trans('messages.' . $key) }}</a></h4>
                                <p>
                                    {{ trans('messages.sending_server_intro_' . $key) }}
                                </p>
                            </li>
                        @endforeach
                    </ul>
                    <div class="">
                        <a href="{{ route('sending.server.index') }}" role="button" class="btn btn-secondary">
                            <i class="icon-cross2"></i> {{ trans('messages.cancel') }}
                        </a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
</div>
@endsection
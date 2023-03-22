@extends('layouts.admin-mail-frontend')

@section('title', trans('messages.create_sending_server'))


@section('page_header')



@endsection

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="page-title">
                <ul class="breadcrumb breadcrumb-caret position-right">
                    <li class="breadcrumb-item"><a href="{{ route("adminDashboard") }}">{{ trans('messages.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route("sending.server.index") }}">{{ trans('messages.sending_servers') }}</a></li>
                </ul>
                <h1 class="mc-h1">
                    <span class="text-semibold">{{ trans('messages.create_sending_server') }}</span>
                </h1>
            </div>
            @include('Admin.email.sending_servers.form.' . $server->type)
        </div>
    </div>
</div>
@endsection

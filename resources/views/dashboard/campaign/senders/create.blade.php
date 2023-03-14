{{-- @extends('layouts.core.frontend')

@section('title', trans('messages.sender.create'))

@section('page_header')

    <div class="page-title">
        <ul class="breadcrumb breadcrumb-caret position-right">
            <li class="breadcrumb-item"><a href="{{ action("HomeController@index") }}">{{ trans('messages.home') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ action("SenderController@index") }}">{{ trans('messages.verified_senders') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ action("SendingDomainController@index") }}">{{ trans('messages.email_addresses') }}</a></li>
        </ul>
        <h1>
            <span class="text-semibold">{{ trans('messages.verified_senders') }}</span>
        </h1>
    </div>

@endsection

@section('content')
    @include('dashboard.campaign.senders._menu')

    <h2>{{ trans('messages.sender.create') }}</h2>

    <form enctype="multipart/form-data" action="{{ action('SenderController@store') }}" method="POST" class="form-validate-jqueryz">
        {{ csrf_field() }}

        @include('dashboard.campaign.senders._form')
    <form>

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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.sender.create') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.verified_senders') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include('dashboard.campaign.senders._menu')

                    <h2>{{ trans('messages.sender.create') }}</h2>

                    <form enctype="multipart/form-data" action="{{ route('user.sender.store', Auth::user()->username) }}" method="POST" class="form-validate-jqueryz">
                        {{ csrf_field() }}

                        @include('dashboard.campaign.senders._form')
                    <form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


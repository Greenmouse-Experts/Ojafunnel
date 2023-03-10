

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
                        <h4 class="mb-sm-0 font-size-18">{{ $sender->name }}</h4>
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

                    <h2>
                        <span class="text-semibold"><span class="material-icons-round">
                                            person_outline
                                            </span> {{ $sender->name }}</span>
                    </h2>

                    <form enctype="multipart/form-data" action="{{ route('user.sender.update', ['username' => Auth::user()->username, 'uid' => $sender->uid]) }}" method="POST" class="form-validate-jquery">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">

                        @include('dashboard.campaign.senders._form')

                    <form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

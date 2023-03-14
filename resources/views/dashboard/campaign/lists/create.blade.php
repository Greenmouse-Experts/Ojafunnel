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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.create_list') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("user.list.index", Auth::user()->username) }}">{{ trans('messages.lists') }}</a></li>

                            </ol>
                        </div>
                        <h1>
                            <span class="text-semibold"><span class="material-icons-round">
                            add
                            </span> {{ trans('messages.create_list') }}</span>
                        </h1>

                    </div>
                    <h1>
                        <span class="text-semibold">{{ $list->name }}</span>
                    </h1>
                    <span class="badge badge-info bg-info-800 badge-big">{{ number_with_delimiter($list->readCache('SubscriberCount')) }}</span> {{ trans('messages.subscribers') }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('user.list.store', Auth::user()->username) }}" method="POST" class="form-validate-jqueryz">
                        {{ csrf_field() }}
                        @include("dashboard.campaign.lists._form")
                        <hr>
                        <div class="text-left">
                            <button class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
                            <a href="{{ route('user.list.index', Auth::user()->username) }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



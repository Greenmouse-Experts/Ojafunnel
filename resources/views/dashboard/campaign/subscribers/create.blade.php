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
                        <h4 class="mb-sm-0 font-size-18">{{ $list->name . ": " . trans('messages.create_subscriber') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route("user.list.index", Auth::user()->username) }}">{{ trans('messages.lists') }}</a></li>
                                <li class="breadcrumb-item">
                                    <div class="btn-group other-lists" style="margin-top: -4px;">
                                        <button role="button" class="btn dropdown-toggle text-teal-600 change-list-button" data-bs-toggle="dropdown">{{ trans('messages.change_list') }} <span class="caret"></span></button>
                                        <ul class="dropdown-menu dropdown-menu-left">
                                            @forelse ($list->otherLists() as $l)
                                                <li>
                                                    <a class="dropdown-item" href="{{ route('user.list.overview', ['username' => Auth::user()->username, 'uid' => $l->uid]) }}">
                                                        {{ $l->readCache('LongName', $l->name) }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li><a href="#">({{ trans('messages.empty') }})</a></li>
                                            @endforelse
                                        </ul>
                                    </div>
                                </li>
                            </ol>
                        </div>

                    </div>
                    <h1>
                        <span class="text-semibold">{{ $list->name }}</span>
                    </h1>
                    <span class="badge badge-info bg-info-800 badge-big">{{ number_with_delimiter($list->readCache('SubscriberCount')) }}</span> {{ trans('messages.subscribers') }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @include("dashboard.campaign.lists._menu")

                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="sub-section">
                                <h2 class="text-semibold text-primary my-4"><span class="material-icons-outlined">
            add
            </span> {{ trans('messages.create_subscriber') }}</h2>

                                <form action="{{ route('user.subscriber.store', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" method="POST" class="form-validate-jquery">
                                    {{ csrf_field() }}

                                    @include("dashboard.campaign.subscribers._form")

                                    @if (\App\Models\Setting::get('import_subscribers_commitment'))
                                        <hr>
                                        <div class="mt-5">
                                            @include('helpers.form_control', [
                                                'type' => 'checkbox2',
                                                'class' => 'policy_commitment mb-10 required',
                                                'name' => 'policy_commitment',
                                                'value' => 'no',
                                                'required' => true,
                                                'label' => \App\Models\Setting::get('import_subscribers_commitment'),
                                                'options' => ['no','yes'],
                                                'rules' => []
                                            ])
                                        </div>
                                    @endif

                                    <div class="text-left">
                                        <button class="btn btn-secondary me-2"><i class="icon-check"></i> {{ trans('messages.save') }}</button>
                                        <a href="{{ route('user.subscriber.index', ['username' => Auth::user()->username, 'uid' => $list->uid]) }}" class="btn btn-link"><i class="icon-cross2"></i> {{ trans('messages.cancel') }}</a>
                                    </div>
                                <form>
                            </div>
                        </div>
                    </div>
                    <script>
                        $(function() {
                            // policy_commitment
                            $('.policy_commitment').each(function () {
                                var input = $(this);
                                var form = input.closest('form');


                                form.submit(function(e) {
                                    if (form.valid()) {
                                        if (input.is(':checked')) {
                                            return true;
                                        } else {
                                            e.preventDedault();
                                            return false;
                                        }
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




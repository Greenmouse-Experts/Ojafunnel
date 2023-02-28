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
                        <h4 class="mb-sm-0 font-size-18">{{ trans('messages.select_campaign_type') }}</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">{{ trans('messages.campaigns') }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <ul class="modern-listing big-icon no-top-border-list mt-0">
                        @foreach (App\Models\Campaign::types() as $key => $type)

                            <li>
                                <a href="{{ route("user.campaign.create", ["username" => Auth::user()->username ,"type" => $key]) }}" class="btn btn-secondary">{{ trans('messages.choose') }}</a>
                                <div class="d-flex pe-4">
                                    <a href="{{ route("user.campaign.create", ["username" => Auth::user()->username ,"type" => $key]) }}">
                                        <span class="pt-1 d-block">
                                            @if ($key == 'regular')
                                                <img width="40px" class="icon-img d-inline-block me-4" src="{{ url('images/icons/regular.svg') }}" />
                                            @elseif ($key == 'plain-text')
                                                <img width="40px" class="icon-img d-inline-block me-4" src="{{ url('images/icons/plain.svg') }}" />
                                            @endif
                                        </span>
                                    </a>
                                    <div>
                                        <h4 class="mb-1"><a href="{{ route("user.campaign.create", ["username" => Auth::user()->username ,"type" => $key]) }}">{{ trans('messages.' . $key) }}</a></h4>
                                        <p>
                                            {{ trans('messages.campaign_intro_' . $key) }}
                                        </p>
                                    </div>
                                </div>

                            </li>

                        @endforeach

                    </ul>
                    <div class="">
                        <a href="{{route('user.campaign.overview', Auth::user()->username)}}" role="button" class="btn btn-secondary">
                            <i class="icon-cross2"></i> {{ trans('messages.cancel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var CampaignsIndex = {
                getList: function() {
                    return makeList({
                        url: '{{ route('user.campaign.list', ['username' => Auth::user()->username]) }}',
                        container: $('#CampaignsIndexContainer'),
                        content: $('#CampaignsIndexContent')
                    });
                }
            };

            $(document).ready(function() {
                console.log(CampaignsIndex.getList())
                CampaignsIndex.getList().load();
            });
        </script>
    </div>
</div>
@endsection

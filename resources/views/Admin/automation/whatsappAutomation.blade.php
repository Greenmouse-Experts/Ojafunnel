@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Whatsapp Automation</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Whatsapp Automation</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Whatsapp Automation</h4>
                            <p>
                                View all automated whatsapp services on ojafunnel.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Automation Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table align-middle table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's</th>
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Sent</th>
                                            <th scope="col">Failed</th>
                                            <th scope="col">Campaign Type</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($whatsappAutomations as $key => $campaign)
                                            <tr>
                                                <th scope="row">{{$loop->iteration}}</th>
                                                <th scope="row">
                                                    <p>{{$campaign->user->username}}</p>
                                                    <p>{{$campaign->user->email}}</p>
                                                </th>
                                                <td>
                                                    <p class='text-bold-600'> {{$campaign->title}} </p>
                                                    <p class='text-muted'>Created at: {{$campaign->created_at->toDayDateTimeString()}}</p>
                                                </td>
                                                <td>
                                                    {{ $campaign->readCache('ContactCount') }}
                                                </td>
                                                <td>
                                                    {{ $campaign->readCache('DeliveredCount') }}
                                                </td>
                                                <td>
                                                    {{ $campaign->readCache('FailedDeliveredCount') }}
                                                </td>
                                                <td>
                                                    {!!$campaign->getCampaignType()!!}
                                                </td>
                                                <td>
                                                    {!!$campaign->getStatus()!!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

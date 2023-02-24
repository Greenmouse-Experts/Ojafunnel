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
                        <h4 class="mb-sm-0 font-size-18">SMS Automation</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">SMS Automation</li>
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
                            <h4 class="font-500">SMS Automation</h4>
                            <p>
                                View all automated sms services on ojafunnel.
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
                                        @foreach($smsAutomations as $key => $campaign)
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
    <div class="modal fade" id="viewSms" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Weekly Deals
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <div>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil perferendis voluptatem, reiciendis velit cumque, earum numquam ullam voluptate eligendi officia voluptatum exercitationem error? Necessitatibus eveniet commodi similique beatae illum sint.
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga, ullam illo ipsam, quo iste veritatis iusto et provident ab sed dolore, officiis eos ipsa consequuntur laborum nam reiciendis molestias ducimus?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

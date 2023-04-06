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
                    <h4 class="card-title mb-4">Automations</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table align-middle table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Campaign Name</th>
                                            <th scope="col">Whatsapp Account</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Sent</th>
                                            <th scope="col">Failed</th>
                                            <th scope="col">Campaign Template</th>
                                            <th scope="col">Status</th>
                                            {{-- <th scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($whatsapp_campaigns as $whatsapp_campaign)
                                            <tr>
                                                <th scope="row">{{$whatsapp_campaign->id}}</th>
                                                <th scope="row" class="text-capitalize">{{$whatsapp_campaign->name}}</th>
                                                <td>
                                                    <p class='text-bold-600'> {{$whatsapp_campaign->whatsapp_account}} </p> 
                                                </td>
                                                <td>
                                                    {{ count($whatsapp_campaign->wa_queues) }}
                                                </td>
                                                <td>
                                                    {{ count($whatsapp_campaign->wa_queues->where('status', 'Sent')) }}
                                                </td>
                                                <td>
                                                    {{ count($whatsapp_campaign->wa_queues->where('status', 'Invalid')) }}
                                                </td>
                                                <td>
                                                    @if ($whatsapp_campaign->template == 'template1')
                                                        {{ 'Template 1 (Text) '}}  
                                                    @endif 

                                                    @if ($whatsapp_campaign->template == 'template2')
                                                        {{ 'Template 2 (Text & File) '}}  
                                                    @endif 

                                                    @if ($whatsapp_campaign->template == 'template3')
                                                        {{ 'Template 3 (Header, Text, Footer, Link, & Call) '}}  
                                                    @endif 
                                                </td>
                                                <td>   
                                                    @if ($whatsapp_campaign->message_timing == 'Immediately')
                                                        @if (count($whatsapp_campaign->wa_queues->where('status', 'Waiting')) > 0)
                                                            <span class="badge bg-info font-size-10">{{ 'Ongoing' }}</span>
                                                        @else
                                                            <span class="badge bg-success font-size-10">{{ 'Completed' }}</span>
                                                        @endif 
                                                    @else
                                                        <span class="badge bg-success font-size-10">{{ 'Scheduled' }}</span>
                                                    @endif

                                                
                                                </td>
                                                {{-- <td>
                                                    <div class="dropdown dropstart"> 
                                                        <ul class="list-unstyled hstack gap-1 mb-0"> 
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Overview">
                                                                <a href="{{ '' }}" class="btn btn-sm btn-soft-info"><i class="mdi mdi-eye-outline"></i></a>
                                                            </li> 
                                                        </ul>
                                                    </div>
                                                </td> --}}
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

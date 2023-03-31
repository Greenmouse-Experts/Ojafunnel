@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">WhatsApp Automation Overview</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">WhatsApp Automation Overview</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">WhatsApp Automation Overview</h4>
                                    <p>
                                        View your campaign overview
                                    </p> 
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create"></div>
                                </div>
                            </div>
                        </div> 
                        <div class="d-flex account-nav"> 
                            <p class="ps-0 active">
                                <a href="#" class="text-decoration-none text-dark">Campaign Overview</a>
                            </p>  
                        </div>
                        <div class="acc-border"></div>
                        <div class="mt-2">
                            @if ($wa_campaign->message_timing == 'Immediately') 
                                <p><b>Message Timing:</b> Immediate Campaign</p>
                            @else
                                <p><b>Message Timing:</b> Scheduled Campaign</p>
                                @if ($wa_campaign->frequency_cycle == 'onetime')
                                    <p><b>Schedule Cycle:</b> {{ $wa_campaign->frequency_cycle }}</p>
                                    <p><b>Start Date:</b> {{ $wa_campaign->start_date }}</p>
                                    <p><b>Start Time:</b> {{ $wa_campaign->start_time }}</p>
                                @elseif ($wa_campaign->frequency_cycle == 'daily' || $wa_campaign->frequency_cycle == 'weekly' || $wa_campaign->frequency_cycle == 'monthly' || $wa_campaign->frequency_cycle == 'yearly')
                                    <p><b>Schedule Cycle:</b> {{ $wa_campaign->frequency_cycle }}</p>
                                    <p><b>Start Date:</b> {{ $wa_campaign->start_date }}</p>
                                    <p><b>Start Time:</b> {{ $wa_campaign->start_time }}</p>
                                    <p><b>Next Campaign Date & Time:</b> {{ $wa_campaign->start_date . 'at' . $wa_campaign->start_time }}</p>
                                    <p><b>End Date:</b> {{ $wa_campaign->end_date }}</p>
                                @else
                                    <p><b>Schedule Cycle:</b> {{ $wa_campaign->frequency_cycle }}</p>
                                    <p><b>Frequency amount:</b> {{ $wa_campaign->frequency_amount }}</p>
                                    <p><b>Frequency unit:</b> {{ $wa_campaign->frequency_unit }}</p>
                                    <p><b>Start Date:</b> {{ $wa_campaign->start_date }}</p>
                                    <p><b>Start Time:</b> {{ $wa_campaign->start_time }}</p>
                                    <p><b>Next Campaign Date & Time:</b> {{ $wa_campaign->start_date . 'at' . $wa_campaign->start_time }}</p>
                                    <p><b>End Date:</b> {{ $wa_campaign->end_date }}</p>
                                @endif 
                            @endif 
                        </div> 
                    </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="">
                    <div class="store-table">
                        <div class="table-head row pt-4">
                            <div class="col-lg-12 text-capitalize">
                                <h4>{{ $wa_campaign->name }} Campaigns Overview</h4>
                            </div> 
                        </div>
                        <div class="table-body mt-1 table-responsive">
                            <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                                <thead class="fw-bold dark" style="background:#F5E6FE;">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Campaign Name</th>
                                        <th scope="col">Campaign Template</th>
                                        <th scope="col">Whatsapp Account</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>   
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse ($wa_queues as $wa_queue)
                                        <tr>
                                            <th scope="row">{{$wa_queue->id}}</th>
                                            <th scope="row" class="text-capitalize">{{$wa_campaign->name}}</th>
                                            <th scope="row" class="text-capitalize">
                                                @if ($wa_campaign->template == 'template1')
                                                {{ 'Template 1 (Text) '}}  
                                                @endif 

                                                @if ($wa_campaign->template == 'template2')
                                                    {{ 'Template 2 (Text & File) '}}  
                                                @endif 

                                                @if ($wa_campaign->template == 'template3')
                                                    {{ 'Template 3 (Header, Text, Footer, Link, & Call) '}}  
                                                @endif 
                                            </th>
                                            <td>
                                                <p class='text-bold-600'> {{$wa_campaign->whatsapp_account}} </p> 
                                            </td>
                                            <td>
                                                {{ $wa_queue->phone_number }}
                                            </td>
                                            <td>
                                                @if ($wa_queue->status == 'Sent')
                                                    <span class="badge bg-success font-size-10">{{ $wa_queue->status }}</span>
                                                @endif
                                                
                                                @if ($wa_queue->status == 'Waiting')
                                                    <span class="badge bg-info font-size-10">{{ $wa_queue->status }}</span>
                                                @endif 

                                                @if ($wa_queue->status == 'Scheduled')
                                                    <span class="badge bg-info font-size-10">{{ $wa_queue->status }}</span>
                                                @endif 

                                                @if ($wa_queue->status == 'Invalid')
                                                    <span class="badge bg-danger font-size-10">{{ $wa_queue->status }}</span>
                                                @endif 

                                                @if ($wa_queue->status == 'Disconnected')
                                                    <span class="badge bg-danger font-size-10">{{ $wa_queue->status }}</span>
                                                @endif 
                                            </td> 
                                        </tr>
                                    @empty
                                        No whatsapp automation Overview yet!
                                    @endforelse
                                    
                                </tbody> 
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    <!-- email confirm modal -->
    <div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add Whatsapp Number
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Description</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" placeholder="Enter a description, eg for book sales" id="" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Cancel
                                            </button></a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                Save Number
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->
<style>
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
</style>
@endsection

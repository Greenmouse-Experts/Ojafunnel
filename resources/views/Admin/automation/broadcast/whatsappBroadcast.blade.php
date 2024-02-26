@extends('layouts.admin-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">WhatsApp Broadcast</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">WhatsApp Broadcast</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
             <!-- start page title -->
             <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">WhatsApp Broadcast</h4>
                            <p>
                                Send broadcast messages to your contact
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Whatsapp Broadcast')->exists())
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                                <a href="{{route('admin.wa-automation.broadcast.create')}}">
                                    <button>
                                        Send Broadcast Messsage
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2"></div>
                <div class="">
                    <div class="store-table">
                        <div class="table-head row pt-4">
                            <div class="col-lg-12 text-capitalize">
                                <h4>Whatsapp Broadcast Overview</h4>
                            </div> 
                        </div>
                        <div class="table-body mt-1 table-responsive">
                            <table id="datatable-buttons" class=" table table-bordered dt-responsive nowrap w-100">
                                <thead class="fw-bold dark" style="background:#F5E6FE;">
                                    <tr>
                                        <th scope="col">S/N</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Sender</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Contacts</th>
                                        <th scope="col">Delivered</th>
                                        {{-- <th scope="col">Failed</th>
                                        <th scope="col">Not Delivered</th>    --}}
                                    </tr>
                                </thead>  
                                <tbody>
                                    @forelse ($broadcasts as $broadcast)
                                        <tr>
                                            <td scope="row">{{$loop->iteration}}</td>
                                            <td scope="row">{{$broadcast->date}} {{$broadcast->time}}</td>
                                            <td scope="row" class="text-capitalize">{{$broadcast->sender_id}}
                                            </td>
                                            <td scope="row">
                                                <p>{{$broadcast->message}}</p>
                                            </td>
                                            <td>
                                                <p class='text-bold-600'> {{$broadcast->ContactCount}} </p> 
                                            </td>
                                            <td>
                                                <p class='text-bold-600'> {{$broadcast->DeliveredCount}} </p> 
                                            </td>
                                            {{-- <td>
                                                <p class='text-bold-600'> {{$broadcast->FailedDeliveredCount}} </p> 
                                            </td>
                                            <td>
                                                <p class='text-bold-600'> {{$broadcast->NotDeliveredCount}} </p> 
                                            </td> --}}
                                        </tr>
                                    @empty
                                        No whatsapp broacast overview yet!
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
@endsection
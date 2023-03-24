@extends('layouts.admin-frontend')

@section('page-content')
@php
    $admin = auth()->guard('admin')->user();
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Transactions Histroy</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Histroy</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Transactions History</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Transactions</h4>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-order" role="tab">
                                        All
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#processing" role="tab">
                                        Recent Transaction
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="all-order" role="tabpanel">

                                    <div class="table-responsive mt-2">
                                        <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th class="align-middle">Order ID</th>
                                                    <th class="align-middle">Reference No.</th>
                                                    <th class="align-middle">Billing Name</th>
                                                    <th class="align-middle">Date</th>
                                                    <th class="align-middle">Total</th>
                                                    <th class="align-middle">Payment Status</th>
                                                    {{-- <th class="align-middle">Payment Method</th>
                                                    <th class="align-middle">View Details</th> --}}
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach ($admin->getAllTransactionLists() as $item)
                                                    <tr>
                                                        <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                                        <td>{{$item->reference}}</td>
                                                        <td>{{$item->user->first_name}} {{$item->user->last_name}}</td>
                                                        <td>
                                                            {{$item->created_at->format('d M, Y')}}
                                                        </td>
                                                        <td>
                                                            ₦{{number_format($item->amount, 2)}}
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-pill badge-soft-success font-size-11">{{$item->status}}</span>
                                                        </td>
                                                        {{-- <td>
                                                            <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                                        </td> --}}
                                                        {{-- <td>
                                                            <!-- Button trigger modal -->
                                                            <!-- Button trigger modal -->
                                                            <a href="{{route('trans.details')}}">
                                                                <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light">
                                                                    View Details
                                                                </button>
                                                            </a>
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane" id="processing" role="tabpanel">
                                    <div>
                                        <div class="table-responsive mt-3">
                                            <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th class="align-middle">Order ID</th>
                                                        <th class="align-middle">Reference No.</th>
                                                        <th class="align-middle">Billing Name</th>
                                                        <th class="align-middle">Date</th>
                                                        <th class="align-middle">Total</th>
                                                        <th class="align-middle">Payment Status</th>
                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    @foreach ($admin->recentTransactions() as $item)
                                                        <tr>
                                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                                            <td>{{$item->reference}}</td>
                                                            <td>{{$item->user->first_name}} {{$item->user->last_name}}</td>
                                                            <td>
                                                                {{$item->created_at->format('d M, Y')}}
                                                            </td>
                                                            <td>
                                                                ₦{{number_format($item->amount, 2)}}
                                                            </td>
                                                            <td>
                                                                <span class="badge badge-pill badge-soft-success font-size-11">{{$item->status}}</span>
                                                            </td>
                                                            {{-- <td>
                                                                <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                                            </td> --}}
                                                            {{-- <td>
                                                                <!-- Button trigger modal -->
                                                                <!-- Button trigger modal -->
                                                                <a href="{{route('trans.details')}}">
                                                                    <button type="button" class="btn btn-primary btn-sm btn-rounded waves-light">
                                                                        View Details
                                                                    </button>
                                                                </a>
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
        </div>
    </div>
</div>
@endsection

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
                        <h4 class="mb-sm-0 font-size-18">Transaction History</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Transaction History</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-3">All Transaction</h4>
                            <div class="tab-content p-3">
                                <div class="tab-pane active" id="all-order" role="tabpanel">

                                    <div class="table-responsive mt-2">
                                        <table class="table table-hover datatable dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Transaction Date</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Transaction Reference No</th>
                                                    <th scope="col">Status</th>
                                                </tr>

                                            </thead>

                                            @foreach($transactions as $transaction)
                                            <tbody>
                                                <tr>
                                                    <td>{{$transaction->created_at->toDayDateTimeString()}}</td>
                                                    <td>₦{{number_format($transaction->amount, 2)}}</td>
                                                    <td>{{$transaction->reference}}</td>
                                                    <td>
                                                        @if($transaction->status == "Top Up")
                                                        <span class="badge bg-success font-size-10">{{$transaction->status}} <i class="mdi mdi-arrow-up me-1"></i></span>
                                                        @else
                                                        <span class="badge bg-danger font-size-10">{{$transaction->status}} <i class="mdi mdi-arrow-down me-1"></i></span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
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
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
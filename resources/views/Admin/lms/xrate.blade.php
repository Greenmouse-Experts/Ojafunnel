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
                        <h4 class="mb-sm-0">Exchange Rate</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Exchange Rate</li>
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
                            <h4 class="font-500">Exchange Rate Listings</h4>
                            <p>
                                Browse through and view shops created by ojafunnel users.
                            </p>
                            <button data-bs-toggle="modal" data-bs-target="#template" class="btn btn-primary d-block mt-2">Set Rate</button>

                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Rates List</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 530px;">
                                <table class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Currency</th>
                                            <th>Amount</th>
                                            <th>Fiat</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $item)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{$item->fx_symbol}}
                                            </td>
                                            <td>
                                                {{$item->fx_amount}}
                                            </td>
                                            <td>{{$item->fiat}}</td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
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

<!-- Modal START -->
<div class="modal fade" id="template" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('xrate.update')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p>
                                    <b>
                                        Set Exchange Rate
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Naira -> Dollar </label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="0.00" name="dollar" value="1.00" class="input" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Naira  -> GBP</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="0.00" id="subdomain" name="pounds" value="1.00" class="input" required>
                                                <small id="generateSubDomain"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">
                                                Proceed
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

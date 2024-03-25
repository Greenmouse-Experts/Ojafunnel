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
                            <h4 class="font-500">Transactions Histroy</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Finalized Payouts</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle">Transaction Reference No</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($withdrawals as $key => $withdraw)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                @if($withdraw->wallet == 'Naira')
                                                <p class='text-bold-600'> ₦{{number_format($withdraw->amount, 2)}} </p>
                                                @else
                                                <p class='text-bold-600'> ${{number_format($withdraw->amount, 2)}} </p>
                                                @endif
                                            </td>
                                            <td>
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#view-{{$withdraw->id}}">View Payment Method</a>
                                                <div class="modal fade" id="view-{{$withdraw->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myExtraLargeModalLabel">View payment method</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body ">
                                                                <div class="row">
                                                                    <div class="Editt">
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'PAYPAL')
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="col-lg-12 mb-4 text-center">
                                                                                        <label for="">{{App\Models\BankDetail::find($withdraw->payment_method)->type}}</label>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="">Account Holder Name: </label>
                                                                                        <label>{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}</label>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="">Email: </label>
                                                                                        <label>{{App\Models\BankDetail::find($withdraw->payment_method)->secret_key}}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'US')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4 text-center">
                                                                                    <label for="">{{App\Models\BankDetail::find($withdraw->payment_method)->type}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Holder Name: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="bank">Bank Account: </label>
                                                                                    <label style="display: none;">{{App\Models\BankDetail::find($withdraw->payment_method)->type_of_bank_account}}</label>
                                                                                    <p onmouseover="showTBA()" onmouseout="hideTBA();"><input type="password" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->type_of_bank_account}}" id="typeBA" disabled style="border: none; outline: none; background-color: #fff !important;"></p>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Routing Number: </label>
                                                                                    <label style="display: none;">{{App\Models\BankDetail::find($withdraw->payment_method)->routing_number}}</label>
                                                                                    <p onmouseover="showRoutingNumber()" onmouseout="hideRoutingNumber();"><input type="password" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->routing_number}}" id="routingNumber" disabled style="border: none; outline: none; background-color: #fff !important;"></p>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Number: </label>
                                                                                    <label style="display: none;">{{App\Models\BankDetail::find($withdraw->payment_method)->account_number}}</label>
                                                                                    <p onmouseover="showAccountNumber()" onmouseout="hideAccountNumber();"><i class="uil uil-wallet"></i> <input type="password" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_number}}" id="accountNumber" disabled style="border: none; outline: none; background-color: #fff !important;"></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'PAYSTACK')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4 text-center">
                                                                                    <label for="">{{App\Models\BankDetail::find($withdraw->payment_method)->type}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Holder Name: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Secret Key: </label>
                                                                                    <label style="display: none;">{{App\Models\BankDetail::find($withdraw->payment_method)->secret_key}}</label>
                                                                                    <p onmouseover="showSecret()" onmouseout="hideSecret();"><input type="password" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->secret_key}}" id="secretKey" disabled style="border: none; outline: none; background-color: #fff !important;"></p>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Public Key: </label>
                                                                                    <label style="display: none;">{{App\Models\BankDetail::find($withdraw->payment_method)->public_key}}</label>
                                                                                    <p onmouseover="showPublic()" onmouseout="hidePublic();"><input type="password" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->public_key}}" id="publicKey" disabled style="border: none; outline: none; background-color: #fff !important;"></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'NGN')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4 text-center">
                                                                                    <label for="">{{App\Models\BankDetail::find($withdraw->payment_method)->type}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Name: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Number: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->account_number}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="bank">Bank Name: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->bank_name}}</label>
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Bank Code: </label>
                                                                                    <label>{{App\Models\BankDetail::find($withdraw->payment_method)->bank_code}}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $withdraw->description }}
                                            </td>
                                            <td>
                                                {{ App\Models\Transaction::find($withdraw->transaction_id)->reference}}
                                            </td>
                                            <td>
                                                @if ($withdraw->status == 'created')
                                                    <span class="badge badge-pill badge-soft-primary font-size-11">{{$withdraw->status}}</span>
                                                @endif

                                                @if ($withdraw->status == 'refunded')
                                                    <span class="badge badge-pill badge-soft-secondary font-size-11">{{$withdraw->status}}</span>
                                                @endif

                                                @if ($withdraw->status == 'finalized')
                                                    <span class="badge badge-pill badge-soft-success font-size-11">{{$withdraw->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($withdraw->created_at)->isoFormat('llll') }}
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

<script>
    function showSecret() {
        var x = document.getElementById("secretKey");
        x.type = "text";
    }

    function hideSecret() {
        var x = document.getElementById("secretKey");
        x.type = "password";
    }

    function showPublic() {
        var x = document.getElementById("publicKey");
        x.type = "text";
    }

    function hidePublic() {
        var x = document.getElementById("publicKey");
        x.type = "password";
    }

    function showRoutingNumber() {
        var x = document.getElementById("routingNumber");
        x.type = "text";
    }

    function hideRoutingNumber() {
        var x = document.getElementById("routingNumber");
        x.type = "password";
    }

    function showAccountNumber() {
        var x = document.getElementById("accountNumber");
        x.type = "text";
    }

    function hideAccountNumber() {
        var x = document.getElementById("accountNumber");
        x.type = "password";
    }

    function showTBA() {
        var x = document.getElementById("typeBA");
        x.type = "text";
    }

    function hideTBA() {
        var x = document.getElementById("typeBA");
        x.type = "password";
    }
</script>
@endsection

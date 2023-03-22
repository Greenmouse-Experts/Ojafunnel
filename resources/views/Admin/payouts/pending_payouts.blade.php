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
                        <h4 class="mb-sm-0 font-size-18">Pending Withdrawals</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Withdrawals</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Pending Withdrawals</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Pending Withdrawals</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">User</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Description</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Withdrawal::latest()->where('status', '!=', 'finalized')->get() as $key => $withdraw)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{ App\Models\User::find($withdraw->user_id)->first_name }} {{ App\Models\User::find($withdraw->user_id)->last_name }}
                                                <p class='text-bold-600'> {{ App\Models\User::find($withdraw->user_id)->email }} </p>
                                            </td>
                                            <td>
                                                <p class='text-bold-600'> ₦{{number_format($withdraw->amount, 2)}} </p>
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
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'US')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Holder Name</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="bank">Bank Account</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->type_of_bank_account}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Routing Number</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->routing_number}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Number</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_number}}" readonly />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'PAYSTACK')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Holder Name</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Secret Key</label>
                                                                                    <input type="text" name="secret_key" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->secret_key}}" placeholder="Enter secret key" required />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Public Key</label>
                                                                                    <input type="text" name="public_key" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->public_key}}" placeholder="Enter public key" required />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @endif
                                                                        @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'NGN')
                                                                        <div class="row">
                                                                            <div class="col-12">
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Name</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_name}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Account Number</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->account_number}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="bank">Bank Name</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->bank_name}}" readonly />
                                                                                </div>
                                                                                <div class="col-lg-12 mb-4">
                                                                                    <label for="">Bank Code</label>
                                                                                    <input type="text" class="form-control" value="{{App\Models\BankDetail::find($withdraw->payment_method)->bank_code}}" readonly />
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
                                                @if ($withdraw->status == 'created')
                                                <span class="badge badge-pill badge-soft-primary font-size-11">{{$withdraw->status}}</span>
                                                @endif

                                                @if ($withdraw->status == 'refunded')
                                                <span class="badge badge-pill badge-soft-secondary font-size-11">{{$withdraw->status}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($withdraw->created_at)->isoFormat('llll') }}
                                            </td>
                                            <td>
                                                @if(App\Models\BankDetail::find($withdraw->payment_method)->type != 'PAYSTACK')
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-primary" data-bs-toggle="modal" data-bs-target="#process-{{$withdraw->id}}">Process</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="process-{{$withdraw->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Process this payout</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="post" action="{{route('process.payouts', Crypt::encrypt($withdraw->id))}}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="Editt">
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="user">User</label>
                                                                                            <input id="user" type="text" value="{{ App\Models\User::find($withdraw->user_id)->first_name }} {{ App\Models\User::find($withdraw->user_id)->last_name }}" readonly />
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="amount">Amount</label>
                                                                                            <input id="" type="text" value="₦{{number_format($withdraw->amount, 2)}}" readonly />
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="description">Description</label>
                                                                                            <textarea id="description" name="description" type="text" required></textarea>
                                                                                        </div>
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label>Status</label>
                                                                                            <select name="status" required>
                                                                                                <option value="{{$withdraw->status}}"> {{$withdraw->status}}</option>
                                                                                                <option value="created"> Created</option>
                                                                                                <option value="refunded"> Refunded</option>
                                                                                                <option value="finalized"> Finalized</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit" class="btn" style="color: #714091; border: 1px solid #714091">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                                @endif
                                                @if(App\Models\BankDetail::find($withdraw->payment_method)->type == 'PAYSTACK')
                                                <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#process-{{$withdraw->id}}" class="btn btn-sm btn-soft-primary">Process</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="process-{{$withdraw->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content pb-3">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Process this payout</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <form class="processForm">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="user">User</label>
                                                                                        <input id="paystack_id" value="{{ $withdraw->id }}" hidden />
                                                                                        <input id="paystack_email" value="{{App\Models\User::find($withdraw->user_id)->email}}" hidden />
                                                                                        <input id="paystack_public_key" value="{{App\Models\BankDetail::find($withdraw->payment_method)->public_key}}" hidden />
                                                                                        <input id="user" value="{{ App\Models\User::find($withdraw->user_id)->first_name }} {{ App\Models\User::find($withdraw->user_id)->last_name }}" readonly />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="amount">Amount</label>
                                                                                        <input id="paystack_amount" value="{{$withdraw->amount}}" hidden />
                                                                                        <input value="₦{{number_format($withdraw->amount, 2)}}" readonly />
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label for="description">Description</label>
                                                                                        <textarea id="paystack_description" name="description" required></textarea>
                                                                                    </div>
                                                                                    <div class="col-lg-12 mb-4">
                                                                                        <label>Status</label>
                                                                                        <select name="status" class="paystack_status" required>
                                                                                            <option value="{{$withdraw->status}}"> {{$withdraw->status}}</option>
                                                                                            <option value="created"> Created</option>
                                                                                            <option value="refunded"> Refunded</option>
                                                                                            <option value="finalized"> Finalized</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="row justify-content-between">
                                                                                        <div class="col-6">
                                                                                            <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="col-6 text-end">
                                                                                            <script src="https://js.paystack.co/v1/inline.js"></script>
                                                                                            <button class="form-btn btn px-4" type="button" onclick="payUserWithPaystack()" style="color: #ffffff; background-color: #714091">
                                                                                                Proceed To Payment
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
                                                <!-- end modal -->
                                                @endif
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
    var processForm = document.querySelector('.processForm');
    processForm.addEventListener("submit", payUserWithPaystack, false);

    function payUserWithPaystack(){
        var handler = PaystackPop.setup({
        key: document.getElementById("paystack_public_key").value,
        email: document.getElementById("paystack_email").value,
        amount: document.getElementById("paystack_amount").value * 100,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        callback: function(response){
            // alert(JSON.stringify(response))
            let url = '{{ route("transaction.confirm", [":id", ":response", ":amount"]) }}';
            url = url.replace(':id', document.getElementById("paystack_id"));
            url = url.replace(':response', response.reference);
            url = url.replace(':amount', document.getElementById("paystack_amount").value);
            document.location.href=url;
        },
        onClose: function(){
            alert('window closed');
        }
        });
        handler.openIframe();
    }
</script>
@endsection
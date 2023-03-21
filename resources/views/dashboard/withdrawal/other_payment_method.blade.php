@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Payment Methods </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Payment Methods</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4>Payment Methods </h4>
                                    <p>
                                        All your Payment methods in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="all-create">
                                    <a href="#">
                                        <button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                            Add Payment Method
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($bank_details as $bank)
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="favorite-icon">
                                <a href="javascript:void(0)"><i class="uil uil-heart-alt fs-18"></i></a>
                            </div>
                            <img src="https://www.freeiconspng.com/thumbs/credit-card-icon-png/credit-card-2-icon-7.png" alt="" height="50" class="mb-3">
                            <h5 class="fs-17 mb-2"><a href="#" class="text-dark">{{$bank->account_name}}</a> </h5>
                            <p class="text-muted fs-14 mb-1">{{$bank->type_of_bank_account}}</p>
                            <p class="text-muted fs-14 mb-0">{{$bank->routing_number}}</p>
                            <p class="text-muted fs-14 mb-0"><i class="uil uil-wallet"></i> {{$bank->account_number}}</p>
                            <div class="mt-4 hstack gap-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#edit-{{$bank->id}}" class="btn text-light w-100" style="background: #70418f;">Edit</a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#delete-{{$bank->id}}" class="btn w-100 bg-danger text-light">Delete</a>
                                <!-- Modal START -->
                                <div class="modal fade" id="edit-{{$bank->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content pb-3">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myExtraLargeModalLabel">Update payment method</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <div class="row">
                                                    <div class="Editt">
                                                        <form method="POST" action="{{ route('user.update.bank.details', Crypt::encrypt($bank->id))}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="">Account Holder Name</label>
                                                                        <input type="text" name="account_name" class="form-control" value="{{$bank->account_name}}" placeholder="Enter acount number" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="bank">What type of bank account is this?</label>
                                                                        <select name="type_of_bank_account" class="form-control">
                                                                            <option value="{{$bank->type_of_bank_account}}">{{$bank->type_of_bank_account}}</option>
                                                                            <option value=""> -- Select a bank account type --</option>
                                                                            <option value="Individual Checking">Individual Checking</option>
                                                                            <option value="Individual Savings">Individual Savings</option>
                                                                            <option value="Corporation Checking">Corporation Checking</option>
                                                                            <option value="Corporation Savings">Corporation Savings</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <img alt="An illustration showing that the nine-digit routing number is at the bottom left of a physical check. The next group of numbers is your account number, usually 5-17 digits. You can also get this information from your bank." src="https://www.upwork.com/static/assets/BpaNuxt/img/bank-account-numbers.d9514ef.png" style="width:100%;">
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="">Routing Number</label>
                                                                        <input type="text" name="routing_number" class="form-control" value="{{$bank->routing_number}}" placeholder="Enter routing number" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="">Account Number</label>
                                                                        <input type="password" name="account_number" class="form-control" value="{{$bank->account_number}}" placeholder="Enter acount number" required />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="">Confirm account number</label>
                                                                        <input type="password" name="account_number_confirmation" class="form-control" placeholder="Confirm acount number" />
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <label for="">By adding this bank account you are confirming that you are the owner and have full authorization to this bank account.</label>
                                                                    </div>

                                                                    <div class="text-end mt-2">
                                                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                            Update
                                                                        </button>
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
                                <!-- Modal START -->
                                <div class="modal fade" id="delete-{{$bank->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content pb-3">
                                            <div class="modal-header border-bottom-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <div class="row">
                                                    <div class="Editt">
                                                        <form method="POST" action="{{ route('user.delete.bank.details', Crypt::encrypt($bank->id))}}">
                                                            @csrf
                                                            <div class="form">
                                                                <p><b>Delete Bank Details</b></p>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p>This action cannot be undone. This will permanently delete.</p>
                                                                    </div>
                                                                    <div class="col-lg-12 mb-4">
                                                                        <div class="boding">
                                                                            <button type="submit" class="form-btn">
                                                                                I understand this consquences, Delete
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
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myExtraLargeModalLabel">Add a payment method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Tell us how you want to get your funds. For all account types, it may take up to 3 days to activate.</h4>
                            <h4>Recommended for Nigeria</h4>
                            </hr>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 45px;">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                        <i class="bx bx-home"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Direct to Local Bank (NGN)</a></h5>
                                                <p>Free payments to NGN banks</p>
                                                <p>Deposit to your local bank account in NGN</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{route('user.bank.details', Auth::user()->username)}}" class="btn text-light btn-secondary">Set up</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 45px;">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                        <img src="https://paystack.com/favicon.png" style="width: 25px;" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Paystack</a></h5>
                                                <p>Free payment</p>
                                                <p>Paystack may charge additional fees for sending and withdrawing funds</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="btn text-light btn-secondary">Set up</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4 class="mt-4">Also Available</h4>
                            </hr>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle table-hover mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 45px;">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                        <img src="https://www.paypalobjects.com/paypal-ui/logos/svg/paypal-mark-color.svg" style="width: 25px;" />
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Paypal</a></h5>
                                                <p>$2 USD {{config('app.name')}} withdrawal fee</p>
                                                <p>PayPal may charge additional fees for sending and withdrawing funds</p>
                                                <p>Set Up will take you to PayPal</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="javascript: void(0);" class="btn text-light btn-secondary">Set up</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 45px;">
                                                <div class="avatar-sm">
                                                    <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-24">
                                                        <i class="bx bx-home"></i>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 mb-1"><a href="javascript: void(0);" class="text-dark">Direct to U.S. Bank (USD)</a></h5>
                                                <p>$0.99 USD per withdrawal</p>
                                                <p>Deposit to a U.S. bank account in USD</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <a href="{{route('user.direct.us.bank', Auth::user()->username)}}" class="btn text-light btn-secondary">Set up</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->


@endsection
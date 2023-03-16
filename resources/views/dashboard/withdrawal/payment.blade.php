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
                        <h4 class="mb-sm-0 font-size-18">Payment Gateway </h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Payment Gateway</li>
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
                                    <h4>Payment Gateway </h4>
                                    <p>
                                        All your Payment Gateway in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="all-create">
                                    <a href="#">
                                        <button type="submit" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                            Add Payment Gateway
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
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="Editt">
                            <form>
                                <div class="form">
                                    <h4 class="card-title">Withdrawal Information</h4>
                                    <p class="card-title-desc">Fill all information below to complete your Withdrawal</p>
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Customer's name</label>
                                            <input type="text" name="name" placeholder="Enter customer's name" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Receiver's name</label>
                                            <input type="text" name="name" placeholder="Enter Receiver's name" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Account number</label>
                                            <input type="text" placeholder="Enter account number" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Amount</label>
                                            <input type="text" name="amount" placeholder="Enter amount" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Amount</label>
                                            <select name="" id="">
                                                <option value="Select Bank"></option>
                                                <option value="Access Bank"></option>
                                                <option value="GtBank"></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Date</label>
                                            <input type="date" required />
                                        </div>
                                        <div class="text-end mt-2">
                                            <a href="#" class="text-decoration-none">
                                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                    Submit
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
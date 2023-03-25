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
                        <h4 class="mb-sm-0 font-size-18">Paystack</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Paystack</li>
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
                                    <h4>Paystack</h4>
                                    <p>
                                        Get access to your funds in 3-5 business days with no fees.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{route('user.add.paystack')}}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6" style="display: flex; align-items: center; flex-wrap: wrap;">
                                    <div style="padding: 3rem;">
                                        <span style="font-size: 64px; margin-bottom: 1rem;">
                                            <i class="bx bx-home"></i>
                                        </span>
                                        <h4 style="font-weight: 700;">Add Paystack Details</h4>
                                        <p>Get access to your funds in 3-5 business days with no fees.</p>
                                        <p>Incorrect information can mean a delay in receiving funds or fees.</p>
                                        <p>This payment method will become active in 3 days.</p>
                                    </div>
                                </div>
                                <div class="col-md-6" style="border-left: 1px solid gainsboro; padding: 50px;">
                                    <div class="col-lg-12 mb-4">
                                        <label for="">Account Holder Name</label>
                                        <input type="text" name="account_name" class="form-control" value="{{Auth::user()->first_name}} {{Auth::user()->last_name}}" placeholder="Enter acount number" required />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <img alt="An illustration showing that the paystack public key and secret key." src="https://support.paystack.com/hc/article_attachments/6522729720732" style="width:100%;">
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="">Secret Key</label>
                                        <input type="password" name="secret_key" class="form-control" placeholder="Enter secret key" required />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="">Public Key</label>
                                        <input type="password" name="public_key" class="form-control" placeholder="Enter public key" required />
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <label for="">By adding this paystack method of payment you are confirming that you are the owner and have full authorization to this details.</label>
                                    </div>
                                    <div class="text-end mt-2">
                                        <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Submit
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
<!-- Modal Ends -->


@endsection
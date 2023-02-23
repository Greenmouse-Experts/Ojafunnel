Skip to content
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
                        <h4 class="mb-sm-0 font-size-18">Transaction Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Transaction Details</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-16">Order # 12345</h4>
                                <div class="mb-4">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="logo" height="50" />
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Billed Name:</strong><br>
                                        Hamzat Adeleke<br>
                                        1234 Main<br>
                                        Apt. 4B<br>
                                        Springfield, ST 54321
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        Visa ending **** 4242<br>
                                        greenmouse@email.com
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-end">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        October 27, 2022<br><br>
                                    </address>
                                </div>
                            </div>
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 fw-bold">Order summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th class="text-end">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>ojafunel - Buy Shoe</td>
                                            <td class="text-end">₦1000.00</td>
                                        </tr>

                                        <tr>
                                            <td>02</td>
                                            <td>ojafunel - Juice</td>
                                            <td class="text-end">₦399.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">Sub Total</td>
                                            <td class="text-end">₦1397.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="border-0 text-end">
                                                <strong>Total</strong>
                                            </td>
                                            <td class="border-0 text-end">
                                                <h4 class="m-0">₦1410.00</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                    <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Save</a>
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

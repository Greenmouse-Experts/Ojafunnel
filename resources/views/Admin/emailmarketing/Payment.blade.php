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
                        <h4 class="mb-sm-0 font-size-18">Payment gateways</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Payment gateways</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">All available payment gateways</h4>
                            <p>
                                Connect with your preferred payment gateways to receive payments by your users
                                Your users can pay by cash, Debit/Credit cards, PayPal, etc.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Select Payment Gateway</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677253987/OjaFunnel-Images/downloadd_ftqv27.png" draggable="false" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>Paystack</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">Receive payments from Credit / Debit card to your Paystack account</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <span class="badge rounded-pill badge-soft-success font-size-11">Active</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#fff; color:#000; border-radius:5px;">Disable</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Connect</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677253987/OjaFunnel-Images/download_j5rhxo.jpg" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>Paypal</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">PayPal is the fast/safe way to send money, make an online payment, receive money or set up a merchant account</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <span class="badge rounded-pill badge-soft-success font-size-11">Active</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#fff; color:#000; border-radius:5px;">Disable</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Connect</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677254812/OjaFunnel-Images/downloaddd_dvdwck.png" draggable="false" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>flutterwave</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">flutterwave is the fast/safe way to send money, make an online payment, receive money or set up a merchant account</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <span class="badge rounded-pill badge-soft-success font-size-11">Active</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#fff; color:#000; border-radius:5px;">Disable</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="#">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Connect</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>
</div>
@endsection

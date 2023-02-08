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
                        <h4 class="mb-sm-0 font-size-18">Sales</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="mb-4">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="logo" height="50" />
                                </div>
                            </div>
                            <div>
                                <strong>Invoice Id -</strong>  #6
                            </div>
                            <div>
                                <strong>Order Id -</strong> 162695CDFS
                            </div>
                            <div class="mb-4">
                                <strong>Order Date - </strong>03-06-2022
                            </div>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr class="text-center">
                                            <th scope="col"><b>From</b></th>
                                            <th scope="col"><b>To</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                                Hamzat Abdulazeez
                                            </td>
                                            <td>
                                                Adeleke Money
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-0">
                                               No:50 Ademola-street lagos state
                                            </td>
                                            <td>
                                                No:50 Ogba-street lagos state
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Contact : 1234567890</td>
                                            <td>Contact : 1234567890</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr class="text-center">
                                            <th scope="col"> <b>Payment Method</b></th>
                                            <th scope="col"><b>Shipping Method</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                            Cash On Delivery
                                            </td>
                                            <td>
                                            Free Shipping - Free Shipping
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 fw-bold">Order summary</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Tax Amount</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>01</td>
                                            <td>Cloth</td>
                                            <td>$100</td>
                                            <td>1</td>
                                            <td>$100</td>
                                            <td>$5</td>
                                            <td>$150</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Sub Total:</strong>
                                            </td>
                                            <td class="border-0">$13.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Tax (18%):</strong>
                                            </td>
                                            <td class="border-0">$13.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Total:</strong>
                                            </td>
                                            <td class="border-0">
                                               <b>$1410.00</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection

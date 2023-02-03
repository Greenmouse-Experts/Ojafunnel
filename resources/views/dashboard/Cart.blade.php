@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Cart</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0 table-nowrap">
                                    <thead class="tread">
                                        <tr class="font-500">
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{URL::asset('dash/assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-shirt</a></h5>
                                            </td>
                                            <td>
                                                ₦ 100
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="02" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                ₦ 500
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            <img src="{{URL::asset('dash/assets/images/product/img-2.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Glass </a></h5>
                                            </td>
                                            <td>
                                                ₦ 200
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="01" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                ₦ 1000
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{route('user.stores', Auth::user()->username)}}" class="btn text-muted d-none d-sm-inline-block btn-link">
                                        <i class="mdi mdi-arrow-left me-1"></i> Back to Store </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-end">
                                        <a href="{{route('user.checkout', Auth::user()->username)}}" class="btn btn-success">
                                            <i class="mdi mdi-truck-fast me-1"></i> Proceed to Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>

@endsection
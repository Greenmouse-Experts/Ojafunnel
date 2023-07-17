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
                        <h4 class="mb-sm-0 font-size-18">Sales Detail</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('productList')}}">Product List</a></li>
                                <li class="breadcrumb-item active">Product Detail</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="mt-4">
                <div class="row justify-content-around">
                    <div class="col-lg-4">
                        <div class="sales-detail-box">
                            <p class="badge">₦{{number_format($product->price, 2)}}</p>
                            <img style="height: 300px" src='{{Storage::url($product['image']) ?? 'https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889793/OjaFunnel-Images/1693472_e1d5_14_k7xwuy.jpg'}}' alt='' width="100%"/>
                            <p class="fw-bold fs-5 text-center mt-3 mb-1">{{$product->name}}</p>
                        </div>
                    </div>
                    <div class="col-lg-7 sales-detail-box">
                        <div class="row">
                            <div class="col-3">
                                <p>Product Name:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->name}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Description:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->description}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Category:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->type}} Product</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Date Created:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->created_at->format('d F Y')}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Referer No.:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->ref_number}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Commission Price:</p>
                            </div>
                            <div class="col-9">
                                <p>₦{{number_format($product->commission, 2)}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Commission Type:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->comm_type}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Unit Sold:</p>
                            </div>
                            <div class="col-9">
                                <p>{{$product->orderItem->sum('quantity')}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Status:</p>
                            </div>
                            <div class="col-9">
                                @if ($product->quantity > 0)
                                    <p><span class="px-3 py-1 bg-success text-white">In Stock</span></p>
                                @else
                                    <p><span class="px-3 py-1 bg-secondary text-white">Out of Stock</span></p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsectiona

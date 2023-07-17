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
                        <h4 class="mb-sm-0 font-size-18">Product List</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Product List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Ecommerce Products</h4>
                            <p>
                                Browse through and view various products in stores.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Products Listing</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Product Name </th>
                                            <th>Store</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin->getAllProducts() as $item)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                {{$item->store->name}}
                                            </td>
                                            <td>
                                                ₦{{number_format($item->price)}}
                                            </td>
                                            <td>
                                                @if ($item->quantity > 0)
                                                    <span class="badge badge-pill badge-soft-success font-size-11">In Stock</span>
                                                @else
                                                    <span class="badge badge-pill badge-soft-secoondary font-size-11">Out of Stock</span>
                                                @endif

                                            </td>
                                            <td>
                                                {{$item->created_at->format('D d M, Y')}}
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View Product Detail">
                                                        <a href="{{route('productDetail', $item->id)}}" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li>
                                                    {{-- <li data-bs-toggle="tooltip" data-bs-placement="top" title="Flag">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li> --}}
                                                </ul>
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
@endsection

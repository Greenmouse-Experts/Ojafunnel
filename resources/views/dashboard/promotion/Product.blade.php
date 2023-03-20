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
                        <h4 class="mb-sm-0 font-size-18">Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="py-2">
                                    <h4 class="font-500">Market Product</h4>
                                    <p>
                                        All your Market Product in one Place
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Market Product</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Product Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Commission(s)</th>
                                            <th scope="col">Multi Level</th>
                                            <th scope="col">Visit</th>
                                            <th scope="col">Created</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr>
                                                <td>
                                                    {{ $product->id }}
                                                </td>
                                                <td>
                                                    {{ $product->name }}
                                                </td>
                                                <td>
                                                    {{ $product->price }}
                                                </td>
                                                <td>
                                                    Level 1: <b>{{ $product->level1_comm }}%</b>, Level 2: <b>{{ $product->level2_comm }}%</b> (Super Affiliates only)
                                                </td>
                                                <td>
                                                    Yes
                                                </td>
                                                <td>
                                                    0
                                                </td>
                                                <td>
                                                    {{ $product->created_at }}
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#onlineStore-{{ $product->id }}" title="View" class="btn btn-sm btn-soft-success"><i class="bi bi-eye-slash-fill"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @empty
                                            No product(s) in any of Ojafunnel stores. Check back later.
                                        @endforelse  
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

@foreach ($products as $product)
<!-- SuccessModal -->
<div class="modal fade" id="onlineStore-{{ $product->id }}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">View Product: 0</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="last">
                    <div class="col-lg-12">
                        <div class="images">
                            <img src="{{ Storage::url($product->image) }}" draggable="false" width="100%" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <b>Vendor</b>
                        </div>
                        <div class="col-md-8 mt-4">
                            {{ 'vendor name here' }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Name</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->name }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Description</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->description }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Price</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->price }}
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commission Type</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Multi Level
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Commissions</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            Level 1: <b>{{ $product->level1_comm }}%</b>, Level 2: <b>{{ $product->level2_comm }}%</b> (Super Affiliates only)
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Promotion Material(s)</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            <a href="#">
                                https://drive.google.com/drive/folders <br> /1X7DPkhjvK4WnaaxrVv2BBxzptLW08S2x
                            </a>
                        </div>
                        <div class="col-md-4 mt-3">
                            <b>Created At</b>
                        </div>
                        <div class="col-md-8 mt-3">
                            {{ $product->created_at }}
                        </div>
                        <div class="col-md-12 mt-4 mb-4 text-center">
                            <b>Affiliate Links</b>
                        </div>
                        <div class="Editt">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" value="http" name="name" id="myInput" class="input mov" readonly required>
                                    </div>
                                    <div class="col-md-2">
                                        <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endforeach

@endsection

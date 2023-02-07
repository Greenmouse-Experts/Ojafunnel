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
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Images</th>
                                            <th scope="col">Product Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Half sleeve T-shirt</a></h5>
                                            </td>
                                            <td>
                                                <img src="{{URL::asset('dash/assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Iste, perferendis?</a></h5>
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
                                            <td>
                                                <a href="#CartDelete" data-bs-toggle="modal" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Long long T-shirt</a></h5>
                                            </td>
                                            <td>
                                                <img src="{{URL::asset('dash/assets/images/product/img-2.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">Lorem ipsum dolor sit amet consectetur <br> adipisicing elit. Iste, perferendis?</a></h5>
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
                                            <td>
                                                <a href="javascript:void(0);" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" class="action-icon text-danger"> <i class="mdi mdi-trash-can font-size-18"></i></a>
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
<!-- Modal -->
<div class="modal fade" id="CartDelete" tabindex="-1" aria-labelledby="CartDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-body px-4 py-5 text-center">
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="avatar-sm mb-4 mx-auto">
                    <div class="avatar-title bg-primary text-primary bg-opacity-10 font-size-20 rounded-3">
                        <i class="mdi mdi-trash-can-outline"></i>
                    </div>
                </div>
                <p class="text-muted font-size-16 mb-4">Are you sure you want to permanently remove this Product.</p>

                <div class="hstack gap-2 justify-content-center mb-0">
                    <button type="button" class="btn btn-danger">Delete Now</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootrstrap touchspin -->
<script src="{{URL::asset('dash/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{URL::asset('dash/assets/js/pages/ecommerce-cart.init.js')}}"></script>
@endsection

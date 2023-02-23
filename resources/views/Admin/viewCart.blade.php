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
                        <h4 class="mb-sm-0 font-size-18">Cart</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
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
                                    <thead class="table-light">
                                        <tr class="font-500">
                                            <th scope="col">Product</th>
                                            <th scope="col">Product Desc</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-1.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-shirt</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Maroon</span></p>
                                            </td>
                                            <td>
                                                $ 450
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="02" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 900
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-2.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Light blue T-shirt</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Light blue</span></p>
                                            </td>
                                            <td>
                                                $ 225
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="01" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 225
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-3.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Black Color T-shirt</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Black</span></p>
                                            </td>
                                            <td>
                                                $ 152
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="02" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 304
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-4.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Hoodie (Blue)</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Blue</span></p>
                                            </td>
                                            <td>
                                                $ 145
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="02" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 290
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-5.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-Shirt</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Light orange</span></p>
                                            </td>
                                            <td>
                                                $ 138
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="01" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 138
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets/images/product/img-6.png" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Green color T-shirt</a></h5>
                                                <p class="mb-0">Color : <span class="fw-medium">Green</span></p>
                                            </td>
                                            <td>
                                                $ 152
                                            </td>
                                            <td>
                                                <div class="me-3" style="width: 120px;">
                                                    <input type="number" value="02" name="demo_vertical">
                                                </div>
                                            </td>
                                            <td>
                                                $ 304
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">

                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Activate">
                                                        <a href="#activate" class="btn btn-sm btn-soft-success"><i class="bi bi-check2-all"></i></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                        <a href="#jobDelete" data-bs-toggle="modal" class="btn btn-sm btn-soft-danger"><i class="mdi mdi-delete-outline"></i></a>
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Deactivate">
                                                        <a href="#" class="btn btn-sm btn-soft-warning"><i class="bi bi-eye-slash-fill"></i></a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <a href="{{route('addProduct')}}" class="btn btn-secondary">
                                        <i class="mdi mdi-arrow-left me-1"></i> Add Product </a>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-sm-end mt-2 mt-sm-0">
                                        <a href="ecommerce-checkout.html" class="btn btn-success">
                                            <i class="mdi mdi-cart-arrow-right me-1"></i> Checkout </a>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
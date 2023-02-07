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
                        <h4 class="mb-sm-0 font-size-18">Available Product</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Available Product</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-600">Available Product</h4>
                                    <p>
                                        All your Available Product in one Place
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="">
                                    <div class="all-create">
                                        <a href="#">
                                            <button type="submit" data-bs-toggle="modal" data-bs-target="#onlineStore">
                                                + Add Product
                                            </button>
                                        </a>
                                    </div>
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
                            <h4 class="card-title mb-4">View Product</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Product Image</th>
                                            <th scope="col">Product Description</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                Half sleeve T-shirt
                                            </td>
                                            <td>
                                                <img src="{{URL::asset('dash/assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md" />
                                            </td>
                                            <td>
                                                <h5 class="font-size-14 text-truncate"><a href="#" class="text-dark">This Red Hot Chili Peppers T-shirt is perfect <br> for both personal usage and gifting purposes.</a></h5>
                                            </td>
                                            <td>
                                                ₦ 100
                                            </td>
                                            <td>
                                                1
                                            </td>
                                        </tr>
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
<!-- SuccessModal -->
<div class="modal fade" id="onlineStore" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">

            <div class="modal-header border-bottom-0">
                <h4 class="card-title mb-4">Add Product</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="Editt">
                    <form action="">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Name</label>
                                    <input type="text" name="name" placeholder="Enter product name" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Image</label>
                                    <input type="file" name="name" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Product Description</label>
                                    <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your product description" required></textarea>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Price</label>
                                    <input type="text" name="name" placeholder="Enter price" required />
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="Name">Quantity</label>
                                    <input type="text" name="name" required />
                                </div>
                                <div class="text-end mt-2">
                                    <a href="#" class="text-decoration-none">
                                        <button class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                            Submit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection

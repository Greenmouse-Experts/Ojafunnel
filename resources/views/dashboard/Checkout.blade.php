@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Checkout Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="checkout-tabs mb-4">
                    <div class="row">
                        <div class="col-xl-2 col-sm-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                                    <i class="bi bi-person-circle d-block check-nav-icon mt-4 mb-2"></i>

                                    <p class="fw-bold mb-4">Customer Info</p>
                                </a>
                                <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                    <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Payment Info</p>
                                </a>
                                <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                    <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Confirmation</p>
                                    <div class="Editt">

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                            <div>
                                                <h4 class="card-title">Customer information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <form action="">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Name</label>
                                                                <input type="text" name="name" placeholder="Enter your name" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Email</label>
                                                                <input type="email" name="name" placeholder="Enter your email" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Phone Number</label>
                                                                <input type="tel" name="name" placeholder="Enter your number" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Address</label>
                                                                <input type="text" name="name" placeholder="Enter your address" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">State</label>
                                                                <input type="tel" name="name" placeholder="Enter your state" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Country</label>
                                                                <input type="text" name="name" placeholder="Enter your country" required />
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
                                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                            <div>
                                                <h4 class="card-title">Payment information</h4>
                                                <p class="card-title-desc">Fill all information below</p>
                                                <div>
                                                    <div class="form-check form-check-inline font-size-16">
                                                        <input class="form-check-input" type="radio" name="paymentoptionsRadio" id="paymentoptionsRadio1" checked>
                                                        <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><i class="fab fa-cc-mastercard me-1 font-size-20 align-top"></i> Credit / Debit Card</label>
                                                    </div>
                                                </div>
                                                <h5 class="mt-3 mb-3 font-size-15">For card Payment</h5>
                                                <form action="">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Name on card</label>
                                                                <input type="text" name="name" placeholder="Enter card name" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Card Number</label>
                                                                <input type="email" name="name" placeholder="0000 0000 0000 0000" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">Expiry Date</label>
                                                                <input type="date" name="name" placeholder="Enter expiry date" required />
                                                            </div>
                                                            <div class="col-lg-6 mb-4">
                                                                <label for="Name">CVV Code</label>
                                                                <input type="date" name="name" placeholder="Enter cvv code" required />
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
                                        <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                            <div class="card shadow-none border mb-0">
                                                <div class="card-body">
                                                    <h4 class="card-title mb-4">Order Summary</h4>
                                                    <div class="table-responsive">
                                                        <table class="table align-middle mb-0 table-nowrap">
                                                            <thead class="tread">
                                                                <tr>
                                                                    <th scope="col">Product</th>
                                                                    <th scope="col">Product Desc</th>
                                                                    <th scope="col">Price</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row"><img src="{{URL::asset('dash/assets/images/product/img-1.png')}}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                    <td>
                                                                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Half sleeve T-shirt </a></h5>
                                                                    </td>
                                                                    <td>₦ 100</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row"><img src="{{URL::asset('dash/assets/images/product/img-7.png')}}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                    <td>
                                                                        <h5 class="font-size-14 text-truncate"><a href="ecommerce-product-detail.html" class="text-dark">Wireless Headphone </a></h5>
                                                                    </td>
                                                                    <td>₦ 200</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <h6 class="m-0 text-end">Total:</h6>
                                                                    </td>
                                                                    <td>
                                                                        ₦ 300
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="row mt-4">
                                                        <div class="col-sm-6">
                                                            <a href="#" class="btn btn-success text-white d-none d-sm-inline-block">
                                                                PLACE ORDER
                                                            </a>
                                                        </div> <!-- end col -->
                                                        <!-- end col -->
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
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>

<!-- SuccessModal -->
<div class="modal fade" id="onlineStore" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="{{URL::asset('dash/assets/image/theme.png')}}" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>Congratulations, you've created your online store</p>
                </div>
                <div class="text-end mt-2">
                    <a href="{{route('user.check.store', Auth::user()->username)}}" class="text-decoration-none">
                        <button class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                            Next
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- END layout-wrapper -->
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/#[[latestVersion]]#/mdb.min.css" rel="stylesheet" />
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/#[[latestVersion]]#/mdb.min.js"></script>
@endsection

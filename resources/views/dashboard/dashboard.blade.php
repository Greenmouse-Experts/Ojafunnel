@extends('layouts.dashboard-frontend')

@section('page-content')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <!-- container-fluid -->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                    <div class="start">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="start-main">
                                        <h1>Welcome, Hamzat 👋</h1>
                                        <p>
                                            Start enjoying full control of your business all in
                                            one place
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>
                                <div class="col-md-3">
                                    <div class="click py-2">
                                        <button type="button" class="px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            + Create
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-top-div">
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>180</h3>
                                <p class="mb-0">New Leads</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #edfbfc">
                                    <img src="{{URL::asset('dash/assets/image/leads.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>212</h3>
                                <p class="mb-0">New Products</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f5effc">
                                    <img src="{{URL::asset('dash/assets/image/products.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>200,500</h3>
                                <p class="mb-0">Total Sales</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f0fcef">
                                    <img src="{{URL::asset('dash/assets/image/sales.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>25</h3>
                                <p class="mb-0">Total Orders</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #fceff1">
                                    <img src="{{URL::asset('dash/assets/image/bags.png')}}" alt="" width="28" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- product & stores row-->
                <div class="products-stores-row">
                    <div class="products-div">
                        <div class="row mb-4">
                            <div class="col-6 font-500">
                                <h4>Products & Stores</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#">Add new products</a>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="col-4 col-lg-3 stores-col">
                                <h3 class="font-500">10</h3>
                                <p>Products</p>
                            </div>
                            <div class="col-4 col-lg-3 stores-col">
                                <h3 class="font-500">21</h3>
                                <p>New Orders</p>
                            </div>
                            <div class="col-4 col-lg-3 stores-col co-max">
                                <h3 class="font-500">12</h3>
                                <p>Confirmed Orders</p>
                            </div>
                            <div class="col-4 col-lg-3 stores-col mt-5">
                                <h3 class="font-500">10</h3>
                                <p>No of Sales</p>
                            </div>
                            <div class="col-4 col-lg-3 stores-col mt-5">
                                <h3 class="font-500">32</h3>
                                <p>Confirmed Orders</p>
                            </div>
                            <div class="col-4 col-lg-3 stores-col mt-5">
                                <h3 class="font-500">9</h3>
                                <p>Cancelled Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="sales-analysis">
                        <div class="row mb-4">
                            <div class="col-6 font-500">
                                <h4>Sales Analysis</h4>
                            </div>
                            <div class="col-6 text-end">
                                <select name="duration" id="" disabled="disabled" class="px-2">
                                    <option value="">weekly</option>
                                    <option value="">yearly</option>
                                </select>
                            </div>
                        </div>
                        <div id="sales"></div>
                    </div>
                </div>
                <!-- /product & stores -->
                <!-- email campaign -->
                <div class="email-campaign-row justify-content-between">
                    <div class="border border-danger campaign-div">
                        <div class="row mb-4">
                            <div class="col-6 font-500">
                                <h4>Email Campaign</h4>
                            </div>
                            <div class="col-6 text-end">
                                <select name="duration" id="" disabled="disabled" class="px-2">
                                    <option value="">weekly</option>
                                    <option value="">yearly</option>
                                </select>
                            </div>
                        </div>
                        <div id="emailAuto"></div>
                    </div>
                    <div class="recent-msg">
                        <div class="row mb-4">
                            <div class="col-8 font-500">
                                <h4>Recent Messages</h4>
                            </div>
                            <div class="col-4 text-end">
                                <a href="#">View All</a>
                            </div>
                        </div>
                        <div class="recent-chat">
                            <div class="row mt-4 align-items-center">
                                <div class="col-11 row">
                                    <div class="chat-img col-2 gx-2">
                                        <img src="{{URL::asset('dash/assets/images/users/avatar-1.jpg')}}" alt="" width="100%" />
                                    </div>
                                    <div class="col-9 gx-3">
                                        <h5 class="font-500 mb-1">Hamzat</h5>
                                        <p class="my-0 py-0">I need new products by tommorow</p>
                                    </div>
                                </div>
                                <div class="col-1 text-end">
                                    <div class="online"></div>
                                </div>
                            </div>
                            <div class="row mt-4 align-items-center">
                                <div class="col-11 row">
                                    <div class="chat-img col-2 gx-2">
                                        <img src="{{URL::asset('dash/assets/images/users/avatar-4.jpg')}}" alt="" width="100%" />
                                    </div>
                                    <div class="col-9 gx-3">
                                        <h5 class="font-500 mb-1">Chuka Uzo</h5>
                                        <p class="my-0 py-0">I need new products by tommorow</p>
                                    </div>
                                </div>
                                <div class="col-1 text-end">
                                    <div class="online"></div>
                                </div>
                            </div>
                            <div class="row mt-4 align-items-center">
                                <div class="col-11 row">
                                    <div class="chat-img col-2 gx-2">
                                        <img src="{{URL::asset('dash/assets/images/users/avatar-6.jpg')}}" alt="" width="100%" />
                                    </div>
                                    <div class="col-9 gx-3">
                                        <h5 class="font-500 mb-1">Nath Olu</h5>
                                        <p class="my-0 py-0">I need new products by tommorow</p>
                                    </div>
                                </div>
                                <div class="col-1 text-end"></div>
                            </div>
                            <div class="row mt-4 align-items-center">
                                <div class="col-11 row">
                                    <div class="chat-img col-2 gx-2">
                                        <img src="{{URL::asset('dash/assets/images/users/avatar-3.jpg')}}" alt="" width="100%" />
                                    </div>
                                    <div class="col-9 gx-3">
                                        <h5 class="font-500 mb-1">Eke Sandra</h5>
                                        <p class="my-0 py-0">I need new products by tommorow</p>
                                    </div>
                                </div>
                                <div class="col-1 text-end"></div>
                            </div>
                            <div class="row mt-4 align-items-center">
                                <div class="col-11 row">
                                    <div class="chat-img col-2 gx-2">
                                        <img src="/{{URL::asset('dash/assets/images/users/avatar-2.jpg')}}" alt="" width="100%" />
                                    </div>
                                    <div class="col-9 gx-3">
                                        <h5 class="fw-bold mb-1">Promise Eze</h5>
                                        <p class="my-0 py-0 text-sm">
                                            I need new products by tommorow
                                        </p>
                                    </div>
                                </div>
                                <div class="col-1 text-end"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /email campaign -->
                <!-- end page title -->
            </div>
        </div>
        <!-- End Page-content -->

        <!-- Transaction Modal -->
        <div class="modal fade transaction-detailModal" tabindex="-1" role="dialog" aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transaction-detailModalLabel">
                            Order Details
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2">
                            Product id: <span class="text-primary">#SK2540</span>
                        </p>
                        <p class="mb-4">
                            Billing Name: <span class="text-primary">Neal Matthews</span>
                        </p>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{URL::asset('dash/assets/images/product/img-7.png')}}" alt="" class="avatar-sm" />
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">
                                                    Wireless Headphone (Black)
                                                </h5>
                                                <p class="text-muted mb-0">$ 225 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 255</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{URL::asset('dash/assets/images/product/img-4.png')}}" alt="" class="avatar-sm" />
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">
                                                    Phone patterned cases
                                                </h5>
                                                <p class="text-muted mb-0">$ 145 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 145</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Sub Total:</h6>
                                        </td>
                                        <td>$ 400</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Shipping:</h6>
                                        </td>
                                        <td>Free</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td>$ 400</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->

        <!-- subscribeModal -->
        <!-- <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <div class="avatar-md mx-auto mb-4">
                                    <div class="avatar-title bg-light rounded-circle text-primary h1">
                                        <i class="mdi mdi-email-open"></i>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-xl-10">
                                        <h4 class="text-primary">Subscribe !</h4>
                                        <p class="text-muted font-size-14 mb-4">Subscribe our newletter and get notification to stay update.</p>

                                        <div class="input-group bg-light rounded">
                                            <input type="email" class="form-control bg-transparent border-0" placeholder="Enter Email address" aria-label="Recipient's username" aria-describedby="button-addon2">
                                            
                                            <button class="btn btn-primary" type="button" id="button-addon2">
                                                <i class="bx bxs-paper-plane"></i>
                                            </button>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <!-- end modal -->
    </div>
    <!-- end main content-->
@endsection
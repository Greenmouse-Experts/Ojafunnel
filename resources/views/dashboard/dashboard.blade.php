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
                                    <h1>Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}} 👋</h1>
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
                <div class="campaign-div">
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
                                    <img src="{{URL::asset('dash/assets/images/users/avatar-6.jpg')}}" alt="" width="100%" />
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
                                    <img src="{{URL::asset('dash/assets/images/users/avatar-4.jpg')}}" alt="" width="100%" />
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

 <!-- Modal START -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-4 py-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Kindly Create...
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-1-circle"></i>
                                </div>
                                <h3>Create Pages</h3>
                                <p>
                                    Design beautiful website, landing page or funnel with our
                                    page editor.
                                </p>
                                <div class="con">
                                    <a href="{{route('user.page.builder', Auth::user()->username)}}" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-2-circle"></i>
                                </div>
                                <h3>Create Store</h3>
                                <p>Create shops to sell your digital and physical products</p>
                                <div class="con">
                                    <a href="{{route('user.my.store', Auth::user()->username)}}" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-3-circle"></i>
                                </div>
                                <h3>Create Emails</h3>
                                <p>
                                    Create emails easily with our drag and drop editors readily
                                    avaliable for you
                                </p>
                                <div class="con">
                                    <a href="{{route('user.create.list', Auth::user()->username)}}" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-4-circle"></i>
                                </div>
                                <h3>Create Automations</h3>
                                <p>
                                    Automate sms, chats and emails to reach subscribers at the
                                    perfect time.
                                </p>
                                <div class="con">
                                    <a href="{{route('user.automation.contact_list', Auth::user()->username)}}" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
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
@endsection

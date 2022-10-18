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
            <div class="row card begin">
                <div class="col-12 account-head">
                    <div class="row py-3 align-items-center">
                        <div class="col-md-6">
                            <h4>Email Automation</h4>
                            <p>
                                Impact your business with automated emails for your
                                customers
                            </p>
                        </div>
                        <div class="col-md-6 text-end">
                            <button class="btn text-purp border-purp">
                                <a href="{{route('user.email.automation')}}">
                                    Create Custom Automation
                                </a>
                            </button>
                        </div>
                    </div>
                    <div class="row text-center mt-5 mb-4">
                        <div class="col-md-2 text-purp">
                            <a href="Eautomation.html">
                                Most Popular
                            </a>
                        </div>
                        <div class="col-md-2 text-purpp">
                            <a href="">
                                Improve Engagement
                            </a>
                        </div>
                        <div class="col-md-2 text-purpp">
                            <a href="#">
                                Increased Traffic
                            </a>
                        </div>
                        <div class="col-md-2 text-purpp">
                            <a href="">
                                Increased Revenue
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="row card begin">
                <div class="template-con">
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="p-3 shadows rounded bg-white">
                                <p class="fs-me">
                                     Abandoned Cart
                                </p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-4 rounded bg-white">
                                <p class="fs-me">
                                    Product Purchase
                                </p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-4 rounded bg-white">
                                <p class="fs-me">Anniversary</p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                            <div class="p-3 shadows mt-4 rounded bg-white last">
                                <p class="fs-me">Welcome Message</p>
                                <p>Send an email after a contact abandons a cart</p>
                            </div>
                        </div>
                        <div class="col-lg-6 p-3 bg-white rounded">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <p class="fs-me">Abandoned Cart</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button class="border-0 rounded bg-purp text-white py-1 px-3">
                                        Close
                                    </button>
                                </div>
                            </div>
                            <div class="abandon-cart">
                                <p class="opacity-75">Automation Starts</p>
                                <p>Trigger - Customer adds product to cart</p>
                            </div>
                            <div class="abandon-cart">
                                <p>Condition - Customer does not checkout</p>
                            </div>
                            <div class="abandon-cart">
                                <p class="opacity-75">Wait</p>
                                <p>Action - Wait for customer for 2 days</p>
                            </div>
                            <div class="abandon-cart">
                                <p class="opacity-75">Email</p>
                                <p>Action - Wait for customer for 2 days</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
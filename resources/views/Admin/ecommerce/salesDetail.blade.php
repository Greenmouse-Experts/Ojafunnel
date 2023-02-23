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
                                <li class="breadcrumb-item"><a href="{{route('adminwelcome')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('salesList')}}">Product Sales</a></li>
                                <li class="breadcrumb-item active">Sales Detail</li>
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
                            <p class="badge">₦40,000.00</p>
                            <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676889791/OjaFunnel-Images/1565838_e54e_16_lmsw3n.jpg' alt='' width="100%"/>
                            <p class="fw-bold fs-5 text-center mt-3 mb-1">Great Minds</p>
                        </div>
                    </div>
                    <div class="col-lg-7 sales-detail-box">
                        <div class="row">
                            <div class="col-3">
                                <p>Product Name:</p>
                            </div>
                            <div class="col-9">
                                <p>Great Minds</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Description:</p>
                            </div>
                            <div class="col-9">
                                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium consectetur quam atque quibusdam amet provident debitis neque nostrum, error illum assumenda libero ipsum ab ad dignissimos vel ut possimus necessitatibus?</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Category:</p>
                            </div>
                            <div class="col-9">
                                <p>Digital Product</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Date Created:</p>
                            </div>
                            <div class="col-9">
                                <p>20 December 2022</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Product Price:</p>
                            </div>
                            <div class="col-9">
                                <p>₦40,000.00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Unit Sold:</p>
                            </div>
                            <div class="col-9">
                                <p>3</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <p>Accumlated Price:</p>
                            </div>
                            <div class="col-9">
                                <p>₦120,000.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsectiona

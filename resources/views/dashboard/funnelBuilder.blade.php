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
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-9">
                            <h4 class="font-60">Choose A Funnel Template</h4>
                            <p>
                                 Pick a ready made funnel templates to begin building your funnel
                            </p>
                        </div>
                        <div class="col-md-3">
                            <div class="all-create">
                                <button>
                                    <!-- <a href="{{route('user.send.broadcast', Auth::user()->username)}}"> -->
                                    + Create New Funnel
                                    </a>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="pageTemp" id="" class="px-3 py-2 bg-light rounded mt-3">
                                <option value="top" disabled selected value>
                                    Content Type
                                </option>
                                <option value="tempOne">Use Cases</option>
                                <option value="tempTwo">Industry</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form">
                                <input type="text">
                            </div>
                        </div> -->
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">
                            <a href="#" class="text-decoration-none text-dark">All</a>
                        </p>
                        <p>
                        <a href="#" class="text-decoration-none text-dark">Quiz</a>
                        </p>
                        <p>
                            <a href="#" class="text-decoration-none text-dark">Online Form </a>
                        </p>
                        <p>
                            <a href="#" class="text-decoration-none text-dark">Survey</a>
                        </p>
                        <p>
                            <a href="#" class="text-decoration-none text-dark">Lead Page</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->

            <div class="row">
                <div class="col-md-3">
                    <div class="pageXX pageAdd">
                        <div class="small-circle">
                            <h5 class="pt-2">
                                <a href="#" class="text-white text-decoration-none">+</a>
                            </h5>
                        </div>
                        <div class="text-center mt-3 text-purp">
                            <h5>Blank Canvas</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pageX">
                        <a href="{{route('user.use.template', Auth::user()->username)}}">
                            <div class="page-top"></div>
                            <div class="p-3">
                                <h6>Sales Lead Form</h6>
                                <p>Ecommerce</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pageX">
                        <a href="{{route('user.product.recall', Auth::user()->username)}}">
                            <div class="page-top"></div>
                            <div class="p-3">
                                <h6>Product Recommendation</h6>
                                <p>Empower</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pageX">
                        <div class="page-top"></div>
                        <div class="p-3">
                            <h6>Discounted Purch</h6>
                            <p>Education</p>
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
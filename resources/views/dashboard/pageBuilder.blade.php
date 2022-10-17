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
                        <div class="col-md-8">
                            <h4 class="font-60">Choose A Template</h4>
                            <p>
                                Pick a ready made template to begin building your pages
                            </p>
                        </div>
                        <div class="col text-end">
                            <select name="pageTemp" id="" class="px-3 py-2 bg-light rounded">
                                <option value="top" disabled selected value>
                                    Select a category
                                </option>
                                <option value="tempOne">Option 1</option>
                                <option value="tempTwo">Option 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <ul class="list-unstyled d-flex justify-content-between w-100">
                            <li class="active">All</li>
                            <li>Landing Page</li>
                            <li>Opt-in-page</li>
                            <!-- <li>Coming Soon Page</li>
                    <li>Sales Page</li>
                    <li>Pre Sales Page</li>
                    <li>Thank You Page</li>
                    <li>Upsell</li> -->
                        </ul>
                    </div>
                    <div class="acc-border temp-border"></div>
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
                        <div class="page-top"></div>
                        <div class="p-3">
                            <h6>Sales Page</h6>
                            <p>Education</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pageX">
                        <div class="page-top"></div>
                        <div class="p-3">
                            <h6>Sales Page</h6>
                            <p>Education</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="pageX">
                        <div class="page-top"></div>
                        <div class="p-3">
                            <h6>Sales Page</h6>
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
@extends('layouts.admin-frontend')

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
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                            <h4 class="mb-sm-0 ">Page Builder</h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                    <li class="breadcrumb-item active">Page Builder</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- hero section -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card account-head">
                            <div class="py-2">
                                <h4 class="font-500">Page Builder</h4>
                                <p>
                                    Create, manage and view list of pages created by ojafunnel users.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1"></div>
                </div>
                <!-- page content -->
                <div class="page-contents">
                    <div class="template-content">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-2 pe-lg-5 template-side">
                                    <div class="license-div">
                                        <p><i class="bi bi-check2-square pe-2 text-warning fs-4"></i>License</p>
                                        <ul class="license-radio">
                                            <li>
                                                <input type="radio" name="license" />
                                                <span>Any</span>
                                            </li>
                                            <li>
                                                <input type="radio" name="license" />
                                                <span>Free</span>
                                            </li>
                                            <li>
                                                <input type="radio" name="license" />
                                                <span>Premium</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="sort-div">
                                        <p><i class="bi bi-sort-down fs-4 pe-2 text-warning"></i>Sort by</p>
                                        <ul class="sort-radio">
                                            <li>
                                                <input type="radio" name="sort" />
                                                <span>Recent</span>
                                            </li>
                                            <li>
                                                <input type="radio" name="sort" />
                                                <span>Popular</span>
                                            </li>
                                            <li>
                                                <input type="radio" name="sort" />
                                                <span>Top Rated</span>
                                            </li>
                                            <li>
                                                <input type="radio" name="sort" />
                                                <span>Editor's Pick</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <!-- category -->
                                    <div class="choose-category">
                                        <p>Choose Category</p>
                                        <div class="category-list">
                                            <ul>
                                                <li class="bg-success text-white">Ecommerce</li>
                                                <li class="bg-warning text-white">Easter</li>
                                                <li class="bg-primary text-white">Business</li>
                                                <li class="bg-danger text-white">Finance</li>
                                                <li class="bg-info text-white">Crypto</li>
                                                <li class="bg-secondary text-white">Logistics</li>
                                                <li class="bg-success text-white">Ecommerce</li>
                                                <li class="bg-warning text-white">Easter</li>
                                                <li class="bg-primary text-white">Business</li>
                                                <li class="bg-danger text-white">Finance</li>
                                                <li class="bg-info text-white">Crypto</li>
                                                <li class="bg-secondary text-white">Logistics</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- category content -->
                                    <div class="template-listing">
                                        <div class="template-listing-grid">
                                            <div class="single-template">
                                                <div class="inner first-grid bg-light">
                                                    <div  class="text-center">
                                                        <i class="bi bi-bookmark-plus-fill text-secondary fs-1"></i>
                                                        <button class="btn btn-primary d-block mt-2">New Template</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="single-template">
                                                <div class="inner second-grid">
                                                    <img src="https://templatemo.com/screenshots-720/template-562-space-dynamic.jpg" alt="templates" width="100%" height="100%"/>
                                                    <div  class="start-template">
                                                        <i class="bi bi-bookmark-plus-fill fs-1 text-primary"></i>
                                                        <a href="#">
                                                            <button class="btn btn-primary d-block mt-2">Use Template</button>
                                                        </a>
                                                        <a href="#">
                                                            <button class="btn btn-warning mt-2">Publish</button>
                                                        </a>
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
<!-- END layout-wrapper -->
@endsection

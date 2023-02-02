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
                        <h4 class="mb-sm-0 font-size-18">Shops</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Shops</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Shops</h4>
                            <p>
                                Set Up Your Own Shop
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="text-center p-4 border-end">
                                    <div class="avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">
                                            B
                                        </span>
                                    </div>
                                    <h5 class="text-truncate pb-1">Lotus Store</h5>
                                </div>
                            </div>

                            <div class="col-xl-7">
                                <div class="p-4 text-center text-xl-start">
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Products Available</p>
                                                <h5>112</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{route('user.stores', Auth::user()->username)}}" class="text-decoration-underline text-reset">See Profile <i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="text-center p-4 border-end">
                                    <div class=" avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-warning bg-soft text-warning font-size-16">
                                            H
                                        </span>
                                    </div>
                                    <h5 class="text-truncate pb-1">Hamzat Store</h5>
                                </div>
                            </div>

                            <div class="col-xl-7">
                                <div class="p-4 text-center text-xl-start">
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Products Available</p>
                                                <h5>104</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{route('user.stores', Auth::user()->username)}}" class="text-decoration-underline text-reset">See Profile <i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-5">
                                <div class="text-center p-4 border-end">
                                    <div class=" avatar-sm mx-auto mb-3 mt-1">
                                        <span class="avatar-title rounded-circle bg-danger bg-soft text-danger font-size-16">
                                            P
                                        </span>
                                    </div>
                                    <h5 class="text-truncate pb-1">Promise Store</h5>
                                </div>
                            </div>

                            <div class="col-xl-7">
                                <div class="p-4 text-center text-xl-start">
                                    <div class="row">
                                        <div class="col-12">
                                            <div>
                                                <p class="text-muted mb-2 text-truncate">Products Available</p>
                                                <h5>506</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{route('user.stores', Auth::user()->username)}}" class="text-decoration-underline text-reset">See Profile <i class="mdi mdi-arrow-right"></i></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--  end row -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
>
@endsection
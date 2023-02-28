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
                        <h4 class="mb-sm-0 font-size-18">Ojafunnel Chat Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Chat Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->

            <div id="app">
                <adminroom-component :adminprop="{{ Auth::guard('admin')->user() }}"></adminroom-component>
            </div>

        </div>
    </div>
    <!-- End Page-content -->
</div>
@endsection
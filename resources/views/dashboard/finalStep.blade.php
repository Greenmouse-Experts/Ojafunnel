@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row card cut begin">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{route('user.choose.temp', Auth::user()->username)}}">
                                <P>
                                    <b>
                                        << Back 
                                    </b>
                                </P>
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="text-center">
                                <h3>
                                    Product Recommendation
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="all-create">
                                <button>
                                    <!-- <a href="{{route('user.send.broadcast', Auth::user()->username)}}"> -->
                                    Use Template
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="commit">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="organ">
                                    <h1 class="where">
                                         Where Can We Reach You ?
                                    </h1>
                                    <p class="mt-1 mb-4">
                                    </p>
                                    <div class="row">
                                        <div class="forrm">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="text" placeholder="Name" name="email" class="input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="email" placeholder="Email" name="email" class="input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-md-12 mb-4">
                                                        <input type="tel" placeholder="Phone Number" name="email" class="input" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="name">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox">
                                                        </li>
                                                        <li>
                                                            Subscribe to newsletter
                                                        </li>
                                                    </ul>
                                                </div> <br>
                                                <div class="name mb-4">
                                                    <ul>
                                                        <li>
                                                            <input type="checkbox">
                                                        </li>
                                                        <li>
                                                            I agree to the processing of personal data
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="boding mb-4">
                                                    <a href="{{route('user.pay', Auth::user()->username)}}">
                                                        <button type="submit">
                                                            Next
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
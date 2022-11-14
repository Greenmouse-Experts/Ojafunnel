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
                                        << Back </b>
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
                                    <div class="content">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668171358/OjaFunnel-Images/image_796_ka7bcn.png" draggable="false" alt="">
                                        <h1>
                                            Congratulations !
                                        </h1>
                                        <p>
                                            You have succefully purchase your glasses, delivery details would be sent to your email
                                        </p>
                                    </div>
                                    
                                    <div class="row">
                                    <div class="col-md-12">
                                        <div class="boding alert mb-4">
                                            <a href="{{route('user.congratulation', Auth::user()->username)}}">
                                                <button type="submit">
                                                    Close
                                                </button>
                                            </a>
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
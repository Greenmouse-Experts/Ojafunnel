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
                                    <h1>
                                        Whats your face shape ?
                                    </h1>
                                    <p class="mt-1 mb-4">
                                    </p>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="emmet">
                                                <a href="{{route('user.choose.diamond', Auth::user()->username)}}">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                                                    <p>
                                                        Diamond
                                                    </p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="emmet">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                                                <p>
                                                    Round
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="emmet">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                                                <p>
                                                    Oval
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="emmet">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1665483192/OjaFunnel-Images/Rectangle_19232_fw5jtg.png" draggable="false" alt="">
                                                <p>
                                                   Squared
                                                </p>
                                            </div>
                                        </div>
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1666276876/OjaFunnel-Images/image_789_uy2ozx.png" alt="">
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
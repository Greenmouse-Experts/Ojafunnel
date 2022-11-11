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
                                    <!-- <a href="{{route('user.send.broadcast')}}"> -->
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
                                <div class="organn">
                                    <h1>
                                        What Glasses Fits Your Face
                                    </h1>
                                    <p class="mt-1 mb-4">
                                        Take this quiz and find out
                                    </p>
                                    <a href="{{route('user.take.quiz')}}">
                                        <button style="margin-bottom:20px !important;">
                                            Take Quiz
                                        </button>  
                                    </a>
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
<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="backing">
                    <div class="card">
                        <div class="user">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1666265880/OjaFunnel-Images/Group_46860_x7neyz.png" draggable="false" alt="">
                            <h2>
                                <b>
                                    Thank you for your message!
                                </b>
                            </h2>
                            <p>
                                We’ll be in touch soon
                            </p>
                        </div>
                        <div class="Light">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="boding mb-4">
                                            <button>
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<!-- END layout-wrapper -->
@endsection
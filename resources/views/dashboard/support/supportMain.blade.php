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
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Ojafunnel Support</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <!-- banner -->
            <div class='support-module-banner'>
                <div class='row justify-content-around align-items-center banner-contain'>
                    <div class='col-lg-7 col-md-9 col-11 mx-auto'>
                        <p class='pt-4 text-center'>
                            Ojafunnel team offers support to customers to help navigate and solve issues.
                        </p>
                    </div>
                    <div class='mobile-support'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676986860/OjaFunnel-Images/mobile-removebg-preview_szop42.png'  alt='mobile' width="100%" height="100%" class="mobile-bg"/>
                    </div>
                </div>
            </div>
            <!-- choose option -->
            <div class="my-5">
                <div class="row gy-4 justify-content-evenly">
                    <div class='col-md-4 support-option'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676990796/OjaFunnel-Images/chat-clip-removebg-preview_weurrv.png' alt='live-chat' />
                        <a href='' class="text-center">Live Chat</a>
                    </div>
                    <div class='col-md-4 support-option'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676991710/OjaFunnel-Images/email-chat-removebg-preview_o6kgo7.png' alt='live-chat' />
                        <a href="" class="text-center">Send Mail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
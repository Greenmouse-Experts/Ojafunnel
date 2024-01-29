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
                    <div class="col-lg-1">
                        <div class="card begin">
                            <div class="card-body">
                                <!-- <p class="cash">Explainer Video Here</p> -->
                                @if(App\Models\ExplainerContent::where('menu', 'Support')->exists())
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    <i class="bi bi-play-btn"></i>
                                </div>
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- choose option -->
            <div class="my-5">
                <div class="row gy-4 justify-content-evenly">
                    <div class='col-md-4 support-option'>
                        <a href="{{route('user.main.support.chat', Auth::user()->username)}}" class="text-center">
                            <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676990796/OjaFunnel-Images/chat-clip-removebg-preview_weurrv.png' alt='live-chat' /> <br>
                            Live Chat
                        </a>
                    </div>
                    <div class='col-md-4 support-option'>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#whatsappNumber" class="text-center">
                            <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676990796/OjaFunnel-Images/chat-clip-removebg-preview_weurrv.png' alt='live-chat' /> <br>
                            Whatsapp Number
                        </a>
                    </div>
                    <div class='col-md-4 support-option'>
                        <a href="{{route('user.main.email', Auth::user()->username)}}" class="text-center">
                            <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676991710/OjaFunnel-Images/email-chat-removebg-preview_o6kgo7.png' alt='live-chat' /> <br>
                            Send Mail
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<div class="modal fade" id="whatsappNumber" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Whatsapp Number List
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <table class="table align-middle table-nowrap">
                        <thead class="tread">
                            <tr>
                                <th>S/N</th>
                                <th>Whatsapp Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Models\WhatsappSupport::latest()->get() as $whatsapp)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    @php
                                        $phoneNumber = $whatsapp->phone_number;

                                        // Check if the phone number starts with "0"
                                        if (Str::startsWith($phoneNumber, '0')) {
                                            // Replace the first "0" with "+234"
                                            $formattedPhoneNumber = '+234' . Str::substr($phoneNumber, 1);
                                        } else {
                                            $formattedPhoneNumber = $phoneNumber;
                                        }
                                    @endphp

                                    <a href="https://wa.me/{{ urlencode($formattedPhoneNumber) }}" target="_blank" class="text-body fw-bold">
                                        {{ $formattedPhoneNumber }} <i class="fab fa-whatsapp"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if(App\Models\ExplainerContent::where('menu', 'Support')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Support')->first()->video}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                {{App\Models\ExplainerContent::where('menu', 'Support')->first()->text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
<!-- END layout-wrapper -->
@endsection

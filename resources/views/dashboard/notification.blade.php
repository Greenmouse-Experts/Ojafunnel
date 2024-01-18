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
                        <h4 class="mb-sm-0 font-size-18">Notifications</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class='row p-3 bg-white shadow-sm rounded notify-text'>
                <div class="col-lg-11">
                    <p class='text-center p-0 m-0 d-flex justify-content-center align-items-center'><i class="bi bi-bell-fill pe-2"></i>Notifications ({{App\Models\OjafunnelNotification::latest()->where('to', Auth::user()->id)->get()->count()}})</p>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Notification')->exists())
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
            <!-- notifications lists -->
            <div class='row my-5'>
                <div class='col-lg-2'></div>
                <div class='col-lg-8'>
                    @foreach(App\Models\OjafunnelNotification::latest()->where('to', Auth::user()->id)->get() as $notification)
                        @if($notification->status == 'Unread')
                        <div class='bg-white notify-box'>
                            <div class=''>
                                <div class='bg-light notify-img-box'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                                </div>
                            </div>
                            <a href="{{route('user.read.notification', Crypt::encrypt($notification->id))}}">
                            <div class=''>
                                <div class='notify-head-tag'>
                                    <p class='p-0 m-0'>{{$notification->title}}</p>
                                </div>
                                <div>
                                    <p class='mb-1 mt-2 fs-5'>{{$notification->body}}</p>
                                </div>
                                <div>
                                    <p class='fst-italic '>{{$notification->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                            </a>
                        </div>
                        @else
                        <div class='bg-white notify-box' style="border-left: none;">
                            <div class=''>
                                <div class='bg-light notify-img-box' >
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                                </div>
                            </div>
                            <div class=''>
                                <div class='notify-head-tag'>
                                    <p class='p-0 m-0'>{{$notification->title}}</p>
                                </div>
                                <div>
                                    <p class='mb-1 mt-2 fs-5'>{{$notification->body}}</p>
                                </div>
                                <div>
                                    <p class='fst-italic '>{{$notification->created_at->diffForHumans()}}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
                <div class='col-lg-2'></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@if(App\Models\ExplainerContent::where('menu', 'Notification')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Notification')->first()->video}}" type="video/mp4">
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
                                {{App\Models\ExplainerContent::where('menu', 'Notification')->first()->text}}
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
@endsection

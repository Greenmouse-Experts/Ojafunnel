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
                        <h4 class="mb-sm-0 font-size-18">Notifications</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Notifications</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class='row justify-content-around p-3 bg-white shadow-sm rounded notify-text'>
                <p class='text-center p-0 m-0 d-flex justify-content-center align-items-center'><i class="bi bi-bell-fill pe-2"></i>Notifications ({{App\Models\OjafunnelNotification::latest()->where('admin_id', Auth::guard('admin')->user()->id)->get()->count()}})</p>
            </div>
            <!-- notifications lists -->
            <div class='row my-5'>
                <div class='col-lg-2'></div>
                <div class='col-lg-8'>
                    @foreach(App\Models\OjafunnelNotification::latest()->where('admin_id', Auth::guard('admin')->user()->id)->get() as $notification)
                        @if($notification->status == 'Unread')
                        <div class='bg-white notify-box'>
                            <div class=''>
                                <div class='bg-light notify-img-box'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                                </div>
                            </div>
                            <a href="{{route('admin.read.notification', Crypt::encrypt($notification->id))}}">
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
@endsection
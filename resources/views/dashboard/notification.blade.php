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
            <div class='row justify-content-around p-3 bg-white shadow-sm rounded notify-text'>
                <p class='text-center p-0 m-0 d-flex justify-content-center align-items-center'><i class="bi bi-bell-fill pe-2"></i>Notifications (4)</p>
            </div>
            <!-- notifications lists -->
            <div class='row my-5'>
                <div class='col-lg-2'></div>
                <div class='col-lg-8'>
                    <div class='bg-white notify-box'>
                        <div class=''>
                            <div class='bg-light notify-img-box'>
                                <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                            </div>
                        </div>
                        <div class=''>
                            <div class='notify-head-tag'>
                                <p class='p-0 m-0'>Ecommerce</p>
                            </div>
                            <div>
                                <p class='mb-1 mt-2 fs-5'>Your course has been succesfully uploaded on the store for purchase.</p>
                            </div>
                            <div>
                                <p class='fst-italic '>10 mins ago</p>
                            </div>
                        </div>
                    </div>
                    <div class='bg-white notify-box mt-3'>
                        <div class=''>
                            <div class='bg-light notify-img-box'>
                                <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                            </div>
                        </div>
                        <div class=''>
                            <div class='notify-head-tag bg-success'>
                                <p class='p-0 m-0'>Affiliate</p>
                            </div>
                            <div>
                                <p class='mb-1 mt-2 fs-5'>A referral bonus of ₦20,000.00 has been credited to your wallet.</p>
                            </div>
                            <div>
                                <p class='fst-italic '>10 mins ago</p>
                            </div>
                        </div>
                    </div>
                    <div class='bg-white notify-box mt-3'>
                        <div class=''>
                            <div class='bg-light notify-img-box'>
                                <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                            </div>
                        </div>
                        <div class=''>
                            <div class='notify-head-tag bg-warning'>
                                <p class='p-0 m-0'>Transactions</p>
                            </div>
                            <div>
                                <p class='mb-1 mt-2 fs-5'>A payment has of ₦50,000.00 has been made to purchase your course (laravel framework).</p>
                            </div>
                            <div>
                                <p class='fst-italic '>10 mins ago</p>
                            </div>
                        </div>
                    </div>
                    <div class='bg-white notify-box mt-3'>
                        <div class=''>
                            <div class='bg-light notify-img-box'>
                                <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                            </div>
                        </div>
                        <div class=''>
                            <div class='notify-head-tag'>
                                <p class='p-0 m-0'>Ecommerce</p>
                            </div>
                            <div>
                                <p class='mb-1 mt-2 fs-5'>Your course has been succesfully uploaded on the store for purchase.</p>
                            </div>
                            <div>
                                <p class='fst-italic '>10 mins ago</p>
                            </div>
                        </div>
                    </div>
                    <p class='my-5 text-center'>
                        <span class='cursor-pointer'>Load More Activities ....</span>
                    </p>
                </div>
                <div class='col-lg-2'></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
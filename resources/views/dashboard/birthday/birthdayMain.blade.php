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
                        <h4 class="mb-sm-0 font-size-18">Birthday Module</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Birthday</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class='birthday-module-banner'>
                <div class='row justify-content-around'>
                    <div class='col-8'>
                        <p class='pt-4'>
                            Customize automated messages that will be delivered on the customer's
                            birthday, anniversary or any other celebration date.
                        </p>
                    </div>
                    <div class='col-4 col-lg-3'>
                        <div class='birthday-calendar'>
                            <div class='month'>
                                <p class='p-0 m-0'>February</p>
                            </div>
                            <div class='day'>
                                <p class='p-0 m-0'>25</p>
                            </div>
                            <div class='word'>
                                <p class='p-0 m-0'>Friday</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class='row mt-5 justify-content-around'>
                <div class='border col-lg-6 col-xl-5 birthday-module-link row'>
                    <div class='col-5 birthday-div'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676473304/OjaFunnel-Images/customers-removebg-preview_l9m5w0.png' alt='users' width="95%"  height="110px" style="border-radius: 10px;" />
                    </div>
                    <div class='col-7'>
                        <p>Create and manage customer listing</p>
                        <div>
                            <a href="{{route('user.manage.list', Auth::user()->username)}}" key="t-tui-calendar">Proceed  <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class='border my-4 my-lg-0 col-lg-6 col-xl-5  birthday-module-link row'>
                    <div class='col-5 birthday-div'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676473293/OjaFunnel-Images/cake_ajgb28.webp' alt='users' width="95%"  />
                    </div>
                    <div class='col-7'>
                        <p>Create and manage birthday modules</p>
                        <div>
                            <a href="{{route('user.manage.birthday', Auth::user()->username)}}" key="t-tui-calendar">Proceed  <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
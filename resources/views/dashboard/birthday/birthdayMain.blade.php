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
                    <div class='col-1 col-lg-3'>
                        <div class='birthday-calendar'>
                            <div class='month'>
                                <p class='p-0 m-0' id='month'>February</p>
                            </div>
                            <div class='day'>
                                <p class='p-0 m-0' id='day'>25</p>
                            </div>
                            <div class='word'>
                                <p class='p-0 m-0' id='days'>Friday</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="card">
                            <div class="card-body">
                                <!-- <p class="cash">Explainer Video Here</p> -->
                                @if(App\Models\ExplainerContent::where('menu', 'Birthday')->exists())
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
            <!-- main content -->
            <div class='row mt-5 justify-content-around'>
                <!-- <div class='border col-lg-6 col-xl-5 birthday-module-link row'>
                    <div class='col-5 birthday-div'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676473304/OjaFunnel-Images/customers-removebg-preview_l9m5w0.png' alt='users' width="95%" height="110px" style="border-radius: 10px;" />
                    </div>
                    <div class='col-7'>
                        <p>Create and manage customer listing</p>
                        <div>
                            <a href="{{route('user.manage.list', Auth::user()->username)}}" key="t-tui-calendar">Proceed <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div> -->
                <div class='border my-4 my-lg-0 col-12 col-xl-5  birthday-module-link row'>
                    <div class='col-5 birthday-div'>
                        <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676473293/OjaFunnel-Images/cake_ajgb28.webp' alt='users' width="95%" />
                    </div>
                    <div class='col-7'>
                        <p>Create and manage birthday modules</p>
                        <div>
                            <a href="{{route('user.manage.birthday', Auth::user()->username)}}" key="t-tui-calendar">Proceed <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
@if(App\Models\ExplainerContent::where('menu', 'Birthday')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Birthday')->first()->video}}" type="video/mp4">
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
                                {{App\Models\ExplainerContent::where('menu', 'Birthday')->first()->text}}
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
<script>
    let monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    let dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

    let d = new Date();
    let month = document.getElementById('month')
    let day = document.getElementById('day')
    let days = document.getElementById('days')
    month.innerHTML = monthNames[d.getMonth()]
    day.innerHTML = d.getUTCDate()
    days.innerHTML = dayNames[d.getDay()]
    console.log("The current month is " + monthNames[d.getMonth()]);
</script>
<!-- END layout-wrapper -->
@endsection

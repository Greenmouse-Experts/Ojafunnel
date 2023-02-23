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
                                <li class="breadcrumb-item active"><a href="{{route('user.main.support', Auth::user()->username)}}"></a>Support</li>
                                <li class="breadcrumb-item active">Email Support</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row px-3 justify-content-between align-items-center">
                            <div class="py-2 col-md-7">
                                <h4 class="font-500">Email Support</h4>
                                <p>
                                Send and receive email from support team.
                                </p>
                            </div>
                            <div class="col-md-5 row justify-content-end">
                                <div class="all-create text-end">
                                 <a href="#" data-bs-toggle="modal" data-bs-target="#sendMail">
                                  <button class="">New Mail</button>
                                 </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- messages -->
            <div class="mt-2 p-5 bg-white">
                <div class="email-msg-box">
                    <div class='bg-white email-box' data-bs-toggle="modal" data-bs-target="#viewMail">
                        <div class=''>
                            <div class='bg-light email-img-box'>
                                <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217513/OjaFunnel-Images/Logo-fav_d0wyqv.png' alt='profile' />
                            </div>
                        </div>
                        <div class=''>
                            <div class=''>
                                <p class='p-0 m-0 fw-bold'>Sent to Support</p>
                            </div>
                            <div>
                                <p class='mb-1 mt-1'>My LMS Courses are not uploading, it returns "Not allowed for the subscription".</p>
                            </div>
                            <div>
                                <p class='fst-italic '>10 mins ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<div class="modal fade" id="sendMail" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Send Instant Mail to Ojafunnel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <form method="post" action="{{route('user.send.message')}}">
                                @crsf
                                <div class="form">
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter your email..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Your Message</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <textarea></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <a href="#" class="text-decoration-none">
                                                <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                    Cancel
                                                </button></a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-none">
                                                <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                    >
                                                    Send
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="viewMail" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Sent Mail to Support Team
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <p>23 January 2023, 11:39am</p>
                            <div>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil perferendis voluptatem, reiciendis velit cumque, earum numquam ullam voluptate eligendi officia voluptatum exercitationem error? Necessitatibus eveniet commodi similique beatae illum sint.
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga, ullam illo ipsam, quo iste veritatis iusto et provident ab sed dolore, officiis eos ipsa consequuntur laborum nam reiciendis molestias ducimus?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END layout-wrapper -->
@endsection
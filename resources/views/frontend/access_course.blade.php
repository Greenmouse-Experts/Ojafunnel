@extends('layouts.frontend')

<link rel='stylesheet' href="{{ asset('assets/css/sweetalert2.min.css') }}">
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>


<input type="hidden" value="{{ url('/') }}/" id="site_url">
<input type="hidden" value="{{ csrf_token() }}" id="txt_token">

@section('page-content')
    <!-- faq-welcome Ends -->
        <section class="faq-welcome" style="padding:120px 0px 20px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        @if($auths == 0)
                        <div class="text">
                            <h1>
                                Enter your email and order no. to continue
                            </h1>
                            <p>
                                Your email you used to buy the course and order no is sent to your email address
                            </p>
                        </div>
                        @endif

                        @if($auths == 1)
                        <div class="text">
                            <h1>View Your Course</h1>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    <!-- faq-welcome Ends -->

    <!-- Ferent -->
        <section class="login">
            <div class="container">
                <div class="row">
                    @if($auths == 0)
                    <div class="offset-lg-4 col-lg-4 offset-sm-3 col-sm-6">
                        <div class="btn-div">
                            <div class="sidelist" style="padding:60px 0 20px 0">
                                <a href="{{route('index')}}">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" draggable="false" alt="" style="width:130px">
                                </a>

                                <form class="sign-div mt-3 form_access_course" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Your Email Address</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <i class="bi bi-envelope"></i>
                                                    <input type="text" placeholder="Enter your email address" name="email" class="input" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <label>Order No.</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <i class="bi bi-file-lock"></i>
                                                    <input type="text" placeholder="Enter your order number" name="order_no" class="input">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-0">
                                            <button type="button" class="accessCourse" style="padding:15px!important;border-radius:50px">
                                                Access Course
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($auths == 1)
                        <div class="col-md-12">
                            @include('frontend.view_paid_course')
                        </div>
                    @endif
                </div>
            </div>
        </section>
    <!-- Ferent Ends -->


    <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/jscripts.js') }}"></script>
@endsection

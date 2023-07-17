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
                        <h4 class="mb-sm-0 font-size-18">Ojafunnel Broadcast</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Broadcast</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>


            <div class="modal-body bg-white p-2">
                <div class="row">
                    <div class="Edit-level">
                        <form method="post">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Broadcast Channel</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="name" class="input">
                                                <option value="">-- Select Channel --</option>
                                                <option value="email">Email</option>
                                                <option value="sms">SMS</option>
                                                <option value="whatsapp">WhatsApp</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label>Recipient</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="name" class="input">
                                                <option value="all">All Users</option>
                                                <option value="subscribed">Subscribed Users</option>
                                                <option value="birthday">Birthday Users</option>
                                                <option value="list">List Users</option>
                                                <option value="course_enroll">Course Enrolled Users</option>
                                                <option value="funnel">Funnel Users</option>
                                                <option value="whatsapp">All Users</option>
                                                <option value="whatsapp">All Users</option>
                                                <option value="whatsapp">All Users</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <label>Subject</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter your email..." name="subject" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Your Message</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button class="px-3 btn" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                            >
                                            Send
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- End Page-content -->
</div>

@endsection
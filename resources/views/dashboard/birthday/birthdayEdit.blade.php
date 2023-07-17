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
                                <li class="breadcrumb-item"><a href="{{route('user.main.list', Auth::user()->username)}}">Birthday</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.manage.birthday', Auth::user()->username)}}">Manage Birthday</a></li>
                                <li  class="breadcrumb-item active">View/Edit Module</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header -->
            <div class=''>
                <div class='row align-items-center birthday-contact'>
                    <div class='col-lg-9 main-text'>
                        <p class='topic'>View/Edit Birthday Module</p>
                        <!-- <p class='mt-2 p-0'> create a new birthday module and set automation to send messages.</p> -->
                    </div>
                </div>
            </div>
            <!-- main content -->
            <div class='row my-4'>
                <div class='col-lg-2'></div>
                <div class='p-3 bg-white col-lg-8'>
                    <div>
                        <form  method="post">
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Message Title</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter the message title" value="Happy Anniversary" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Select Recipient List</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <select name="status" id="" class='py-3 fs-6'>
                                                <option  disabled class='p-5'>Choose from birthday listing</option>
                                                <option value="Active"  class='p-5'>Greenmouse List</option>
                                                <option value="Suspend" selected>Greenmouse Test</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Message Body</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea placeholder="Your story started with a simple ring, you two became husband and wife, and then you progressed to being parents’ and you are still best friends for life. – Happy Anniversary to you both!" ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class='fs-6 fw-bold'>Choose Automation</p>
                                    <div class="row">
                                        <div class="col-md-12 mb-5">
                                            <div class='d-flex mt-2 align-items-center'>
                                                <input type='checkbox' checked class='w-auto mt-1 checkboxs' />
                                                <label class='w-auto '>Email Automation</label>
                                            </div>
                                            <div class='d-flex mt-3 align-items-center'>
                                                <input type='checkbox' checked class='w-auto mt-1' />
                                                <label class='w-auto'>SMS & WhatsApp Automation</label>
                                            </div>
                                            <div class='d-flex mt-3 align-items-center'>
                                                <input type='checkbox' class='w-auto mt-1' />
                                                <label class='w-auto'>Whatsapp Automation</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class='row'>
                                        <div class='col-lg-6'>
                                            <label>Start Date</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="date"  name="name" class="input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-lg-6'>
                                            <label>End Date</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-5">
                                                    <input type="date"  name="name" class="input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <a href="{{route('user.manage.birthday', Auth::user()->username)}}" class="text-decoration-none">
                                            <button type="button" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Return to Modules
                                            </button></a>
                                    </div>
                                    <div class="col-6 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
                                                Save
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class='col-lg-2'></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection

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
            <div class="row begin">
                <div class="col-lg-12 move">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="align-items-center">
                                <h4>Create Automated Campaign</h4>
                                <p>
                                    Create a flow that is triggered by your customers actions
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cut">
                <div class="col-lg-3">
                </div>
                <div class="col-lg-6">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Automation Name </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter automation name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Senders Email </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter senders email" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Senders Name </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter senders name" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="boding">
                                                <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                    Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
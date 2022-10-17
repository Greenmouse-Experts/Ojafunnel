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
                <div class="col-12 card account-head">
                    <div class="py-2">
                        <h4 class="font-500">Email Checker</h4>
                        <p>
                            Check if your mailing list contains invalid email addresses
                        </p>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="account-con">
                    <div class="account-input-div mb-5">
                        <input type="email" placeholder="enter your email address" class="rounded" />
                        <div class="label-text">Email Address</div>
                    </div>
                    <div class="text-end">
                        <button class="btn px-4 my-2" style="color: #ffffff; background-color: #714091" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                            Verify Email
                        </button>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->

    <!-- email confirm modal -->
    <div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content pb-3">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <div>
                        <h4 class="font-500 mt-0">Email Result</h4>
                    </div>
                    <div class="mt-3">
                        <p>
                            The checked e-mail is completed, the email is
                            <span class="font-600 px-2" style="color: #714091">valid</span>
                        </p>
                    </div>
                    <div class="icon-success mt-4">
                        <img src="assets/image/theme.png" alt="" width="100%" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
</div>
<!-- end main content-->
</div>
<!-- END layout-wrapper -->
@endsection
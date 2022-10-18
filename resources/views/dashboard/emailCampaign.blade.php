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
            <div class="row card begin">
                <div class="col-lg-12 account-head began">
                    <div class="py-2">
                        <h4 class="font-500">New Email Campaign</h4>
                        <p>
                            Start an email campaign tom promote business with customers
                        </p>
                    </div>
                    <div class="campaign-nav mt-3">
                        <ul class="list-unstyled">
                            <li class="px-3 py-2 text-white bg-purp">Campaign Info >> </li>
                            </li>
                            </li>
                            <li>
                                <a href="{{route('user.email.Ecampaign')}}" class="text-decoration-none text-dark">Message Content >></a>
                            </li>
                            <li>
                                <a href="Ecampaign.html" class="text-decoration-none text-dark">Summary >></a>
                            </li>
                            <li>
                                <a href="Ecampaign.html" class="text-decoration-none text-dark">Send >></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="commerce-con">
                    <div>
                        <h4>Campaign Info</h4>
                    </div>
                    <div class="mt-4">
                        <label for="mailing" class="fs-5">Mailing List:</label>
                        <select name="mailing" id="" class="rounded px-3 w-100 py-2">
                            <option value="" disabled selected>
                                Choose from mailing list
                            </option>
                            <option value="">option 1</option>
                            <option value="">option 2</option>
                        </select>
                    </div>
                    <div class="d-flex mt-2">
                        <input type="checkbox" name="segregate" id="" />
                        <label for="segregate" class="px-2 mt-1">Use Segregation</label>
                    </div>
                    <div class="account-input-div my-5">
                        <input type="email" placeholder="enter your senders email address" class="rounded" required />
                        <div class="label-text fs-me">Senders Email Address</div>
                    </div>
                    <div class="account-input-div mb-5">
                        <input type="text" placeholder="enter senders name" class="rounded" required />
                        <div class="label-text fs-me">Senders Name</div>
                    </div>
                    <div class="account-input-div mb-5">
                        <input type="text" placeholder="enter the title of your report" class="rounded" required />
                        <div class="label-text fs-me">Subject Line</div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <button class="btn px-4 my-2" style="border: 1px solid #714091; color: #714091">
                                Save as draft
                            </button>
                        </div>
                        <div class="text-end col-6">
                            <a href="{{route('user.email.Ecampaign')}}">
                                <button class="btn px-4 my-2" style="color: #ffffff; background-color: #714091">
                                    Proceed
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
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
                <div class="col-12 account-head">
                    <div class="row py-2 justify-content-between align-items-center">
                        <div class="col">
                            <h4 class="font-60">My SMS Campaigns</h4>
                            <p>View your sent and scheduled sms to your customers</p>
                        </div>
                        <div class="col text-end">
                            <a href="{{route('user.new.sms')}}"><button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                    Create New Campaign
                                </button></a>
                        </div>
                    </div>
                    <div class="d-flex account-nav">
                        <p class="ps-0 active">Sent SMS</p>
                        <p>
                            <a href="#" class="text-decoration-none text-dark">Scheduled SMS</a>
                        </p>
                    </div>
                    <div class="acc-border"></div>
                </div>
            </div>
            <!-- store data information-->
            <div class="container">
                <div class="store-table">
                    <div class="table-head row pt-4">
                        <div class="col-lg-6">
                            <h4>Sent SMS</h4>
                        </div>
                        <div class="col-lg-6 search-item">
                            <div class="bg-light search-store border-in flex">
                                <input class="bg-light" type="search" placeholder="search by name" name="store" id="" />
                                <button><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="table-body mt-5 table-responsive">
                        <table class="table text-center">
                            <thead class="fw-bold bg-light rounded-pill">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Campaign Name</th>
                                    <th scope="col">Date Sent</th>
                                    <th scope="col">SMS Sent</th>
                                    <th scope="col">Delivered</th>
                                    <th scope="col">Not Delivered</th>
                                    <th scope="col">Opens</th>
                                    <th scope="col">Unsubscribed</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Chukka SMS</td>
                                    <td>30-09-2022</td>
                                    <td>100</td>
                                    <td>70</td>
                                    <td>30</td>
                                    <td>66</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Chukka Digital</td>
                                    <td>31-09-2022</td>
                                    <td>32</td>
                                    <td>30</td>
                                    <td>2</td>
                                    <td>23</td>
                                    <td>2</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row align-items-center table-footer mt-4 bg-light rounded-pill">
                        <div class="col-6 mt-2 fw-bold ps-4">
                            <p>2 campaign in total</p>
                        </div>
                        <div class="col-6 text-end">
                            <button class="btn mx-4 fw-bold fs-4 btn-outline-dark py-0 px-2"></button>
                            <button class="btn fw-bold fs-4 btn-outline-dark py-0 px-2"></button>
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
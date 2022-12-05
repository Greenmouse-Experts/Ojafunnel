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
                    <div class="row py-3 justify-content-between align-items-center">
                        <div class="col-md-12">
                            <h4 class="font-60">Choose Your Plan</h4>
                            <p>
                                Our service plans grow with your workforce!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row Pricing">
                <div class="col-lg-12">
                    <div class="pricing-intro">
                        <h1>
                            Upgrade Your Plan:
                        </h1>
                    </div>
                </div>
                <div class="col-lg-5"></div>
                <div class="col-lg-3">
                    <div class="price-switcher-container">
                        <div class="price-switcher-title">Choose your<br> billing period</div>
                        <div class="price-switcher">
                            <div class="price-switcher-period price-switcher-period__monthly active js-switch-button-period">Monthly</div>
                            <div class="price-switcher-period price-switcher-period__yearly js-switch-button-period">Annually</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            Free
                        </p>
                        <h1>
                            $0/<span>month</span>
                        </h1>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            STARTER
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                $100/<span>monthly</span>
                            </h1>
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                $200/<span>yearly</span>
                            </h1>
                        </div>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            STANDARD
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                $500/<span>monthly</span>
                            </h1>
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                $1000/<span>yearly</span>
                            </h1>
                        </div>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            ESSENCIAL
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                $1500/<span>monthly</span>
                            </h1>
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                $2000/<span>yearly</span>
                            </h1>
                        </div>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            PREMIUM
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                $2500/<span>monthly</span>
                            </h1>
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                $3000/<span>yearly</span>
                            </h1>
                        </div>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            ENTERPRISE
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                $4000/<span>monthly</span>
                            </h1>
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                $4500/<span>yearly</span>
                            </h1>
                        </div>
                        <a href="">
                            <button>UPGRADE FOR FREE</button>
                        </a>
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
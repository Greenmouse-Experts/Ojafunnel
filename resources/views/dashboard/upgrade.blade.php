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
                            <h4 class="font-60">Upgrade Your Account</h4>
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
                            Your current {{config('app.name')}} plan: {{$plan->name}}
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
                @foreach($plans as $singleplan)
                <div class="col-lg-4">
                    <div class="message upgrade-single">
                        <p>
                            {{strtoupper($singleplan->name)}}
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                {{$singleplan->currency}}{{$singleplan->monthly_amount}}/<span>monthly</span>
                            </h1>
                            @if($singleplan->name == $plan->name)
                            <a href="#" class="upgrade-btn" style="background: rgb(255, 255, 255); border: 3px solid rgb(0, 160, 255); color: rgb(0, 160, 255);">Your Plan</a>
                            @else
                            <a class='upgrade-btn' href="{{route('user.upgrade.account', [Auth::user()->username, Crypt::encrypt($singleplan->id), Crypt::encrypt($singleplan->monthly_amount)])}}">CHANGE</a>
                            @endif
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                {{$singleplan->currency}}{{$singleplan->yearly_amount}}/<span>yearly</span>
                            </h1>
                            @if($singleplan->name == $plan->name)
                            <a class="-yearly -hide upgrade-btn" href="#" style="background: rgb(255, 255, 255); border: 3px solid rgb(0, 160, 255); color: rgb(0, 160, 255);">Your Plan</a>
                            @else
                            <a class="-yearly -hide upgrade-btn" href="{{route('user.upgrade.account', [Auth::user()->username, Crypt::encrypt($singleplan->id), Crypt::encrypt($singleplan->yearly_amount)])}}">CHANGE</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
<style>
    .upgrade-single{
        background: rgb(149,102,122);
        background: radial-gradient(circle, rgba(149,102,122,1) 0%, rgba(113,63,147,1) 73%);
        padding: 20px 20px 40px;
        margin: 20px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        color: white;
        }
        .upgrade-single:hover{
            box-shadow: rgba(0, 0, 0, 0.6) 0px 10px 36px 0px, rgba(0, 0, 0, 0.6) 0px 0px 0px 1px;
        }
        .upgrade-btn{
            padding: 10px 40px !important;
            font-weight: 600;
            border: none !important;
        }
        .upgrade-btn:hover{
            transform:scale(1.2) !important;
        }
</style>
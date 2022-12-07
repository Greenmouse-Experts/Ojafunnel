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
                <div class="col-lg-2">
                    <div class="message">
                        <p>
                            {{strtoupper($singleplan->name)}}
                        </p>
                        <div class="js-price-big-wrapper-month">
                            <h1 class="">
                                {{$singleplan->currency}}{{$singleplan->monthly_amount}}/<span>monthly</span>
                            </h1>
                            @if($singleplan->name == $plan->name)
                            <a href="#" style="background: rgb(255, 255, 255); border: 3px solid rgb(0, 160, 255); color: rgb(0, 160, 255);">Your Plan</a>
                            @else
                            <a href="{{route('user.upgrade.account', [Auth::user()->username, Crypt::encrypt($singleplan->id), Crypt::encrypt($singleplan->monthly_amount)])}}">CHANGE</a>
                            @endif
                        </div>
                        <div class="js-price-big-wrapper">
                            <h1 class="-yearly -hide">
                                {{$singleplan->currency}}{{$singleplan->yearly_amount}}/<span>yearly</span>
                            </h1>
                            @if($singleplan->name == $plan->name)
                            <a class="-yearly -hide" href="#" style="background: rgb(255, 255, 255); border: 3px solid rgb(0, 160, 255); color: rgb(0, 160, 255);">Your Plan</a>
                            @else
                            <a class="-yearly -hide" href="{{route('user.upgrade.account', [Auth::user()->username, Crypt::encrypt($singleplan->id), Crypt::encrypt($singleplan->yearly_amount)])}}">CHANGE</a>
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
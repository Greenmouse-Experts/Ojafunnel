@extends('layouts.dashboard-frontend')
  <link href="{{asset('assets/css/components.min.css')}}" rel="stylesheet" type="text/css">	
  <script type="text/javascript" src="{{asset('assets/js/echarts.min.js')}}"></script>
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
                        <h4 class="mb-sm-0 font-size-18">Reports & Analysis</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Reports & Analysis</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- main content -->
            <div>
                <div class='repAnal-div'>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Funnel Analytics</p>
                        <p class='fs-4 fw-bold'>Funnel Builder</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>funnel count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-primary'>{{\App\Models\FunnelPage::where('user_id', Auth::user()->id)->count()}}</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Page Analytics</p>
                        <p class='fs-4 fw-bold'>Page Builder</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>page count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-warning'>{{App\Models\Page::where('user_id', Auth::user()->id)->count()}}</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Email Analytics</p>
                        <p class='fs-4 fw-bold'>Email Marketing</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>email count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-success'>18</p>
                        </div>
                    </div>
                    <div class='repAnal-box'>
                        <p class='repAnal-badge'>Ecommerce</p>
                        <p class='fs-4 fw-bold'>Ecommerce Stores</p>
                        <div>
                            <div class='d-flex justify-content-center fw-bold text-secondary'>
                                <p class='text-center'>store count</p>
                                <i class="bi bi-graph-up-arrow ps-1"></i>
                            </div>
                            <p class='fs-3 fw-bolder text-center text-danger'>{{App\Models\Store::where('user_id', Auth::user()->id)->get()->count()}}</p>
                        </div>
                    </div>
                </div>
                <div class='product-numbers '>
                    <div class='transact-analysis'>
                        <p class='transact-badge'>Transaction Analysis</p>
                        <p class='fs-4 fw-bold'>Transaction Analysis</p>
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="bars_basic"></div>
                        </div>
                    </div>
                    <div class="row mt-4">
                      <div class='col-md-6 subscribe-analysis'>
                        <p class="default-badge">Subscription Detail</p>
                        <div>
                          <p class="text-center fw-bold fs-4 text-warning">{{App\Models\OjaPlan::find(Auth::user()->plan)->name}} </p>
                        </div>
                        <div class="d-flex align-items-center">
                          <p>Status:</p>
                          <p><span class="ms-2 px-2 py-1 bg-success text-white fw-bold">Active</span></p>
                        </div>
                        <div>
                          @if(App\Models\OjaSubscription::where('user_id', Auth::user()->id)->where('status', 'active')->get()->isEmpty())
                          @else
                          <p class="mb-1">Duration:</p>
                          <p class="d-flex align-items-center">{{date('D/M/Y', strtotime(App\Models\OjaSubscription::latest()->where('user_id', Auth::user()->id)->where('status', 'Active')->first()->started_at))}}<span><i class="bi bi-arrow-left-right px-1 text-danger"></i></span> {{date('D/M/Y', strtotime(App\Models\OjaSubscription::latest()->where('user_id', Auth::user()->id)->where('status', 'Active')->first()->ends_at))}}</p>
                          @endif
                        </div>
                      </div>
                      <div class='col-md-6 affiliate-analysis' style="margin-top: 0px;">
                        <p class="default-badge">Affiliate Detail</p>
                        <div>
                          <p class="text-center fw-bold detail-fonting">{{App\Models\User::where('referral_link', Auth::user()->id)->get()->count()}}</p>
                          <p class="text-center">No of Direct Affiliate</p>
                        </div>
                        <div>
                          <p class="text-center fw-bold detail-fonting" >₦{{number_format(Auth::user()->ref_bonus, 2)}}</p>
                          <p class="text-center">Refferal Bonus</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="product-details">
                  <div class="lms-details row align-items-end">
                    <p class="transact-badge">L.M.S Analysis</p>
                    <div class="col-lg-4">
                      <div class=" d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/courses_aqxpw1.png" alt="course" width="100%" class="course-img" />
                      </div>
                      <p class="text-center fw-bold">{{App\Models\Course::where('user_id', Auth::user()->id)->where('approved', true)->get()->count()}} Courses in Shop</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/book_rvzxzs.webp" alt="books" width="80%" class="course-img" />
                      </div>
                      <p class="text-center fw-bold">
                        @php
                          $shop = \App\Models\Shop::where('user_id', Auth::user()->id)->first();
                        @endphp
                        @if($shop != null)
                          {{App\Models\ShopOrder::where('shop_id', $shop->id)->get()->count()}} Courses Sold
                        @else
                          0 Course Sold
                        @endif
                      </p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/bookwin-removebg-preview_cgkz6f.png" alt="books" width="70%" class="course-img">
                      </div>
                      <p class="text-center fw-bold">
                        @if($shop != null)
                          {{App\Models\Enrollment::where('shop_id', $shop->id)->get()->count()}} Total Students
                        @else
                          0 Total Student
                        @endif
                      </p>
                    </div>
                  </div>
                  <div class="ecommerce-details pt-lg-5 row">
                    <p class="transact-badge">Ecommerce Analysis</p>
                    <div class="col-lg-4">
                      <div class=" d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247982/OjaFunnel-Images/store_edshht.png" alt="course" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">{{App\Models\Store::where('user_id', Auth::user()->id)->get()->count()}} Stores</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/product_uqmijd.png" alt="books" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">
                          @php
                            $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
                          @endphp
                          @if($store != null)
                            {{\App\Models\StoreProduct::where('store_id', $store->id)->count()}} Total Products
                          @else
                            0 Total Product
                          @endif
                        </p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/prize_q1vmvf.jpg"  alt="books" width="60%" class="course-imgs" >
                      </div>
                      <p class="text-center fw-bold">
                          @if($store != null)
                            {{\App\Models\StoreOrder::where('store_id', $store->id)->count()}} Total Orders
                          @else
                            0 Total Order
                          @endif
                      </p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<script type="text/javascript">
var bars_basic_element = document.getElementById('bars_basic');
if (bars_basic_element) {
    var bars_basic = echarts.init(bars_basic_element);
    bars_basic.setOption({
        color: ['#713f93'],
        tooltip: {
            trigger: 'axis',
            axisPointer: {            
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [
            {
                type: 'category',
                data: ['Course Purchase', 'Referral Bonus', 'Product Purchase', 'Top Up'],
                axisTick: {
                    alignWithLabel: true
                }
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                name: 'Transaction Analysis',
                type: 'bar',
                barWidth: '20%',
                data: [
                    '{{$coursePurchase}}',
                    '{{$referralBonus}}', 
                    '{{$productPurchase}}',
                    '{{$topUp}}'
                ]
            }
        ]
    });
}
</script>

<!-- END layout-wrapper -->
@endsection
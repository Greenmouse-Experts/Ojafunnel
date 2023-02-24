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
                            <p class='fs-3 fw-bolder text-center text-primary'>02</p>
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
                            <p class='fs-3 fw-bolder text-center text-warning'>08</p>
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
                            <p class='fs-3 fw-bolder text-center text-danger'>02</p>
                        </div>
                    </div>
                </div>
                <div class='product-numbers '>
                    <div class='transact-analysis'>
                        <p class='transact-badge'>Transaction Analysis</p>
                        <p class='fs-4 fw-bold'>Transaction Analysis</p>
                        <div id='transact'></div>
                    </div>
                    <div>
                      <div class='subscribe-analysis'>
                        <p class="default-badge">Subscription Detail</p>
                        <div>
                          <p class="text-center fw-bold fs-4 text-warning">STANDARD PLAN</p>
                        </div>
                        <div class="d-flex align-items-center">
                          <p>Status:</p>
                          <p><span class="ms-2 px-2 py-1 bg-success text-white fw-bold">Active</span></p>
                        </div>
                        <div>
                          <p class="mb-1">Duration:</p>
                          <p class="d-flex align-items-center">02-Feb-2023 <span><i class="bi bi-arrow-left-right px-1 text-danger"></i></span> 02-Mar-2023</p>
                        </div>
                      </div>
                      <div class='affiliate-analysis'>
                        <p class="default-badge">Affiliate Detail</p>
                        <div>
                          <p class="text-center fw-bold detail-fonting" >0</p>
                          <p class="text-center">No of Affiliate</p>
                        </div>
                        <div>
                          <p class="text-center fw-bold detail-fonting" >₦0.00</p>
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
                      <p class="text-center fw-bold">12 Courses in Store</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/book_rvzxzs.webp" alt="books" width="80%" class="course-img" />
                      </div>
                      <p class="text-center fw-bold">49 Unit Sold</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/bookwin-removebg-preview_cgkz6f.png" alt="books" width="70%" class="course-img">
                      </div>
                      <p class="text-center fw-bold my-0">Top Grossing Course</p>
                      <p class="text-sm text-center my-0">(Laravel Framework)</p>
                    </div>
                  </div>
                  <div class="ecommerce-details pt-lg-5 row">
                    <p class="transact-badge">Ecommerce Analysis</p>
                    <div class="col-lg-4">
                      <div class=" d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247982/OjaFunnel-Images/store_edshht.png" alt="course" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">5 Shops</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/product_uqmijd.png" alt="books" width="60%" class="course-imgs" />
                      </div>
                      <p class="text-center fw-bold mt-2">45 Products</p>
                    </div>
                    <div class="col-lg-4">
                      <div class="d-flex justify-content-center">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677247981/OjaFunnel-Images/prize_q1vmvf.jpg"  alt="books" width="60%" class="course-imgs" >
                      </div>
                      <p class="text-center fw-bold mb-0">Top Grossing Product</p>
                      <p class="text-sm my-0 text-center">(Funnel Case)</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<script>
     var options = {
          series: [{
          name: 'Servings',
          data: [44, 55, 41, 67, 22, 43, 21, 33, 45, 31, 87, 65, 35]
        }],
          annotations: {
          points: [{
            x: 'Bananas',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Bananas are good',
            }
          }]
        },
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: ['Course Sales', 'Email Auto..', 'Strawberries', 'Tangerines', 'Papayas'
          ],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Servings',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };

        var chart = new ApexCharts(document.querySelector("#transact"), options);
        chart.render();
</script>
<!-- END layout-wrapper -->
@endsection
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
                        <h4 class="mb-sm-0 font-size-18">Analytics</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Sales Analytics</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='row align-items-center birthday-contact'>
                    <div class='col-lg-11 main-text'>
                        <p class='topic'>Sales Analytics</p>
                        <p class='mt-2 p-0'> All your sales analytics in one place</p>
                    </div>
                    <div class="col-lg-1">
                        <div class="card">
                            <div class="card-body">
                                <!-- <p class="cash">Explainer Video Here</p> -->
                                @if(App\Models\ExplainerContent::where('menu', 'Sales-Analytics')->exists())
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                    <i class="bi bi-play-btn"></i>
                                </div>
                                <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main content -->
            <div>
                <div class='analytics-header-boxes'>
                    <div class='analytics-header-box box1'>
                        <p class='text-center label1'>Total Sales</p>
                        <p class='text-center label2'>
                          @php
                            $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
                            $shop = \App\Models\Shop::where('user_id', Auth::user()->id)->first();
                          @endphp
                          @if($store != null AND $shop != null)
                            ₦{{number_format(App\Models\StoreOrder::where('store_id', $store->id)->sum('amount') + App\Models\ShopOrder::where('shop_id', $shop->id)->sum('amount'), 2)}}
                          @elseif($shop != null AND $store == null)
                            ₦{{number_format(App\Models\ShopOrder::where('shop_id', $shop->id)->sum('amount'), 2)}}
                          @elseif($store != null AND $shop == null)
                            ₦{{number_format(App\Models\StoreOrder::where('store_id', $store->id)->sum('amount'), 2)}}
                          @else
                            ₦0
                          @endif
                        </p>
                        <div class='d-flex justify-content-center'>
                            <img src='https://cdn-icons-png.flaticon.com/512/1389/1389181.png' alt='analysis' width='60%' />
                        </div>
                    </div>
                    <div class='analytics-header-box box2'>
                        <p class='text-center label1'>Ecommerce Sales</p>
                        <p class='text-center label2'>
                          @php
                            $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
                          @endphp
                          @if($store != null)
                            ₦{{number_format(App\Models\StoreOrder::where('store_id', $store->id)->sum('amount'), 2)}}
                          @else
                            ₦0
                          @endif
                        </p>
                        <div id='chart1'></div>
                    </div>
                    <div class='analytics-header-box box3'>
                        <p class='text-center label1'>Course Sales</p>
                        <p class='text-center label2'>
                          @php
                            $shop = \App\Models\Shop::where('user_id', Auth::user()->id)->first();
                          @endphp
                          @if($shop != null)
                            ₦{{number_format(App\Models\ShopOrder::where('shop_id', $shop->id)->sum('amount'), 2)}}
                          @else
                            ₦0
                          @endif
                        </p>
                        <div id='chart2'></div>
                    </div>
                </div>
                <div class='product-numbers'>
                    <div class='product-numbers-graph'>
                        <p class='fs-5 fw-bold'>Analysis Data</p>
                        <div id="products"></div>
                    </div>
                    <!-- <div class='product-numbers-products'>
                        <p class='fs-5 fw-bold'>Top Product Sales</p>
                        <div>
                            <div class='product-details-box'>
                                <div class='products-img'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548205/OjaFunnel-Images/laravel_iupjh0.png' alt='profile' width='100%' />
                                </div>
                                <div class='products-text'>
                                    <p class='mb-1 fs-5'>Laravel Framework</p>
                                    <p>Total Sales: <span class=''>40 Units</span></p>
                                </div>
                            </div>
                            <div class='product-details-box mt-2'>
                                <div class='products-img'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548206/OjaFunnel-Images/vue_hie5ra.jpg' alt='profile' width='100%' />
                                </div>
                                <div class='products-text'>
                                    <p class='mb-1 fs-5'>Vue Beginner</p>
                                    <p>Total Sales: <span class=''>35 Units</span></p>
                                </div>
                            </div>
                            <div class='product-details-box mt-2'>
                                <div class='products-img'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548204/OjaFunnel-Images/html_yhwt1x.jpg' alt='profile' width='100%' />
                                </div>
                                <div class='products-text'>
                                    <p class='mb-1 fs-5'>HTML5 Guildlines</p>
                                    <p>Total Sales: <span class=''>34 Units</span></p>
                                </div>
                            </div>
                            <div class='product-details-box mt-2'>
                                <div class='products-img'>
                                    <img src='https://res.cloudinary.com/greenmouse-tech/image/upload/v1676548205/OjaFunnel-Images/laravel_iupjh0.png' alt='profile' width='100%' />
                                </div>
                                <div class='products-text'>
                                    <p class='mb-1 fs-5'>Laravel Framework</p>
                                    <p>Total Sales: <span class=''>40 Units</span></p>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
@if(App\Models\ExplainerContent::where('menu', 'Sales-Analytics')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="{{App\Models\ExplainerContent::where('menu', 'Sales-Analytics')->first()->video}}" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Text Explainer</h4>
                        <div class="aller">
                            <p>
                                {{App\Models\ExplainerContent::where('menu', 'Sales-Analytics')->first()->text}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ends -->
@endif
    <script>
        // total sales chart
        let options1 = {
          series: ['{{$storeOrderCount}}'],
          chart: {
          height: 190,
          width: "100%",
          type: 'radialBar',
          toolbar: {
            show: true
          }
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 225,
             hollow: {
              margin: 0,
              size: '70%',
              background: '#fff',
              image: undefined,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: 'front',
              dropShadow: {
                enabled: true,
                top: 3,
                left: 0,
                blur: 4,
                opacity: 0.24
              }
            },
            track: {
              background: '#fff',
              strokeWidth: '67%',
              margin: 0, // margin is in pixels
              dropShadow: {
                enabled: true,
                top: -3,
                left: 0,
                blur: 4,
                opacity: 0.35
              }
            },

            dataLabels: {
              show: true,
              name: {
                offsetY: -10,
                show: true,
                color: '#888',
                fontSize: '13px'
              },
              value: {
                formatter: function(val) {
                  return parseInt(val);
                },
                color: '#111',
                fontSize: '26px',
                show: true,
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: ['red'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          }
        },
        stroke: {
          lineCap: 'round'
        },
        labels: ['Percent'],
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options1);
        chart.render();
    </script>
    <script>
        // total sales chart
        let options2 = {
          series: ['{{$shopOrderCount}}'],
          chart: {
          height: 190,
          width: "100%",
          type: 'radialBar',
          toolbar: {
            show: true
          }
        },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 225,
             hollow: {
              margin: 0,
              size: '70%',
              background: '#fff',
              image: undefined,
              imageOffsetX: 0,
              imageOffsetY: 0,
              position: 'front',
              dropShadow: {
                enabled: true,
                top: 3,
                left: 0,
                blur: 4,
                opacity: 0.24
              }
            },
            track: {
              background: '#fff',
              strokeWidth: '67%',
              margin: 0, // margin is in pixels
              dropShadow: {
                enabled: true,
                top: -3,
                left: 0,
                blur: 4,
                opacity: 0.35
              }
            },

            dataLabels: {
              show: true,
              name: {
                offsetY: -10,
                show: true,
                color: '#888',
                fontSize: '13px'
              },
              value: {
                formatter: function(val) {
                  return parseInt(val);
                },
                color: '#111',
                fontSize: '26px',
                show: true,
              }
            }
          }
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: 'horizontal',
            shadeIntensity: 0.5,
            gradientToColors: ['green'],
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 100]
          }
        },
        stroke: {
          lineCap: 'round'
        },
        labels: ['Percent'],
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options2);
        chart.render();
    </script>
    <script>
      // total sales chart
      let options3 = {
        series: [18],
        chart: {
        height: 190,
        type: 'radialBar',
        toolbar: {
          show: true
        }
      },
      plotOptions: {
        radialBar: {
          startAngle: -135,
          endAngle: 225,
            hollow: {
            margin: 0,
            size: '70%',
            background: '#fff',
            image: undefined,
            imageOffsetX: 0,
            imageOffsetY: 0,
            position: 'front',
            dropShadow: {
              enabled: true,
              top: 3,
              left: 0,
              blur: 4,
              opacity: 0.24
            }
          },
          track: {
            background: '#fff',
            strokeWidth: '67%',
            margin: 0, // margin is in pixels
            dropShadow: {
              enabled: true,
              top: -3,
              left: 0,
              blur: 4,
              opacity: 0.35
            }
          },

          dataLabels: {
            show: true,
            name: {
              offsetY: -10,
              show: true,
              color: '#888',
              fontSize: '13px'
            },
            value: {
              formatter: function(val) {
                return parseInt(val);
              },
              color: '#111',
              fontSize: '26px',
              show: true,
            }
          }
        }
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['orange'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round'
      },
      labels: ['Percent'],
      };

      var secondChart = new ApexCharts(document.getElementById("chart3"), options3);
      secondChart.render();
    </script>
    <script>
      var options = {
        series: [{
        data: ['{{$shopOrderCount}}', '{{$students}}', '{{$storeOrderCount}}']
      }],
        chart: {
        type: 'bar',
        height: 350
      },
      plotOptions: {
        bar: {
          borderRadius: 4,
          horizontal: true,
        }
      },
      dataLabels: {
        enabled: false
      },
      xaxis: {
          categories: ['Course Sales', 'Students', 'Ecommerce Sales'],
      },
      fill: {
          colors: ['#713f93']
        }
      };

      let products = new ApexCharts(document.querySelector("#products"), options);
      products.render();
    </script>
<!-- END layout-wrapper -->
@endsection

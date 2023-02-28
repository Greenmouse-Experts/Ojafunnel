@extends('layouts.admin-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0">Sales Analytics</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Sales Analytics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div>
                <div class="monthly-sales">
                    <p class="fw-bold">Number of Sales</p>
                    <div id="chart1"></div>
                </div>
                <div class="analysis-second-row">
                    <div class="sales-money">
                        <p class="fw-bold">Amount Sales</p>
                        <div id='chart2'></div>
                    </div>
                    <div class="subscription-money">
                            <p class="number">430 <i class=" ps-2 text-danger bi bi-graph-up-arrow"></i></p>
                            <p class="word">Subscribers</p>
                            <p class="money">₦940,000.00 <span class="fs-5 text-warning">earned</span></p>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            
        </div>
    </div>
</div>
<script>
    let option = {
          series: [{
          name: 'LMS Sales',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66],
        }, {
          name: 'Ecommerce Sales',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
          colors: ['#713f93', 'rgba(248, 132, 21, 0.8)']
        },
        yaxis: {
          title: {
            text: 'unit sold',
            colors: ['#713f93', 'rgba(248, 132, 21, 0.8)']
          }
        },
        fill: {
          opacity: 1,
          colors: ['#713f93', 'rgba(248, 132, 21, 0.8)']
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return  val + " units sold"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), option);
        chart.render();
</script>
<script>
    var option2 = {
          series: [{
          data: [520000, 430000, 50000]
        }],
          chart: {
          type: 'bar',
          height: 250
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
          categories: ['LMS Sales', 'Ecom Sales', 'Other Sales'
          ],
          title: {
            text: 'Sales Amount'
          }
        },
        fill: {
                    colors: ['#713f93']
                }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), option2);
        chart.render();
</script>
@endsection
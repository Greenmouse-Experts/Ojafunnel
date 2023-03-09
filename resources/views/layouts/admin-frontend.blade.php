<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{config('app.name')}} | Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Admin Dashboard" name="Oja Funnel |  Dashboard" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('admin/assets/images/Logo-fav.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap Css -->
    <link href="{{URL::asset('admin/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('admin/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- DataTables -->
    <link href="{{URL::asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('admin/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        window.setTimeout(function() {
            $(".alert-timeout").fadeTo(500, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 8000);

        function show1() {
            document.getElementById('schedule').style.display = 'none';
        }

        function show2() {
            document.getElementById('schedule').style.display = 'block';
        }

        function myFunction() {
            var x = document.getElementById("preview");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</head>

<body data-sidebar="dark" data-layout-mode="light">
    @php
        $admin = auth()->guard('admin')->user();
    @endphp
    <!-- Alerts  Start-->
    <div style="position: fixed; top: 20px; right: 20px; z-index: 100000; width: auto;">
        @include('layouts.alerts')
    </div>
    <!-- Alerts End -->
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Header -->
        @includeIf('layouts.admin-header')
        <!-- Header Ends -->

        <!-- Sidebar -->
        @includeIf('layouts.admin-sidebar')
        <!-- Sidebar Ends -->

         <!-- Sidebar -->
         @includeIf('layouts.admin-footer')
        <!-- Sidebar Ends -->

        <!-- Page-Content -->
        @yield('page-content')
        <!-- Page-Content Ends -->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{URL::asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{URL::asset('admin/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Saas dashboard init -->
    <script src="{{URL::asset('admin/assets/js/pages/saas-dashboard.init.js')}}"></script>

    <!-- adminboard init -->
    <script src="{{URL::asset('admin/assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{URL::asset('admin/assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- App js -->
    <script src="{{URL::asset('admin/assets/js/app.js')}}"></script>

    <!-- Ion Range Slider-->
    <script src="{{URL::asset('admin/assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>

    <!-- init js -->
    <script src="{{URL::asset('admin/assets/js/pages/product-filter-range.init.js')}}"></script>

    <!-- select 2 plugin -->
    <script src="{{URL::asset('admin/assets/libs/select2/js/select2.min.js')}}"></script>

    <!-- dropzone plugin -->
    <script src="{{URL::asset('admin/assets/libs/dropzone/min/dropzone.min.js')}}"></script>

    <!-- init js -->
    <script src="{{URL::asset('admin/assets/js/pages/ecommerce-select2.init.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{URL::asset('admin/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->
    <script src="{{URL::asset('admin/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('admin/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>


    <script>
        // pricing switch button
        let pricingIsYearly = false;
        $('.js-switch-button-period').on('click', function(e) {
            e.preventDefault();
            $(this).parent().toggleClass('-yearly');
            pricingIsYearly = !pricingIsYearly;

            if (pricingIsYearly) {
                $('.js-price-big-wrapper').addClass('-yearly');
                $('.js-price-big-wrapper-month').addClass('-monthly');
                $('.price-switcher-period__monthly').removeClass('active');
                $('.price-switcher-period__yearly').addClass('active');
            } else {
                $('.js-price-big-wrapper').removeClass('-yearly');
                $('.js-price-big-wrapper-month').removeClass('-monthly');
                $('.price-switcher-period__monthly').addClass('active');
                $('.price-switcher-period__yearly').removeClass('active');
            }
        });
    </script>
    <!-- email automation chart -->
    <script>
        var options = {
            series: [{
                    name: "open",
                    data: [76, 85, 101, 98, 87, 105, 91],
                },
                {
                    name: "click",
                    data: [35, 41, 36, 26, 45, 48, 52],
                },
            ],
            chart: {
                type: "bar",
                height: 380,
            },
            colors: ["#F1972E", "#5FBF4F"],
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "65%",
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            xaxis: {
                categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            },
            yaxis: {
                title: {},
            },
            fill: {
                opacity: 1,
            },
        };

        var chart = new ApexCharts(document.querySelector("#emailAuto"), options);
        chart.render();
    </script>

    <!-- sales analysis chart -->
    <script>
        var options = {
            series: [{
                name: "Desktops",
                data: [10, 26, 50, 70, 20, 40, 60]
            }],
            chart: {
                height: 300,
                type: "area",
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "straight"
            },
            colors: ["#DD0EFF"],
            fill: {
                type: "gradient",
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 90, 100],
                },
            },
            xaxis: {
                categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            },
        };
        var chart = new ApexCharts(document.getElementById("sales"), options);
        chart.render();
    </script>

    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>

    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
</body>

</html>

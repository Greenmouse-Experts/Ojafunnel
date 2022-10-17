<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> Oja Funnel | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />

    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body data-sidebar="dark" data-layout-mode="light">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Header -->
        @includeIf('layouts.dashboard-header')
        <!-- Header Ends -->

        <!-- Sidebar -->
        @includeIf('layouts.dashboard-sidebar')
        <!-- Sidebar Ends -->

        <!-- Page-Content -->
        @yield('page-content')
        <!-- Page-Content Ends -->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Modal START -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content px-4 py-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Kindly Create...
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-1-circle"></i>
                                </div>
                                <h3>Create Pages</h3>
                                <p>
                                    Design beautiful website, landing page or funnel with our
                                    page editor.
                                </p>
                                <div class="con">
                                    <a href="pagebuild.html" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-2-circle"></i>
                                </div>
                                <h3>Create Shore</h3>
                                <p>Create shops to sell your digital and physical products</p>
                                <div class="con">
                                    <a href="ecommerce.html" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-3-circle"></i>
                                </div>
                                <h3>Create Emails</h3>
                                <p>
                                    Create emails easily with our drag and drop editors readily
                                    avaliable for you
                                </p>
                                <div class="con">
                                    <a href="emailmarket.html" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="dropover">
                                <div class="for-drop">
                                    <i class="bi bi-4-circle"></i>
                                </div>
                                <h3>Create Automations</h3>
                                <p>
                                    Automate sms, chats and emails to reach subscribers at the
                                    perfect time.
                                </p>
                                <div class="con">
                                    <a href="emailAuto.html" class="text-purp">
                                        <b> Continue <i class="bi bi-arrow-right"></i> </b>
                                    </a>
                                </div>
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

    <!-- JAVASCRIPT -->
    <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{URL::asset('dash/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

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
            // grid: {
            //   row: {
            //     colors: ["transparent"],
            //     opacity: 0,
            //   },
            //   column: {
            //     colors: ["transparent"],
            //     opacity: 0,
            //   },
            //   borderColor: "black",
            //   yaxis: {
            //     lines: {
            //       show: true,
            //     },
            //   },
            //   Xaxis: {
            //     lines: {
            //       show: true,
            //       colors: ["black"],
            //     },
            //   },
            // },
            xaxis: {
                categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
            },
        };
        var chart = new ApexCharts(document.getElementById("sales"), options);
        chart.render();
    </script>

    <script src="https://kit.fontawesome.com/997b229808.js" crossorigin="anonymous"></script>

    <!-- dashboard init -->
    <script src="{{URL::asset('dash/assets/js/pages/dashboard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{URL::asset('dash/assets/js/app.js')}}"></script>
</body>

</html>
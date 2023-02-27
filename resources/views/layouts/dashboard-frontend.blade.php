<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title> {{config('app.name')}} | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Oja Funnel |  Dashboard" name="Oja Funnel |  Dashboard" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{URL::asset('dash/assets/images/Logo-fav.png')}}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/js/app.js', 'resources/css/app.css', 'public/dash/assets/css/bootstrap.min.css', 'public/dash/assets/css/app.min.css'])

    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('core/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css">
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/css/tooltipster.bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-light.min.css" />
    <!-- DataTables -->
    <link href="{{URL::asset('dash/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::asset('dash/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tooltipster/4.2.7/js/tooltipster.bundle.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('core/numeric/jquery.numeric.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/validate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/autofill.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/validate.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/UrlAutofill.js') }}"></script>
    <script type="text/javascript" src="{{URL::asset('dash/assets/js/functions.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/link.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/box.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/popup.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/group-manager.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/sidebar.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/sidebar.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/list.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/anotify.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/dialog.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/iframe_modal.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('dash/assets/js/search.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/js/editor.js') }}"></script>

    <!-- Dropzone -->
	<script type="text/javascript" src="{{ URL::asset('core/dropzone/dropzone.js') }}"></script>

    <!-- App Css-->
    {{-- <script src=" http://localhost:8001/core/js/autofill.js"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('core/js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/anytime.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/pickadate/picker.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('core/datetime/pickadate/picker.date.js') }}"></script>

    <script src="https://js.paystack.co/v1/inline.js"></script>
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

        function emailAuto(){
            var smsVal = document.querySelector('#email_select');
            if (smsVal.checked == true) {
                document.querySelector('.email_automation').style.display = 'block'
            } else {
                document.querySelector('.email_automation').style.display = 'none'
            }
        }

        function smsAuto(){
            var smsVal = document.querySelector('#sms_select');
            if (smsVal.checked == true) {
                document.querySelector('.sms_automation').style.display = 'block'
            } else {
                document.querySelector('.sms_automation').style.display = 'none'
            }
        }

        function whatsAppAuto(){
            var smsVal = document.querySelector('#whatsapp');
            if (smsVal.checked == true) {
                document.querySelector('.whatsapp_automation').style.display = 'block'
            } else {
                document.querySelector('.whatsapp_automation').style.display = 'none'
            }
        }


        function frequencyChange(){
            var frq = document.getElementById("selectFrenquncy");
            var value = frq.value;
            console.log(value);
            if(value == 'daily'){
                document.getElementById('end_period').style.display = 'block';
            }
            if(value == 'monthly'){
                document.getElementById('end_period').style.display = 'block';
            }
            if(value == 'yearly'){
                document.getElementById('end_period').style.display = 'block';
            }
            if(value == 'custom'){
                document.getElementById('end_period').style.display = 'block';
                document.getElementById('frq_custom').style.display = 'block';
            }
            if(value == 'onetime'){
                document.getElementById('end_period').style.display = 'none';
                document.getElementById('frq_custom').style.display = 'none';
            }
        }
    </script>
</head>
@include('layouts.core._script_vars')
<body data-sidebar="dark" data-layout-mode="light">
    <!-- Alerts  Start-->
    <div style="position: fixed; top: 20px; right: 20px; z-index: 100000; width: auto;">
        @include('layouts.alerts')
    </div>
    <!-- Alerts End -->
    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- Header -->
        @includeIf('layouts.dashboard-header')
        <!-- Header Ends -->

        <!-- Sidebar -->
        @includeIf('layouts.dashboard-sidebar')
        <!-- Sidebar Ends -->

        <!-- Sidebar -->
        @includeIf('layouts.dashboard-footer')
        <!-- Sidebar Ends -->

        <!-- Page-Content -->
        @yield('page-content')
        <!-- Page-Content Ends -->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    {{-- <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('core/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{URL::asset('dash/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- dashboard init -->
    <script src="{{URL::asset('dash/assets/js/pages/datatables.init.js')}}"></script>
    <script src="{{URL::asset('dash/assets/js/pages/dashboard.init.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
     <!-- apexcharts init -->
     <script src="{{URL::asset('dash/assets/js/pages/apexcharts.init.js')}}"></script>
    <!-- App js -->
    <script src="{{URL::asset('dash/assets/js/app.js')}}"></script>
     <!-- echarts js -->
     <script src="{{URL::asset('dash/assets/libs/echarts/echarts.min.js')}}"></script>
     <!-- echarts init -->
     <script src="{{URL::asset('dash/assets/js/pages/echarts.init.js')}}"></script>

    <!-- Required datatable js -->
    <script src="{{URL::asset('dash/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->
    <script src="{{URL::asset('dash/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        function myFunction() {
            // Get the text field
            var copyText = document.getElementById("myInput");

            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);

            // Alert the copied text
            alert("Copied the text: " + copyText.value);
        }
    </script>
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

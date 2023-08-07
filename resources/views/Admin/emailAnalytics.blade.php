@extends('layouts.admin-frontend')

<style>
    #chartdiv {
        width: 100%;
        height: 435px;
        font-weight: 600 !important;
    }

    .card_shadow{
        /* box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.8); */
        box-shadow: rgba(0, 0, 0, 0.15) 0px 4px 14px !important;
        /* box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.85) !important; */
        /* background-color: #ddd !important; */
    }
</style>

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0">Report & Analytics</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Report & Analytics</li>
                            </ol>
                        </div>
                    </div>


                    <div class="row mb-4">
                        <div class="col-md-8 mt-3">
                            <h4>Showing Daily Data</h4>
                        </div>
                        <div class="col-md-4">
                            <select name="content_type" class="soryBy select_box">
                                <option value="">-- Select One --</option>
                                <option value="today" selected>Today</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-n3">
                        <div class="col-md-4">
                            <div class="card card_shadow p-3">
                                <h5>Total Subscribers</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h2 class="total_sub">{{ number_format($ojaSub) }}</h2>
                                    </div>
                                    <div class="col-md-9 text-end">
                                        <div style="font-size:13px"> Active Sub: <font style="color:#f1b44c">{{ number_format($ojaActiveSub) }}</font></div>
                                        <div style="font-size:13px"> Unactive Sub: <font style="color:#f1b44c">{{ number_format($ojaSub - $ojaActiveSub) }}</font></div>
                                        <div style="font-size:13px"> ----</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-lg-0 mt-3">
                            <div class="card card_shadow p-3">
                                <h5>Total Broadcasts</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h2 class="totalBroadcst">{{ number_format($broadcasts) }}</h2>
                                    </div>
                                    <div class="col-md-9 text-end">
                                        <div style="font-size:13px"> Emails: <font style="color:#f1b44c" class="lbl_emails">{{ number_format($emailBroadcst) }}</font></div>
                                        <div style="font-size:13px"> Sms: <font style="color:#f1b44c" class="lbl_sms">{{ number_format($smsBroadcst) }}</font></div>
                                        <div style="font-size:13px"> ----</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-lg-0 mt-n1">
                            <div class="card card_shadow p-3">
                                <h5>Total OptIn Rates</h5>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h2 class="totalOpt">{{ number_format($broadcasts) }}</h2>
                                    </div>
                                    <div class="col-md-9 text-end">
                                        <div style="font-size:13px"> Paid: <font style="color:#f1b44c">{{ number_format($paidOpt) }}</font></div>
                                        <div style="font-size:13px"> Pending: <font style="color:#f1b44c">{{ number_format($pendingOpt) }}</font></div>
                                        <div style="font-size:13px"> Failed: <font style="color:#f1b44c">{{ number_format($failedOpt) }}</font></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="chartdiv"></div>
                    

                </div>
            </div>
        </div>
    </div>
</div>




<script src="{{URL::asset('admin/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/amcharts.js') }}"></script> 
<script src="{{ asset('assets/js/pie.js') }}"></script> 
<script src="{{ asset('assets/js/light.js') }}"></script>



<script>

    
    $(document).ready(function(){
        $('.select2').select2();
    });



    var chart = AmCharts.makeChart( "chartdiv", {
        "type": "pie",
        "theme": "light",
        "dataProvider": [ {
            "campaigns": "Subscribers",
            "value": {{ $ojaSub }}
        }, {
            "campaigns": "Broadcasts",
            "value": {{ $broadcasts }}
        }, {
            "campaigns": "OptIn Rates",
            "value": 0
        }],
        "valueField": "value",
        "titleField": "campaigns",
        "outlineAlpha": 0.4,
        "depth3D": 25,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "fontSize": 13,
        "export": {
            "enabled": true
        }
    });


    $('body').on('change', '.soryBy', function (e) {
        var self = this;    
        var results = '';
        if($(this).val() == "") return;
        $(self).attr('disabled', true).css({'opacity': '0.4'});

        var datastring='sory_by='+$(this).val()
        +'&_token='+token;

        $.ajax({
            type : "POST",
            url : site_url + "admin/page/get-statistics",
            data: datastring,
            success : function(data){

                $(self).removeAttr('disabled').css({'opacity': '1'});

                let subs = 0;
                let broadcst = 0;
                let optIn = 0;

                if($(self).val() == "today"){
                    broadcst = parseInt(data.data.daily);
                    subs = parseInt(data.data.ojaSubDaily);
                    optIn = parseInt(data.data.ojaOptDaily);
                }
                if($(self).val() == "weekly"){
                    broadcst = parseInt(data.data.weekly);
                    subs = parseInt(data.data.ojaSubWeekly);
                    optIn = parseInt(data.data.ojaOptWeekly);
                }
                if($(self).val() == "monthly"){
                    broadcst = parseInt(data.data.monthly);
                    subs = parseInt(data.data.ojaSubMonthly);
                    optIn = parseInt(data.data.ojaOptMonthly);
                }
                if($(self).val() == "yearly"){
                    broadcst = parseInt(data.data.yearly);
                    subs = parseInt(data.data.ojaSubYearly);
                    optIn = parseInt(data.data.ojaOptYearly);
                }

                $('.total_sub').html(parseFloat(subs).toLocaleString());
                $('.totalBroadcst').html(parseFloat(broadcst).toLocaleString());
                $('.totalOpt').html(parseFloat(optIn).toLocaleString());

                // $('.lbl_emails').html(parseFloat(optIn).toLocaleString());
                // $('.lbl_sms').html(parseFloat(optIn).toLocaleString());

                var chart = AmCharts.makeChart( "chartdiv", {
                    "type": "pie",
                    "theme": "light",
                    "dataProvider": [ {
                        "campaigns": "Subscribers",
                        "value": subs
                    }, {
                        "campaigns": "Broadcasts",
                        "value": broadcst
                    }, {
                        "campaigns": "OptIn Rates",
                        "value": optIn
                    }],
                    "valueField": "value",
                    "titleField": "campaigns",
                    "outlineAlpha": 0.4,
                    "depth3D": 25,
                    "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                    "angle": 30,
                    "fontSize": 13,
                    "export": {
                        "enabled": true
                    }
                });
            
            },error : function(data){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
                title: "Error!",
                text: "Poor network connection",
                icon: 'error',
                timer: 4000
            });
            }
        });
    });
    
    </script>

@endsection
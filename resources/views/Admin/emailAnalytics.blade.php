@extends('layouts.admin-frontend')

<style>
    #chartdiv {
        width: 100%;
        height: 435px;
        font-weight: 600 !important;
    }

    .card_shadow{
        /* box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.8); */
        box-shadow: rgba(0, 0, 0, 0.5) 0px 4px 14px !important;
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
                        <div class="offset-md-8 col-md-4">
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
                        <div class="col-4">
                            <div class="card_ card_shadow p-3">
                                <h5>No of Subscribers</h5>
                                <h2>23</h2>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card_shadow p-3">
                                <h5>No of Broadcasts</h5>
                                <h2>201</h2>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="card card_shadow p-3">
                                <h5>No of OptIn Rates</h5>
                                <h2>65</h2>
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
            "value": 260
        }, {
            "campaigns": "Broadcasts",
            "value": 201
        }, {
            "campaigns": "OptIn Rates",
            "value": 65
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
        // $(self).attr('disabled', true).css({'opacity': '0.4'});

        var chart = AmCharts.makeChart( "chartdiv", {
            "type": "pie",
            "theme": "light",
            "dataProvider": [ {
                "campaigns": "Subscribers",
                "value": 392
            }, {
                "campaigns": "Broadcasts",
                "value": 101
            }, {
                "campaigns": "OptIn Rates",
                "value": 165
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

        /* var newData = [
            { campaigns: "Subscribers", value: 50 },
            { campaigns: "Broadcasts", value: 30 },
            { campaigns: "OptIn Rates", value: 120 }
        ];

        chart.dataProvider = newData;
        chart.validateData(); */
        
        /* $.ajax({
            type : "POST",
            url : site_url + "send-broadcast",
            data: $(".form_channel").serialize(),
            success : function(data){

            if(data.status=="success"){
                $(self).removeAttr('disabled').css({'opacity': '1'});
                Swal.fire("Successful", "Broadcast sent to their channels", "success");
                $(".form_channel")[0].reset();
            
            }else{
                $(self).removeAttr('disabled').css({'opacity': '1'});
                Swal.fire({
                title: "Error!",
                html: data.message,
                icon: 'error',
                timer: 3000
                });
            }
            },error : function(data){
            $(self).removeAttr('disabled').css({'opacity': '1'});
            Swal.fire({
                title: "Error!",
                text: "There are some wrong email addresses or phone numbers",
                icon: 'error',
                timer: 5000
            });
            }
        }); */
    });
    
    </script>

@endsection
@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <button hidden id="btn-nft-enable" onclick="startFCM()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-8 aminn">
                    <div class="page-title-box mt-4">
                        <h4 style="color:#000; font-weight:600;">Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}} 👋</h4>
                        <p>
                            Start enjoying full control of your business all in
                            one place
                        </p>
                    </div>
                </div>
                <div class="col-lg-1 aminn">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Dashboard')->exists())
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
                <div class="col-lg-3 aminn">
                    <div class="card account-head">
                        <div class="all-create" style="text-align:right!important;">
                            <button type="button" class="px-3 mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="display:inline">
                                + Create
                            </button>
                            @if($users->paid_for_backup == 1)
                                <button type="button" class="px-3" style="display:inline;opacity:0.4">
                                    <i class="fa fa-cloud-upload-alt"></i> Data Backedup
                                </button>
                            @else
                                <button type="button" class="px-3 backup_data" data-bs-toggle="modal" data-bs-target="#backUpData" style="display:inline">
                                    <i class="fa fa-cloud-upload-alt"></i> Backup my data
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="content-top-div">
                    <div class="top-div">
                        <div class="Ensure wallet-dashboard row align-items-center">
                            <div class="col-8 font-500">
                                <h3>₦{{number_format(Auth::user()->promotion_bonus, 2)}}</h3>
                                <p class="mb-0">Promotion Naira Bonus</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <i class="mdi mdi-wallet me-1" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure wallet-dashboard row align-items-center">
                            <div class="col-8 font-500">
                                <h3>${{number_format(Auth::user()->dollar_promotion_bonus, 2)}}</h3>
                                <p class="mb-0">Promotion Dollar Bonus</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <i class="mdi mdi-wallet me-1" style="font-size: 3rem;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="content-top-div">
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>{{App\Models\User::where('referral_link', Auth::user()->id)->get()->count() ?? '0'}}</h3>
                                <p class="mb-0">Total Direct Affiliate</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #edfbfc">
                                    <img src="{{URL::asset('dash/assets/image/leads.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                @php
                                $store = \App\Models\Store::where('user_id', Auth::user()->id)->first();
                                @endphp
                                @if($store != null)
                                <h3>{{\App\Models\StoreProduct::where('store_id', $store->id)->count()}}</h3>
                                @else
                                <h3>0</h3>
                                @endif
                                <p class="mb-0">New Products</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f5effc">
                                    <img src="{{URL::asset('dash/assets/image/products.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                <h3>{{App\Models\Store::where('user_id', Auth::user()->id)->get()->count()}}</h3>
                                <p class="mb-0">Total Store</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #f0fcef">
                                    <img src="{{URL::asset('dash/assets/image/sales.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-div">
                        <div class="Ensure row align-items-center">
                            <div class="col-8 font-500">
                                @if($store != null)
                                <h3>{{\App\Models\StoreOrder::where('store_id', $store->id)->count()}}</h3>
                                @else
                                <h3>0</h3>
                                @endif
                                <p class="mb-0">Total Orders</p>
                            </div>
                            <div class="col-4 lead-img-div">
                                <div class="lead-img p-2 rounded d-flex justify-content-center" style="background: #fceff1">
                                    <img src="{{URL::asset('dash/assets/image/bags.png')}}" alt="" width="28" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product & stores row-->
            <div class="products-stores-row mt-4">
                <div class="sales-analysis">
                    <div class="row mb-4">
                        <div class="col-6 font-500">
                            <h4>Sales Analysis</h4>
                        </div>
                        <div class="col-6 text-end">
                            <select name="duration" id="" class="px-2">
                                <option value="">weekly</option>
                                {{-- <option value="">yearly</option> --}}
                            </select>
                        </div>
                    </div>
                    <div id="sales"></div>
                </div>
                <div class="campaign-div mt-1">
                    <div class="row mb-4">
                        <div class="col-6 font-500">
                            <h4>Email Campaign</h4>
                        </div>
                        <div class="col-6 text-end">
                            <select name="duration" id="" class="px-2">
                                <option value="">weekly</option>
                                {{-- <option value="">yearly</option> --}}
                            </select>
                        </div>
                    </div>
                    <div id="emailAuto"></div>
                </div>
            </div>
            <!-- /product & stores -->
            <!-- end page title -->
            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Latest Transaction</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">Transaction No</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Payment Status</th>
                                        </tr>
                                    </thead>
                                    @foreach(App\Models\Transaction::latest()->where('user_id', Auth::user()->id)->get()->take(5) as $transaction)
                                    <tbody>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$transaction->reference}}</a> </td>
                                            <td>
                                                {{$transaction->created_at->toDayDateTimeString()}}
                                            </td>
                                            <td>
                                                {{$transaction->amount}}
                                            </td>
                                            <td>
                                                <span class="badge badge-pill badge-soft-success font-size-11">{{$transaction->status}}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- end main content-->

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
                                <a href="{{route('user.page.builder', Auth::user()->username)}}" class="text-purp">
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
                            <h3>Create Store</h3>
                            <p>Create shops to sell your digital and physical products</p>
                            <div class="con">
                                <a href="{{route('user.my.store', Auth::user()->username)}}" class="text-purp">
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
                                <a href="{{ route('user.email-marketing.email.campaigns', ['username' => Auth::user()->username]) }}" class="text-purp">
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
                                <a href="{{route('user.whatsapp.automation', Auth::user()->username)}}" class="text-purp">
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

@if(App\Models\ExplainerContent::where('menu', 'Dashboard')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{ App\Models\ExplainerContent::where('menu', 'Dashboard')->first()->video }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
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
                           {{App\Models\ExplainerContent::where('menu', 'Dashboard')->first()->text}}
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

<div class="modal fade" id="backUpData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="backup_form">
            <div class="modal-content px-2 py-2">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Backup My Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-0 mb-3">Keep your data with us if you do not want to subscrive at the moment to avoid permanent deletion</div>
                    <div class="row">
                        <label style="font-weight:500;font-size:15px;margin-bottom:-4px">One Time Fee</label>
                        <div class="col-md-12 mb-2">
                            <label class="input" style="font-weight:600;font-size:22px">&#8358;{{ number_format($admin->backup_amt) }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <label style="font-weight:500;font-size:15px;margin-bottom:-5px">Payment Method</label>
                        <div class="col-md-12 mb-4">
                            <select name="pay_mthd" id="" class="px-2 select_box pay_mthd" autocomplete="off">
                                <option value="">-Choose One-</option>
                                <option value="paystack" selected>Paystack</option>
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" class="pay_amt" value="{{ $admin->backup_amt }}">
                <input type="hidden" class="user_email" value="{{ $users->email }}">
                <input type="hidden" class="user_id" value="{{ $users->id }}">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_me" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-success pay_backup">
                        Pay &#8358;{{ number_format($admin->backup_amt) }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js"></script>

<script>
    window.onload=function(){
        document.getElementById("btn-nft-enable").click();
    };

    var firebaseConfig = {
        apiKey: "AIzaSyBcg119ZTB8mbzBPQdYoq2tojaa2uQCzgU",
        authDomain: "ojafunnel.firebaseapp.com",
        projectId: "ojafunnel",
        storageBucket: "ojafunnel.appspot.com",
        messagingSenderId: "466300978039",
        appId: "1:466300978039:web:8af3d79c8b6e6d34ed1772",
        measurementId: "G-B5FX3YDK5B"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function (response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{ route("save.token") }}',
                    type: 'POST',
                    data: {
                        token: response
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        console.log('Token stored.');
                    },
                    error: function (error) {
                        console.log('User Token Error'+ error);
                    },
                });
            }).catch(function (error) {
                console.log('User Token Error'+ error);
            });
    }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });
</script>

<script>
    let useTemplate = JSON.parse(localStorage.getItem('use_template'));

    if(useTemplate.view == false){
        let url = "{{ route('user.page.use_template', ['username' => Auth::user()->username, 'id' => '?']) }}".replace('?', useTemplate.page_id);
        window.location.assign(url);
    }
</script>

<!-- email automation chart -->
<script>
    var options = {
        series: [{
                name: "sent",
                data: JSON.parse("{{ $sent_mails }}"),
            },
            // {
            //     name: "delivered",
            //     data: [35, 41, 36, 26, 45, 48, 52],
            // },
        ],
        chart: {
            type: "bar",
            height: 380,
        },
        colors: ["#5FBF4F", "#F1972E"],
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
            categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
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
            name: "sales",
            data: JSON.parse("{{ $sales }}")
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
            categories: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        },
    };
    var chart = new ApexCharts(document.getElementById("sales"), options);
    chart.render();
</script>

<style>
    .wallet-dashboard {
        background-color: #713f93 !important;
        color: #fff !important;
    }
</style>
@endsection

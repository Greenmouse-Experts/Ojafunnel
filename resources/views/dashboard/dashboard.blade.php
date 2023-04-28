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
                <div class="col-lg-9 aminn">
                    <div class="card">
                        <div class="card-body">
                            <h4 style="color:#000; font-weight:600;">Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}} 👋</h4>
                            <p>
                                Start enjoying full control of your business all in
                                one place
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1 aminn">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            <i class="bi bi-play-btn"></i>
                            </div>
                            <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            <i class="bi bi-card-text"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 aminn">
                    <div class="card">
                        <div class="card-body">
                            <div class="all-create">
                                <button type="button" class="px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    + Create
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="start">
                <div class="row">
                    <div class="col-md-8">
                        <div class="start-main">
                            <h1>Welcome, {{Auth::user()->first_name}} {{Auth::user()->last_name}} 👋</h1>
                            <p>
                                Start enjoying full control of your business all in
                                one place
                            </p>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="exaplaner" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1678461136/OjaFunnel-Images/multimedia_yugciw.png" draggable="false" alt="">

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="exaplanerr" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1678959746/OjaFunnel-Images/written-paper_1_wlsmrq.png" draggable="false" alt="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="click">
                            <button type="button" class="px-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                + Create
                            </button>
                        </div>
                    </div>
                </div>
            </div> -->
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
                                                ₦{{number_format($transaction->amount, 2)}}
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
                                <a href="{{ route('user.email-marketing.email.templates', ['username' => Auth::user()->username]) }}" class="text-purp">
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
                                <a href="{{route('user.automation.contact_list', Auth::user()->username)}}" class="text-purp">
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

<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <iframe src="https://www.youtube.com/embed/9xwazD5SyVg" title="Dummy Video For YouTube API Test" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                           Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, ducimus iste. Consequuntur doloremque voluptatem officia, quos laborum delectus atque distinctio reprehenderit earum iure. Sequi voluptate architecto libero, repellat neque deserunt assumenda sunt in sit ipsam delectus nostrum qui ratione. Laboriosam aliquid obcaecati vitae voluptatum ea minus quidem! Pariatur soluta quasi modi harum aut quas veritatis et. Necessitatibus fuga illo ipsa dicta aut nisi laborum nam at, id eveniet consectetur praesentium enim, cum dignissimos ipsum rem odio. Atque, eaque magni aut incidunt quo laudantium repudiandae quae modi officiis in, iusto suscipit fugiat rem inventore non dolorum adipisci rerum dolorem. Nulla, vero!
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
@endsection

{{-- <html lang="en">
    <head itemscope="" itemtype="http://schema.org/WebSite">
    <title itemprop="name">Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="Preview Bootstrap snippets. company invoice. Copy and paste the html, css and js code for save time, build your app faster and responsive">
    <meta name="keywords" content="bootdey, bootstrap, theme, templates, snippets, bootstrap framework, bootstrap snippets, free items, html, css, js">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="{{Storage::url($store->logo)}}">
    <link rel="apple-touch-icon" sizes="135x140" href="{{Storage::url($store->logo)}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{Storage::url($store->logo)}}">
    <link rel="canonical" href="https://www.bootdey.com/snippets/preview/company-invoice?full-screen=true" itemprop="url">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>

    <style type="text/css">
    body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
.bgc-default-tp1 {
    background-color: rgba(121,169,197,.92)!important;
}
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #68a3d5!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}</style>
    </head>
    <body>


<div class="page-content container">
    <div class="page-header text-blue-d2">
        <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info" style="text-transform: uppercase">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #{{$order->order_no}}
            </small>
        </h1>

        <div class="page-tools">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" id="print" data-title="Print">
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <img src="{{Storage::url($store->logo)}}" style="width: 50px" alt="">
                            <span class="text-default-d3">{{$store->name}}</span>
                        </div>
                    </div>
                </div>
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle">{{$order->user[0]->name}}</span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                {{$order->user[0]->address}}
                            </div>
                            <div class="my-1">
                                {{$order->user[0]->state}}, {{$order->user[0]->country}}
                            </div>
                            <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$order->user[0]->phone_no}}</b></div>
                            <div class="my-1"><i class="fa fa-envelope fa-flip-horizontal text-secondary"></i> <b class="text-600">{{$order->user[0]->email}}</b></div>
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">ID:</span> #{{$order->order_no}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{$order->created_at->format('d M, Y')}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-success badge-pill px-25">{{$order->status}}</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                @php
                    $orderItem = \App\Models\OrderItem::where('store_order_id', $order->id)->get();
                @endphp
                <div class="mt-4" style="margin-top: 15% !important">
                    <div class="table-responsive">
                        <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                            <thead class="bg-none bgc-default-tp1">
                                <tr class="text-white">
                                    <th class="opacity-2">Product</th>
                                    <th class="opacity-2">Image</th>
                                    <th class="opacity-2">Product Type</th>
                                    <th>Description</th>
                                    <th>Product Type</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th width="140">Amount</th>
                                </tr>
                            </thead>

                            <tbody class="text-95 text-secondary-d3">
                                @foreach ($orderItem as $item)
                                <tr>
                                    <td>{{$item->product->name}}</td>
                                    <td>
                                        <img style="width: 50px" src="{{Storage::url($item->product->image)}}" alt="" srcset="">
                                    </td>
                                    <td>{{$item->product->description}}</td>
                                    <td> 
                                        @if($item->product->type == 'Digital')
                                        Digital - <a href="{{$item->product->link}}">Download</a>
                                        @else 
                                        Physical
                                        @endif
                                    </td>
                                    <td class="text-95">{{$item->quantity}}</td>
                                    <td class="text-secondary-d2">₦{{$item->amount}}</td>
                                    <td class="text-secondary-d2">₦{{$item->quantity*$item->amount}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">


                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">₦{{number_format($order->amount, 2)}}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <span class="text-secondary-d1 text-105">ojafunnel.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $("#print").click(function () {
        //Hide all other elements other than printarea.
        $('#print').css('display', 'none');
        window.print();
        window.location.href='{{route('user.stores.link', $store->name)}}';

    });
</script>
    </body>
</html> --}}
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>{{$store->name}} | Oja Funnel | StoreFront</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="title" name="{{$store->name}} | Oja Funnel | StoreFront" />
  <meta content="description" name="{{$store->description}} | Oja Funnel | StoreFront" />
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{Storage::url($store->logo)}}" />

  <!-- App Css-->
  <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
  <!-- Bootstrap Css -->
  <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
  <!-- style Css -->
  <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <!-- Font Css-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-white">
  <header class="pt-4">
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="">
    <div class="page-content">
        <div class="">
            {{-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Sales</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="mb-4">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="logo" height="50" />
                                </div>
                            </div>
                            <div>
                                <strong>Order Id -</strong> {{$order->order_no}}
                            </div>
                            <div class="mb-4">
                                <strong>Order Date - </strong>{{$order->created_at->format('d-m-Y')}}
                            </div>
                            <div class="table-responsive mb-3">
                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr class="text-center">
                                            <th scope="col"><b>Store</b></th>
                                            <th scope="col"><b>Shipping To</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                               <img style="width: 40px;" src="{{Storage::url($store->logo)}}" alt=""> {{$store->name}}
                                            </td>
                                            <td class="border-0" style="text-align: right">
                                                <p><strong>Name: </strong>{{$order->user[0]->name}}</p>
                                                <p><strong>Email: </strong>{{$order->user[0]->email}}</p>
                                                <p><strong>Phone No: </strong>{{$order->user[0]->phone_no}}</p>
                                                <p><strong>Address: </strong>{{$order->user[0]->address}}, <br>
                                                    {{$order->user[0]->state}}, {{$order->user[0]->country}}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="table-responsive">
                                <table class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr class="text-center">
                                            <th scope="col"> <b>Payment Method</b></th>
                                            <th scope="col"><b>Shipping Method</b></th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <tr>
                                            <td>
                                            {{$order->payment_method}}
                                            </td>
                                            <td>
                                            Free Shipping - Free Shipping
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 fw-bold">Order summary</h3>
                            </div>
                            @php
                                $orderItem = \App\Models\OrderItem::where('store_order_id', $order->id)->get();
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Product Name</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Product Type</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Tax Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$item->product->name}}</td>
                                            <td><img style="width: 50px" src="{{Storage::url($item->product->image)}}" alt="" srcset=""></td>
                                            <td class="text-wrap" style="width: 330px;">{{$item->product->description}}</td>
                                            <td> 
                                                @if($item->product->type == 'Digital')
                                                Digital - <a href="{{$item->product->link}}">Download</a>
                                                @else 
                                                Physical
                                                @endif
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td>₦{{number_format($item->amount, 2)}}</td>
                                            <td>₦{{number_format($item->quantity*$item->amount, 2)}}</td>
                                        </tr>
                                        @endforeach
                                        {{-- <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Sub Total:</strong>
                                            </td>
                                            <td class="border-0">$13.00</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Tax (18%):</strong>
                                            </td>
                                            <td class="border-0">$13.00</td>
                                        </tr> --}}
                                        <tr>
                                            <td colspan="6" class="border-0 text-end">
                                                <strong>Total:</strong>
                                            </td>
                                            <td class="border-0">
                                               <b>₦{{number_format($order->amount, 2)}}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a id="print" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
    $("#print").click(function () {
        //Hide all other elements other than printarea.
        $('#print').css('display', 'none');
        window.print();
        window.location.href='{{route('user.stores.link', $store->name)}}';

    });
</script>

</body>

</html>

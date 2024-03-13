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
                                               <img style="width: 40px;" src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="{{$store->name}}"> {{$store->name}}
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
                                            <th>Product Type</th>
                                            <th>Qty</th>
                                            <th>Subtotal</th>
                                            <th>Discount</th>
                                            <th>Total Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td class="text-wrap" style="width: 330px;">
                                                <p>{{$item->product->name}}</p>
                                                <p>{{$item->product->description}}</p>
                                            </td>
                                            <td><img style="width: 50px" src="{{Storage::url($item->product->image)}}" alt="" srcset=""></td>
                                            <td>
                                                @if($item->product->type == 'Digital')
                                                Digital - <a href="{{$item->product->link}}">Download</a>
                                                @else
                                                Physical
                                                @endif
                                            </td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->amount}}</td>
                                            <td>
                                                @if ($order['coupon'])
                                                    @php
                                                        $coupon = json_decode($order['coupon']);
                                                    @endphp
                                                    @if ($coupon)
                                                        <p>{{ $coupon->percent }}% </p>
                                                    @endif
                                                @else
                                                    <p>0%</p>
                                                @endif
                                            </td>
                                            <td>{{$store->currency_sign}}{{$item->quantity * preg_replace('/[^0-9.]/', '', $item->amount)}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7" class="border-0 text-end">
                                                <strong>Total:</strong>
                                            </td>
                                            <td class="border-0">
                                               <b>{{json_decode($order->coupon)->amountPaid}}</b>
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

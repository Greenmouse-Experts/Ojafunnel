@extends('layouts.dashboard-frontend')

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
                        <h4 class="mb-sm-0 font-size-18">Sales</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Sales</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="table-responsive">
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
                            </div>
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
                                            <th>Price</th>
                                            <th>Qty</th> 
                                            <th>Subtotal</th>
                                            <th>Tax Amount</th>
                                            <th>Promoted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                @if (App\Models\StoreProduct::where('id', $item->store_product_id)->exists())
                                                    {{$item->product->name}}
                                                @else
                                                    <b>{{ 'DELETED' }}</b> 
                                                @endif
                                            </td>
                                            <td>
                                                @if (App\Models\StoreProduct::where('id', $item->store_product_id)->exists())
                                                    <img style="width: 50px" src="{{Storage::url($item->product->image)}}" alt="" srcset="">
                                                @else
                                                    <b>{{ 'DELETED' }}</b> 
                                                @endif
                                            </td>
                                            <td class="text-wrap" style="width: 330px;">
                                                @if (App\Models\StoreProduct::where('id', $item->store_product_id)->exists())
                                                    {{$item->product->description}}
                                                @else
                                                    <b>{{ 'DELETED' }}</b> 
                                                @endif
                                            </td>
                                            <td>{{$item->quantity}}</td> 
                                            <td>₦{{$item->amount}}</td>
                                            <td>₦{{number_format($item->quantity*$item->amount, 2)}}</td>
                                            <td>
                                                @if ($item->type == 'Promotion')
                                                    {{ 'Yes' }}
                                                @else
                                                    {{ 'No' }}
                                                @endif
                                            </td>
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
                                               <b>₦{{number_format($order->amount, )}}</b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
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
@endsection

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
                        <h4 class="mb-sm-0 font-size-18">Enrollment</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Enrollment Details</li>
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
                                <strong>Order Id -</strong> {{$enroll->order_no}}
                            </div>
                            <div class="mb-4">
                                <strong>Order Date - </strong>{{$enroll->created_at->format('d-m-Y')}}
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
                                               <img style="width: 40px;" src="{{$shop->logo}}" alt=""> {{$shop->name}}
                                            </td>
                                            <td class="border-0" style="text-align: right">
                                                <p><strong>Name: </strong>{{$enroll->name}}</p>
                                                <p><strong>Email: </strong>{{$enroll->email}}</p>
                                                <p><strong>Phone No: </strong>{{$enroll->phone_no}}</p>
                                                <p><strong>Address: </strong>{{$enroll->address}}, <br>
                                                    {{$enroll->state}}, {{$enroll->country}}
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
                                            {{$shopOrder->payment_method}}
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
                                $orderItem = \App\Models\ShopOrder::where('enrollment_id', $enroll->id)->get();
                            @endphp
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Course Title</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                            {{-- <th>Tax Amount</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{\App\Models\Course::find($item->course_id)->title ?? 'Course has been Deleted'}}</td>
                                            <td><img style="width: 50px" src="{{\App\Models\Course::find($item->course_id)->image ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" srcset=""></td>
                                            <td class="text-wrap" style="width: 330px;">{{$shop->currency_sign}}{{$item->amount}}</td>
                                            <td>{{$shop->currency_sign}}{{number_format($item->amount)}}</td>
                                            {{-- <td>{{$shop->currency_sign}}{{number_format($item->amount, 2)}}</td> --}}
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="border-0 text-end">
                                                <strong>Total:</strong>
                                            </td>
                                            <td class="border-0">
                                               <b>{{$shop->currency_sign}}{{number_format($orderItem->sum('amount'), 2)}}</b>
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

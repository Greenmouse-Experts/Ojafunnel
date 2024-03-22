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
                        <h4 class="mb-sm-0 font-size-18">Order Items</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Order Items</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4 class="font-500">Order Items</h4>
                                    <p>
                                        All your orders is in one Place
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Order Items</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->product->name}}
                                                    <p>{{$item->product->description}}</p>
                                                    <p><img src="{{URL::asset('storage/'.$item->product->image)}}" alt="{{$item->product->name}}" width="100"/></p>
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->amount}}</td>
                                                <td>{{$item->type}}</td>
                                                <td>{{$item->created_at->toDayDateTimeString()}}</td>
                                                <td>
                                                    @if($item->type == 'Promotion')
                                                    <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#viewPromoters-{{$item->id}}">
                                                        View Promotion
                                                    </a>
                                                    @else
                                                    <a>
                                                        {{$item->type}}
                                                    </a>
                                                    @endif
                                                    <div class="modal fade" id="viewPromoters-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-bottom-0">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Promotion
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="card">
                                                                                <div class="card-body">
                                                                                    <div class="table-responsive">
                                                                                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                                                                            <thead class="tread">
                                                                                                <tr>
                                                                                                    <th scope="col">S/N</th>
                                                                                                    <th scope="col">Promoter Details</th>
                                                                                                    <th scope="col">Amount</th>
                                                                                                    <th scope="col">Status</th>
                                                                                                    <th scope="col">Date</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                @foreach (App\Models\Promotion::latest()->where('order_item_id', $item->id)->where('promoter_id', '!=', Auth::user()->id)->with(['promoter', 'store'])->get() as $promote)
                                                                                                    <tr>
                                                                                                        <td>{{$loop->iteration}}</td>
                                                                                                        <td>{{$promote->promoter->first_name}} {{$promote->promoter->last_name}}
                                                                                                            <p>{{$promote->promoter->email}}</p>
                                                                                                            <p>{{$promote->promoter->phone_number}}</p>
                                                                                                            <p>{{$promote->promoter->user_name}}</p>
                                                                                                        </td>
                                                                                                        <td>{{$promote->store->currency_sign}}{{$promote->amount}}</td>
                                                                                                        <td>
                                                                                                            <a class="btn btn-success">{{ucfirst($promote->status)}}</a>
                                                                                                        </td>
                                                                                                        <td>{{$item->created_at->format('d M, Y')}}</td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

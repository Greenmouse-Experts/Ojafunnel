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
                        <h4 class="mb-sm-0 font-size-18">Promotion Withdrawal Requests</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Promotion Withdrawal Requests</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Promotion Withdrawal Requests</h4>
                            <p>
                                All your Promotion Withdrawal requests in one Place
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            @if(App\Models\ExplainerContent::where('menu', 'Withdrawal')->exists())
                            <!-- <p class="cash">Explainer Video Here</p> -->
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
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recent Product Withdrawal</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">Store</th>
                                            <th class="align-middle">StoreOwner</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Type</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($promotions as $key => $promote)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{$promote->store->name}}
                                                <p>{{$promote->store->description}}</p>
                                                <p><img src="{{URL::asset('storage/'.$promote->store->logo)}}" alt="{{$promote->store->name}}" width="100"/></p>
                                            </td>
                                            <td>
                                                {{$promote->storeOwner->first_name}} {{$promote->storeOwner->last_name}}
                                                <p>{{$promote->storeOwner->email}}</p>
                                                <p>{{$promote->storeOwner->phone_number}}</p>
                                                <p>{{$promote->storeOwner->user_name}}</p>
                                            </td>
                                            <td>
                                                @if($promote->gateway_payment_id)
                                                    {{ App\Models\BankDetail::find($promote->gateway_payment_id)->type ?? '' }} -
                                                    {{ App\Models\BankDetail::find($promote->gateway_payment_id)->account_name ?? '' }}
                                                    {{ App\Models\BankDetail::find($promote->gateway_payment_id)->account_number ?? '' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{$promote->store->currency_sign}}{{ $promote->amount }}
                                            </td>
                                            <td>
                                                {{$promote->type}}
                                            </td>
                                            <td>
                                                @if ($promote->status == 'pending')
                                                <span class="badge badge-pill badge-soft-primary font-size-11">{{ucfirst($promote->status)}}</span>
                                                @endif

                                                @if ($promote->status == 'withdrawal request')
                                                <span class="badge badge-pill badge-soft-secondary font-size-11">{{ucfirst($promote->status)}}</span>
                                                @endif

                                                @if ($promote->status == 'paid')
                                                <span class="badge badge-pill badge-soft-success font-size-11">{{ucfirst($promote->status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{$promote->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                @if ($promote->status == 'paid')
                                                <a class="btn btn-sm btn-soft-primary">{{ucfirst($promote->status)}}</a>
                                                @else
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-danger" data-bs-toggle="modal" data-bs-target="#request-{{$promote->id}}">Confirm Payment</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="request-{{$promote->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h3>Confirm Payment</h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="post" action="{{route('user.withdrawPromotionRequest', Crypt::encrypt($promote->id))}}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="Editt">
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="name">Status</label>
                                                                                            <select name="status" id="name">
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="paid">Paid</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit" class="btn" style="color: #714091; border: 1px solid #714091">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                                @endif
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Recent Course Withdrawal</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th class="align-middle">S/N</th>
                                            <th class="align-middle">shop</th>
                                            <th class="align-middle">shopOwner</th>
                                            <th class="align-middle">Payment Method</th>
                                            <th class="align-middle">Amount</th>
                                            <th class="align-middle">Type</th>
                                            <th class="align-middle">Payment Status</th>
                                            <th class="align-middle">Date</th>
                                            <th class="align-middle">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($coursePromotions as $key => $cpromote)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>
                                                {{$cpromote->shop->name}}
                                                <p>{{$cpromote->shop->description}}</p>
                                                <p><img src="{{URL::asset($cpromote->shop->logo)}}" alt="{{$cpromote->shop->name}}" width="100"/></p>
                                            </td>
                                            <td>
                                                {{$cpromote->shopOwner->first_name}} {{$cpromote->shopOwner->last_name}}
                                                <p>{{$cpromote->shopOwner->email}}</p>
                                                <p>{{$cpromote->shopOwner->phone_number}}</p>
                                                <p>{{$cpromote->shopOwner->user_name}}</p>
                                            </td>
                                            <td>
                                                @if($cpromote->gateway_payment_id)
                                                    {{ App\Models\BankDetail::find($cpromote->gateway_payment_id)->type ?? '' }} -
                                                    {{ App\Models\BankDetail::find($cpromote->gateway_payment_id)->account_name ?? '' }}
                                                    {{ App\Models\BankDetail::find($cpromote->gateway_payment_id)->account_number ?? '' }}
                                                @endif
                                            </td>
                                            <td>
                                                {{$cpromote->shop->currency_sign}}{{ $cpromote->amount }}
                                            </td>
                                            <td>
                                                {{$cpromote->type}}
                                            </td>
                                            <td>
                                                @if ($cpromote->status == 'pending')
                                                <span class="badge badge-pill badge-soft-primary font-size-11">{{ucfirst($cpromote->status)}}</span>
                                                @endif

                                                @if ($cpromote->status == 'withdrawal request')
                                                <span class="badge badge-pill badge-soft-secondary font-size-11">{{ucfirst($cpromote->status)}}</span>
                                                @endif

                                                @if ($cpromote->status == 'paid')
                                                <span class="badge badge-pill badge-soft-success font-size-11">{{ucfirst($cpromote->status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{$cpromote->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                @if ($cpromote->status == 'paid')
                                                <a class="btn btn-sm btn-soft-primary">{{ucfirst($cpromote->status)}}</a>
                                                @else
                                                <a style="cursor: pointer;" class="btn btn-sm btn-soft-danger" data-bs-toggle="modal" data-bs-target="#request-{{$cpromote->id}}">Confirm Payment</a>
                                                <!-- Modal START -->
                                                <div class="modal fade" id="request-{{$cpromote->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0">
                                                                <h3>Confirm Payment</h3>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form method="post" action="{{route('user.withdrawCoursePromotionRequest', Crypt::encrypt($cpromote->id))}}">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="Editt">
                                                                                <div class="form">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-12 mb-4">
                                                                                            <label for="name">Status</label>
                                                                                            <select name="status" id="name">
                                                                                                <option value="">-- Select --</option>
                                                                                                <option value="paid">Paid</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                    </button>
                                                                    <button type="submit" class="btn" style="color: #714091; border: 1px solid #714091">
                                                                        Submit
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end modal -->
                                                @endif
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
<!-- Modal Ends -->
@if(App\Models\ExplainerContent::where('menu', 'Withdrawal')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Withdrawal')->first()->video}}" type="video/mp4">
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
                                {{App\Models\ExplainerContent::where('menu', 'Withdrawal')->first()->text}}
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
@endsection

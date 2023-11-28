@extends('layouts.admin-frontend')
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
                        <h4 class="mb-sm-0 font-size-18">Active Subscribers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Subscribers</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Active Subscribers List</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Active Subscribers</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Interval</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @Foreach(App\Models\OjaSubscription::latest()->where('status', 'Active')->get() as $sub)

                                        @php
                                            $fullnames = App\Models\User::find($sub->user_id)->first_name." ".App\Models\User::find($sub->user_id)->last_name;

                                            $end_date = date("Y-m-d", strtotime($sub->ends_at));

                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>
                                                {{$fullnames}}
                                                <p class="font-italic"><a href="mailto:{{App\Models\User::find($sub->user_id)->email}}">{{App\Models\User::find($sub->user_id)->email}}</a></p>
                                            </td>
                                            <td><a href="javascript:;" data-bs-toggle="modal" data-bs-target="#renew_sub" class="renew_sub" fullnames="{{ $fullnames }}" starts_at="{{ $sub->started_at }}" ends_at="{{ $end_date }}" subscription_id="{{ $sub->id }}" style="font-weight:500;">Renew / Extend</a></td>

                                            <td>{{date('D/M/Y', strtotime($sub->started_at))}}</td>
                                            <td>{{date('D/M/Y', strtotime($sub->ends_at))}}</td>
                                            <td>{{App\Models\OjaPlan::find($sub->plan_id)->name}} Plan</td>
                                            <td>{{App\Models\OjaPlanInterval::where('plan_id', $sub->plan_id)->where('price', $sub->amount)->where('currency', $sub->currency)->first()->currency_sign}}{{number_format($sub->amount,2)}}</td>
                                            <td>{{App\Models\OjaPlanInterval::where('plan_id', $sub->plan_id)->where('price', $sub->amount)->where('currency', $sub->currency)->first()->type}}</td>
                                            <td>
                                                @if($sub->status == 'Active')
                                                <span class="badge bg-success font-size-10">{{$sub->status}}</span>
                                                @else
                                                <span class="badge bg-danger font-size-10">{{$sub->status}}</span>
                                                @endif
                                            </td>
                                            <td>{{$sub->created_at->toDayDateTimeString()}}</td>
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


<div class="modal fade" id="renew_sub" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Editt">
                        <form method="POST" action="{{route('renewExtend')}}">
                            {{ csrf_field() }}
                            <div class="form">
                                <p class="mt-n4"><b class="sub_name"></b></p>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Select Subscription Type</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <select name="sub_type" class="input sub_type">
                                                    <option value="">-- Select One --</option>
                                                    <option value="renew" selected>Renew</option>
                                                    <option value="extend">Extend</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="start_date" class="input start_date"> 
                                    <input type="hidden" name="end_date" class="input end_date"> 
                                    <input type="hidden" name="subscription_id" class="input subscription_id"> 

                                    <div class="col-lg-12 ext_div" style="display:none">
                                        <label>Extend to</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="end_date" class="input end_date"> 
                                                <div class="expiry_info" style="font-size:12px;margin-top:3px"></div>
                                            </div> 
                                        </div> 
                                    </div>
                                    <div class="col-lg-12 mb-4">
                                        <div class="boding">
                                            <button type="submit">Renew Subscription</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
<!-- ============================================================== -->
<!-- Start right Content Ends -->
<!-- ============================================================== -->

@extends('layouts.admin-frontend')
@section('page-content')
@inject('uc', 'App\Http\Controllers\DashboardController')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Affiliate list</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Affiliate List</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Affiliate Program</h4>
                            <p>View and edit your affiliate program</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Affiliate List</h4>
                            <div class="mb-4">These users below are sorted by the highest referrals</div>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <?php /*
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Referred</th>
                                            <th scope="col">Date Referred</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($referrals) > 0)
                                            @php $kk=1; @endphp
                                            @foreach($referrals as $referral)
                                            <tr>
                                                <td>{{$kk}}</td>
                                                <td>{{ $referral->full_names }}</td>
                                                <td><a href="mailto:{{$referral->email}}">{{$referral->email}}</a></td>
                                                <td>{{ $referral->total_referred }} <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#view_referrals" class="view_referrals" fullnames="{{ $referral->full_names }}" user_id="{{ $referral->user_id }}">(view)</a></p>
                                                </td>
                                                <td>{{$referral->dates}}</td>
                                            </tr>
                                            @php $kk++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                    */ ?>

                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Affiliate Type</th>
                                            <th>Level</th>
                                            <th>Commission (%)</th>
                                            <th>Referred By</th>
                                            <th>Bonus Amount</th>
                                            <th>Joined Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($affiliates as $key => $affiliate)
                                        <tr>
                                            <th scope="row">{{$loop->iteration}}</th>
                                            <td>{{App\Models\User::find($affiliate->referral_id)->first_name}} {{App\Models\User::find($affiliate->referral_id)->last_name}}</td>
                                            <td>
                                                @if($affiliate->level == 1)
                                                Direct Referral
                                                @else
                                                Indirect Referral
                                                @endif
                                            </td>
                                            <td><a href="javascript: void(0);" class="badge badge-soft-primary font-size-11 m-1">{{$affiliate->level}}</a></td>
                                            <td>{{App\Models\AffiliateLevel::where('level', $affiliate->level)->first()->bonus_percent}}%</td>
                                            <td>{{App\Models\User::find(App\Models\User::find($affiliate->referral_id)->referral_link)->first_name}} {{App\Models\User::find(App\Models\User::find($affiliate->referral_id)->referral_link)->last_name}}</td>
                                            <td>{{$affiliate->bonus}}</td>
                                            <td>{{ $affiliate->created_at->toDayDateTimeString() }}</td>
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



<div class="modal fade" id="view_referrals" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Editt">
                        <div class="form">
                            <p class="mt-n5"><b class="sub_name"></b></p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="data-tables"></div>
                                </div>
                            </div>
                        </div>
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


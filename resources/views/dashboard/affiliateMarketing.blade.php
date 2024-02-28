@extends('layouts.dashboard-frontend')

@section('page-content')
@inject('uc', 'App\Http\Controllers\DashboardController')
@php
$array = \App\Models\User::all();
$usr = Auth::user()->id;
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row aminn">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="font-60">Affiliate Program</h4>
                            <p>
                                View and edit your mailing list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="Editt">
                                <div class="form">
                                    <label>Your Affiliate Link</label>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" value=" {{ route('signup', ['ref' => Auth::user()->affiliate_link]) }}" name="name" id="myInput" class="input mov" readonly required>
                                        </div>
                                        <div class="col-md-1">
                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction1()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="card">
                        <div class="card-body">
                            <!-- <p class="cash">Explainer Video Here</p> -->
                            @if(App\Models\ExplainerContent::where('menu', 'Affiliate-Marketing')->exists())
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="affliate">
                                <h2>
                                    {{$affiliates->where('level', 1)->count()}}
                                </h2>
                                <p>
                                    No of Direct Affiliates
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="affliate">
                                <h2>
                                    ₦{{number_format(Auth::user()->ref_bonus, 2)}}
                                </h2>
                                <p>
                                    Referral Bonus
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-purpp"><a href="">
                                    Affiliates</h4>
                            <p class="card-title-desc">
                            </p>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Affiliate Type</th>
                                            <th>Level</th>
                                            <th>Commission (%)</th>
                                            <th>Referred By</th>
                                            <th>Bonus</th>
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
                                            <td>{{number_format($affiliate->bonus, 2)}}</td>
                                            <td>{{ $affiliate->created_at->toDayDateTimeString() }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
</div>
<!-- END layout-wrapper -->
@if(App\Models\ExplainerContent::where('menu', 'Affiliate-Marketing')->exists())
<div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title mb-3">Explainer Video</h4>
                        <div class="aller">
                            <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                <source src="{{App\Models\ExplainerContent::where('menu', 'Affiliate-Marketing')->first()->video}}" type="video/mp4">
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
                                {{App\Models\ExplainerContent::where('menu', 'Affiliate-Marketing')->first()->text}}
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

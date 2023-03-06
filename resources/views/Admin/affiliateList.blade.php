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
                            <p>View and edit your mailing list</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Affiliate List</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Names</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Referred By</th>
                                            <th scope="col">Date Referred</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\User::latest()->where('referral_link', '!=', null)->get() as $affiliate)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$affiliate->first_name}} {{$affiliate->last_name}}</td>
                                            <td>{{$affiliate->email}}</td>
                                            <td>{{App\Models\User::find($affiliate->referral_link)->first_name}} {{App\Models\User::find($affiliate->referral_link)->last_name}}
                                                <p>{{App\Models\User::find($affiliate->referral_link)->email}}</p>
                                            </td>
                                            <td>{{$affiliate->created_at->toDayDateTimeString()}}</td>
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
<!-- ============================================================== -->
<!-- Start right Content Ends -->
<!-- ============================================================== -->

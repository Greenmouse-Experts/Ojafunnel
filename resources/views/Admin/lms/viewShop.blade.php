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
                        <h4 class="mb-sm-0">L.M.S Shops</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">L.M.S Shops</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- banner -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">L.M.S Shop</h4>
                            <p>
                                Browse through and view shops created by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Shop List</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 530px;">
                                <table class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's Name</th>
                                            <th>Shop Name</th>
                                            <th>Courses</th>
                                            <th>Students</th>
                                            <th>Shop Link</th>
                                            <th>Date Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Models\Shop::latest()->get() as $item)
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">{{$loop->iteration}}</a> </td>
                                            <td>
                                                {{App\Models\User::find($item->user_id)->first_name}} {{App\Models\User::find($item->user_id)->last_name}}
                                            </td>
                                            <td>
                                                {{$item->name}}
                                            </td>
                                            <td>{{\App\Models\Course::where('user_id', $item->user_id)->get()->count()}}</td>
                                            <td>
                                                {{\App\Models\Enrollment::where('shop_id', $item->id)->get()->count()}}
                                            </td>
                                            <td>
                                                <a href="{{$item->link}}" target="_blank" class="text-decoration-underline">Preview</a>
                                            </td>
                                            <td>
                                                {{$item->created_at->toDayDateTimeString()}}
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

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
                        <h4 class="mb-sm-0 font-size-18">Priviledges/Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">List Management</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Lists</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons_" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th>Feature</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($site_features) > 0)
                                            @foreach($site_features as $feature)
                                            <tr>
                                                <td>{{ $feature->features }}</td>
                                                <td style="color:{{ $feature->status == 'enable' ? '' : 'red' }};font-weight:{{ $feature->status == 'enable' ? '' : '600' }}">{{ ucfirst($feature->status) }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-{{ $feature->status == 'enable' ? 'success' : 'danger' }} reactFeatures" ids="{{ md5($feature->id) }}" status="{{ $feature->status == 'disabled' ? 'enable' : 'disable' }}" type="button">{{ $feature->status == "enable" ? "Disable" : "Enable" }}</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
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
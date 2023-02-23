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
                        <h4 class="mb-sm-0 font-size-18">Manage Plans</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Manage Plans</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">Manage Plans</h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-md-12">
                <div class="card-body card">
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table align-middle table-nowrap">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Name</th>
                                            <th>Montly Amount</th>
                                            <th>Bi Annual Amount</th>
                                            <th>Yearly Amount</th>
                                            <th>Currency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#1</a> </td>
                                            <td>
                                                Hamzat
                                            </td>
                                            
                                            <td>
                                                $100
                                            </td>
                                            <td>
                                                $500
                                            </td>
                                            <td>
                                                $1000
                                            </td>
                                            <td>
                                                Dollar
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#2</a> </td>
                                            <td>
                                                Adeleke
                                            </td>
                                            
                                            <td>
                                                $100
                                            </td>
                                            <td>
                                                $500
                                            </td>
                                            <td>
                                                $1000
                                            </td>
                                            <td>
                                                Nairs
                                            </td>
                                        </tr>
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
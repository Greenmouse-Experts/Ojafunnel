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
                        <h4 class="mb-sm-0 ">User Integration</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Integrations</li>
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
                            <h4 class="font-500">Integration</h4>
                            <p>
                               View list of integrations carried out by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Integration Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" >
                                <table class="table  table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th scope="col">User ID</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">SID</th>
                                            <th scope="col">Token</th>
                                            <th scope="col">From</th>
                                            <th scope="col">Api Key</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <th scope="row">#01</th>
                                                <td>
                                                    DB-42137197249402
                                                </td>
                                                <td>
                                                    greenmouse@gmail.com
                                                </td>
                                                <td>
                                                    Greenmouse
                                                </td>
                                                <td>
                                                    PORT-03933
                                                </td>
                                                <td>
                                                    PK-TEST29393390308138
                                                </td>
                                                <td>
                                                    GR-TOKEN
                                                </td>
                                                <td>
                                                    HRT-TEST29393390308138
                                                </td>
                                                <td>
                                                    Automated
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-soft-success font-size-11">active</span>
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

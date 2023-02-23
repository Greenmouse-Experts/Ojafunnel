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
                        <h4 class="mb-sm-0 font-size-18">SMS Automation</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">SMS Automation</li>
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
                            <h4 class="font-500">SMS Automation</h4>
                            <p>
                                View all automated sms services on ojafunnel.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Automation Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                <table class="table align-middle table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's Name</th>
                                            <th>Campaign Name</th>
                                            <th>Contact</th>
                                            <th>Sent</th>
                                            <th>Failed</th>
                                            <th>Campaign Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td><a href="javascript: void(0);" class="text-body fw-bold">#11</a> </td>
                                            <td>
                                                Greenmouse Tech
                                            </td>
                                            <td>
                                                Weekly Deals
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                               0
                                            </td>
                                            <td>
                                            <span class="badge badge-pill badge-soft-primary font-size-11">scheduled</span>
                                            <p>Mon, Jan 30, 2023, 11:23AM</p>
                                            </td>
                                            <td>
                                            <span class="badge badge-pill badge-soft-success font-size-11">Delivered</span>
                                            <p>Delivered At: Mon, Jan 30, 2023, 11:23AM</p>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled hstack gap-1 mb-0">
                                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="View Message">
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewSms"  class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
                                                    </li>
                                                </ul>
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
    <div class="modal fade" id="viewSms" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Weekly Deals
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <div>
                                <p>
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil perferendis voluptatem, reiciendis velit cumque, earum numquam ullam voluptate eligendi officia voluptatum exercitationem error? Necessitatibus eveniet commodi similique beatae illum sint.
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga, ullam illo ipsam, quo iste veritatis iusto et provident ab sed dolore, officiis eos ipsa consequuntur laborum nam reiciendis molestias ducimus?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                        <h4 class="mb-sm-0">Birthday Modules</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Birthday Module</li>
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
                            <h4 class="font-500">Birthday Module</h4>
                            <p>
                                Browse through birthday automated modules created by ojafunnel users.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <!-- table content of courses -->
            <div class="col-md-12">
                <div class="card-body card">
                    <h4 class="card-title mb-4">Module Listing</h4>
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive" >
                                <table class="table  table-nowrap" id="datatable-buttons">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Owner's</th>
                                            <th scope="col">List Name</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Automation</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <th scope="row">#01</th>
                                                <th scope="row">
                                                    Greenmouse
                                                </th>
                                                <td>
                                                    Funnel Pro
                                                </td>
                                                <td>
                                                    Birthday Wishes
                                                </td>
                                                <td>
                                                    <p>Whatsapp Automation</p>
                                                    <p>SMS Automation</p>
                                                </td>
                                                <td>
                                                    <span class="badge badge-pill badge-soft-success font-size-11">active</span>
                                                </td>
                                                <td>
                                                    <p>30-Dec-2022</p>
                                                </td>
                                                <td>
                                                    <p>27-Dec-2023</p> 
                                                </td>
                                                <td>
                                                    <ul class="list-unstyled hstack gap-1 mb-0">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top" title="View Message">
                                                            <a href="" data-bs-toggle="modal" data-bs-target="#viewMessage" class="btn btn-sm btn-soft-primary"><i class="mdi mdi-eye-outline"></i></a>
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
    <div class="modal fade" id="viewMessage" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Happy Birthday (Username)
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
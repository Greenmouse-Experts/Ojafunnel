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
                        <h4 class="mb-sm-0 font-size-18">{{$plan->name}} Parameters</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Plan Parameters</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">{{$plan->name}} - Manage Parameters</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500" style="display: flex; justify-content: flex-end;">
                                <a class="btn btn-success dropdown-toggle" href="{{route('admin.addPlan.parameter', Crypt::encrypt($parameters->id))}}" onclick="event.preventDefault();
                                document.getElementById('submit-button').submit();">
                                    Update
                                </a>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="col-md-12">
                <div class="card-body card">
                    <div class="tab-content">
                        <div class="tab-pane active" id="transactions-all-tab" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap table-hover mb-0 table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Parameter</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form id="submit-button" nmethod="POST" action="{{route('admin.addPlan.parameter', Crypt::encrypt($parameters->id))}}">
                                            <tr>
                                                <td class="text-dark fw-medium">Page Builder</td>
                                                <td><input class="form-control" name="page_builder" value="{{$parameters->page_builder}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Funnel Builder</td>
                                                <td><input class="form-control" name="funnel_builder" value="{{$parameters->funnel_builder}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Whatsapp Number</td>
                                                <td><input class="form-control" name="whatsapp_number" value="{{$parameters->wa_number}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">SMS Contact List</td>
                                                <td><input class="form-control" name="sms_contact_list" value="{{$parameters->sms_contact_list}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">SMS & WhatsApp Automation</td>
                                                <td><input class="form-control" name="sms_automation" value="{{$parameters->sms_automation}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Whatsapp Automation</td>
                                                <td><input class="form-control" name="whatsapp_automation" value="{{$parameters->whatsapp_automation}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Product</td>
                                                <td><input class="form-control" name="product" value="{{$parameters->products}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Store</td>
                                                <td><input class="form-control" name="store" value="{{$parameters->store}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Course</td>
                                                <td><input class="form-control" name="course" value="{{$parameters->courses}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                            <td class="text-dark fw-medium">Shop</td>
                                                <td><input class="form-control" name="shop" value="{{$parameters->shop}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Birthday Contact List</td>
                                                <td><input class="form-control" name="birthday_contact_list" value="{{$parameters->birthday_contact_list}}" type="number" /></td>
                                            </tr>
                                            <tr>
                                                <td class="text-dark fw-medium">Birthday Automation</td>
                                                <td><input class="form-control" name="birthday_automation" value="{{$parameters->birthday_automation}}" type="number" /></td>
                                            </tr>
                                        </form>
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

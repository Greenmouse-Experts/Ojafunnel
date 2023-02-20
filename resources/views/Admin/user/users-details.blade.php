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
                        <h4 class="mb-sm-0 font-size-18">All Details</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminwelcome')}}">Home</a></li>
                                <li class="breadcrumb-item active">All Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-600">User Details</h4>
                            <p>
                                Connect the tools that power your business
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row mt-1"></div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">User Personal Information</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">First Name :</th>
                                    <td>Hamzat</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Name :</th>
                                    <td>Abdulazeez Adeleke</td>
                                </tr>
                                <tr>
                                    <th scope="row">Username:</th>
                                    <td>Hamzat</td>
                                </tr>
                                <tr>
                                    <th scope="row">E-mail :</th>
                                    <td>greenmousetest@gmail.com</td>
                                </tr>
                                <tr>
                                    <th scope="row">Mobile :</th>
                                    <td>(123) 123 1234</td>
                                </tr>
                                <tr>
                                    <th scope="row">Referral Cone :</th>
                                    <td>None</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

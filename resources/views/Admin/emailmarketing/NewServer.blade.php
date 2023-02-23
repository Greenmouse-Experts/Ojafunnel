@extends('layouts.admin-frontend')

@section('page-content')
@php
$admin = auth()->guard('admin')->user();
@endphp
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Sending Type</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('adminDashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Sending server</li>
                                <li class="breadcrumb-item active">Sending Type</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-400">Select Sending Type</h4>
                            <p>
                                This feature allows you to add a sending type which will actually send out your campaign emails.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Select Type</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap align-middle mb-0">
                                    <tbody>
                                        <tr>
                                            <td style="width: 40px;">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck01">
                                                    <label class="form-check-label" value="rap"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677155193/OjaFunnel-Images/aws_vgp791.png" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>Amazon SMTP</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">Amazon's Simple Email service through SMTP protocol</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="{{route('choose.server')}}">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Choose</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40px;">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck02">
                                                    <label class="form-check-label" value="Zap"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677155290/OjaFunnel-Images/sendmail_1_xjasuw.png" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>Sendmail</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">Send emails through the sendmail program on the hosting system</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="{{route('choose.server')}}">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Choose</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40px;">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck02">
                                                    <label class="form-check-label" value="Zap"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677155190/OjaFunnel-Images/smtp_f3tszv.png" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>SMTP</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">Send emails through a SMTP service</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="{{route('choose.server')}}">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Choose</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40px;">
                                                <div class="form-check font-size-16">
                                                    <input class="form-check-input" type="checkbox" id="upcomingtaskCheck02">
                                                    <label class="form-check-label" value="Zap"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <a href="javascript: void(0);" class="inline-block">
                                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677155189/OjaFunnel-Images/elasticemail_b15glp.png" alt="" class="rounded-circle avatar-xs">
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="text-truncate font-size-14 mb-2"><a href="javascript: void(0);" class="text-dark"><b>Elastic Email SMTP</b></a></h5>
                                                <p style="margin-bottom: 0; margin-top:0;">Elastic Email's service through SMTP protocol</p>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <div class="all-create" style="margin-bottom: 0 !important;">
                                                        <a href="{{route('choose.server')}}">
                                                            <button style="background:#000; color:#fff; border-radius:5px;">Choose</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
        </div>
    </div>
</div>
@endsection

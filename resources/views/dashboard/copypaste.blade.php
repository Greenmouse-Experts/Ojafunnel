@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Copy and Paste Contacts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Contacts</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- start page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Add Contact ; <span style="color:#2E59F3;"> {{$mailinglist->mailinglist_name}}</span> </h4>
                            <p>
                            Add first name, last name, emails & phone numbers to your created mailing lis
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="sms">
                        <ul>
                            <li class="text-purpp">
                                <a href="{{route('user.up.load', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])}}">
                                    Upload Files
                                </a>
                            </li>
                            <li class="text-purp">
                                <a href="#">
                                    Copy & Paste
                                </a>
                            </li>
                            <li class="text-purpp">
                                <a href="{{route('user.add.contact', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])}}">
                                    Add Individualy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row cut">
                <div class="col-12">
                    <div class="Edit">
                    <form method="POST" action="{{ route('user.subscriber.mailing.contact.copy.paste', Crypt::encrypt($mailinglist->id))}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Contact List</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="contact" required cols="30" placeholder="First Name, Last Name, Email, Phone Number" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="name">
                                        <ul>
                                            <li>
                                                Email Verification :
                                            </li>
                                            <li>
                                                <input type="checkbox" checked readonly>
                                            </li>
                                            <li>
                                                Verify uploaded addresses
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="boding">
                                                <button type="submit" class="btn px-3" style="color: #714091; background:#fff; border: 1px solid #714091;">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="boding">
                                                <button type="submit" class="form-btn">
                                                    Proceed
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
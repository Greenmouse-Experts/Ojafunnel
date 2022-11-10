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
                <div class="col-lg-12">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Add Contact ; <span style="color: #2E59F3;"> {{$mailinglist->mailinglist_name}}</span></h4>
                            <p>
                            Add first name, last name, emails & phone numbers to your created mailing list
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="sms">
                        <ul>
                            <li class="text-purp">
                                <a href="#">
                                    Upload Files
                                </a>
                            </li>
                            <li class="text-purpp">
                                <a href="{{route('user.copy.paste', [Auth::user()->username, Crypt::encrypt($mailinglist->id)])}}">
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
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <form method="POST" action="{{ route('user.subscriber.mailing.contact.upload', Crypt::encrypt($mailinglist->id)) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="Edittt">
                            <div class="mt-5">
                                <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                    <p>
                                        <b>
                                            Upload a file containing your contact
                                        </b>
                                    </p>
                                    <div class="logo-input2 border-in py-5 px-3">
                                        <div class="avatar">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                        </div>
                                        <div class="logo-file">
                                            <input type="file" name="contact_upload" class="mt-4 w-100" />
                                            <span class="mt-3 text-danger">This tool allows you to import (merge) contact data from a csv, xsls, xsl file format</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4 py-3">
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
                            <!-- buttons -->
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn px-4" style="width:100%; color: #ffffff; background-color: #714091">
                                    Proceed
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- End Page-content -->
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
@endsection
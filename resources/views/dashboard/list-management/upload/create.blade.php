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
                        <h4 class="mb-sm-0 font-size-18">List Management Contact</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create new contact list</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="py-2">
                                    <h4>List Management Contact</h4>
                                    <p>
                                        Import (merge) contact data from a csv, xsls, xsl file format
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-body" style="padding: 4rem;">
                        <form method="post" action="{{ route('user.upload.contact', Crypt::encrypt($list->id)) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
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
                                                <span class="mt-3 text-danger text-center">This tool allows you to import (merge) contact data from a csv, xsls, xsl file format.</span>
                                            </div>
                                        </div>
                                        <p class="mt-5 text-center">
                                            <b><a href="{{route('user.subscriber.download.format')}}">Click here to view our format</a></b>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <a href="{{route('user.view.list', Crypt::encrypt($list->id))}}">
                                    <button type="button" class="btn px-4 py-1 btn-danger">
                                        Cancel
                                    </button>
                                </a>
                                <button type="submit" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
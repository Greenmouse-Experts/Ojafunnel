@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">List Setting</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">List Setting</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">List Setting </h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="card all-create account-head">
                        <nav aria-label="Page navigation example normal float-right">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{route('user.list.performance', Auth::user()->username)}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs nav-tabs-custom">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.list.performance', Auth::user()->username)}}"><i class="bi bi-graph-up"></i> Overview</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{route('user.list.setting', Auth::user()->username)}}"><i class="bi bi-gear"></i> Setting</a>
                                </li>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <a class="nav-link" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-person-check"></i> Subscribers <i class="bi bi-caret-up"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{route('user.list.subscribers', Auth::user()->username)}}">View all</a></li>
                                            <li><a class="dropdown-item" href="{{route('user.new.subscribers', Auth::user()->username)}}">Add</a></li>
                                            <li><a class="dropdown-item" href="{{route('user.import.subscribers', Auth::user()->username)}}">Import</a></li>
                                          <li><a class="dropdown-item" href="{{route('user.export.subscribers', Auth::user()->username)}}">Export</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.new.segments', Auth::user()->username)}}"><i class="bi bi-layout-three-columns"></i> Segment</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-card-checklist"></i> Manage list fields</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-columns"></i> Form / Pages</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="bi bi-envelope-check"></i> Email Verifications</a>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <p class="tell mb-4">
                                    <b class="mb-sm-0 font-size-15">Edit Your Mail List</b>
                                </p>
                                <p>
                                    <b> Identity  </b>
                                </p>
                                <div class="col-lg-6">
                                    <label>Name <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Names" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>From Email <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="From Email" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Default From name <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Default from name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Default Email subject <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Default Email subject" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                 <b> Contact Information  </b>
                                </p>
                                <div class="col-lg-6">
                                    <label>Company / organization <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Company name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>State / Province / Region <span>*</span> </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter State" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Address 1</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Address 1" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>City</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Enter city" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Address 2</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Address 2" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Zip / Postal code</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter zip / postal code" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Country</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter country" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="Enter Phone Number" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Email</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="email" placeholder="Enter email" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Home page</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="=text" placeholder="Enter homepage" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <p class="tell mb-4">
                                    <b class="mb-sm-0 font-size-15">Settings</b>
                                </p>
                                <p>
                                    <b>Subscriptions</b>
                                </p>
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <p class="send">
                                            Send subscription confirmation email (Double Opt-in)
                                             <input type="checkbox">
                                             <div class="when">When people subscribe to your list, send them a subscription confirmation email.</div>
                                        </p>
                                        <p class="send">
                                            Send unsubscribe notification to subscribers
                                             <input type="checkbox">
                                             <div class="when">Send subscribers a final “Goodbye” email to let them know they have unsubscribed.</div>
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="send">
                                            Send a final welcome email
                                             <input type="checkbox">
                                             <div class="when">When people opt-in to your list, send them an email welcoming them to your list. The final welcome email can be edited in the List -> Forms / Pages management</div>
                                        </p>
                                    </div>
                                </div>
                                <p class="tell mb-4">
                                    <b class="mb-sm-0 font-size-15">Sending servers</b>
                                </p>
                                <div class="col-md-12 mb-4">
                                    <p class="sending">
                                        Use all sending servers
                                         <input type="checkbox">
                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

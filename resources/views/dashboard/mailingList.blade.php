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
                <div class="col-lg-8">
                    <div class="card account-head">
                        <div class="py-2">
                            <h4 class="font-500">Mailing List </h4>
                            <p>
                                Create, view, edit and do many more with your contact list
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card account-head">
                        <div class="all-create py-2">
                            <button>
                                <a href="{{route('user.add.contact')}}">
                                + Add Contact 
                                </a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Mailing List(s)</h4>
                            <p class="card-title-desc">

                            </p>

                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="tread">
                                        <tr>
                                            <th>S/N</th>
                                            <th>Mailing List Name </th>
                                            <th>Date Created</th>
                                            <th>No of Contacts </th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.add.contact')}}">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.add.contact')}}">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.add.contact')}}">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.add.contact')}}">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Hamzat</td>
                                            <td>Students List</td>
                                            <td>30 - 09 - 2022</td>
                                            <td>70</td>
                                            <td>greenmousetest@gmail.com</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Options
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <li><a class="dropdown-item" href="{{route('user.add.contact')}}">Add Contact</a></li>
                                                        <li><a class="dropdown-item" href="#">Enable</a></li>
                                                        <li><a class="dropdown-item" href="#">Disable</a></li>
                                                        <li><a class="dropdown-item" href="#">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->
@endsection
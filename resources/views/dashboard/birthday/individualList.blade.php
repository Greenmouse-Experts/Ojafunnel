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
                        <h4 class="mb-sm-0 font-size-18">Greenmouse Contacts</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.main.list', Auth::user()->username)}}">Birthday</a></li>
                                <li class="breadcrumb-item"><a href="{{route('user.manage.list', Auth::user()->username)}}">Birthday Listing</a></li>
                                <li class="breadcrumb-item active">Individual List</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header -->
            <div class=''>
                <div class='row align-items-center birthday-contact'>
                    <div class='col-lg-9 main-text'>
                        <p class='topic'>Greenmouse Contact Listing</p>
                        <p class='mt-2 p-0'> create and manage individual contact list to send messages to customers</p>
                    </div>
                    <div class='col-lg-3 text-end'>
                        <div class="">
                            <div class="all-create">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#createContactList">
                                <i class="bi bi-card-checklist pe-1"></i>Add individual
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">View Contact Listing</h4>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                                    <thead class="tread">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date of birth</th>
                                            <th scope="col">Phone number</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>blue mouse</td>
                                            <td>10-02-1996</td>
                                            <td>+23480123456789</td>
                                            <td>greenmouseapp@gmail.com</td>
                                            <td>
                                                <div class="row fs-5">
                                                    <div class='col'><i class="bi bi-pencil-square cursor-pointer" data-bs-toggle="modal" data-bs-target="#editContactList"></i></div>
                                                    <div class='col'><i class="bi bi-trash3-fill text-danger cursor-pointer" data-bs-toggle="modal" data-bs-target="#deleteContactList"></i></div>
                                                </div>
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
    <!-- End Page-content -->
    <!-- add contacts modal -->
    <div class="modal fade" id="createContactList" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Add New Contact
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <form  method="post">
                                <div class="form">
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Full Name..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Phone Number..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Email..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Date of Birth</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="date" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Anniversary (optional)</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="date" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <a href="#" class="text-decoration-none">
                                                <button type='button' class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                                    Cancel
                                                </button></a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-none">
                                                <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                    >
                                                    Save
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit contacts modal -->
    <div class="modal fade" id="editContactList" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Edit this Contact
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <form  method="post">
                                <div class="form">
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Full Name..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Phone Number..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Email..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 row">
                                       <div class='col-lg-6'>
                                            <label>Date of Birth</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="date" name="date" class="input"
                                                        required>
                                                </div>
                                            </div>
                                       </div>
                                       <div class='col-lg-6'>
                                            <label>Anniversary (optional)</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <input type="date" name="date" class="input"
                                                        required>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <a href="#" class="text-decoration-none">
                                                <button type='button' class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                                    Cancel
                                                </button></a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-none">
                                                <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                    >
                                                    Save
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- delete contacts modal -->
    <div class="modal fade" id="deleteContactList" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 bg-light">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Are you sure you want to delete this contact ?
                    </h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class='row justify-content-between p-3'>
                    <div class='col'>
                        <button type="button" class="mybtnprimary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                    </div>
                    <div class='col text-end'>
                        <button type="button" class="mybtncancel" data-bs-dismiss="modal" aria-label="Close">Delete</button>
                    </div>
                </div>
                <!-- <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <form  method="post">
                                <div class="form">
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Full Name..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Phone Number..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Email..." name="name" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Date of Birth</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="date" class="input"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <a href="#" class="text-decoration-none">
                                                <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                    Cancel
                                                </button></a>
                                        </div>
                                        <div class="col-6 text-end">
                                            <a href="#" class="text-decoration-none">
                                                <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                    >
                                                    Save
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<!-- END layout-wrapper -->
@endsection
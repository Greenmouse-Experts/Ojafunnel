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
                        <h4 class="mb-sm-0 font-size-18">{{$bd->name}} Contacts</h4>

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
                        <p class='topic'>{{$bd->name}} Listing</p>
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
                                        @foreach ($bdc as $i)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$i->name}}</td>
                                                <td>{{$i->date_of_birth}}</td>
                                                <td>{{$i->phone_number}}</td>
                                                <td>{{$i->email}}</td>
                                                <td>
                                                    <div class="row fs-5">
                                                        <div class='col'><i class="bi bi-pencil-square cursor-pointer" data-bs-toggle="modal" data-bs-target="#editContactList-{{$i->id}}"></i></div>
                                                        <div class='col'><i class="bi bi-trash3-fill text-danger cursor-pointer" data-bs-toggle="modal" data-bs-target="#deleteContactList-{{$i->id}}"></i></div>
                                                    </div>
                                                </td>
                                                <div class="modal fade" id="editContactList-{{$i->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
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
                                                                        <form action="{{route('user.main.birthday.update.list', ['username' => Auth::user()->username, 'birthday_id' => $bd->id, 'id' => $i->id])}}" method="post">
                                                                            @csrf
                                                                            <div class="form">
                                                                                <div class="col-lg-12">
                                                                                    <label>Name</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Full Name..." value="{{$i->name}}" name="name" class="input"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Phone Number</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Enter Phone Number..." value="{{$i->phone_number}}" name="phone" class="input me" id="phone_number"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <label>Email</label>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 mb-4">
                                                                                            <input type="text" placeholder="Email..." name="email" value="{{$i->email}}" class="input"
                                                                                                required>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-lg-12 row">
                                                                                   <div class='col-lg-6'>
                                                                                        <label>Date of Birth</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="date" name="dob" value="{{$i->date_of_birth}}" class="input"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                   </div>
                                                                                   <div class='col-lg-6'>
                                                                                        <label>Anniversary (optional)</label>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12 mb-4">
                                                                                                <input type="date" name="aniDate" value="{{$i->anniv_date}}" class="input"
                                                                                                    required>
                                                                                            </div>
                                                                                        </div>
                                                                                   </div>
                                                                                </div>
                                                                                <div class="row justify-content-between">
                                                                                    <div class="col-6">
                                                                                        <a href="#" class="text-decoration-none">
                                                                                            <button type='reset' class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
                                                                                                Cancel
                                                                                            </button></a>
                                                                                    </div>
                                                                                    <div class="col-6 text-end">
                                                                                        <a href="#" class="text-decoration-none">
                                                                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                                                                >
                                                                                                Update
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
                                                <div class="modal fade" id="deleteContactList-{{$i->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header border-bottom-0 bg-light">
                                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                                    Are you sure you want to delete this contact ?
                                                                </h5>
                                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                                            </div>
                                                            <form action="{{route('user.main.birthday.delete.list', ['username' => Auth::user()->username, 'birthday_id' => $bd->id, 'id' => $i->id])}}" method="post">
                                                                @csrf
                                                                <div class='row justify-content-between p-3'>
                                                                    <div class='col'>
                                                                        <button type="button" class="mybtnprimary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                                                                    </div>
                                                                    <div class='col text-end'>
                                                                        <button type="submit" class="mybtncancel" data-bs-dismiss="modal" aria-label="Close">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </tr>
                                        @endforeach

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
                            <form action="{{route('user.main.birthday.create.list', ['username' => Auth::user()->username, 'birthday_id' => $bd->id])}}" method="post">
                                @csrf
                                <div class="form">
                                    <div class="col-lg-12">
                                        <label>Name</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Full Name..." name="name" class="input" value="{{ old('name') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Phone Number</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Enter Phone Number..." name="phone" class="input me" id="phone_number" value="{{ old('phone') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Email</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="text" placeholder="Email..." name="email" class="input" value="{{ old('email') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Date of Birth</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="dob" class="input" value="{{ old('date') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Anniversary (optional)</label>
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <input type="date" name="aniDate" value="{{ old('aniDate') }}" class="input">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            <a href="#" class="text-decoration-none">
                                                <button type='reset' class="btn px-3" data-bs-dismiss="modal" aria-label="Close" style="color: #714091; border: 1px solid #714091">
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


</div>
<!-- END layout-wrapper -->

<style>
    .iti {
        display: block !important;
    }
    .iti__country-list {
        z-index: 2000 !important;
    }

    .me {
        padding-left: 100px !important;
    }
</style>
<script>
    $(document).ready(function () {
        $("#phone_number").intlTelInput({
            // preferredCountries: ["us", "ca"],
            separateDialCode: true,
            initialCountry: ""
        }).on('countrychange', function (e, countryData) {
            $("#phone_number").val('+'+($("#phone_number").intlTelInput("getSelectedCountryData").dialCode));
        });
    });
</script>
@endsection

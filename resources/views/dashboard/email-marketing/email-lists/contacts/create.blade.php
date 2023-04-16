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
                        <h4 class="mb-sm-0 font-size-18">Email Contact List</h4>

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
                                    <h4>Create new contact list</h4>
                                    <p>
                                        Create new contact list
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
                        <form method="post" action="{{ route('user.email.create.contact') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">First Name</label>
                                    <input type="text" name="first_name" class="form-control"  value="{{old('first_name')}}" placeholder="Enter first name" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Last Name</label>
                                    <input type="text" name="last_name" class="form-control"  value="{{old('last_name')}}" placeholder="Enter last name" required />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Email Address</label>
                                <input type="email" name="email" class="form-control"  value="{{old('email')}}" placeholder="Enter email" required />
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 1</label>
                                    <textarea type="text" name="address_1" class="form-control" value="{{old('address_1')}}" placeholder="Enter address one" required></textarea>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 2</label>
                                    <textarea type="text" name="address_2" class="form-control" value="{{old('address_2')}}" placeholder="Enter address two"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Country</label>
                                <select class="form-control" name="country">
                                    <optgroup>-- Select Country --</optgroup>
                                    @foreach(App\Models\Country::get() as $country)
                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control"  value="{{old('state')}}" placeholder="Enter State" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Zip</label>
                                    <input type="text" name="zip" class="form-control"  value="{{old('zip')}}" placeholder="Enter Zip" required />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Phone Number</label>
                                <input type="text" name="state" class="form-control"  value="{{old('state')}}" placeholder="Enter State" required />
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Subscribe</label>
                                <p class="text-xs text-gray-500">
                                    Will not be sent any emails at all
                                </p>
                                <input type="checkbox" name="subscribe" value="1" required /> Yes &nbsp;
                                <input type="checkbox" name="subscribe" value="0" required /> No
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

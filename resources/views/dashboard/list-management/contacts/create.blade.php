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
                                        Create new contact for {{$list->name}} list
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
                        <form method="post" action="{{ route('user.create.contact', Crypt::encrypt($list->id)) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control"  value="{{old('name')}}" placeholder="Enter name" required />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" class="form-control"  value="{{old('email')}}" placeholder="Enter email" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Address 1</label>
                                    <textarea type="text" name="address_1" class="form-control" value="{{old('address_1')}}" placeholder="Enter address one"></textarea>
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
                                    <input type="text" name="state" class="form-control"  value="{{old('state')}}" placeholder="Enter State" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Zip</label>
                                    <input type="text" name="zip" class="form-control"  value="{{old('zip')}}" placeholder="Enter Zip" />
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" class="form-control"  value="{{old('phone')}}" placeholder="Enter Phone Number" />
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control"  value="{{old('date_of_birth')}}" placeholder="Enter Date of Birth" />
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="">Anniversary Date</label>
                                    <input type="date" name="anniv_date" class="form-control"  value="{{old('anniv_date')}}" placeholder="Enter Anniversary Date" />
                                </div>
                            </div>
                            <!-- <div class="col-lg-12 mb-4">
                                <label for="">Subscribe</label>
                                <p class="text-xs text-gray-500">
                                    Will be sent emails
                                </p>
                                <input type="radio" id="subscribe" name="subscribe" value="1"/> Yes &nbsp;
                                <input type="radio" id="subscribe" name="subscribe" value="0"/> No
                            </div> -->
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
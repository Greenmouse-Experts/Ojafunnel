@extends('layouts.dashboard-frontend')

@section('page-content')
<div class="main-content">
  <div class="page-content">
    <!-- container-fluid -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
            <h4 class="mb-sm-0 font-size-18">My shop</h4>

            <div class="page-title-right">
              <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                <li class="breadcrumb-item active">My shop</li>
              </ol>
            </div>

          </div>
        </div>
      </div>
      <!-- start page title -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card account-head">
            <div class="row">
              <div class="col-lg-8">
                <div class="py-2">
                  <h4 class="font-500">My Shop</h4>
                  <p>
                    All your shops and courses in them
                  </p>
                </div>
              </div>
              <div class="col-lg-3">
                <div class="card">
                <div class="card-body">
                  <div class="all-create">
                    <a href="{{route('user.create.shop.course', Auth::user()->username)}}">
                      <button>
                      + Create New Shop
                      </button>
                    </a>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-lg-1">
                <div class="card">
                    <div class="card-body">
                        <!-- <p class="cash">Explainer Video Here</p> -->
                        @if(App\Models\ExplainerContent::where('menu', 'Learning-Management')->exists())
                        <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                            <i class="bi bi-play-btn"></i>
                        </div>
                        <div class="here" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                            <i class="bi bi-card-text"></i>
                        </div>
                        @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- shop data information-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title mb-4">Shop</h4>
              <div class="table-responsive">
                <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                  <thead class="tread">
                    <tr>
                      <th>S/N</th>
                      <th>Shop Name</th>
                      <th>Available Course</th>
                      <th>Orders</th>
                      <th>Shop Link</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($shop->count() > 0)
                        @foreach ($shop as $item)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$item->name}}</td>
                            <td>
                              {{\App\Models\Course::where(['user_id' => Auth::user()->id, 'shop_id' => $item->id])->where('approved', true)->get()->count()}}
                              <a href="{{route('user.create.course', Auth::user()->username)}}" class="text-decoration-underline">Courses</a>
                            </td>
                            <td>

                              {{\App\Models\ShopOrder::where('shop_id', $item->id)->get()->count()}}
                              <a href="{{route('user.view.course.enrollments', [Auth::user()->username, $item->id])}}" class="text-decoration-underline">Orders</a>
                            </td>
                            <td>
                              <a href="{{$item->link}}" target="_blank" class="text-decoration-underline">Preview</a>
                              <input type="hidden" value="{{$item->link}}" name="name" id="myInput">
                              <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction2()" class="btn btn-secondary push" style="margin-left: 10px; padding: 0.2rem 0.5rem;"><i class="mdi mdi-content-copy"></i></button>
                            </td>
                            <td>
                                <button class="btn-list" data-bs-toggle="modal" data-bs-target="#editshop-{{$item->id}}">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit shop" class="material-icons-outlined">
                                        edit
                                    </span>
                                </button>
                                <div class="modal fade" id="deleteshop-{{$item->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content pb-3">

                                            <div class="modal-header border-bottom-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="Editt">
                                                    <form action="{{route('user.shop.delete', ['username' => Auth::user()->username, 'id' => $item->id])}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="row">
                                                                <h3 style="text-align: center; margin-bottom: 15%;" >Are you sure you want to delete <br>this Shop: ({{$item->name}})</h3>
                                                                <div class="row justify-content-between">
                                                                    <div class="col-6">
                                                                        <a href="#" class="text-decoration-none">
                                                                            <button type="button" data-bs-dismiss="modal" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                                Cancel
                                                                            </button></a>
                                                                    </div>
                                                                    <div class="col-6 text-end">
                                                                        <a href="#" class="text-decoration-none">
                                                                            <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #BA0028"
                                                                                >
                                                                                Delete
                                                                            </button>
                                                                        </a>
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
                                <button class="btn-list" data-bs-toggle="modal" data-bs-target="#deleteshop-{{$item->id}}">
                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="Delete shop" class="material-icons-outlined">
                                        delete
                                    </span>
                                </button>
                                {{-- modal --}}
                                <div class="modal fade" id="editshop-{{$item->id}}" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" style="max-width: 45%">
                                        <div class="modal-content pb-3">

                                            <div class="modal-header border-bottom-0">
                                                <h4 class="card-title mb-4">Edit Shop</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="Editt">
                                                    <form action="{{route('user.shop.update', ['username' => Auth::user()->username, 'id' => $item->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <!-- shop name -->
                                                        <div>
                                                            <div class="Editt">
                                                                <div class="form">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 mb-4">
                                                                            <label for="Name">Shop Name</label>
                                                                            <input type="text" name="name" value="{{$item->name}}" id="shopName" placeholder="Enter your shop name" required />
                                                                        </div>
                                                                        <div class="col-lg-12 mb-4">
                                                                            <label for="Name">Shop Description</label>
                                                                            <textarea name="description" id="" cols="30" rows="10" value="{{$item->description}}" placeholder="Enter your shop description">{{$item->description}}</textarea>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <label for="Name">Shop Name</label>
                                                                            <input type="text" value="{{$item->link}}" name="link" id="myInput" class="input mov myPut" readonly>
                                                                        </div>
                                                                        <div class="col-md-1 mt-3 mb-3">
                                                                            <button data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction1()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="Name">Store Currency</label>
                                                                            <select name="currency" id="currency" class="input mov" required>
                                                                                <option value="{{$item->currency}}">{{$item->currency}}</option>
                                                                                <option value="">-- Select Currency --</option>
                                                                                <option value="USD">USD</option>
                                                                                <option value="NGN">NGN</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <label for="payment_gateway">Store Payment Gateway</label>
                                                                            <select name="payment_gateway" id="payment_gateway" class="input mov" required>
                                                                                @foreach($paymentGateways as $paymentGateway)
                                                                                    @php
                                                                                        $selected = ($paymentGateway->name == $item->payment_gateway) ? 'selected' : '';
                                                                                    @endphp
                                                                                    @if (in_array($paymentGateway->name, ['Paypal', 'Flutterwave', 'Stripe']))
                                                                                        <option value="{{ $paymentGateway->name }}" data-currency="USD" {{ $selected }}>{{ $paymentGateway->name }}</option>
                                                                                    @endif
                                                                                    @if (in_array($paymentGateway->name, ['Paystack', 'Flutterwave']))
                                                                                        <option value="{{ $paymentGateway->name }}" data-currency="NGN" {{ $selected }}>{{ $paymentGateway->name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- shop theme -->
                                                        <div class="hihj mb-4">
                                                            <label for="theme" class="fs-5"> Shop Theme </label>
                                                            <div class="row mt-2 justify-content-between">
                                                                <div class="col-lg-6 theme-select">
                                                                    <label class="container2">
                                                                        <input type="radio" value="#00387d" name="theme">
                                                                        <span class="rdio amber"></span>
                                                                      </label>
                                                                      <label class="container2">
                                                                        <input type="radio" value="#00ff00" name="theme">
                                                                        <span class="rdio lime"></span>
                                                                      </label>
                                                                      <label class="container2">
                                                                        <input type="radio" value="#008080" name="theme">
                                                                        <span class="rdio teal"></span>
                                                                      </label>
                                                                      <label class="container2">
                                                                        <input type="radio" value="#010199" name="theme">
                                                                        <span class="rdio blue"></span>
                                                                      </label>
                                                                      <label class="container2">
                                                                        <input type="radio" value="#4b0082" name="theme">
                                                                        <span class="rdio indigo"></span>
                                                                      </label>
                                                                </div>
                                                                <div class="col-lg-6 text-end">
                                                                    <div class="baseColor">
                                                                        <label for="baseColor" style="color: #714091;">Choose another color: </label>
                                                                        <input class="baseColorInput" id="baseColor" type="color" name="primaryColor">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- shop logo -->
                                                            <div class="mt-5 hihj">
                                                                <label for="logo" class="fs-5 mb-3"> Shop Logo </label>
                                                                <div class="logo-input border-in w-full px-5 py-1 pb-5">
                                                                    <p>Update your Shop logo</p>
                                                                    <div class="logo-input2 border-in py-1 px-3">
                                                                        <div class="avatar-logo"></div>
                                                                        <div class="logo-file">
                                                                            <input type="file" accept="image" name="logo" id="" class="mt-4 w-100" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- buttons -->
                                                            <div class="row hihj justify-content-between mt-5">
                                                                <div class="col-6">
                                                                    <a data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                        Cancel
                                                                    </a>
                                                                </div>
                                                                <div class="col-6 text-end">
                                                                    <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                                        Update Shop
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                          </tr>
                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end page title -->
    </div>
  </div>
    @if(App\Models\ExplainerContent::where('menu', 'Learning-Management')->exists())
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="card-title mb-3">Explainer Video</h4>
                            <div class="aller">
                                <video id="explainerVideo" controls controlsList="nodownload" width="100%" height="400">
                                    <source src="{{App\Models\ExplainerContent::where('menu', 'Learning-Management')->first()->video}}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->
    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="card-title mb-3">Text Explainer</h4>
                            <div class="aller">
                                <p>
                                    {{App\Models\ExplainerContent::where('menu', 'Learning-Management')->first()->text}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Ends -->
    @endif
  <!-- End Page-content -->
</div>
<script>
    $(document).ready(function(){
        $("#shopName").keyup(function(){
            var shopNameValue = $(this).val(); // Get the value from #shopName
            var sanitizedValue = shopNameValue.replace(/\s+/g, '').toLowerCase(); // Remove spaces from the value
            $(".myPut").val("{{ config('app.url') }}/course/shop/" + sanitizedValue); // Set the value of #myInput
        });

        $('#currency').change(function() {
            var currency = $(this).val();
            $('#payment_gateway option').each(function() {
                if ($(this).data('currency') !== currency) {
                    $(this).prop('disabled', true);
                } else {
                    $(this).prop('disabled', false);
                }
            });
            $('#payment_gateway').val('');
        });
    });
</script>
<style>
    .container2 {
      display: inline;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 22px;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* Hide the browser's default radio button */
    .container2 input[type=radio] {
      position: absolute;
      opacity: 0;
      cursor: pointer;
    }

    /* Create a custom radio button */
    .amber {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #00387d;
      border-radius: 50%;
    }

    .lime {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #00ff00;
      border-radius: 50%;
    }

    .teal {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #008080;
      border-radius: 50%;
    }
    .blue {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #010199;
      border-radius: 50%;
    }

    .indigo {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #4b0082;
      border-radius: 50%;
    }



    /* On mouse-over, add a grey background color */
    .container2:hover input ~ .rdio {
      background-color: #ccc;
    }

    /* When the radio button is checked, add a blue background */
    .container2 input:checked ~ .rdio {
      background-color: #2196F3;
    }

    /* Create the indicator (the dot/circle - hidden when not checked) */
    .rdio:after {
      content: "";
      position: absolute;
      display: none;
    }

    /* Show the indicator (dot/circle) when checked */
    .container2 input:checked ~ .rdio:after {
      display: block;
    }

    /* Style the indicator (dot/circle) */
    .container2 .rdio:after {
         top: 9px;
        left: 9px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: white;
    }
    .btn-list{
        border: 0;
        padding: 5px 10px;
        border-radius: 5px;
        color: #7b7676;
    }
    .btn-list .material-icons-outlined{
        font-size: 16px;
    }
    .dropdown-item .material-icons-outlined{
        font-size: 15px;
    }
    .dropdown{
        display: inline;
    }
</style>

@endsection

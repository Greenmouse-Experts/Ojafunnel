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
              <div class="col-md-9">
                <div class="py-2">
                  <h4 class="font-600">My Shop</h4>
                  <p>
                    All your shops and courses in them
                  </p>
                </div>
              </div>
              <div class="col-md-3">
                <div class="">
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
                      <th>shop Name</th>
                      <th>Available Course</th>
                      <!-- <th>Sales</th> -->
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
                              {{\App\Models\Course::where('user_id', Auth::user()->id)->get()->count()}}
                            </td>
                            <td>
                              <a href="{{$item->link}}" target="_blank" class="text-decoration-underline">Preview</a>
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
                                                                            <input type="text" value="{{$item->link}}" name="link" id="myInput" class="input mov" readonly>
                                                                        </div>
                                                                        <div class="col-md-1 mt-3 mb-3">
                                                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
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
                                                                {{-- <div class="col-lg-6 text-end">
                                                                    <div class="baseColor">
                                                                        <label for="baseColor" style="color: #714091;">Choose another color: </label>
                                                                        <input class="baseColorInput" id="baseColor" type="color" name="primaryColor" value="#09091B">
                                                                    </div>
                                                                </div> --}}
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
                                                                    <a href="#" class="text-decoration-none">
                                                                        <button type="reset" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                                            Cancel
                                                                        </button></a>
                                                                </div>
                                                                <div class="col-6 text-end">
                                                                    <a href="ecommerce2.html" class="text-decoration-none">
                                                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091">
                                                                            Update Shop
                                                                        </button>
                                                                    </a>
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
  <script>
    $(document).ready(function(){

      $("#shopName").keyup(function(){
        if(document.getElementById('shopName').value.match(/\s/g)){
            document.getElementById('shopName').value=document.getElementById('shopName').value.replace(/\s/g,'');
        }
        $("#myInput").val('http://shop.ojafunnel.test/'+$("#shopName").val());
      });
    });
</script>
<script>
    function myCopyFunction() {
        // Get the text field
        var copyText = document.getElementById("myInput");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        // Alert the copied text
        //alert("Copied the text: " + copyText.value);
    }
</script>
  <!-- End Page-content -->
</div>

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
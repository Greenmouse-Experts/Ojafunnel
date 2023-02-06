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
                        <h4 class="mb-sm-0 font-size-18">Create Store</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard', Auth::user()->username)}}">Home</a></li>
                                <li class="breadcrumb-item active">Create Store</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <div class="row card account-head">
                <div class="col-12">
                    <div class="py-3">
                        <h4 class="font-60">Create Store</h4>
                        <p>Create a store for your digital/physical product sales</p>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="container">
                <div class="commerce-con">
                    <form action="{{route('user.store.create', Auth::user()->username)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- store name -->
                        <div>
                            <div class="Editt">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Store Name</label>
                                            <input type="text" name="name" id="storeName" placeholder="Enter your shop name" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Store Description</label>
                                            <textarea name="description" id="" cols="30" rows="10" placeholder="Enter your shop description" required></textarea>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="Name">Store Name</label>
                                            <input type="text" value=" http://shop.ojafunnel.test/" name="link" id="myInput" class="input mov" readonly required>
                                        </div>
                                        <div class="col-md-1 mt-3 mb-3">
                                            <button type=" button" data-bs-toggle="tooltip" data-bs-placement="top" title="Copy" onclick="myFunction()" class="btn btn-secondary push"><i class="mdi mdi-content-copy"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- store theme -->
                        <div class="hihj">
                            <label for="theme" class="fs-5"> Store Theme </label>
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
                                        <input class="baseColorInput" id="baseColor" type="color" name="primaryColor" value="#09091B">
                                    </div>
                                    <!-- <button id="color-picker-6" class="btn btn-primary btn-sm">Color Picker</button>
                                        <a type="color" style="color: #714091">Choose another color</a>
                                    </div> -->
                                </div>
                            </div>
                            <!-- store logo -->
                            <div class="mt-5 hihj">
                                <label for="logo" class="fs-5 mb-3"> Store Logo </label>
                                <div class="logo-input border-in w-full px-5 py-4 pb-5">
                                    <p>upload your store logo</p>
                                    <div class="logo-input2 border-in py-5 px-3">
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
                                        <button type="submit" class="btn px-4" style="color: #ffffff; background-color: #714091" data-bs-toggle="modal" data-bs-target="#onlineStore">
                                            Create Shop
                                        </button>
                                    </a>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
</div>

<!-- SuccessModal -->
<div class="modal fade" id="onlineStore" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="{{URL::asset('dash/assets/image/theme.png')}}" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>Congratulations, you've created your online store</p>
                </div>
                <div class="text-end mt-2">
                    <a href="{{route('user.check.store', Auth::user()->username)}}" class="text-decoration-none">
                        <button class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                            Next
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<script>
    $(document).ready(function(){

      $("#storeName").keyup(function(){
        if(document.getElementById('storeName').value.match(/\s/g)){
            document.getElementById('storeName').value=document.getElementById('storeName').value.replace(/\s/g,'');
        }
        $("#myInput").val('http://store.ojafunnel.test/'+$("#storeName").val());
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
<!-- END layout-wrapper -->
<script>
    let input = document.querySelectorAll("#baseColor");
    let input2 = document.querySelectorAll("#secondaryColor");
    let output = document.querySelector(".baseColor p");
    let output2 = document.querySelector(".baseColor.secondary p");

    function handleUpdate() {
        const suffix = this.dataset.sizing || "";
        document.documentElement.style.setProperty(
            `--${this.name}`,
            this.value + suffix
        );
        console.log(this.value);
        output.innerHTML = this.value;
        output2.innerHTML = this.value;
    }
    input.forEach((input) => input.addEventListener("change", handleUpdate));
    input2.forEach((input2) => input2.addEventListener("change", handleUpdate));

</script>

<style>
    /* The container */
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


    </style>

@endsection


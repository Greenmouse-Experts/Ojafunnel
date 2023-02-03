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
                    <form action="">
                        <!-- store name -->
                        <div>
                            <div class="Editt">
                                <div class="form">
                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Store Name</label>
                                            <input type="text" placeholder="Enter your shop name" required />
                                        </div>
                                        <div class="col-lg-12 mb-4">
                                            <label for="Name">Store Description</label>
                                            <textarea name="" id="" cols="30" rows="10" placeholder="Enter your shop description" required></textarea>
                                        </div>
                                        <div class="col-md-8">
                                            <label for="Name">Store Name</label>
                                            <input type="text" value=" https://chuka.ojafunnel.cc/store" name="name" id="myInput" class="input mov" readonly required>
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
                                    <!-- <input type="radio" value="#8DA5FA" />
                                    <input type="color" value="#F88DFA" />
                                    <input type="color" value="#8DFA98" />
                                    <input type="color" value="#F8D3D3" />
                                    <input type="color" value="#F8FA8D" /> -->
                                    <label class="amber">
                                        <input type="radio" class="cotton" name="color" value="#FF5722">
                                        <div class="layer"></div>
                                        <div class="button"><span></span></div>
                                    </label>
                                    <label class="lime">
                                        <input type="radio" name="color" class="cotton" value="#FFC107">
                                        <div class="layer"></div>
                                        <div class="button"><span></span></div>
                                    </label>

                                    <label class="teal">
                                        <input type="radio" name="color" class="cotton" value="#009688">
                                        <div class="layer"></div>
                                        <div class="button"><span></span></div>
                                    </label>

                                    <label class="blue">
                                        <input type="radio" name="color" class="cotton" value=" #2196F3">
                                        <div class="layer"></div>
                                        <div class="button"><span></span></div>
                                    </label>

                                    <label class="indigo">
                                        <input type="radio" name="color" class="cotton" value="#3F51B5">
                                        <div class="layer"></div>
                                        <div class="button"><span></span></div>
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
                                        <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button></a>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="ecommerce2.html" class="text-decoration-none">
                                        <button class="btn px-4" style="color: #ffffff; background-color: #714091" data-bs-toggle="modal" data-bs-target="#onlineStore">
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

@endsection
<style>
    .button {
        display: inline-block;
        position: relative;
        width: 50px;
        height: 50px;
        margin: 10px;
        cursor: pointer;
    }

    .button span {
        display: block;
        position: absolute;
        width: 50px;
        height: 50px;
        padding: 0;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        -o-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        border-radius: 100%;
        background: #eeeeee;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
        transition: ease .3s;
    }

    .button span:hover {
        padding: 10px;
    }

    .amber .button span {
        background: #FFC107;
    }

    .lime .button span {
        background: #8BC34A;
    }

    .teal .button span {
        background: #009688;
    }

    .blue .button span {
        background: #2196F3;
    }

    .indigo .button span {
        background: #3F51B5;
    }

    .layer {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: transparent;
        /*transition: ease .3s;*/
        z-index: -1;
    }

    .orange input:checked~.layer {
        background: #F4511E;
    }

    .amber input:checked~.layer {
        background: #FFB300;
    }

    .lime input:checked~.layer {
        background: #7CB342;
    }

    .teal input:checked~.layer {
        background: #00897B;
    }

    .blue input:checked~.layer {
        background: #1E88E5;
    }

    .indigo input:checked~.layer {
        background: #3949AB;
    }

    .cotton {
        display: none;
    }
</style>
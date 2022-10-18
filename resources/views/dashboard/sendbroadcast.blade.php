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
                        <div class="col-lg-12">
                            <div class="card begin account-head mb-4">
                                <div class="py-2">
                                    <h4 class="font-600">WhatsApp Automation</h4>
                                    <p>
                                        Send instant, scheduled or automated messages to your contact
                                    </p>
                                </div>
                                <div class="d-flex account-nav">
                                    <p class="ps-0">New Campaign</p>
                                    <p>
                                        <a href="#" class="text-decoration-none text-dark">Recieved Messages</a>
                                    </p>
                                    <p>
                                        <a href="#" class="text-decoration-none text-dark">Sent Campaigns</a>
                                    </p>
                                    <p>
                                        <a href="#" class="text-decoration-none text-dark">Auto Reply</a>
                                    </p>
                                    <p>

                                    </p>
                                    <p class="ps-0 active">
                                        <a href="#" class="text-decoration-none text-dark">Settings</a>
                                    </p>
                                </div>
                                <div class="acc-border"></div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="Edit">
                                <div class="form">
                                    <div class="row">
                                        <p class="tell mb-4">
                                            <b>
                                                Send Brodcast Messsage
                                            </b>
                                        </p>
                                        <div class="col-lg-12">
                                            <label>Senders Account :</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select>
                                                        <option>Choose sender account </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Sending List :</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <select>
                                                        <option>Choose sending list </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Message 1</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                   <textarea placeholder="Type in your message" name="" id="" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Message 2</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                   <textarea placeholder="Type in your message" name="" id="" cols="30" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-2">
                                            <p>
                                                <a href="#">
                                                    + Add New Message
                                                </a>
                                            </p>
                                        </div>
                                        <div class="col-lg-12">
                                            <p>
                                                Upload Attachment :
                                            </p>
                                        </div>
                                        <div class="logo-input w-full px-5 py-4 pb-5">
                                            <p>
                                                <b>
                                                    Attach, images, videos, audios or files 
                                                </b>
                                            </p>
                                            <div class="logo-input2 border-in py-5 px-2">
                                                    <div class="avatar">
                                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664984753/OjaFunnel-Images/Vectoor_rbkrfl.png" alt="">
                                                    </div>
                                                <div class="logo-file">
                                                    <input type="file" accept="image" name="logo" id=""
                                                        class="mt-4 w-100" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="boding">
                                                        <button class="btn px-3" style="color: #714091; border:1px solid #714091; background:#fff;">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="boding">
                                                        <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                            Proceed
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-md-6"></div>
                                                <div class="col-md-6">
                                                    <div class="boding">
                                                        <button>
                                                            <a href="" style="color: #fff;">
                                                                Update Setting
                                                            </a>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>

<!-- END layout-wrapper -->

<!-- smsModal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        Automate Message(s)
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="Edit-level">
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Message 1</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>When To Send</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" value="1" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Time (GMT)</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="datetime" placeholder="Hrs/Mins" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="Edit-level">
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Message 2</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="+234 800 000 0000" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Message Period</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" value="1" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Time (GMT)</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="datetime" placeholder="Hrs/Mins" name="name" class="input"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-4">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                                Cancel
                                            </button></a>
                                    </div>
                                    <div class="col-8 text-end">
                                        <a href="#" class="text-decoration-none">
                                            <button class="btn px-4" style="color: #ffffff; background-color: #714091"
                                                >
                                                Start Message Automation
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
      <!-- end modal -->
@endsection
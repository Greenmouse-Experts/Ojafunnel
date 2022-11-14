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
            <div class="row card begin mt-4">
                <div class="col-lg-12 account-head">
                <h4 class="font-500">New SMS Campaign</h4>
                        <p>
                            Send SMS to your new customer and those on your mailing list
                        </p>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                        <nav aria-label="Page navigation example normal">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="{{route('user.sms.automation', Auth::user()->username)}}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Senders Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter Senders Name" name="first_name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>SMS Message Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" cols="30" rows="5" placeholder="Enter the message you would like to send to the reciepient(s) details below " ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-4 justify-content-between">
                                    <div class="col-4">
                                        <p class="font-500 fs-6">Recipients:</p>
                                    </div>
                                    <div class="col-7">
                                        <select name="recipients" id="" class="bg-light w-100 py-2 rounded px-2 fs-6">
                                            <option value="">Choose from mailing list</option>
                                            <option value="">Option 1</option>
                                            <option value="">Option 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" cols="30" rows="5" placeholder="Add phone number manually E.g: +234 8000 111 333 " ></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Opt Out Message </label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Enter opt out message eg text stop to 12344" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <div class="row fine">
                                        <div class="col-md-4">
                                            Send SMS:
                                        </div>
                                        <div class="col-md-4">
                                            <div class="between">
                                                <input type="radio" name="send" value="Immediately"/>
                                                <label for="sms">Immediately</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="between">
                                                <input type="radio" name="send" value="Schedule"/>
                                                <label for="sms">Schedule to</label>
                                                <div class="row">
                                                    <div class="col-sm-6 mt-4">
                                                        <input type="date" />
                                                    </div>
                                                    <div class="col-sm-6  mt-4">
                                                        <input type="Time" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9"></div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="boding">
                                            <button data-bs-toggle="modal" data-bs-target="#OpenReview" type="submit">
                                                Send SMS
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p data-bs-toggle="modal" data-bs-target="#OpenReview" class="open">
                        Open Preview
                    </p>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content ---->

    <footer class="footer border-0 bg-transparent mt-5">
        <div class="container-fluid mt-5">
            <div class="row text-center bg-white mt-5">
                <div class="text-center py-4">
                    Copyright ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    Ojafunnel | All Right Reserved
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- END layout-wrapper -->
<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Option For Integration
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <!-- <p class="tell mb-4">
                                    <b>
                                        Essentials - Your integration starter kit
                                    </b>
                                </p> -->
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 789.png')}}" draggable="false" alt="">
                                                Zapier
                                            </div>
                                            <div class="zazu"  data-bs-toggle="modal" data-bs-target="#smsSuccess">
                                                <input type="radio" name="Zapier" value="Zapier">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="circle">
                                                <img src="{{URL::asset('dash/assets/image/image 793.png')}}" draggable="false" alt="">
                                                Getresponse
                                            </div>
                                            <div class="zazu" data-bs-toggle="modal" data-bs-target="#smsSuccess">
                                                <input type="radio" name="Zapier" value="Getresponse">
                                            </div>
                                        </div>
                                    </div>
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

<!-- OpenReview modal -->
<div class="modal fade" id="OpenReview" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <p class="modal-title" id="staticBackdropLabel">
                    ClosePreview >
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           
            <div class="modal-body">
                <div class="row">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="master">
                                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1668162728/EProd%20Images/Frame_46722_xglo6p.png" draggable="false" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <div class="insert">
                                                    <textarea name="" id="" cols="30" rows="10" placeholder="Enter Your Message" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
<!-- smsModal -->
<div class="modal fade" id="smsSuccess" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="icon-success">
                    <img src="assets/image/theme.png" alt="" width="100%" />
                </div>
                <div class="text-center mt-5">
                    <p>
                        <b>
                            You’ve succesfully sent your SMS to the recipient(s)
                        </b>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
@endsection
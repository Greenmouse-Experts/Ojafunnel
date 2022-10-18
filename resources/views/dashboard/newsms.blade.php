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
                <div class="col-12 account-head">
                    <div class="py-3">
                        <h4 class="font-500">New SMS Campaign</h4>
                        <p>
                            Send SMS to your new customer and those on your mailing list
                        </p>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="sms-con">
                        <form action="">
                            <!-- senders name -->
                            <div class="">
                                <div class="account-input-div">
                                    <input type="text" class="rounded" placeholder="Enter Senders name" required />
                                    <div class="label-text fs-6 font-500">Senders Name</div>
                                </div>
                            </div>
                            <!-- sms message -->
                            <div class="mt-5">
                                <div class="account-input-div">
                                    <textarea type="Password" class="rounded p-3" style="height: 100px; width: 100%" placeholder="Enter the message you would like to send to the reciepient(s) details below " required></textarea>
                                    <div class="label-text fs-6 font-500">SMS Message</div>
                                </div>
                            </div>
                            <!-- recipients -->
                            <div class="mt-5 row justify-content-between">
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
                            <!-- additional message -->
                            <div class="mt-5">
                                <div class="account-input-div">
                                    <textarea class="rounded p-2" style="height: 100px; width: 100%" placeholder="Add phone number manually E.g: +234 8000 111 333 " required></textarea>
                                </div>
                            </div>
                            <!-- send sms -->
                            <div class="mt-5 row">
                                <div class="col-3 fs-6 font-500">send SMS:</div>
                                <div class="col-9 row justify-content-between">
                                    <div class="col-lg-5">
                                        <input type="radio" name="sms" id="" />
                                        <label for="sms">Immediately</label>
                                    </div>
                                    <div class="col-lg-5">
                                        <div>
                                            <input type="radio" name="sms" id="" />
                                            <label for="sms">Schedule to</label>
                                        </div>
                                        <div class="row">
                                            <div class="w-100">
                                                <input type="date" name="sms-date" id="" class="rounded px-2 border-light py-1" />
                                            </div>
                                            <div class="w-100 mt-3">
                                                <input type="time" name="sms-date" id="" class="rounded px-2 border-light py-1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-end mt-5">
                                    <button class="btn mt-2 px-4" style="color: #ffffff; background-color: #714091" data-bs-toggle="modal" data-bs-target="#smsSuccess">
                                        Send SMS
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- End Page-content -->

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

<!-- smsModal -->
<div
        class="modal fade"
        id="smsSuccess"
        tabindex="-1"
        aria-labelledby="subscribeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
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
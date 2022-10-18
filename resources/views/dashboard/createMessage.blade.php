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
            <div class="row mt-4 begin">
                <div class="col-lg-12 card">
                    <div class=" account-head">
                        <div class="py-2">
                            <h4 class="font-600">Compose New Message</h4>
                            <p>
                                Compose sms, emails and whatsapp messages here
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cut">
                <div class="col-lg-2">
                </div>
                <div class="col-lg-8">
                    <div class="Edit">
                        <div class="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Senders Name</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="text" placeholder="Senders Name" name="name" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Message</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" placeholder="Enter the message you would like to send to the reciepient(s) details below" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class=" row justify-content-between">
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
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <textarea name="" id="" placeholder="Add phone number, and email manually here" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Phone Number</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="tel" placeholder="Enter contacts phone number" name="email" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="name">
                                        <ul>
                                            <li>
                                                <p>
                                                    <b>
                                                        Send Through :
                                                    </b>
                                                </p>
                                            </li>
                                            <p>
                                                Choose the channel(s) you want to send this message through
                                            </p>
                                        </ul>
                                    </div>
                                    <div class="name">
                                        <ul>
                                            <li>
                                                <input type="checkbox">
                                            </li>
                                            <li>
                                                Email
                                            </li>
                                            <li>
                                                <input type="checkbox">
                                            </li>
                                            <li>
                                                SMS
                                            </li>
                                            <li>
                                                <input type="checkbox">
                                            </li>
                                            <li>
                                                WhatsApp
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Email Message</label>
                                    <div class="row">
                                        <div class="col-md-12 MB-2">
                                            <textarea name="" id="" placeholder="Enter the message you would like to send to the reciepient(s) details below " cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>SMS Message</label>
                                    <div class="row">
                                        <div class="col-md-12 MB-2">
                                            <textarea name="" id="" placeholder="Enter the message you would like to send to the reciepient(s) details below " cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>WhatsApp Message</label>
                                    <div class="row">
                                        <div class="col-md-12 MB-2">
                                            <textarea name="" id="" placeholder="Enter the message you would like to send to the reciepient(s) details below " cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="boding">
                                        <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                            Schedule Time
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="boding">
                                        <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                            Schedule Time
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <div class="boding">
                                        <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                            Schedule Time
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="boding">
                                            <button style="background-color: #fff !important; border: 1px solid #70418f; color: #70418f;">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-7"></div>
                                    <div class="col-md-3">
                                        <div class="boding">
                                            <button data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                Send Message
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- END layout-wrapper -->


<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="white">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660311906/OjaFunnel-Images/ic-email_fi8ukf.png" draggable="false" alt="">
                            <p>
                                Send Now
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="whitee">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664540530/OjaFunnel-Images/Group_46737_j3022w.png" draggable="false" alt="">
                                <p>
                                    Automate
                                </p>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5 col-md-12">
                        <div class="boding">
                            <button>
                                Send Message
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<div
  class="modal fade"
  id="staticBackdrop1"
  data-bs-backdrop="static"
  data-bs-keyboard="false"
  tabindex="-1"
  aria-labelledby="staticBackdropLabel1"
  aria-hidden="true"
>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content px-4 py-2">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel1">
            Send Message
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- <div class="col-lg-2 col-md-2"></div> -->
          <div class="col-lg-6 col-md-6">
              <div class="white">
                  <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660311906/OjaFunnel-Images/ic-email_fi8ukf.png" draggable="false" alt="">
                  <p>
                    Send Now
                  </p>
              </div>
          </div>
          <div class="col-lg-6 col-md-6">
            <div class="whitee">
              <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664540530/OjaFunnel-Images/Group_46737_j3022w.png" draggable="false" alt="">
              <p>
                Automate
              </p>
          </div>
          </div>
          <div class="col-lg-12 col-md-12">
            <div class="form">
               <div class="row">
                <div class="col-lg-12">
                  <label>Message Period</label>
                  <div class="row">
                      <div class="col-md-12 mb-4">
                          <input type="number" value="1" name="email" class="input" required>
                      </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <label>Time (GMT)</label>
                  <div class="row">
                      <div class="col-md-12 mb-4">
                          <input type="datetime-local" placeholder="DD/MM/YY" name="email" class="input" required>
                      </div>
                  </div>
                </div>
               </div>
            </div>
          </div>
          <div class="col-lg-12 mt-5 col-md-12">
              <div class="boding">
                <button>
                    Start Message Automation
                </button>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-secondary"
          data-bs-dismiss="modal"
        >
          Close
        </button>
      </div>
    </div>
  </div>
  </div>
  <!-- Modal Ends -->

@endsection
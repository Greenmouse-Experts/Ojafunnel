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
            <div class="row mt-1">
              <div class="col-lg-12 account-head">
                <div class="row align-items-center">
                  <div class="col-md-2">
                    <a
                      href="{{route('user.email.design')}}"
                      class="text-purp text-decoration-none"
                      ><p class="text-purpp fs-me">  < Back To Editor</p></a
                    >
                  </div>
                  <div class="col-md-7 campaign-nav mt-3">
                    <ul class="list-unstyled">
                        
                      </li>
                    </ul>
                  </div>
                  <div class="col-md-3">
                    <div class="save">
                      <button>
                        <a href="Email-Summary.html">
                          Save and Proceed
                        </a>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- account container form -->
            <!-- end page title -->
            <!-- Design Email -->
            <div class="row cut">
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <div class="arise">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457383/OjaFunnel-Images/image_786_x7hbxi.png" draggable="false" alt=""> 
                        <div class="off">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Rectangle_19139_i4ejte.png" alt="">

                            <h5>
                                Dear Customer,
                            </h5>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda exercitationem odio adipisci quae vitae numquam eos nobis. Quis totam hic non rem cum et, nesciunt mollitia doloremque eius laborum!
                                Winter time is cozy time. Enjoy your holidays in the best hotels of the world with your fluffy partners in the crime. Check out our lists below and see where to stay for this winter holiday or how to make your little friends a lovely gift!
                            </p>
                            <button>
                                Button
                            </button>
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <div class="shut">
                                        <ul>
                                            <li>
                                                <a href="">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_932_xwn2cy.png" draggable="false" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_934_h9frde.png" draggable="false" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_933_yhpvkj.png" draggable="false" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="">
                                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_935_bmzgsi.png" draggable="false" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>  
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                            <p class="has">
                                This email has been sent to you, because you are a customer or subscriber of chukka_company. Kindly check your inbox for more dealtail <a href="#">
                                    Unsubscribe
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                   <div class="resign">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664527159/OjaFunnel-Images/Group_46771_gffoas.png" draggable="false" alt="">
                   </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
             <!-- Design Email Ends -->
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
@endsection
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
          <div class="row begin card mt-1">
            <div class="col-lg-12 account-head">
              <div class="row align-items-center">
                <div class="col-md-10">
                  <div class="Design">
                    <h4 class="font-500">Design your Email</h4>
                    <p>Build your email or select from our premade templates</p>
                  </div>
                </div>
                <div class="col-md-2">
                  <nav aria-label="Page navigation example normal">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="{{route('user.email.code')}}" aria-label="Previous">
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
                <!-- <div class="col-md-2">
                  <a href="Ecampaign.html" class="text-purp text-decoration-none">
                    <p class="text-purp fs-me">
                      < previous</p>
                  </a>
                </div> -->
                <div class="col-md-7 campaign-nav mt-3">
                  <ul class="list-unstyled">
                    <li class="px-3 py-2 text-white bg-purp" style="border-right: 1px solid #fff">
                      <a href="Ecampaign.html" class="text-decoration-none text-white bg-purp">
                        <div class="campp">
                          Campaign Info >>
                        </div>
                      </a>
                    </li>
                    <li class="px-3 py-2 text-white bg-purp" style="border-right: 1px solid #fff">
                      Message Content >>
                    </li>
                    <li>
                      <a href="{{route('user.email.preview')}}" class="text-decoration-none text-dark">
                        <div class="camp">
                          Preview >>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="text-decoration-none text-dark">
                        <div class="camp">Send >></div>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-md-3">
                  <div class="save">
                    <button>
                      <a href="">
                        Save and Proceed
                      </a>
                    </button>
                  </div>
                </div>
              </div>
              <div>
              </div>
            </div>
          </div>
          <!-- account container form -->
          <!-- end page title -->
          <!-- Design Email -->
          <div class="row cut">
            <div class="col-lg-2 ">
              <div class="email-arise">
                <div class="arising">
                  <p>
                    Add Section
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/font_1_avung1.png"
                    draggable="false">
                  <p>
                    Text
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Group_46716_ygvjty.png"
                    draggable="false">
                  <p>
                    Picture
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457383/OjaFunnel-Images/Group_46717_lnipii.png"
                    draggable="false">
                  <p>
                    Button
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Group_46718_boovfx.png"
                    draggable="false">
                  <p>
                    Seperator
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Group_46718_boovfx.png"
                    draggable="false">
                  <p>
                    Video
                  </p>
                </div>
              </div>
              <div class="email-arising">
                <div class="arising">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Group_46720_toa1gs.png"
                    draggable="false">
                  <p>
                    Socials
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="arise">
                <img
                  src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457383/OjaFunnel-Images/image_786_x7hbxi.png"
                  draggable="false" alt="">
                <div class="off">
                  <img
                    src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664457382/OjaFunnel-Images/Rectangle_19139_i4ejte.png"
                    alt="">

                  <h5>
                    Dear Customer,
                  </h5>
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam assumenda exercitationem odio
                    adipisci quae vitae numquam eos nobis. Quis totam hic non rem cum et, nesciunt mollitia doloremque
                    eius laborum!
                    Winter time is cozy time. Enjoy your holidays in the best hotels of the world with your fluffy
                    partners in the crime. Check out our lists below and see where to stay for this winter holiday or
                    how to make your little friends a lovely gift!
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
                              <img
                                src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_932_xwn2cy.png"
                                draggable="false" alt="">
                            </a>
                          </li>
                          <li>
                            <a href="">
                              <img
                                src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_934_h9frde.png"
                                draggable="false" alt="">
                            </a>
                          </li>
                          <li>
                            <a href="">
                              <img
                                src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_933_yhpvkj.png"
                                draggable="false" alt="">
                            </a>
                          </li>
                          <li>
                            <a href="">
                              <img
                                src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664459432/OjaFunnel-Images/Ellipse_935_bmzgsi.png"
                                draggable="false" alt="">
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-md-3"></div>
                  </div>
                  <p class="has">
                    This email has been sent to you, because you are a customer or subscriber of chukka_company. Kindly
                    check your inbox for more dealtail <a href="#">
                      Unsubscribe
                    </a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="arisse">
                <nav aria-label="...">
                  <ul class="pagination">
                    <li class="page-item">
                      <span class="page-link">Elements</span>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">Email Body</a>
                    </li>
                  </ul>
                </nav>
                <div class="page">
                  <h2>
                    TEXT BLOCK
                  </h2>
                  <p>
                    Text Colour: <span style="background: #fff;"> #00000</span>
                  </p>
                  <p>
                    Font: <span><select name="" id="">
                        <option value="">Montserrat</option>
                        <option value="">Poppins</option>
                      </select></span>
                  </p>
                  <p>
                    Line Height: <span>1200px</span>
                  </p>
                  <h3>
                    COMPONENT SETTING
                  </h3>
                  <p>
                    Background Colour: <span style="background: #fff;"> #00000</span>
                  </p>
                  <p>
                    The Inner Padding: <span><input placeholder="1" type="number"></span>
                  </p>
                  <p>
                    Background Image: <span><input type="file"></span>
                  </p>

                </div>
              </div>
            </div>
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
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
            <div class="row begin">
                <div class="col-lg-12 move">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="align-items-center">
                                <h4>Edit Automation Template</h4>
                                <p>
                                    Edit  the automated email campaignto suit you     
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row cut">
                <div class="col-lg-2 ">
                    <div class="email-arise">
                        <div class="arising">
                            <p>
                                Actions
                            </p>
                        </div>
                    </div>
                    <div class="email-arising">
                        <div class="arising">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965301/OjaFunnel-Images/Vectorr_asucru.png" draggable="false">
                            <p>
                                Send Message 
                            </p>
                        </div>
                    </div>
                    <div class="email-arising">
                        <div class="arising">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965300/OjaFunnel-Images/Group_46747_du2s51.png" draggable="false">
                            <p>
                                Wait 
                            </p>
                        </div>
                    </div>
                    <div class="email-arising">
                        <div class="arising">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965300/OjaFunnel-Images/Group_46748_utkqqz.png" draggable="false">
                            <p>
                                Apply Tags 
                            </p>
                        </div>
                    </div>
                    <div class="email-arising">
                        <div class="arising">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965301/OjaFunnel-Images/Vectorrr_u3hhoe.png" draggable="false">
                            <p>
                                Conditions 
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="Edit">
                        <div class="product">
                            <ul>
                                <li>
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965960/OjaFunnel-Images/Group_46830_sy8dxi.png" draggable="false" alt="">
                                </li>
                                <li>
                                    <h5>
                                        Campaign Trigger :
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        Purchase Product 
                                    </h5>
                                </li>
                            </ul>
                        </div>
                        <div class="product">
                            <ul>
                                <li>
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965960/OjaFunnel-Images/Group_46831_g4ya5z.png" draggable="false" alt="">
                                </li>
                                <li>
                                    <h5>
                                        Campaign Trigger :
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        Purchase Product 
                                    </h5>
                                </li>
                            </ul>
                        </div>
                        <div class="product">
                            <ul>
                                <li>
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965960/OjaFunnel-Images/Group_46835_rvexhk.png" draggable="false" alt="">
                                </li>
                                <li>
                                    <h5>
                                        Campaign Trigger :
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        Purchase Product 
                                    </h5>
                                </li>
                            </ul>
                        </div>
                        <div class="product">
                            <ul>
                                <li>
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1664965960/OjaFunnel-Images/Group_46837_pfafoe.png" draggable="false" alt="">
                                </li>
                                <li>
                                    <h5>
                                        Campaign Trigger :
                                    </h5>
                                </li>
                                <li>
                                    <h5>
                                        Purchase Product 
                                    </h5>
                                </li>
                            </ul>
                        </div>
                       <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="product">
                                    <div class="end">
                                        <Button>
                                            <a href="{{route('user.automation.campaign')}}">
                                                Create Automation
                                            </a>
                                        </Button>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="Dept">
                        Description
                    </h5>
                    <div class="form">
                    <div class="row">
                     <div class="col-md-12">
                       <label>Message</label>
                       <div class="row">
                           <div class="col-md-12 mb-4">
                               <textarea name="" id="" cols="20" rows="6"></textarea>
                           </div>
                       </div>
                     </div>
                     <div class="col-md-8"></div>
                     <div class="col-md-4">
                        <div class="end">
                            <Button>Set</Button>
                        </div>
                     </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- account container form -->
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
@endsection
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
            <div class="row card begin mt-1">
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
                                        <a class="page-link" href="{{route('user.email.Ecampaign')}}" aria-label="Previous">
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
                        <!-- <div class="col-lg-3">
                    <a
                      href="Ecampaign.html"
                      class="text-purp text-decoration-none"
                      ><p class="text-purp fs-me">previous</p></a
                    >
                  </div> -->
                        <div class="col-lg-9 campaign-nav mt-2 mb-4">
                            <ul class="list-unstyled">
                                <li class="px-3 py-2 text-white bg-purp" style="border-right: 1px solid #fff">
                                    <a href="" class="text-decoration-none text-white">
                                        <div class="campp">
                                            Campaign Info >>
                                        </div>
                                    </a>
                                </li>
                                <li class="px-3 py-2 text-white bg-purp" style="border-right: 1px solid #fff">
                                    Message Content >>
                                </li>
                                <li class="">
                                    <a href="Ecampaign.html" class="text-decoration-none text-dark">
                                        <div class="camp">Preview >></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="Ecampaign.html" class="text-decoration-none text-dark">
                                        <div class="camp">Send >></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2 mb-4">
                        <div class="col-sm-2 col-md-3 py-2">My Templates</div>
                        <div class="col-sm-2 col-md-3 text-purp py-2">
                            Template Gallery
                        </div>
                        <div class="col-sm-2 col-md-3 text-center text-purpp py-2">
                            <div style="border-bottom: 1px solid #713f93;">
                                Layouts</div>
                        </div>
                        <div class="col-sm-2 col-md-3 py-2">
                            Code
                        </div>
                    </div>
                </div>
            </div>
            <!-- account container form -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-con">
                        <div class="mb-5 mt-3">
                            <select name="tempCat" id="" class="px-2 py-1 rounded">
                                <option value="" selected disabled>
                                    Select A Template Category
                                </option>
                                <option value="">Option 1</option>
                                <option value="">Option 2</option>
                            </select>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="founds">
                                        <div class="found-top"></div>
                                        <div class="p-2">
                                            <p class="font-500 my-1">Basic Layout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="founds">
                                        <div class="found-top"></div>
                                        <div class="p-2">
                                            <p class="font-500 my-1">Shop Layout</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="founds">
                                        <div class="found-top"></div>
                                        <div class="p-2">
                                            <p class="font-500 my-1">Three Coloumns </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="founds">
                                        <div class="found-top"></div>
                                        <div class="p-2">
                                            <p class="font-500 my-1">News</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="founds">
                                        <div class="found-top"></div>
                                        <div class="p-2">
                                            <p class="font-500 my-1">Text</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-10"></div>
                                <div class="col-lg-2">
                                    <nav aria-label="Page navigation example normal">
                                        <ul class="pagination mt-4">
                                            <li class="page-item">
                                                <a class="page-link" href="{{route('user.email.Ecampaign')}}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="{{route('user.email.code')}}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
@endsection
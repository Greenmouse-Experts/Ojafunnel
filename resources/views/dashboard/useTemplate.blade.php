@extends('layouts.dashboard-frontend')

@section('page-content')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="container-fluid">
            <div class="row card cut begin">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="{{route('user.choose.temp', Auth::user()->username)}}">
                                <P>
                                    <b>
                                        << Back
                                    </b>
                                </P> 
                            </a>
                        </div>
                        <div class="col-md-8">
                            <div class="text-center">
                                <h3>
                                    Sales Lead Form
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="all-create">
                                <button>
                                    <!-- <a href="{{route('user.send.broadcast', Auth::user()->username)}}"> -->
                                    Use Template
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-10">
                    <div class="backing">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="user">
                                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1666265880/OjaFunnel-Images/Group_46860_x7neyz.png" draggable="false" alt="">
                                        <h2>
                                            Get In Touch
                                        </h2>
                                        <p>
                                            Contact us with the form below
                                        </p>
                                    </div>
                                    <div class="Light">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <label>First Name</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="text" placeholder="Enter your first name" name="email" class="input" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Email</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="email" placeholder="Enter your email" name="email" class="input" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label>Phone Number</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <input type="tel" placeholder="Enter your phone number" name="email" class="input" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="" id="">
                                                                <option>What Service Do You Want </option>
                                                                <option value="">1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-4">
                                                            <select name="" id="">
                                                                <option>What Did You Hear About Us</option>
                                                                <option value="">1</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <label for="">Your message</label>
                                                    <div class="row">
                                                        <div class="col-md-12 mb-1">
                                                            <textarea placeholder="..." name="" id="" cols="30" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="name">
                                                        <ul>
                                                            <li>
                                                                <input type="checkbox">
                                                            </li>
                                                            <li>
                                                                Subscribe to newsletter
                                                            </li>
                                                        </ul>
                                                    </div> <br>
                                                    <div class="name mb-4">
                                                        <ul>
                                                            <li>
                                                                <input type="checkbox">
                                                            </li>
                                                            <li>
                                                                I agree to the processing of personal data
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="boding mb-4">
                                                        <button type="submit" data-bs-toggle="modal" data-bs-target="#emailConfirm">
                                                            Send
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-sm-4">
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
                                                    <div class="col-md-4"></div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <p>
                                                            Your company.All right reserved
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
</div>
<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content pb-3">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="backing">
                    <div class="card">
                        <div class="user">
                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1666265880/OjaFunnel-Images/Group_46860_x7neyz.png" draggable="false" alt="">
                            <h2>
                                <b>
                                    Thank you for your message!
                                </b>
                            </h2>
                            <p>
                                We’ll be in touch soon
                            </p>
                        </div>
                        <div class="Light">
                            <div class="form">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="boding mb-4">
                                            <button>
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
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
<!-- END layout-wrapper -->
@endsection
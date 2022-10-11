@extends('layouts.frontend')

@section('page-content')
    <!-- Contact-us Ends -->
        <section class="cont-welcome">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text">
                            <h1>
                                How can we help ?
                            </h1>
                            <p>
                                Do you have an issue we can help with ? Here’s how you can reach us.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Contact-us Ends -->

    <!-- Phone Line -->
        <section class="Phone">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="btn-call">
                            <div class="rep">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660817848/OjaFunnel-Images/phone_ghgo0b.png" draggable="false">
                                <h6>
                                    Phone Lines
                                </h6>
                                <div class="line">
                                    +234- 800-000-000,
                                    <br>
                                    +234- 800-000-0000
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        <div class="btn-call">
                            <div class="rep">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660817848/OjaFunnel-Images/support_jlwwjw.png" draggable="false" class="tect">
                                <h6>
                                    Email Support
                                </h6>
                                <div class="line">
                                    ojafunnel@gmail.com 
                                    <br>
                                    info@ojafunnel.com
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        <div class="btn-call">
                            <div class="rep">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660817848/OjaFunnel-Images/office_yx6ez0.png" draggable="false"  class="tectt">
                                <h6>
                                    Office Address
                                </h6>
                                <div class="line">
                                    7, Office address, street, agege Lagos country.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Phone Line Ends -->

    <!-- Location -->
        <section class="location">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="btn-loval">
                            <h5>
                                Office Location 
                            </h5>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1014756.6903908219!2d2.976542089307389!3d6.535154865265881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf2bae227550d%3A0xe771ad7f1bbe89d6!2sLagos!5e0!3m2!1sen!2sng!4v1639066038889!5m2!1sen!2sng" style="border:1px solid #fff; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="btn-lovall">
                            <h5>
                                Get In Touch
                            </h5>
                            <div class="Visit">
                                <form class="login">
                                    <div class="row">
                                        <!--Name-->
                                        <div class="col-lg-12">
                                            <label>First Name</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <i class="bi bi-person"></i>
                                                    <input type="text" placeholder="First name" name="firstname" class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Phone Number-->
                                        <div class="col-lg-12">
                                            <label>Phone Number</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <i class="bi bi-phone"></i>
                                                    <input type="tel" placeholder="Enter your phone number " name="lastname" class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Email</label>
                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <i class="bi bi-envelope"></i>
                                                    <input type="text" placeholder="Email address" name="lastname" class="input" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--Message-->
                                        <div class="col-lg-12 mb-4">
                                            <label>Message</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <textarea required class="input" cols="20" placeholder="Enter your message." rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-2">
                                            <button>
                                                Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Location Line -->

    <!-- Digital -->
        <section class="digital">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mount">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <h1>
                                        Are you ready to take your digital marketing to the next level! 
                                    </h1>
                                    <div class="level"></div>
                                    <button>
                                        Sign up
                                    </button>
                                    <button style="background-color: #527EEB; color: #fff;">
                                        See Demo
                                    </button>
                                </div>
                                <div class="col-md-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Digital Ends -->
@endsection
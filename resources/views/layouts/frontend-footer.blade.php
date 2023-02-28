<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="kit-font">
                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png">
                    <p>
                        Ojafunnel is an all-in-one marketing platform to acquire leads through lead generation forms and optin, engage web visitors through beautiful landing pages, nurture them through engaging emails, and automate your marketing funnel through marketing automation.
                    </p>
                </div>

            </div>
            <div class="col-lg-2">
                <div class="quick">
                    <h1>
                        Quick Link
                    </h1>
                    <ul>
                        <li>
                            <a href="{{route('index')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('emailmarketing')}}">Features</a>
                        </li>
                        <li>
                            <a href="{{route('pricing')}}"> Pricing</a>
                        </li>
                        <li>
                            <a href="{{route('faqs')}}">FAQs</a>
                        </li>
                        <li>
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="quick">
                    <h1>
                        Contact
                    </h1>
                    <ul>
                        <li>
                            8, Address street ikeja area lagos state
                        </li>
                        <li>
                            0815530260
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="quick">
                    <h1>
                        Newsletter
                    </h1>
                    <ul>
                        <li>
                            Get News & Updates
                        </li>
                    </ul>
                    <form class="search-bar">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email Address" required>
                            <span class="input-group-text" id="basic-addon2" type="submit" required>Subscribe</span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="last-fot">
                    <h1>
                        Helping thousands of businesses succeed,<a href="{{route('login')}}">
                                join us
                            </a>
                    </h1>
                </div>
            </div>
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="top">
                    <div class="logo-details">
                        <div class="media-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="last-fott text-center">
                    <a href="{{route('privacy')}}">
                        Privacy Policy
                    </a>
                        |
                    <a href="{{route('terms')}}">
                        Terms & Condition
                    </a>
                    <h1>
                        Copyright © {{ date('Y') }} {{config('app.name')}}. All rights reserved
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

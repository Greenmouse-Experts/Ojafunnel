<section class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="quick">
                    <ul>
                        <li>
                            <div class="force">
                                <a href="#">
                                    <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="">
                                </a>
                            </div>
                        </li>
                        <li>
                            Ojafunnel is an all-in-one marketing platform to acquire leads through lead generation forms and optin, engage web visitors through beautiful landing pages, nurture them through engaging emails, and automate your marketing funnel through marketing automation.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="quick">
                    <h1>
                        Features
                    </h1>
                    <ul>
                        <li>
                            <a href="{{route('pagebuilder')}}">Page Builder</a>
                        </li>
                        <li>
                            <a href="{{route('funnelbuilder')}}">Funnel Builder</a>
                        </li>
                        <li>
                            <a href="{{route('marketauto')}}">Automation</a>
                        </li>
                        <li>
                            <a href="{{route('ecommerce')}}">Ecommerce</a>
                        </li>
                        <li>
                            <a href="{{route('emailmarketing')}}">Email Marketing</a>
                        </li>
                        <li>
                            <a href="{{route('affiliate')}}">Affiliate Marketing</a>
                        </li>
                        <li>
                            <a href="{{route('chatautomation')}}">Chat Automation</a>
                        </li>
                        <li>
                            <a href="{{route('integrations')}}">API Integration</a>
                        </li>
                    </ul>
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
                        Account
                    </h1>
                    <ul>
                        <li>
                            <a href="{{route('signup')}}">Register</a>
                        </li>
                        <li>
                            <a href="{{route('login')}}">Login</a>
                        </li>
                    </ul>
                    <h1>
                        Resources
                    </h1>
                    <ul>
                        <li>
                            <a href="{{route('privacy')}}">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="{{route('terms')}}">Terms & Condition</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="quick">
                    <h1>
                        Newsletter
                    </h1>
                    <form class="search-bar mb-4" method="post" action="{{route('subscribe.newsletter')}}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" name="email" placeholder="Your email Address" required>
                            <input type="submit" class="input-group-text" value="Subscribe" id="basic-addon2">
                        </div>
                    </form>
                    <h1>
                        Follow Us
                    </h1>
                    <ul>
                        <li>
                            <a href="#">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678779/OjaFunnel-Images/facebook_n5uvff.png" draggable="false" title="Follow" alt="">
                            </a>
                            <a href="#">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678781/OjaFunnel-Images/twitter_kd7mew.png" draggable="false" alt="">
                            </a>
                            <a href="#">
                                <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1677678783/OjaFunnel-Images/instagram_zf1kco.png" draggable="false" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="last-fott text-center">
                    <!-- <a href="{{route('privacy')}}">
                        Privacy Policy
                    </a>
                    |
                    <a href="{{route('terms')}}">
                        Terms & Condition
                    </a> -->
                    <h1>
                        Copyright © {{ date('Y') }} {{config('app.name')}}. All rights reserved
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>

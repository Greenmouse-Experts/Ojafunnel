@extends('layouts.frontend')
@section('page-content')
<!-- hero -->
<div class="template-hero-banner">
    <div class="container h-100">
        <div class="hero-container">
            <div class="template-hero-div">
                <p class="template-head-text">{{$page->folder}} Page</p>
            </div>
        </div>
    </div>
</div>
<!-- hero ends -->
<!-- page contents -->
<div class="template-content mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 template-img-col mt-3">
                <div class="w-100">
                     @if($page->thumbnail)
                    <img src="{{$page->thumbnail}}" alt="{{$page->name}}" width="100%" height="100%" />
                    @else
                    <img src="http://via.placeholder.com/640x1000" alt="template" width="100%" height="100%" />
                    @endif
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5 template-text-col mt-3">
                <div class="details-text">
                    <p class="text-header">Do you like this template?</p>

                    <a href="
                        @if (env('APP_ENV') == 'local')
                            {{ $page->file_location }}
                        @else
                            @if ($page->name == 'index.html')
                                {{ "https://$page->slug-page.ojafunnel.com"}}
                            @else
                                {{ "https://$page->slug-page.ojafunnel.com/" . explode('.', $page->name)[0] }}
                            @endif 
                        @endif
                    " class="btn btn-primary mt-4">View Template</a><br>
                    <button onclick="useTemplate('@auth {{ route('user.dashboard', ['username' => Auth::user()->username]) }} @else {{ route('signup')}} @endauth','{{ $page->id }}')" class="btn btn-primary mt-4">Use Template</button>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            8, Address street
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
<script>
    function useTemplate (url, template_id) {  
        localStorage.setItem('use_template', JSON.stringify({
            page_id: template_id,
            view: false
        }));
        window.location.assign(url); 
    }
</script>
<!-- page contents ends -->
@endsection 
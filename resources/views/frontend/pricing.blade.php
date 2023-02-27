@extends('layouts.frontend')
@section('page-content')
<!-- faq-welcome Ends -->
<section class="faq-welcome">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text">
                    <h1>
                        Choose Your Plan
                    </h1>
                    <p>
                        Our service plans grow with your workforce!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- faq-welcome Ends -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
                    <h1 class="text-center all">
                        Choose your plan:
                    </h1>
            <div class="main">
                <table class="price-table">
                    <tbody>
                        <tr>
                            <td></td>
                            <td class="price">
                                <br>Free
                                <br>
                            </td>
                            <td class="price">
                                <div class="arel">Starter</div>
                                <br>₦100 / monthly
                                <br>
                            </td>
                            <td class="price">
                                <div class="arel">Standard</div>
                                <br>₦250 / monthly
                                <br>
                            </td>
                            <td class="price">
                                <div class="arel">Essencial</div>
                                <br>₦350 / monthly
                                <br>
                            </td>
                            <td class="price">
                                <div class="arel">Premuim</div>
                                <br>₦450 / monthly
                                <br>
                            </td>
                            <td class="price">
                                <div class="arel">Enterprise</div>
                                <br>₦550 / monthly
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-asset-updates" class="price-table-help"><i class="bi bi-info-circle"></i></a> SMS</td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                            <td><i class="fas fa-times"></i></td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-core-updates" class="price-table-help"><i class="bi bi-info-circle"></i></a> Whatsapp</td>
                            <td>14 daily 1 WhatsApp</td>
                            <td>100 daily 2 WhatsApp</td>
                            <td>1000 daily 2 WhatsApp</td>
                            <td>2000 daily 2 WhatsApp</td>
                            <td>3000 daily 2 WhatsApp</td>
                            <td>Unlimited daily 6 WhatsApp</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-security-monitoring" class="price-table-help"><i class="bi bi-info-circle"></i></a> Email</td>
                            <td>500 daily</td>
                            <td>1000 daily</td>
                            <td>2000 daily</td>
                            <td>3000 daily</td>
                            <td>4000 daily</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-uptime-monitoring" class="price-table-help"><i class="bi bi-info-circle"></i></a> Page builder</td>
                            <td>2</td>
                            <td>10</td>
                            <td>20</td>
                            <td>30</td>
                            <td>40</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-malware-cleanup" class="price-table-help"><i class="bi bi-info-circle"></i></a> Custom domain</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-security-audit" class="price-table-help"><i class="bi bi-info-circle"></i></a> Funnel builder</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-security-audit" class="price-table-help"><i class="bi bi-info-circle"></i></a> LMS</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-priority-support" class="price-table-help"><i class="bi bi-info-circle"></i></a> Ecommerce Products</td>
                            <td>No</td>
                            <td>No</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-billing" class="price-table-help"><i class="bi bi-info-circle"></i></a> Upload list</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Yes</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td><a href="#wordpress-billing" class="price-table-help"><i class="bi bi-info-circle"></i></a> Use your own email server (AWS, etc)</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="price">
                                <a href="{{route('signup')}}">Get started</a>
                            </td>
                            <td class="price">
                                <a href="{{route('signup')}}">Get started</a>
                            </td>
                            <td class="price">
                                <a href="{{route('signup')}}">Get started</a>
                            </td>
                            <td class="price">
                                <a href="{{route('signup')}}">Get started</a>
                            </td>
                            <td class="price">
                                <a href="{{route('signup')}}">Get started</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script async type="text/javascript" src="//cdn.carbonads.com/carbon.js?serve=CESDK2J7&placement=getbutterflycom" id="_carbonads_js"></script>
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
<!-- Pricing -->
<!-- <section class="Pricing">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="pricing-intro">
                    <h1>
                        Choose your plan:
                    </h1>
                </div>
            </div>
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <div class="price-switcher-container">
                    <div class="price-switcher-title">Choose your<br> billing period</div>
                    <div class="price-switcher">
                        <div class="price-switcher-period price-switcher-period__monthly active js-switch-button-period">Monthly</div>
                        <div class="price-switcher-period price-switcher-period__yearly js-switch-button-period">Annually</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
            @foreach($plans as $plan)
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        {{strtoupper($plan->name)}}
                    </p>
                    <div class="js-price-big-wrapper-month">
                        <h1 class="">
                            {{$plan->currency}}{{$plan->monthly_amount}}/<span>monthly</span>
                        </h1>
                    </div>
                    <div class="js-price-big-wrapper">
                        <h1 class="-yearly -hide">
                            {{$plan->currency}}{{$plan->yearly_amount}}/<span>yearly</span>
                        </h1>
                    </div>
                    <a href="{{route('signup')}}">START FOR FREE</a>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-rep-plugin responsive">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">FREE</th>
                                        <th scope="col">STARTER</th>
                                        <th scope="col">STANDARD</th>
                                        <th scope="col">ESSENCIAL</th>
                                        <th scope="col">PREMIUM</th>
                                        <th scope="col">ENTERPRISE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">SMS</th>
                                        <td><i class="bi bi-asterisk"></i></td>
                                        <td><i class="bi bi-asterisk"></i></td>
                                        <td><i class="bi bi-asterisk"></i></td>
                                        <td><i class="bi bi-asterisk"></i></td>
                                        <td><i class="bi bi-asterisk"></i></td>
                                        <td><i class="bi bi-asterisk"></i></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="whatapp">Whatsapp</th>
                                        <td>14 daily <br> 1 WhatsApp</td>
                                        <td>100 daily <br> 2 WhatsApp</td>
                                        <td>1000 daily <br> 3 WhatsApp</td>
                                        <td>2000 daily <br> 4 WhatsApp</td>
                                        <td>3000 daily <br> 5 WhatsApp</td>
                                        <td>Unlimited daily <br> 6 WhatsApp</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td>500 daily</td>
                                        <td>1000 daily</td>
                                        <td>2000 daily</td>
                                        <td>3000 daily</td>
                                        <td>4000 daily</td>
                                        <td>Unlimited </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Page builder</th>
                                        <td>2</td>
                                        <td>10</td>
                                        <td>20</td>
                                        <td>30</td>
                                        <td>40</td>
                                        <td>Unlimited </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Custom domain</th>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Funnel builder</th>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">LMS</th>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Ecommerce Products</th>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Yes</td>
                                        <td>Unlimited</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="whatapp">Upload list</th>
                                        <td>Can upload list but wont work for email</td>
                                        <td>Can upload list but wont work for email</td>
                                        <td>Can upload list but wont work for email</td>
                                        <td>Can upload list but wont work for email</td>
                                        <td>Can upload list and it will work for email</td>
                                        <td>Can upload List and it will work for email</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Use your own email server (AWS, etc)</th>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>No</td>
                                        <td>Yes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Pricing Ends -->

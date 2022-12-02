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

<!-- Pricing -->
<section class="Pricing">
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
                        <div class="price-switcher-period price-switcher-period__monthly active" id="checbox" onclick="check()">Monthly</div>
                        <div class="price-switcher-period price-switcher-period__yearly">Annually</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        Free
                    </p>
                    <h1>
                        $0/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        STARTER
                    </p>
                    <h1>
                        $100/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        STANDARD
                    </p>
                    <h1>
                        $200/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        ESSENCIAL
                    </p>
                    <h1>
                        $300/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        PREMIUM
                    </p>
                    <h1>
                        $400/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="message">
                    <p>
                        ENTERPRISE
                    </p>
                    <h1>
                        $500/<span>month</span>
                    </h1>
                    <a href="">
                        <button>START FOR FREE</button>
                    </a>
                </div>
            </div>
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
                                        <td>14 daily</td>
                                        <td>100 daily</td>
                                        <td>1000 daily</td>
                                        <td>2000 daily</td>
                                        <td>3000 daily</td>
                                        <td>Unlimited daily</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>1 WhatsApp</td>
                                        <td>2 WhatsApp</td>
                                        <td>3 WhatsApp</td>
                                        <td>4 WhatsApp</td>
                                        <td>5 WhatsApp</td>
                                        <td>6 WhatsApp</td>
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
                                        <td>Can upload</td>
                                        <td>Can upload</td>
                                        <td>Can upload</td>
                                        <td>Can upload</td>
                                        <td>Can upload</td>
                                        <td>Can upload List</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"></th>
                                        <td>list but wont work for email </td>
                                        <td>list but wont work for email </td>
                                        <td>list but wont work for email </td>
                                        <td>list but wont work for email</td>
                                        <td>and it will work for email </td>
                                        <td>and it will work for email </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Upload List</th>
                                        <td>wont work for email  </td>
                                        <td>wont work for email  </td>
                                        <td>wont work for email  </td>
                                        <td>list but wont work for email</td>
                                        <td>it will work for email </td>
                                        <td>it will work for email</td>
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
</section>
<!-- Pricing Ends -->

@endsection
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>{{$store->name}} | Oja Funnel | StoreFront</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="title" name="{{$store->name}} | Oja Funnel | StoreFront" />
    <meta content="description" name="{{$store->description}} | Oja Funnel | StoreFront" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{Storage::url($store->logo)}}" />

    <!-- App Css-->
    <link href="{{URL::asset('dash/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Css -->
    <link href="{{URL::asset('dash/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{URL::asset('dash/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- style Css -->
    <link href="{{URL::asset('dash/assets/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- App Css-->
    <!-- Font Css-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
        .hide {
            display: none !important;
        }
        #valid-msg,  #confirmvalid-msg{
            color: green !important;
            font-size: 12px !important;
        }
        #error-msg, #confirmerror-msg, #emailError, #confirmEmailError{
            color: red !important;
            font-size: 12px !important;
        }
    </style>
</head>

<body class="bg-white">
  <header class="pt-4">
    <div class="container">
      <div class="row justify-content-between align-items-center">
        <div class="col-4 d-flex align-items-center">
            <a href="{{route('user.stores.link', $store->name)}}" style="display: contents;">
                <img src="{{Storage::url($store->logo) ?? URL::asset('dash/assets/image/store-logo.png')}}" alt="" width="40" />
                <h3 class="mt-3 px-2">{{$store->name}}</h3>
            </a>
        </div>
        <div class="col-4">
          <form class="app-search d-none d-lg-block">
            <div class="position-relative">
              <input type="text" class="form-control" placeholder="Search...">
              <span class="bx bx-search-alt"></span>
            </div>
          </form>
        </div>
        <div class="col-3 d-flex align-items-center justify-content-between">
          <div>
            @auth
                <a href="{{route('user.my.store', Auth::user()->username)}}">Go to store</a>
            @else
                <a href="{{route('index')}}">Set up your own store</a>
            @endauth
          </div>

            {{-- <a href="{{route('user.cart', Auth::user()->username)}}">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-cart-check"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}
                </button>
            </a> --}}
            <div class="dropdown">
                <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                </button>

                <div class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton1">
                    <div class="row total-header-section">
                        <div class="col-lg-6 col-sm-6 col-6">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
                        </div>
                        @php $total = 0 @endphp
                        @foreach((array) session('cart') as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                        @endforeach
                        <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                            <p>Total: <span class="text-info">$ {{ $total }}</span></p>
                        </div>
                    </div>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            <div class="row cart-detail">
                                <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                    <img style="width: 70px" src="{{ Storage::url($details['image']) }}" />
                                </div>
                                <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                                    <p>{{ $details['name'] }}</p>
                                    <span class="price text-info"> ${{ $details['price'] }}</span> <span class="count"> Quantity:{{ $details['quantity'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                            <a href="{{ route('cart', $store->name) }}" class="btn btn-primary btn-block">View all</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </header>
  <div class="acc-border my-4"></div>

  <div class="container">
    <div class="page-content">
        <!-- container-fluid -->
        <div class="">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between mt-4">
                        <h4 class="mb-sm-0 font-size-18">Checkout Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.stores.link', $store->name)}}">Home</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="checkout-tabs mb-4">
                    <div class="row">
                        <div class="col-xl-2 col-sm-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-shipping-tab" data-bs-toggle="pill" href="#v-pills-shipping" role="tab" aria-controls="v-pills-shipping" aria-selected="true">
                                    <i class="bi bi-person-circle d-block check-nav-icon mt-4 mb-2"></i>

                                    <p class="fw-bold mb-4">Customer Info</p>
                                </a>
                                <a class="nav-link" id="v-pills-payment-tab" data-bs-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false">
                                    <i class="bx bx-money d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Payment Info</p>
                                </a>
                                <a class="nav-link" id="v-pills-confir-tab" data-bs-toggle="pill" href="#v-pills-confir" role="tab" aria-controls="v-pills-confir" aria-selected="false">
                                    <i class="bx bx-badge-check d-block check-nav-icon mt-4 mb-2"></i>
                                    <p class="fw-bold mb-4">Confirmation</p>
                                    <div class="Editt">

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-sm-9">
                            <div class="card">
                                <div class="card-body">
                                    <form action="
                                        {{
                                            route('payment.checkout', [
                                                'storename' => $store->name,
                                                'promotion_id' => Request::get('promotion_id'),
                                                'product_id' => Request::get('product_id'),
                                            ])
                                        }}
                                    " id="checkoutForm" method="post">
                                        @csrf
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-shipping" role="tabpanel" aria-labelledby="v-pills-shipping-tab">
                                                <div>
                                                    <h4 class="card-title">Customer information</h4>
                                                    <p class="card-title-desc">Fill all information below</p>

                                                        <div class="form" id="myForm">
                                                            <span style="color: red" id="error"></span>
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Name *</label>
                                                                    <input type="text" name="name" id="name" placeholder="Enter your name" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Email *</label>
                                                                    <input type="email" name="email" id="email" class="customer_email" placeholder="Enter your email" required />
                                                                </div>

                                                                <input type="hidden" name="product_id" class="product_id" value="{{ Request::get('product_id') }}" />

                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Phone Number *</label>
                                                                    <input type="tel" name="phoneNo" id="phoneNo" placeholder="Enter your number" required />
                                                                    <span id="valid-msg" class="help-block hide">✓ Valid</span>
					                                                <span id="error-msg" class="help-block hide"></span>
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Address *</label>
                                                                    <input type="text" name="address" id="address" placeholder="Enter your address" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">State *</label>
                                                                    <input type="tel" name="state" id="state" placeholder="Enter your state" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <label for="Name">Country *</label>
                                                                    <select name="country" id="country" required>
                                                                        <option value="" selected="selected">Select Country</option>
                                                                        <option value="United States">United States</option>
                                                                        <option value="United Kingdom">United Kingdom</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                        <option value="Algeria">Algeria</option>
                                                                        <option value="American Samoa">American Samoa</option>
                                                                        <option value="Andorra">Andorra</option>
                                                                        <option value="Angola">Angola</option>
                                                                        <option value="Anguilla">Anguilla</option>
                                                                        <option value="Antarctica">Antarctica</option>
                                                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                        <option value="Argentina">Argentina</option>
                                                                        <option value="Armenia">Armenia</option>
                                                                        <option value="Aruba">Aruba</option>
                                                                        <option value="Australia">Australia</option>
                                                                        <option value="Austria">Austria</option>
                                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                                        <option value="Bahamas">Bahamas</option>
                                                                        <option value="Bahrain">Bahrain</option>
                                                                        <option value="Bangladesh">Bangladesh</option>
                                                                        <option value="Barbados">Barbados</option>
                                                                        <option value="Belarus">Belarus</option>
                                                                        <option value="Belgium">Belgium</option>
                                                                        <option value="Belize">Belize</option>
                                                                        <option value="Benin">Benin</option>
                                                                        <option value="Bermuda">Bermuda</option>
                                                                        <option value="Bhutan">Bhutan</option>
                                                                        <option value="Bolivia">Bolivia</option>
                                                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                        <option value="Botswana">Botswana</option>
                                                                        <option value="Bouvet Island">Bouvet Island</option>
                                                                        <option value="Brazil">Brazil</option>
                                                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                                        <option value="Bulgaria">Bulgaria</option>
                                                                        <option value="Burkina Faso">Burkina Faso</option>
                                                                        <option value="Burundi">Burundi</option>
                                                                        <option value="Cambodia">Cambodia</option>
                                                                        <option value="Cameroon">Cameroon</option>
                                                                        <option value="Canada">Canada</option>
                                                                        <option value="Cape Verde">Cape Verde</option>
                                                                        <option value="Cayman Islands">Cayman Islands</option>
                                                                        <option value="Central African Republic">Central African Republic</option>
                                                                        <option value="Chad">Chad</option>
                                                                        <option value="Chile">Chile</option>
                                                                        <option value="China">China</option>
                                                                        <option value="Christmas Island">Christmas Island</option>
                                                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                                        <option value="Colombia">Colombia</option>
                                                                        <option value="Comoros">Comoros</option>
                                                                        <option value="Congo">Congo</option>
                                                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                                        <option value="Cook Islands">Cook Islands</option>
                                                                        <option value="Costa Rica">Costa Rica</option>
                                                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                                        <option value="Croatia">Croatia</option>
                                                                        <option value="Cuba">Cuba</option>
                                                                        <option value="Cyprus">Cyprus</option>
                                                                        <option value="Czech Republic">Czech Republic</option>
                                                                        <option value="Denmark">Denmark</option>
                                                                        <option value="Djibouti">Djibouti</option>
                                                                        <option value="Dominica">Dominica</option>
                                                                        <option value="Dominican Republic">Dominican Republic</option>
                                                                        <option value="Ecuador">Ecuador</option>
                                                                        <option value="Egypt">Egypt</option>
                                                                        <option value="El Salvador">El Salvador</option>
                                                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                        <option value="Eritrea">Eritrea</option>
                                                                        <option value="Estonia">Estonia</option>
                                                                        <option value="Ethiopia">Ethiopia</option>
                                                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                                        <option value="Faroe Islands">Faroe Islands</option>
                                                                        <option value="Fiji">Fiji</option>
                                                                        <option value="Finland">Finland</option>
                                                                        <option value="France">France</option>
                                                                        <option value="French Guiana">French Guiana</option>
                                                                        <option value="French Polynesia">French Polynesia</option>
                                                                        <option value="French Southern Territories">French Southern Territories</option>
                                                                        <option value="Gabon">Gabon</option>
                                                                        <option value="Gambia">Gambia</option>
                                                                        <option value="Georgia">Georgia</option>
                                                                        <option value="Germany">Germany</option>
                                                                        <option value="Ghana">Ghana</option>
                                                                        <option value="Gibraltar">Gibraltar</option>
                                                                        <option value="Greece">Greece</option>
                                                                        <option value="Greenland">Greenland</option>
                                                                        <option value="Grenada">Grenada</option>
                                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                                        <option value="Guam">Guam</option>
                                                                        <option value="Guatemala">Guatemala</option>
                                                                        <option value="Guinea">Guinea</option>
                                                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                                                        <option value="Guyana">Guyana</option>
                                                                        <option value="Haiti">Haiti</option>
                                                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                                        <option value="Honduras">Honduras</option>
                                                                        <option value="Hong Kong">Hong Kong</option>
                                                                        <option value="Hungary">Hungary</option>
                                                                        <option value="Iceland">Iceland</option>
                                                                        <option value="India">India</option>
                                                                        <option value="Indonesia">Indonesia</option>
                                                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                                        <option value="Iraq">Iraq</option>
                                                                        <option value="Ireland">Ireland</option>
                                                                        <option value="Israel">Israel</option>
                                                                        <option value="Italy">Italy</option>
                                                                        <option value="Jamaica">Jamaica</option>
                                                                        <option value="Japan">Japan</option>
                                                                        <option value="Jordan">Jordan</option>
                                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                                        <option value="Kenya">Kenya</option>
                                                                        <option value="Kiribati">Kiribati</option>
                                                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                                        <option value="Latvia">Latvia</option>
                                                                        <option value="Lebanon">Lebanon</option>
                                                                        <option value="Lesotho">Lesotho</option>
                                                                        <option value="Liberia">Liberia</option>
                                                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                                        <option value="Liechtenstein">Liechtenstein</option>
                                                                        <option value="Lithuania">Lithuania</option>
                                                                        <option value="Luxembourg">Luxembourg</option>
                                                                        <option value="Macao">Macao</option>
                                                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                                        <option value="Madagascar">Madagascar</option>
                                                                        <option value="Malawi">Malawi</option>
                                                                        <option value="Malaysia">Malaysia</option>
                                                                        <option value="Maldives">Maldives</option>
                                                                        <option value="Mali">Mali</option>
                                                                        <option value="Malta">Malta</option>
                                                                        <option value="Marshall Islands">Marshall Islands</option>
                                                                        <option value="Martinique">Martinique</option>
                                                                        <option value="Mauritania">Mauritania</option>
                                                                        <option value="Mauritius">Mauritius</option>
                                                                        <option value="Mayotte">Mayotte</option>
                                                                        <option value="Mexico">Mexico</option>
                                                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                                        <option value="Monaco">Monaco</option>
                                                                        <option value="Mongolia">Mongolia</option>
                                                                        <option value="Montserrat">Montserrat</option>
                                                                        <option value="Morocco">Morocco</option>
                                                                        <option value="Mozambique">Mozambique</option>
                                                                        <option value="Myanmar">Myanmar</option>
                                                                        <option value="Namibia">Namibia</option>
                                                                        <option value="Nauru">Nauru</option>
                                                                        <option value="Nepal">Nepal</option>
                                                                        <option value="Netherlands">Netherlands</option>
                                                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                        <option value="New Caledonia">New Caledonia</option>
                                                                        <option value="New Zealand">New Zealand</option>
                                                                        <option value="Nicaragua">Nicaragua</option>
                                                                        <option value="Niger">Niger</option>
                                                                        <option value="Nigeria">Nigeria</option>
                                                                        <option value="Niue">Niue</option>
                                                                        <option value="Norfolk Island">Norfolk Island</option>
                                                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                                        <option value="Norway">Norway</option>
                                                                        <option value="Oman">Oman</option>
                                                                        <option value="Pakistan">Pakistan</option>
                                                                        <option value="Palau">Palau</option>
                                                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                                        <option value="Panama">Panama</option>
                                                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                                                        <option value="Paraguay">Paraguay</option>
                                                                        <option value="Peru">Peru</option>
                                                                        <option value="Philippines">Philippines</option>
                                                                        <option value="Pitcairn">Pitcairn</option>
                                                                        <option value="Poland">Poland</option>
                                                                        <option value="Portugal">Portugal</option>
                                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                                        <option value="Qatar">Qatar</option>
                                                                        <option value="Reunion">Reunion</option>
                                                                        <option value="Romania">Romania</option>
                                                                        <option value="Russian Federation">Russian Federation</option>
                                                                        <option value="Rwanda">Rwanda</option>
                                                                        <option value="Saint Helena">Saint Helena</option>
                                                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                        <option value="Saint Lucia">Saint Lucia</option>
                                                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                                        <option value="Samoa">Samoa</option>
                                                                        <option value="San Marino">San Marino</option>
                                                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                                        <option value="Senegal">Senegal</option>
                                                                        <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                                                        <option value="Seychelles">Seychelles</option>
                                                                        <option value="Sierra Leone">Sierra Leone</option>
                                                                        <option value="Singapore">Singapore</option>
                                                                        <option value="Slovakia">Slovakia</option>
                                                                        <option value="Slovenia">Slovenia</option>
                                                                        <option value="Solomon Islands">Solomon Islands</option>
                                                                        <option value="Somalia">Somalia</option>
                                                                        <option value="South Africa">South Africa</option>
                                                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                                        <option value="Spain">Spain</option>
                                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                                        <option value="Sudan">Sudan</option>
                                                                        <option value="Suriname">Suriname</option>
                                                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                                        <option value="Swaziland">Swaziland</option>
                                                                        <option value="Sweden">Sweden</option>
                                                                        <option value="Switzerland">Switzerland</option>
                                                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                                        <option value="Tajikistan">Tajikistan</option>
                                                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                                        <option value="Thailand">Thailand</option>
                                                                        <option value="Timor-leste">Timor-leste</option>
                                                                        <option value="Togo">Togo</option>
                                                                        <option value="Tokelau">Tokelau</option>
                                                                        <option value="Tonga">Tonga</option>
                                                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                        <option value="Tunisia">Tunisia</option>
                                                                        <option value="Turkey">Turkey</option>
                                                                        <option value="Turkmenistan">Turkmenistan</option>
                                                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                        <option value="Tuvalu">Tuvalu</option>
                                                                        <option value="Uganda">Uganda</option>
                                                                        <option value="Ukraine">Ukraine</option>
                                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                                        <option value="United Kingdom">United Kingdom</option>
                                                                        <option value="United States">United States</option>
                                                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                                        <option value="Uruguay">Uruguay</option>
                                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                                        <option value="Vanuatu">Vanuatu</option>
                                                                        <option value="Venezuela">Venezuela</option>
                                                                        <option value="Viet Nam">Viet Nam</option>
                                                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                                        <option value="Western Sahara">Western Sahara</option>
                                                                        <option value="Yemen">Yemen</option>
                                                                        <option value="Zambia">Zambia</option>
                                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                                    </select>
                                                                </div>
                                                                <div class="text-end mt-2">
                                                                    <a class="nav-link" class="text-decoration-none">
                                                                        <button type="button" id="activePayment" class="btn px-4 py-1" style="color: #714091; border: 1px solid #714091">
                                                                            Next
                                                                        </button>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                                                <div>
                                                    <h4 class="card-title">Payment information</h4>
                                                    <p class="card-title-desc">Select payment below</p>
                                                    @foreach(App\Models\PaymentGateway::latest()->where('status', 'Active')->get() as $payment)
                                                        @if($payment->name == 'Paystack' && $store->currency == 'NGN')
                                                        <div class="mt-3">
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                            </div>
                                                        </div>
                                                        @elseif(($payment->name == 'Flutterwave') && ($store->currency == 'NGN' || $store->currency == 'USD' || $store->currency == 'GBP'))
                                                        <div class="mt-3">
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                            </div>
                                                        </div>
                                                        @elseif(($payment->name == 'Stripe') && ($store->currency == 'USD' || $store->currency == 'GBP' || $store->currency == 'EUR'))
                                                        <div class="mt-3">
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                            </div>
                                                        </div>
                                                        @elseif(($payment->name == 'Paypal') && ($store->currency == 'USD' || $store->currency == 'GBP' || $store->currency == 'EUR'))
                                                        <div class="mt-3">
                                                            <div class="form-check form-check-inline font-size-16">
                                                                <input class="form-check-input" type="radio" name="paymentOptions" id="paymemtOptions" value="{{$payment->name}}">
                                                                <label class="form-check-label font-size-13" for="paymentoptionsRadio1"><img src="{{URL::asset($payment->logo)}}" alt="{{$payment->name}}" class="me-1 font-size-20 align-top" width="15"/> {{$payment->name}}</label>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    @endforeach
                                                    <div class="text-end mt-2">
                                                        <a type="button" class="text-decoration-none">
                                                            <button type="button" class="btn px-4 py-1" id="activeconfirm" style="color: #714091; border: 1px solid #714091">
                                                                Next
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-confir" role="tabpanel" aria-labelledby="v-pills-confir-tab">
                                                <div class="card shadow-none border mb-0">
                                                    <div class="card-body">
                                                        <!-- <h4 class="card-title ">Note</h4> -->
                                                        {{-- <h6 class="mb-4"><span class="text-danger">Note:</span> Kindly check your email to download your digital products.</h6> --}}

                                                        <h4 class="card-title mb-4">Order Summary</h4>
                                                        <div class="table-responsive">
                                                            <table class="table align-middle mb-0 table-nowrap">
                                                                <thead class="tread">
                                                                    <tr>
                                                                        <th scope="col">Product</th>
                                                                        <th scope="col">Product Desc</th>
                                                                        <th scope="col">Price</th>
                                                                        <th scope="col">Quantity</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php $total = 0 @endphp
                                                                    @if(session('cart'))
                                                                        @foreach(session('cart') as $id => $details)
                                                                        @php $total += $details['price'] * $details['quantity'] @endphp
                                                                            <tr>
                                                                                <th scope="row"><img src="{{ Storage::url($details['image']) }}" alt="product-img" title="product-img" class="avatar-md"></th>
                                                                                <td>
                                                                                    <h5 class="font-size-14 text-truncate"><a href="javascrit(0);" class="text-dark"><span class="badge badge-success" style="background: green">({{\App\Models\StoreProduct::getProductLabel($details['id'])}} Product)</span><br />{{ $details['name'] }} </a></h5>
                                                                                </td>
                                                                                <td>{{$store->currency_sign}} {{ $details['price'] }}</td>
                                                                                <td>{{ $details['quantity'] }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <h6 class="m-0 text-end">Total:</h6>
                                                                        </td>
                                                                        <td>
                                                                        {{$store->currency_sign}} <input id="AmountToPay" value="" name="amountToPay" style="border: none; outline: none;">
                                                                            <input type="hidden" id="couponDiscount" value="" name="">
                                                                            <input type="hidden" id="couponID" value="" name="couponID">
                                                                            <input type="hidden" id="totalAmount" value="{{ $total }}" name="totalAmount">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <h4 class="card-title mt-4 mb-4">Have a coupon? <a href="#" onclick="myFunction()">Click here to enter your code</a></h4>
                                                        <span style="color: red" id="couponerror"></span>
                                                        <span style="color: green" id="couponsuccess"></span>
                                                        <form>
                                                            <div class="form" id="myDIV" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-lg-6 mt-1 mb-4">
                                                                        <p>If you have a coupon code, please apply it below.</p>
                                                                        <div style="display: block ruby;">
                                                                            <input type="text" name="coupon" id="coupon" required />
                                                                            <input type="button" id="submitCoupon" value="Apply Coupon" style="background: #556ee6; padding: .8rem; color: #fff;"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <div class="form" style="display: none;" id="stripePayment">
                                                            <h5 class="mt-3 mb-3 font-size-15">For Stripe Payment</h5>
                                                            <div class="row">
                                                                <div class="col-12 mb-4">
                                                                    <label for="Name">Name on card</label>
                                                                    <input type="text" name="cardName" id="card-name" placeholder="Enter card name" required />
                                                                </div>
                                                                <div class="col-lg-6 mb-4">
                                                                    <div id="card"></div>
                                                                </div>
                                                                <div class="row mt-4">
                                                                    <div class="col-sm-6">
                                                                        <button type="submit" class="btn btn-success text-white d-none d-sm-inline-block">
                                                                            PLACE ORDER
                                                                        </button>
                                                                    </div> <!-- end col -->
                                                                    <!-- end col -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4" style="display: none;" id="paystackPayment">
                                                            <div class="col-sm-6">
                                                                <button type="button" id="makePayment" class="btn btn-success text-white d-none d-sm-inline-block">
                                                                    PLACE ORDER
                                                                </button>
                                                            </div> <!-- end col -->
                                                            <!-- end col -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page-content -->
    </div>

    <footer class="footer">
        <div class="container">
        <div class="row">
            <div class="col-sm-12 mb-2 mt-5">
            <div class="text-center text-dark">Copyright ©
                <script>
                document.write(new Date().getFullYear())
                </script> {{config('app.name')}} | All Right Reserved
            </div>
            </div>
        </div>
        </div>
    </footer>
    <!-- Button trigger modal -->

    <input type="hidden" value="{{ csrf_token() }}" id="txt_token1">
    <input type="hidden" value="{{ url('/') }}/" id="site_url">

    <!-- JAVASCRIPT -->
    <script src="{{URL::asset('dash/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{URL::asset('dash/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{URL::asset('dash/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://checkout.flutterwave.com/v3.js"></script>

    <script>
        $(document).ready(function () {
            // $('#paystackPayment').show();
            // Handle radio button change event
            $('input[name="paymentOptions"]').change(function () {
                // Check if the selected option is Stripe
                if ($(this).val() === 'Stripe') {
                    $('#stripePayment').show();
                    $('#paystackPayment').hide();
                } else if ($(this).val() === 'Flutterwave') {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                } else if ($(this).val() === 'Paypal') {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                } else {
                    $('#stripePayment').hide();
                    $('#paystackPayment').show();
                }
            });

            // Handle initial state
            if ($('input[name="paymentOptions"]:checked').val() === 'Stripe') {
                $('#stripePayment').show();
            }
        });

        var token = $('#txt_token1').val();
        var site_url = $('#site_url').val();

        window.onload=function(){
            $discount = $('#totalAmount').val() - $('#couponDiscount').val();
            $('#AmountToPay').val($discount);
        };

        $("#activePayment").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == ''  || $('#address').val() == ''  || $('#state').val() == '' || $('#country').val() == '' || $('#paymemtOptions').val() == '') {
                $('#error').html('Please fill the asterisks field to continue');
            } else {
                if($('.customer_email').val() !== ""){
                    var datastring='customer_email='+$('.customer_email').val()
                    +'&product_id='+$('.product_id').val()
                    +'&product_type=products'
                    +'&_token='+token;

                    $.ajax({
                        type: "POST",
                        url : site_url + "store-cart-details-tmp", // store users email temporary, delete back if they complete the payment
                        data: datastring,
                        cache: false,
                        timeout: 30000, // 30 second timeout
                        success : function(data){}
                    });
                }

                $('#v-pills-shipping-tab').removeClass('active')
                $('#v-pills-shipping').removeClass('show active')
                $('#v-pills-payment-tab').addClass('active')
                $('#v-pills-payment').addClass('show active')
            }
        })

        $("#activeconfirm").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == ''  || $('#address').val() == ''  || $('#state').val() == '' || $('#country').val() == '') {
                $('#error').html('Please fill the asterisks field to continue');
            } else {
                $('#v-pills-payment-tab').removeClass('active')
                $('#v-pills-payment').removeClass('show active')
                $('#v-pills-confir-tab').addClass('active')
                $('#v-pills-confir').addClass('show active')
            }
        })

        $("#makePayment").click(function() {
            if ($('#name').val() == '' || $('#email').val() == '' || $('#phoneNo').val() == '' || $('#address').val() == '' || $('#state').val() == '' || $('#country').val() == '' || !$('input[name="paymentOptions"]:checked').val()) {
                alert('Please fill in the required fields to continue');
                $('#error').html('Please fill in the required fields to continue');
            } else {
                var selectedPaymentOption = $('input[name="paymentOptions"]:checked').val();
                var checkoutForm = document.getElementById('checkoutForm');

                if (selectedPaymentOption == 'Paypal') {
                    // Prevent the default form submission
                    event.preventDefault();
                    // Your conditions are met, trigger the form submission asynchronously
                    // checkoutForm.submit();
                } else if (selectedPaymentOption == 'Flutterwave') {
                    $.ajax({
                        method: 'GET',
                        url: '/retrieve/payment/' + 'Flutterwave', // Replace with your actual backend endpoint
                        success: function(response) {
                            // Get the base URL of the current page
                            var baseUrl = window.location.origin;

                            // Configure FlutterwaveCheckout
                            FlutterwaveCheckout({
                                public_key: response.FLW_PUBLIC_KEY,
                                tx_ref: ''+Math.floor((Math.random() * 1000000000) + 1),
                                amount: document.getElementById("AmountToPay").value, // Amount in cents (e.g., $50.00 is 5000 cents)
                                currency: '{{$store->currency}}',
                                payment_options: "card",
                                customer: {
                                    email: $('#email').val(), // Replace with your user's email
                                },
                                customizations: {
                                    title: 'Product Purchase',
                                    description: 'Purchased Products',
                                    logo: baseUrl + '/dash/assets/images/Logo-fav.png', // Replace 'your-logo.png' with the actual path to your logo in the public folder
                                },
                                callback: function(response) {
                                    console.log(response);
                                    // Handle the response after successful payment
                                    alert('Payment successful!');
                                    $( "#checkoutForm" ).submit();
                                },
                                onclose: function() {
                                    console.log('Payment closed');
                                    // Handle actions when the payment modal is closed
                                }
                            });
                        },
                        error: function(error) {
                            console.error("Error fetching payment details:", error);
                        }
                    });
                } else if (selectedPaymentOption == 'Paystack') {
                    $.ajax({
                        method: 'GET',
                        url: '/retrieve/payment/' + 'Paystack', // Replace with your actual backend endpoint
                        success: function(response) {
                            var handler = PaystackPop.setup({
                                key: response.PAYSTACK_PUBLIC_KEY,
                                email: $('#email').val(),
                                amount: document.getElementById("AmountToPay").value * 100,
                                ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                                callback: function(response){
                                    // let url = '{{ route("user.transaction.confirm", [':response', ':amount']) }}';
                                    // url = url.replace(':response', response.reference);
                                    // url = url.replace(':amount', document.getElementById("amount").value);
                                    // document.location.href=url;
                                    $( "#checkoutForm" ).submit();
                                },
                                onClose: function(){
                                    alert('window closed');
                                }
                            });
                            handler.openIframe();
                        },
                        error: function(error) {
                            console.error("Error fetching payment details:", error);
                        }
                    });
                } else {
                    // Handle other payment gateways or show an error message
                    alert('Unsupported payment option');
                }
            }
        })

        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        $("#submitCoupon").click(function()
        {
            if ($('#coupon').val() == '') {
                $('#couponerror').html('Please fill the coupon field to continue.');
            } else {

                $coupon = $('#coupon').val();
                $totalAmount = $('#totalAmount').val();
                $.ajax({
                url: "{{ route('user.store.check.coupon') }}",
                    method: "post",
                    data: {
                        _token: '{{ csrf_token() }}',
                        coupon: $coupon,
                        totalAmount: $totalAmount,
                    },
                    success: function (response) {
                        if(response['success'] === true)
                        {
                            $('#couponerror').hide();
                            $('#couponsuccess').show();
                            $('#couponsuccess').html(response['message']);
                            $('#couponDiscount').val(response['data'])
                            $('#couponID').val(response['id'])
                            $discount = $('#totalAmount').val() - response['data'];
                            $('#AmountToPay').val($discount);
                            $('#coupon').val('')
                        } else {
                            $('#couponsuccess').hide();
                            $('#couponerror').show();
                            $('#couponerror').html(response['message']);
                        }
                    }
                });
            }
        });

        $.ajax({
            method: 'GET',
            url: '/retrieve/payment/' + 'Stripe', // Replace with your actual backend endpoint
            success: function(response) {
                let stripe = Stripe(response.STRIPE_KEY);
                const elements = stripe.elements();
                const cardElement = elements.create('card', {
                    style: {
                        base: {
                            fontSize: '16px'
                        }
                    }
                });

                const checkoutForm = document.getElementById('checkoutForm');
                const cardName = document.getElementById('card-name');
                cardElement.mount('#card');

                checkoutForm.addEventListener('submit', async (e) => {
                    e.preventDefault();

                    const { paymentMethod, error } = await stripe.createPaymentMethod({
                        type: 'card',
                        card: cardElement,
                        billing_details: {
                            name: cardName.value
                        }
                    });

                    if (error) {
                        console.log('error');
                    } else {
                        let input = document.createElement('input');
                        input.setAttribute('type', 'hidden');
                        input.setAttribute('name', 'payment_method');
                        input.setAttribute('value', paymentMethod.id);
                        checkoutForm.appendChild(input);

                        // Directly submit the form
                        checkoutForm.submit();
                    }
                });
            },
            error: function(error) {
                console.error("Error fetching payment details:", error);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
    <script>
        const input = document.querySelector("#phoneNo");
        const errorMsg = document.querySelector("#error-msg");
        const validMsg = document.querySelector("#valid-msg");
        let validationTimeout;

        // here, the index maps to the error code returned from getValidationError - see readme
        const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        // initialise plugin
        const iti = window.intlTelInput(input, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            initialCountry: "auto", // Automatically select the user's country
            separateDialCode: true, // Add a space between the country code and the phone number
            placeholderNumberType: "MOBILE", // Set the placeholder to match the user's mobile number format
            nationalMode: false, // Do not automatically switch to national mode
        });

        const updateMessages = () => {
            clearTimeout(validationTimeout);
            reset();
            if (input.value.trim()) {
                validationTimeout = setTimeout(() => {
                    if (iti.isValidNumber()) {
                        validMsg.classList.remove("hide");
                    } else {
                        input.classList.add("error");
                        const errorCode = iti.getValidationError();
                        errorMsg.innerHTML = errorMap[errorCode];
                        errorMsg.classList.remove("hide");
                    }
                }, 300); // Adjust the delay time as needed (in milliseconds)
            }
        };

        const reset = () => {
            input.classList.remove("error");
            errorMsg.innerHTML = "";
            errorMsg.classList.add("hide");
            validMsg.classList.add("hide");
        };

        // on input: validate with slight delay
        input.addEventListener('input', updateMessages);

        // on keyup / change flag: reset
        input.addEventListener('change', reset);
        input.addEventListener('keyup', reset);

        // Set the initial value of the input to include the selected country code
        input.addEventListener('countrychange', () => {
            const countryCodeValue = iti.getSelectedCountryData().dialCode;
            input.value = `+${countryCodeValue}`;
        });
    </script>
    <style>
        .iti {
            display: block !important;
        }

        .iti__country-list {
            z-index: 2000 !important;
        }

        .iti__country-name {
            color: #000 !important;
        }

        .iti__dial-code {
            color: #000 !important;
        }
        .thumbnail {
            position: relative;
            padding: 0px;
            margin-bottom: 20px;
        }
        .thumbnail img {
            width: 80%;
        }
        .thumbnail .caption{
            margin: 7px;
        }
        .main-section{
            background-color: #F8F8F8;
        }
        .dropdown button.btn-info{
            /* float:right;
            padding-right: 30px; */
            color: {{$store->color}};
            background: {{$store->theme}};
        }
        .btn-success{
            color: {{$store->color}} !important;
            background: {{$store->theme}} !important;
        }
        .btn{
            border:0px;
            margin:10px 0px;
            box-shadow:none !important;
        }
        .dropdown .dropdown-menu{
            padding:20px;
            /*top:30px !important;*/
            width:350px !important;
            /*left:-110px !important;*/
            box-shadow:0px 4px 7px #a8a7a7;
        }
        .total-header-section{
            border-bottom:1px solid #d2d2d2;
        }
        .total-section p{
            margin-bottom:20px;
        }
        .cart-detail{
            padding:15px 0px;
        }
        .cart-detail-img img{
            width:100%;
            height:100%;
            padding-left:15px;
        }
        .cart-detail-product p{
            margin:0px;
            color:#000;
            font-weight:500;
        }

        span.text-info{
            color: {{$store->theme}} !important;
        }
        .cart-detail .price{
            font-size:12px;
            margin-right:10px;
            font-weight:500;
        }
        .cart-detail .count{
            color:#C2C2DC;
        }
        .checkout{
            border-top:1px solid #d2d2d2;
            padding-top: 15px;
        }
        .checkout .btn-primary{
            color: {{$store->color}};
            background: {{$store->theme}};
        }
        .dropdown-menu:before{
            content: " ";
            position:absolute;
            top:-20px;
            right:50px;
            border:10px solid transparent;
            border-bottom-color:#fff;
        }
    </style>
</body>
</html>

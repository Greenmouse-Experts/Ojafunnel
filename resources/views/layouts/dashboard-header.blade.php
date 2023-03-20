<!-- place below the html form -->
<header id="page-topbar">
    @include('sweetalert::alert')
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('index')}}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{URL::asset('dash/assets/images/Logo-fav.png')}}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="" class="image-div" />
                    </span>
                </a>

                <a href="{{route('index')}}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{URL::asset('dash/assets/images/Logo-fav.png')}}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" class="image-div" />
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-90 header-item waves-effect" id="vertical-menu-btn">
                <div class="effect">
                    <i class="fa fa-fw fa-bars"></i>
                </div>
            </button>

            <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    <span key="t-megamenu">
                        <div class="convert">Dashboard</div>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-flex">
            <div class="float-end pushing">
                <div class="dropdown">
                    <button type="button" class="btn btn-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-wallet me-1"></i> <span class="d-none d-sm-inline-block">Wallet <i class="mdi mdi-chevron-down"></i></span></button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                        <div class="dropdown-item-text">
                            <div>
                                <p class="text-muted mb-2">Available Balance</p>
                                <h5 class="mb-0">₦{{number_format(Auth::user()->wallet, 2)}}</h5> <button data-bs-toggle="modal" data-bs-target="#emailConfirm">Deposit Now</button>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="fullscreen">
                    <div class="full-screen">
                        <i class="bx bx-fullscreen"></i>
                    </div>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="bell">
                        <i class="bx bx-bell bx-tada"></i>
                        <span class="badge bg-danger rounded-pill">{{App\Models\OjafunnelNotification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->get()->count()}}</span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications">Notifications</h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('user.main.notification', Auth::user()->username)}}" class="small" key="t-view-all"> View All</a>
                            </div>
                        </div>
                    </div>
                    @foreach(App\Models\OjafunnelNotification::latest()->where('to', Auth::user()->id)->where('status', 'Unread')->get()->take(5) as $OjaNotification)
                    <div data-simplebar style="max-height: 230px">
                        <a href="{{route('user.main.notification', Auth::user()->username)}}" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="bx bx-badge-check"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1" key="t-shipped">
                                        {{$OjaNotification->title}}
                                    </h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1" key="t-grammer">
                                            {{$OjaNotification->body}}
                                        </p>
                                        <p class="mb-0">
                                            <i class="mdi mdi-clock-outline"></i>
                                            <span key="t-min-ago">{{$OjaNotification->created_at->diffForHumans()}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{route('user.main.notification', Auth::user()->username)}}">
                            <i class="mdi mdi-arrow-right-circle me-1"></i>
                            <span key="t-view-more">View More..</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="dropdown d-inline-block">
                <button type="button" style="display: flex; align-items: center;" class="btn header-item" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">
                        <div class="hamzat">
                            <b> {{Auth::user()->first_name}} {{Auth::user()->last_name}} </b>
                        </div>
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    <!-- <img class="rounded-circle header-profile-user" src="{{URL::asset('dash/assets/images/users/avatar-1.jpg')}}" alt="Header Avatar" /> -->
                    @if(Auth::user()->photo)
                    <img class="rounded-circle header-profile-user" src="{{Auth::user()->photo}}" alt="{{Auth::user()->first_name}}" width="100%">
                    @else
                    <span class="rounded-circle header-profile-user" style="vertical-align: middle; align-items: center; background: #713f93; color: #fff; display: flex; justify-content: center;">{{ ucfirst(substr(Auth::user()->first_name, 0, 1)) }} {{ ucfirst(substr(Auth::user()->last_name, 0, 1)) }}</span>
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('user.general', Auth::user()->username)}}"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item d-block" href="{{route('user.security', Auth::user()->username)}}"><i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings">Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('logout', Auth::user()->username)}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- email confirm modal -->
<div class="modal fade" id="emailConfirm" tabindex="-1" aria-labelledby="subscribeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Provide Us Your Amount Below
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="Edit-level">
                        <form class="paymentForm">
                            @csrf
                            <div class="form">
                                <div class="col-lg-12">
                                    <label>Amount</label>
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <input type="number" placeholder="Enter Your Amount" id="amount" class="input" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-6">
                                        <button data-bs-dismiss="modal" aria-label="Close" class="btn px-3" style="color: #714091; border: 1px solid #714091">
                                            Cancel
                                        </button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="form-btn btn px-4" type="button" onclick="payWithPaystack()" style="color: #ffffff; background-color: #714091">
                                            Proceed To Payment
                                        </button>
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
<!-- end modal -->

<script>
    var paymentForm = document.querySelector('.paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);

    function payWithPaystack(){
        var handler = PaystackPop.setup({
        key: 'pk_test_dafbbf580555e2e2a10a8d59c6157b328192334d',
        email: '{{Auth::user()->email}}',
        amount: document.getElementById("amount").value * 100,
        ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        callback: function(response){
            // alert(JSON.stringify(response))
            let url = '{{ route("user.transaction.confirm", [":response", ":amount"]) }}';
            url = url.replace(':response', response.reference);
            url = url.replace(':amount', document.getElementById("amount").value);
            document.location.href=url;
        },
        onClose: function(){
            alert('window closed');
        }
        });
    handler.openIframe();
  }
</script>

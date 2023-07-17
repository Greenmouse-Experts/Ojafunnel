

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{URL::asset('admin/assets/images/Logo-fav.png')}}" alt="" height="22" />
                    </span>
                    <span class="logo-lg">
                        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660217514/OjaFunnel-Images/Logo_s0wfpp.png" alt="" class="image-div" />
                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{URL::asset('admin/assets/images/Logo-fav.png')}}" alt="" height="22" />
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
                        <div class="convert">Admin Dashboard</div>
                    </span>
                </button>
            </div>
        </div>
        <div class="d-flex">
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
                        <span class="badge bg-danger rounded-pill">{{App\Models\OjafunnelNotification::latest()->where('admin_id', Auth::guard('admin')->user()->id)->where('status', 'Unread')->get()->count()}}</span>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0" key="t-notifications">Notifications</h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('notification')}}" class="small" key="t-view-all"> View All</a>
                            </div>
                        </div>
                    </div>
                    @foreach(App\Models\OjafunnelNotification::latest()->where('admin_id', Auth::guard('admin')->user()->id)->where('status', 'Unread')->get()->take(5) as $OjaNotification)
                    <div data-simplebar style="max-height: 230px">
                        <a href="javascript: void(0);" class="text-reset notification-item">
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
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{route('notification')}}">
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
                            <b>{{Auth::guard('admin')->user()->name}} </b>
                        </div>
                    </span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    <!-- <img class="rounded-circle header-profile-user" src="{{URL::asset('dash/assets/images/users/avatar-1.jpg')}}" alt="Header Avatar" /> -->

                    <img class="rounded-circle header-profile-user" src="{{URL::asset('dash/assets/images/users/avatar-1.jpg')}}" alt="" width="100%">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('general')}}"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span></a>
                    <a class="dropdown-item d-block" href="{{route('general')}}"><i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings">Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('adminLogout')}}"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                        <span key="t-logout">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>

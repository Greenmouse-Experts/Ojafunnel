<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('user.dashboard', Auth::user()->username)}}">
                        <i class="bi bi-grid"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-envelope-paper"></i>
                        <span key="t-chat">Email Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{route('user.email-marketing.email.kits', Auth::user()->username)}}" key="t-tui-calendar">
                            Email Kits
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.email-marketing.email.templates', Auth::user()->username)}}" key="t-tui-calendar">
                                Email Templates
                            </a>
                        </li>
                        <li>
                            <a href="{{route('user.email-marketing.email.campaigns', Auth::user()->username)}}" key="t-tui-calendar">
                                Email Campaign
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('broadcast-message', Auth::user()->username) }}" key="t-chat">Broadcast</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('user.list.management', Auth::user()->username)}}">
                        <i class="bi bi-person-lines-fill"></i>
                        <span key="t-chat">List Management</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.choose.temp', Auth::user()->username)}}">
                        <i class="bi bi-building"></i>
                        <span key="t-chat">Funnel Builder</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.page.builder', Auth::user()->username)}}">
                        <i class="bi bi-calendar2-check"></i>
                        <span key="t-chat">Page Builder</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.transaction', Auth::user()->username)}}">
                        <i class="bi bi-bank"></i>
                        <span key="t-chat">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-cash-coin"></i>
                        <span key="t-chat">Withdrawal</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.withdrawal', Auth::user()->username)}}" key="t-tui-calendar">Withdraw</a></li>
                        <li><a href="{{route('user.bank.details', Auth::user()->username)}}" key="t-tui-calendar">Bank Details</a></li>
                        <li><a href="{{route('user.other.payment.method', Auth::user()->username)}}" key="t-tui-calendar">Payment Method</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('user.subscription', Auth::user()->username)}}">
                        <i class="bi bi-award"></i>
                        <span key="t-chat">Subscriptions</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-chat-dots"></i>
                        <span key="t-chat">Automation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.whatsapp.wa-number', Auth::user()->username)}}" key="t-tui-calendar">WA Number</a></li>
                        <li><a href="{{route('user.sms.automation', Auth::user()->username)}}" key="t-tui-calendar">SMS Automation</a></li>
                        <li><a href="{{route('user.whatsapp.automation', Auth::user()->username)}}" key="t-tui-calendar">Whatsapp Automation</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-cart2"></i>
                        <span key="t-chat">Ecommerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.check.store', Auth::user()->username)}}" key="t-tui-calendar">My Store</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Stores</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('user.my.store', Auth::user()->username)}}" key="t-list">Create Store</a></li>
                                <li><a href="{{route('user.shops', Auth::user()->username)}}" key="t-list">View Store</a></li>
                                <li><a href="{{route('user.store.coupon', Auth::user()->username)}}" key="t-list">Coupon</a></li>
                                {{-- <li><a href="{{route('user.sales', Auth::user()->username)}}" key="t-overview">View Sales</a>
                        </li>
                        <li><a href="{{route('user.order.details', Auth::user()->username)}}" key="t-overview">Order Details</a></li> --}}
                    </ul>
                </li>
            </ul>
            </li>
            <li>
                <a href="{{route('user.main.promotion', Auth::user()->username)}}">
                    <i class="bi bi-people"></i>
                    <span key="t-chat">Marketplace</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.affiliate.marketing', Auth::user()->username)}}">
                    <i class="bi bi-bookmark"></i>
                    <span key="t-chat">Affiliate Marketing </span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bi bi-tag"></i>
                    <span key="t-chat">Integration</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('user.integration', Auth::user()->username)}}" key="t-tui-calendar">Create Integrations</a></li>
                    <li><a href="{{route('user.manage_integration', Auth::user()->username)}}" key="t-tui-calendar">Manage Integrations</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bi bi-book"></i>
                    <span key="t-chat">Learning Management</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('user.create.course', Auth::user()->username)}}" key="t-tui-calendar">Create Course</a></li>
                    <!-- <li><a href="{{route('user.details', Auth::user()->username)}}" key="t-tui-calendar">Course Details</a></li> -->
                    <!-- <li><a href="{{route('user.shop.course', Auth::user()->username)}}" key="t-chat">Shop Course</a></li> -->
                    <li>
                        <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Shop</a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="{{route('user.create.shop.course', Auth::user()->username)}}" key="t-tui-calendar">Create Shop</a></li>
                            <li><a href="{{route('user.view.course.shops', Auth::user()->username)}}" key="t-tui-calendar">View Shop</a></li>
                            <!-- <li><a href="{{route('user.my.shops.course', Auth::user()->username)}}" key="t-tui-calendar">My Shop</a></li> -->
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{route('user.main.list', Auth::user()->username)}}">
                    <i class="bi bi-balloon"></i>
                    <span key="t-chat">Birthday Modules</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.main.sales', Auth::user()->username)}}">
                    <i class="bi bi-receipt"></i>
                    <span key="t-chat">Sales Analytics</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.reports.analysis', Auth::user()->username)}}">
                    <i class="bi bi-bar-chart"></i>
                    <span key="t-chat">Reports & Analysis</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.main.notification', Auth::user()->username)}}">
                    <i class="bi bi-bell"></i>
                    <span key="t-chat">Notifications</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.upgrade', Auth::user()->username)}}">
                    <i class="bi bi-send-check"></i>
                    <span key="t-chat">Upgrade</span>
                </a>
            </li>
            <li>
                <a href="{{route('user.main.support', Auth::user()->username)}}">
                    <i class="bi bi-chat"></i>
                    <span key="t-chat">Support</span>
                </a>
            </li>
            <li>
                <a href="javascript: void(0);" class="has-arrow">
                    <i class="bi bi-sliders2"></i>
                    <span key="t-chat">Settings</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{route('user.general', Auth::user()->username)}}" key="t-tui-calendar">General</a></li>
                    <li><a href="{{route('user.security', Auth::user()->username)}}" key="t-full-calendar">Security</a></li>
                </ul>
            </li>
            <li>
                <a href="/logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span key="t-chat">Log Out</span>
                </a>
            </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->

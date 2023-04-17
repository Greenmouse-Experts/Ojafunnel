<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('adminDashboard')}}">
                        <i class="bi bi-grid"></i>
                        <span key="t-dashboards">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('view_users')}}">
                        <i class="bi bi-person"></i>
                        <span key="t-dashboards">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-person-check"></i>
                        <span key="t-dashboards">Subscriptions</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.subcribers')}}" key="t-full-calendar">Subscribers</a></li>
                        <!-- <li><a href="{{route('admin.unscribers')}}" key="t-full-calendar">Unsubscribers</a></li> -->
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Plans</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('add_plans')}}" key="t-full-calendar">Add Plan</a></li>
                                <li><a href="{{route('manage_plans')}}" key="t-full-calendar">Manage Plan</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-envelope-check"></i>
                        <span key="t-chat">Email Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('admin.email-marketing.email-kits') }}" key="t-tui-calendar">
                            Email Kits
                            </a>
                        </li>
                        {{-- <li>
                            <a href="/test-2" key="t-tui-calendar">
                                Email Templates
                            </a>
                        </li> --}}
                        <li>
                            <a href="{{ route('admin.email-marketing.email-lists') }}" key="t-tui-calendar">
                                Email Lists
                            </a>
                        </li> 
                        <li>
                            <a href="{{ route('admin.email-marketing.email-campaigns') }}" key="t-tui-calendar">
                                Email Campaigns
                            </a>
                        </li> 
                    </ul>
                </li>
                <li>
                    <a href="{{route('affiliateList')}}">
                        <i class="bi bi-view-list"></i>
                        <span key="t-dashboards">Affiliate list</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-bank"></i>
                        <span key="t-chat">Payouts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('pending.payouts')}}">Pending</a></li>
                        <li><a href="{{route('finalized.payouts')}}">Finalized</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('transactions')}}">
                        <i class="bi bi-bank"></i>
                        <span key="t-chat">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-cart2"></i>
                        <span key="t-chat">Ecommerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('storeList')}}">Store List</a></li>
                        <li><a href="{{route('productList')}}">Product List</a></li>
                        <li><a href="{{route('salesList')}}">Sales List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-chat-dots"></i>
                        <span key="t-chat">Automation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('smsAutomation')}}"  key="t-tui-calendar">SMS Automation</a></li>
                        <li><a href="{{route('whatsappAutomation')}}"  key="t-tui-calendar">Whatsapp Automation</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('integration')}}">
                        <i class="bi bi-tags"></i>
                        <span key="t-chat">Integration</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('pageBuilder')}}">
                        <i class="bi bi-window-fullscreen"></i>
                        <span key="t-chat">Page Builder</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-book"></i>
                        <span key="t-chat">Learning Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('viewCategory')}}" key="t-tui-calendar">Course Category</a></li>
                        <li><a href="{{route('viewCourse')}}" key="t-tui-calendar">View Courses</a></li>
                        <li><a href="{{route('viewShop')}}" key="t-tui-calendar">View Shop</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('birthdayModule')}}">
                        <i class="bi bi-balloon"></i>
                        <span key="t-chat">Birthday Modules</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('salesAnalytics')}}">
                        <i class="bi bi-receipt"></i>
                        <span key="t-chat">Sales Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('notification')}}">
                        <i class="bi bi-bell"></i>
                        <span key="t-chat">Notification</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-headset"></i>
                        <span key="t-dashboards">Support</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('whatsappSupport')}}" key="t-full-calendar">Whatsapp Support</a></li>
                        <li><a href="{{route('chatSupport')}}" key="t-full-calendar">Chat Support</a></li>
                        <li><a href="{{route('emailSupport')}}" key="t-full-calendar">Email Support</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-book"></i>
                        <span key="t-chat">Frontend</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('viewFaq')}}" key="t-tui-calendar">FAQ</a></li>
                        <li><a href="{{route('viewContactUs')}}" key="t-tui-calendar">Contact Us</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-sliders2"></i>
                        <span key="t-dashboards">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('general')}}" key="t-full-calendar">General</a></li>
                        {{--<li><a href="{{route('security')}}" key="t-full-calendar">Security</a></li>--}}
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->

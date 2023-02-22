<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('adminwelcome')}}">
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
                        <li><a href="{{route('admin.unscribers')}}" key="t-full-calendar">Unsubscribers</a></li>
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
                        <li><a href="#" key="t-tui-calendar">View Email Checker</a></li>
                        <li><a href="#" key="t-full-calendar">View Email Campaign</a></li>
                        <li><a href="#" key="t-full-calendar">View Automation Campaign</a></li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="{{route('vendorlist')}}">
                        <i class="bi bi-card-checklist"></i>
                        <span key="t-dashboards">Vendor list</span>
                    </a>
                </li> -->
                <li>
                    <a href="{{route('affiliateList')}}">
                        <i class="bi bi-view-list"></i>
                        <span key="t-dashboards">Affiliate list</span>
                    </a>
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
                    <a href="#">
                        <i class="bi bi-receipt"></i>
                        <span key="t-chat">Sales Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-chat-dots"></i>
                        <span key="t-chat">Automation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">SMS Automation</a></li>
                        <li><a href="#" key="t-tui-calendar">Whatsapp Automation</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-bookmark"></i>
                        <span key="t-chat">Affiliate Marketing </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-tags"></i>
                        <span key="t-chat">Integration</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">Create Integrations</a></li>
                        <li><a href="#" key="t-tui-calendar">Manage Integrations</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-book"></i>
                        <span key="t-chat">Learning Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('viewCourse')}}" key="t-tui-calendar">View Courses</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-balloon"></i>
                        <span key="t-chat">Birthday Modules</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="bi bi-receipt"></i>
                        <span key="t-chat">Sales Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-sliders2"></i>
                        <span key="t-dashboards">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('general')}}" key="t-full-calendar">General</a></li>
                        <li><a href="{{route('security')}}" key="t-full-calendar">Security</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->

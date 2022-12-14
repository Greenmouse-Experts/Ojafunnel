<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('adminwelcome')}}">
                        <i class="bi bi-grid-fill"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('view_users')}}">
                        <i class="bi bi-person-circle"></i>
                        <span key="t-dashboards">Users</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span key="t-dashboards">Plans</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('add_plans')}}" key="t-full-calendar">Add Plan</a></li>
                        <li><a href="{{route('manage_plans')}}" key="t-full-calendar">Manage Plan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('subscriptions')}}">
                        <i class="bi bi-person-check"></i>
                        <span key="t-dashboards">Subscriptions</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-envelope-check-fill"></i>
                        <span key="t-chat">Email Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">View Email Checker</a></li>
                        <li><a href="#" key="t-full-calendar">View Email Campaign</a></li>
                        <li><a href="#" key="t-full-calendar">View Automation Campaign</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('vendorlist')}}">
                        <i class="bi bi-card-checklist"></i>
                        <span key="t-dashboards">Vendor list</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('affiliateList')}}">
                        <i class="bi bi-person-lines-fill"></i>
                        <span key="t-dashboards">Affiliate list</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('transactions')}}">
                        <i class="bi bi-bank2"></i>
                        <span key="t-chat">Transactions</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="fa-solid fa-dumpster"></i>
                        <span key="t-chat">Ecommerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('addProduct')}}">Add Product</a></li>
                        <li><a href="{{route('product')}}">View Store</a></li>
                        <li><a href="{{route('viewCart')}}">View Cart</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Product Details</a></li>
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
                        <i class="bi bi-chat-dots-fill"></i>
                        <span key="t-chat">Chat Automation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">SMS Automation</a></li>
                        <li><a href="#" key="t-tui-calendar">Whatsapp Automation</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-dumpster"></i>
                        <span key="t-chat">Affiliate Marketing </span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-tags-fill"></i>
                        <span key="t-chat">Integration</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-tui-calendar">Create Integrations</a></li>
                        <li><a href="#" key="t-tui-calendar">Manage Integrations</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-gear-wide-connected"></i>
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
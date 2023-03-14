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
                    <a href="#" id="emailmarketDrop" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="has-arrow">
                        <i class="bi bi-envelope-paper"></i>
                        <span key="t-layouts">Email Marketing </span>
                    </a>
                    <ul class="sub-menu p mt-1" aria-labelledby="emailmarketDrop">
                        {{-- <li>
                            <a href="{{route('user.email.checker', Auth::user()->username)}}" key="t-vertical" class="">Email Checker</a>
                        </li> --}}
                        <li>
                            <a href="{{route('user.automation.index', Auth::user()->username)}}" key="t-vertical" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">Automation</a>
                        </li>
                        <li class="nav-item" rel0="MailListController">
                            <a href="{{route('user.campaign.overview', Auth::user()->username)}}" key="t-vertical" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">Campaign</a>
                        </li>
                        {{-- <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Lists</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('user.list.overview', Auth::user()->username)}}" key="t-tui-calendar">Overview</a>
                                </li>
                                <li><a href="{{route('user.list.lists', Auth::user()->username)}}" key="t-tui-calendar">Lists</a></li>
                                <li><a href="{{route('user.list.contacts', Auth::user()->username)}}" key="t-tui-calendar">Contacts</a></li>
                                <li><a href="{{route('user.list.segments', Auth::user()->username)}}" key="t-tui-calendar">Segments</a></li>
                                <li><a href="{{route('user.list.forms', Auth::user()->username)}}" key="t-tui-calendar">Forms</a></li>
                            </ul>
                            <a href="{{route('user.edit.template', Auth::user()->username)}}" key="t-vertical" class="py-2">Email Automation</a>
                        </li> --}}
                        <li class="nav-item" rel0="MailListController">
                            <a href="{{ route('user.list.index', Auth::user()->username) }}" title="{{ trans('messages.lists') }}" class="leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1">
                                {{-- <i class="navbar-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 86.3 87.8"><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><g id="Layer_2-2" data-name="Layer 2"><g id="Layer_1-2-2" data-name="Layer 1-2"><g id="Layer_2-2-2" data-name="Layer 2-2"><g id="Layer_1-2-2-2" data-name="Layer 1-2-2"><g id="Layer_2-2-2-2" data-name="Layer 2-2-2"><g id="Layer_1-2-2-2-2" data-name="Layer 1-2-2-2"><path d="M62.5,49.5A13.1,13.1,0,1,1,75.6,36.4,13.1,13.1,0,0,1,62.5,49.5Zm0-18.8a5.8,5.8,0,1,0,5.8,5.7A5.8,5.8,0,0,0,62.5,30.7Z" style="fill:#f2f2f2"/><path d="M42.6,87.5h-.1a3.5,3.5,0,0,1-3.4-3.6c.4-10.4,4.5-20,10.8-25.6a18.4,18.4,0,0,1,14.2-4.9C76.6,54.5,85.5,66.8,86,83.9a3.3,3.3,0,0,1-3.3,3.6A3.5,3.5,0,0,1,79,84.2c-.4-13.3-6.8-23.1-15.6-23.9a12.1,12.1,0,0,0-8.9,3.3c-4.9,4.3-8,12-8.4,20.6A3.4,3.4,0,0,1,42.6,87.5Z" style="fill:#f2f2f2"/><path d="M82.5,87.5H42.6A3.5,3.5,0,0,1,39.1,84a3.5,3.5,0,0,1,3.5-3.5H82.5A3.5,3.5,0,0,1,86,84,3.4,3.4,0,0,1,82.5,87.5Z" style="fill:#f2f2f2"/><path d="M28.9,87.8H15.6C7,87.8,0,81.9,0,74.6V13.1C0,5.9,7,0,15.6,0h55c8.7,0,15.7,5.9,15.7,13.1V24.6a3.8,3.8,0,1,1-7.5,0V13.1c0-3-3.7-5.6-8.2-5.6h-55c-4.3,0-8.1,2.6-8.1,5.6V74.6c0,3.1,3.8,5.7,8.1,5.7H28.9a3.8,3.8,0,1,1,0,7.5Z" style="fill:#f2f2f2"/><path d="M44.2,30.5H23.4A3.5,3.5,0,0,1,19.9,27a3.5,3.5,0,0,1,3.5-3.5H44.2A3.5,3.5,0,0,1,47.7,27,3.4,3.4,0,0,1,44.2,30.5Z" style="fill:#f2f2f2"/><path d="M28.9,47.8H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h5.5a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,28.9,47.8Z" style="fill:#ff0"/><path d="M27.7,65.1H23.4a3.5,3.5,0,0,1-3.5-3.5,3.5,3.5,0,0,1,3.5-3.5h4.3a3.5,3.5,0,0,1,3.5,3.5A3.4,3.4,0,0,1,27.7,65.1Z" style="fill:#f2f2f2"/><polygon points="43.7 55.8 40.3 54.5 37.2 56.6 37.4 52.9 34.4 50.7 38 49.7 39.2 46.2 41.2 49.3 44.9 49.3 42.6 52.3 43.7 55.8" style="fill:lime"/><path d="M37.2,57.1H37a.5.5,0,0,1-.3-.5l.2-3.4-2.8-2.1c-.1-.1-.2-.3-.1-.4s.1-.4.3-.4l3.4-1,1.1-3.2c0-.2.2-.3.4-.4a.5.5,0,0,1,.5.3l1.8,2.8h3.4a.9.9,0,0,1,.5.3c.1.2.1.4-.1.5l-2.1,2.8,1,3.3a.4.4,0,0,1-.1.5c-.2.1-.4.2-.5.1l-3.2-1.2-2.9,2Zm-1.6-6.2,2.1,1.6a.4.4,0,0,1,.2.5v2.7l2.3-1.6a.3.3,0,0,1,.4,0L43,55l-.8-2.5a.5.5,0,0,1,0-.5l1.7-2.2H41.2a.4.4,0,0,1-.4-.2l-1.4-2.2-.9,2.5a.3.3,0,0,1-.3.3Z" style="fill:lime"/></g></g></g></g></g></g></g></g></svg>
                                </i> --}}
                                <span>{{ trans('messages.lists') }}</span>
                            </a>
                        </li>
                        <li class="nav-item" rel0="MailListController">
                            <a href="javascript: void(0);" class="has-arrow leftbar-tooltip nav-link d-flex align-items-center py-3 lvl-1" key="t-candidate">Sending</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('user.sending-domain.index', Auth::user()->username)}}" key="t-tui-calendar">Sending Domains</a>
                                </li>
                                <li><a href="{{route('user.sender.index', Auth::user()->username)}}" key="t-tui-calendar">Sending Identity</a></li>
                                <li><a href="{{route('user.sending-server.index', Auth::user()->username)}}" key="t-tui-calendar">Sending Server</a></li>
                                <li><a href="{{route('user.tracking-domain.index', Auth::user()->username)}}" key="t-tui-calendar">Tracking Domain</a></li>
                            </ul>
                        </li>

                    </ul>
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
                        <li><a href="{{route('user.automation.contact_list', Auth::user()->username)}}" key="t-tui-calendar">Contact List</a></li>
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
                        <li><a href="{{route('user.my.store', Auth::user()->username)}}" key="t-tui-calendar">Create Store</a></li>
                        <li><a href="{{route('user.check.store', Auth::user()->username)}}" key="t-tui-calendar">My Store</a></li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Shops</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('user.shops', Auth::user()->username)}}" key="t-list">View Shop</a></li>
                                {{-- <li><a href="{{route('user.sales', Auth::user()->username)}}" key="t-overview">View Sales</a></li>
                                <li><a href="{{route('user.order.details', Auth::user()->username)}}" key="t-overview">Order Details</a></li> --}}
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('user.main.promotion', Auth::user()->username)}}">
                        <i class="bi bi-people"></i>
                        <span key="t-chat">Promotion</span>
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
                        <li><a href="{{route('user.details', Auth::user()->username)}}" key="t-tui-calendar">Course Details</a></li>
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

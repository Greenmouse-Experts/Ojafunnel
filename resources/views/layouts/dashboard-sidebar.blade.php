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
                <!-- email marketing -->
                <li>
                    <!-- class="has-arrow waves-effect" -->
                    <a href="#" id="emailmarketDrop" role="button" data-bs-toggle="dropdown" aria-expanded="false" class="has-arrow">
                        <i class="bi bi-envelope-paper"></i>
                        <span key="t-layouts">Email Marketing </span>
                    </a>
                    <ul class="sub-menu p mt-1" aria-labelledby="emailmarketDrop">
                        <li>
                            <a href="{{route('user.email.checker', Auth::user()->username)}}" key="t-vertical" class="">Email Checker</a>
                        </li>
                        <li>
                            <a href="{{route('user.campaign.overview', Auth::user()->username)}}" key="t-vertical" class="py-2">Email Campaign</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow" key="t-candidate">Lists</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{route('user.create.list', Auth::user()->username)}}" key="t-tui-calendar">Create Mail List</a>
                                </li>
                                <li><a href="{{route('user.view.list', Auth::user()->username)}}" key="t-tui-calendar">View Mail List</a></li>
                            </ul>
                            <a href="{{route('user.edit.template', Auth::user()->username)}}" key="t-vertical" class="py-2">Email Automation</a>
                        </li>
                        <li>
                            <a href="{{route('user.automation.campaign', Auth::user()->username)}}" key="t-vertical" class="py-2">Automation Campaign</a>
                        </li>
                    </ul>
                    <!-- <li>
                <a
                  href="#"
                  id="emailmarketDrop"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  class="has-arrow"
                >
                <i class="bi bi-share"></i>
                  <span key="t-layouts">Subscribers</span>
                </a>
                <ul class="sub-menu p mt-1" aria-labelledby="emailmarketDrop">
                  <li>
                    <a href="{{route('user.mailing.list', Auth::user()->username)}}" key="t-vertical" class=""
                      >Mailing List </a
                    >
                  </li>
                </ul>
                </li> -->
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-envelope"></i>
                        <span key="t-dashboards">Messages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.create.message', Auth::user()->username)}}" key="t-tui-calendar">Create Message</a></li>
                        <li><a href="{{route('user.view.message', Auth::user()->username)}}" key="t-full-calendar">View Message</a></li>
                    </ul>
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
                    <a href="#" class="has-arrow">
                        <i class="bi bi-cart2"></i>
                        <span key="t-chat">Ecommerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.my.store', Auth::user()->username)}}" key="t-tui-calendar">My Store</a></li>
                    </ul>
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
                    <a href="{{route('user.reports.analysis', Auth::user()->username)}}">
                        <i class="bi bi-bar-chart"></i>
                        <span key="t-chat">Reports & Analysis</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.upgrade', Auth::user()->username)}}">
                        <i class="bi bi-send-check"></i>
                        <span key="t-chat">Upgrade</span>
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
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
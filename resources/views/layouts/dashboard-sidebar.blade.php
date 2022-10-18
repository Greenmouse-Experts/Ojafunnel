<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('user.dashboard')}}">
                    <i class="bi bi-grid-fill"></i>
                    <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <!-- email marketing -->
                <li>
                <!-- class="has-arrow waves-effect" -->
                <a
                  href="#"
                  id="emailmarketDrop"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  class="has-arrow"
                >
                  <i class="bi bi-envelope-paper-fill"></i>
                  <span key="t-layouts">Email Marketing </span>
                </a>
                <ul class="sub-menu p mt-1" aria-labelledby="emailmarketDrop">
                  <li>
                    <a href="{{route('user.email.checker')}}" key="t-vertical" class=""
                      >Email Checker</a
                    >
                  </li>
                  <li>
                    <a href="{{route('user.email.campaign')}}" key="t-vertical" class="py-2">Email Campaign</a>
                  </li>
                  <li>
                    <a href="{{route('user.edit.template')}}" key="t-vertical" class="py-2"
                      >Email Automation</a
                    >
                  </li>
                  <li>
                    <a href="{{route('user.automation.campaign')}}" key="t-vertical" class="py-2"
                      >Automation Campaign</a
                    >
                  </li>
                </ul>
                <li>
                <a
                  href="#"
                  id="emailmarketDrop"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  class="has-arrow"
                >
                <i class="bx bx-share-alt"></i>
                  <span key="t-layouts">Subscribers</span>
                </a>
                <ul class="sub-menu p mt-1" aria-labelledby="emailmarketDrop">
                  <li>
                    <a href="{{route('user.mailing.list')}}" key="t-vertical" class=""
                      >Mailing List </a
                    >
                  </li>
                </ul>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-envelope-open-fill"></i>
                        <span key="t-dashboards">Messages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.create.message')}}" key="t-tui-calendar">Create Message</a></li>
                        <li><a href="{{route('user.view.message')}}" key="t-full-calendar">View Message</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
                        <i class="fa-solid fa-building-circle-check"></i>
                        <span key="t-chat">Funnel Builder</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.page.builder')}}">
                        <i class="bi bi-calendar-range-fill"></i>
                        <span key="t-chat">Page Builder</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-chat-dots-fill"></i>
                        <span key="t-chat">Chat Automation</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.sms.automation')}}" key="t-tui-calendar">SMS Automation</a></li>
                        <li><a href="{{route('user.whatsapp.automation')}}" key="t-tui-calendar">Whatsapp Automation</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="fa-solid fa-dumpster"></i>
                        <span key="t-chat">Ecommerce</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.my.store')}}" key="t-tui-calendar">My Store</a></li>
                        <li><a href="{{route('user.create.course')}}" key="t-full-calendar">Create Course</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('user.affiliate.marketing')}}">
                        <i class="fa-solid fa-dumpster"></i>
                        <span key="t-chat">Affiliate Marketing </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.integration')}}">
                        <i class="bi bi-code-square"></i>
                        <span key="t-chat">Integration</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('user.reports.analysis')}}">
                        <i class="bi bi-bar-chart-fill"></i>
                        <span key="t-chat">Reports & Analysis</span>
                    </a>
                </li>
                <li class="qeustion">
                    <a href="{{route('user.help')}}">
                        <i class="bi bi-question-diamond-fill"></i>
                        <span key="t-chat">Help</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bi bi-gear-wide-connected"></i>
                        <span key="t-chat">Settings</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('user.general')}}" key="t-tui-calendar">General</a></li>
                        <li><a href="{{route('user.security')}}" key="t-full-calendar">Security</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);">
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
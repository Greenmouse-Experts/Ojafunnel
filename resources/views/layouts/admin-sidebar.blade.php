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
                    <a href="#" class="has-arrow">
                    <i class="bx bx-share-alt"></i>
                        <span key="t-dashboards">Subscribers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('viewlist')}}" key="t-full-calendar">View Mailing List</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow">
                        <i class="bi bi-envelope-open-fill"></i>
                        <span key="t-dashboards">Messages</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-full-calendar">View Message</a></li>
                    </ul>
                </li>
                 <li>
                    <a href="#" class="has-arrow">
                    <i class="bi bi-envelope-check-fill"></i>
                        <span key="t-dashboards">Email Marketing</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-full-calendar">View Email Checker</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-full-calendar">View Email Campaign</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#" key="t-full-calendar">View Automation Campaign</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                    <i class="fa-solid fa-building-circle-check"></i>
                        <span key="t-dashboards">Funnel Builder</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
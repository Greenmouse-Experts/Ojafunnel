<header>
    <nav class="navbar navbar-expand-lg fixed-top" id="header-scroll">
        <div class="container">
        <a href="{{route('index')}}" class="navbar-brand">
        <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1660222222/OjaFunnel-Images/lo_dwxa54.png" draggable="false" alt="OjaFunnel">
        </a>
            <button class="navbar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <i class="fas fa-bars"></i>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-100" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <button data-bs-dismiss="offcanvas">
                        <i class="bi bi-x-square"></i>
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1">
                        <li class="nav-item">
                            <a href="{{route('index')}}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" class="routers">
                                Home
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->is('features*')) ? 'active' : '' }}" href="#">
                                Features
                            </a>
                            <div class="dropdown-content container desktop-dropdown">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/growth_pb0d7g.png" draggable="false">
                                            <span>MARKETING</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('emailmarketing')}}">
                                                        Email Marketing <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Affiliate Marketing <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Ecommerce <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/globe_wpfoop.png" draggable="false">
                                            <span>CREATE AND DESIGN</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        Funnel Builder <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('pagebuilder')}}">
                                                        Page Builder <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254552/OjaFunnel-Images/setting_kzwd29.png" draggable="false">
                                            <span>AUTOMATIONS</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('marketauto')}}">
                                                        Automations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="{{route('chatautomation')}}">
                                                        Chat Automations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua dolor.</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="upload">
                                            <img src="https://res.cloudinary.com/greenmouse-tech/image/upload/v1661254551/OjaFunnel-Images/plugin_g09fa1.png" draggable="false">
                                            <span>MORE</span>
                                        </div>
                                        <div>
                                            <div class="btn-area">
                                                <h4>
                                                    <a href="">
                                                        API Integrations <i class="bi bi-arrow-right-short"></i>
                                                    </a>
                                                </h4>
                                            </div>
                                            <p>Amet minim mollit non desunt ullamco est sit aliqua .</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="dropdown-menu mobile-dropdown" aria-labelledby="navbarDropdown">
                                <li>
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Email Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Affiliate Marketing
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Ecommerce
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Funnel Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('pagebuilder')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Page Builder
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('marketauto')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Marketing Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('chatautomation')}}" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> Chat Automations
                                        </a>
                                    </a>
                                </li>
                                <li>
                                    <a href="index" class="routers">
                                        <a class="dropdown-item">
                                            <i class="bi bi-arrow-right-short"></i> API Integrations
                                        </a>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('faqs')}}" class="nav-link {{ (request()->is('faqs')) ? 'active' : '' }}" class="routers">
                                FAQs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" class="routers">
                                Resources
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('contact')}}" class="nav-link {{ (request()->is('contact')) ? 'active' : '' }}" class="routers">
                                Contact
                            </a>
                        </li>
                    </ul>
                    <div class="login-div">
                        <a href="{{route('login')}}" class="btn-login">Login</a>
                        <a href="{{route('signup')}}" class="btn-signup">Sign Up <i class="bi bi-box-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-end offcanvas-contact-hambuger" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <button data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="bi bi-x-square"></i>
            </button>
        </div>
        <div class="offcanvas-body text-center">
        </div>
    </div>
</header>
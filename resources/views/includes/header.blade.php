<div id="kt_app_header" class="app-header" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
    <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
        </div>
        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-18">
            <a href="{{ url('/') }}">
                <img alt="Logo" src="/assets/favicon.png" class="h-25px d-sm-none" />
                <img alt="Logo" src="/assets/logo.png" class="h-25px d-none d-sm-block" />
            </a>
        </div>
        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
            <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                <div class="menu menu-rounded menu-active-bg menu-state-primary menu-column menu-lg-row menu-title-gray-700 menu-icon-gray-500 menu-arrow-gray-500 menu-bullet-gray-500 my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0" id="kt_app_header_menu" data-kt-menu="true">
                    <div class="{{ checkActivePage(['/']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                        <a class="menu-link" href="{{ url('/') }}">
                            <span class="menu-title">Home</span>
                            <span class="menu-arrow d-lg-none"></span>
                        </a>
                    </div>
                    @if(session('orgName'))
                        <div class="{{ checkActivePage(['huiswerk', 'huiswerk/*']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a class="menu-link" href="{{ url('/huiswerk') }}">
                                <span class="menu-title">Huiswerk</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                        <div class="{{ checkActivePage(['afwezigheid', 'afwezigheid/*']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a class="menu-link" href="{{ url('/afwezigheid') }}">
                                <span class="menu-title">Afwezigheid</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                        <div class="{{ checkActivePage(['cijfers', 'cijfers/*']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a class="menu-link" href="{{ url('/cijfers') }}">
                                <span class="menu-title">Cijfers</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                        <div class="{{ checkActivePage(['vakken', 'vak/*']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a class="menu-link" href="{{ url('/vakken') }}">
                                <span class="menu-title">Vakken</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                    @endif
                    @if (session('orgName'))
                    <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="bottom-start" class=" {{ checkActivePage(['werkstuk', 'werkstuk/*']) }} menu-item menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
   <span class="menu-link">
   <span class="menu-title">Educatie</span>
   <span class="menu-arrow d-lg-none"></span>
   </span>
                        <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px">
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/leerweg') }}">
         <span class="menu-icon">
         <i class="ki-outline ki-rocket fs-2"></i>
         </span>
                                    <span class="menu-title">Flitskaarten</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/werkstuk') }}">
         <span class="menu-icon">
         <i class="ki-outline ki-abstract-26 fs-2"></i>
         </span>
                                    <span class="menu-title">Werkstukken</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('/boeken') }}">
         <span class="menu-icon">
         <i class="ki-outline ki-book fs-2"></i>
         </span>
                                    <span class="menu-title">Leesboeken</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="{{ checkActivePage(['werkstuk', 'werkstuk/*']) }} menu-item menu-here-bg menu-lg-down-accordion me-0 me-lg-2">
                            <a class="menu-link" href="{{ url('/werkstuk') }}">
                                <span class="menu-title">Werkstukken</span>
                                <span class="menu-arrow d-lg-none"></span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="app-navbar flex-shrink-0">
                <?php
                $allowed_roles = ['Gebruiker', 'Redactie', 'Klantenservice', 'Technische Medewerker', 'Teamleider', 'Bestuur'];
                ?>
                @if(in_array(Auth::user()->role, $allowed_roles))
                    <div class="app-navbar-item ms-1 ms-lg-5">
                        <a href="https://mijn.ncle.nl">
                            <div class="btn btn-icon btn-custom btn-active-color-primary w-35px h-35px w-md-40px h-md-40px">
                                <i class="ki-outline ki-setting-2 fs-1"></i>
                            </div>
                        </a>
                    </div>
                @endif
                <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                         data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                         data-kt-menu-attach="parent"
                         data-kt-menu-placement="bottom-end">
                        <img class="symbol symbol-circle symbol-35px symbol-md-40px" src="{{ Auth::user()->gravatar }}" alt="user" />
                    </div>
                    <!-- Begin::User account menu -->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                         data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="Logo" src="{{ Auth::user()->gravatar }}" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-5">
                                        {{ Auth::user()->firstname }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                              {{ Auth::user()->getRoleNames()->first() }}
                              </span>
                                    </div>
                                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><b>@</b>{{ Auth::user()->username }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5">
                            <a href="/account/profiel" class="menu-link px-5">Mijn Profiel</a>
                        </div>
                        @if(session('orgName'))
                            <div class="menu-item px-5">
                                <a href="/huiswerk" class="menu-link px-5">
                                    <span class="menu-text">Huiswerk</span>
                                </a>
                            </div>
                            <div class="menu-item px-5">
                                <a href="/afwezigheid" class="menu-link px-5">
                                    <span class="menu-text">Afwezigheid</span>
                                </a>
                            </div>
                        @endif
                        <div class="separator my-2"></div>
                        <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                            <a href="#" class="menu-link px-5">
                     <span class="menu-title position-relative">Thema
                     <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                     <i class="ki-outline ki-night-day theme-light-show fs-2"></i>
                     <i class="ki-outline ki-moon theme-dark-show fs-2"></i>
                     </span>
                     </span>
                            </a>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px">
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">
                           <span class="menu-icon" data-kt-element="icon">
                           <i class="ki-outline ki-night-day fs-2"></i>
                           </span>
                                        <span class="menu-title">Licht</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                           <span class="menu-icon" data-kt-element="icon">
                           <i class="ki-outline ki-moon fs-2"></i>
                           </span>
                                        <span class="menu-title">Donker</span>
                                    </a>
                                </div>
                                <div class="menu-item px-3 my-0">
                                    <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                           <span class="menu-icon" data-kt-element="icon">
                           <i class="ki-outline ki-screen fs-2"></i>
                           </span>
                                        <span class="menu-title">Systeem</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="menu-item px-5">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="menu-link px-5" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Uitloggen
                            </a>
                        </div>
                    </div>
                    <!-- End::User account menu -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

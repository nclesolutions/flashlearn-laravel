<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FlashLearn</title>
    <meta name="description" content="NCLE™ Group is een toonaangevend software- en mediaproductiebedrijf dat zich toelegt op het leveren van hoogwaardige oplossingen en content. We zijn gepassioneerd door innovatie en streven ernaar om cutting-edge producten en diensten te bieden aan onze klanten en de bredere gemeenschap.">
    <meta name="author" content="NCLE™ Group">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('includes.header')


        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <div id="kt_app_toolbar" class="app-toolbar py-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
                    <div class="d-flex flex-column flex-row-fluid">
                        <div class="d-flex align-items-center pt-1">
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                <li class="breadcrumb-item text-white fw-bold lh-1">
                                    <a href="/" class="text-white">
                                        <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-white fw-bold lh-1">Vakken</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">Vakken
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina vind je al je vakken!</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-container container-xxl">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div class="row g-7">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card card-flush" id="kt_contacts_list">
                                        <div class="card-header pt-7" id="kt_contacts_list_header">
                                            <form class="d-flex align-items-center position-relative w-100 m-0" autocomplete="off">
                                                <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></i>
                                                <input type="text" class="form-control form-control-solid ps-13" name="search" value="" placeholder="Zoeken in vakken" />
                                            </form>
                                        </div>
                                        <div class="card-body pt-5" id="kt_contacts_list_body">
                                            <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
                                                @if ($subjects->isEmpty())
                                                    <div class="text-center py-5">
                                                        <p class="text-gray-400 fs-4 fw-semibold mb-2">Geen vakken beschikbaar.</p>
                                                        <img class="mw-100 mh-300px" alt="" src="{{ asset('assets/media/illustrations/sketchy-1/5.png') }}" />
                                                    </div>
                                                @endif
                                                @foreach ($subjects as $subject)
                                                    <div class="d-flex flex-stack py-4">
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-4">
                                                                <a href="{{ url('/vak/bekijk/' . $subject->vak_naam) }}" class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2">{{ $subject->vak_naam }}</a>
                                                                <div class="fw-semibold fs-7 text-muted">    @if($subject->teacher && $subject->teacher->user)
                                                                        {{ substr($subject->teacher->user->firstname, 0,1) }}. {{ $subject->teacher->user->lastname }}
                                                                    @else
                                                                        Geen vaste leraar
                                                                    @endif</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="separator separator-dashed d-none"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                        <!--begin::Card header-->
                                        <div class="card-header pt-7" id="kt_chat_contacts_header">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <i class="ki-outline ki-book-open fs-1 me-2"></i>
                                                <h2>{{ $selectedSubject->vak_naam }}</h2>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar gap-3">
                                                <!--begin::Chat-->
                                                <a href="apps/inbox/reply.html" class="btn btn-sm btn-light btn-active-light-primary">
                                                    <i class="ki-outline ki-messages fs-2"></i>Contacteer Docent</a>
                                                <!--end::Chat-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="apps/contacts/edit-contact.html" class="menu-link px-3">Edit</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" id="kt_contact_delete" data-kt-redirect="apps/contacts/getting-started.html">Delete</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Action menu-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-5">
                                            <!--begin::Profile-->
                                            <div class="d-flex gap-7 align-items-center">
                                                <!--begin::Avatar-->
                                                @php
                                                    // Creëer de Gravatar-URL
                                                    $emailHash = md5(strtolower(trim($selectedSubject->teacher->user->email)));
                                                    $gravatarUrl = "https://www.gravatar.com/avatar/$emailHash?s=100&d=mp";
                                                @endphp
                                                <div class="symbol symbol-circle symbol-100px">
                                                    <img src="{{ $gravatarUrl }}" alt="image" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Contact details-->
                                                <div class="d-flex flex-column gap-2">
                                                    <!--begin::Name-->
                                                    <h3 class="mb-0">{{ substr($selectedSubject->teacher->user->firstname, 0,1) }}. {{ $selectedSubject->teacher->user->lastname }}</h3>
                                                    <!--end::Name-->
                                                    <!--begin::Email-->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="ki-outline ki-sms fs-2"></i>
                                                        <a href="#" class="text-muted text-hover-primary">{{ $selectedSubject->teacher->user->email }}</a>
                                                    </div>
                                                    <!--end::Email-->
                                                    <!--begin::Phone-->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <i class="ki-outline ki-user fs-2"></i>
                                                        <a href="#" class="text-muted text-hover-primary"><b>@</b>{{ $selectedSubject->teacher->user->username }}</a>
                                                    </div>
                                                    <!--end::Phone-->
                                                </div>
                                                <!--end::Contact details-->
                                            </div>
                                            <!--end::Profile-->
                                            <!--begin:::Tabs-->
                                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-semibold mt-6 mb-8 gap-2">
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-primary d-flex align-items-center pb-4 active" data-bs-toggle="tab" href="#kt_contact_view_general">
                                                        <i class="ki-outline ki-home fs-4 me-1"></i>Overzicht</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-primary d-flex align-items-center pb-4" data-bs-toggle="tab" href="#kt_contact_view_meetings">
                                                        <i class="ki-outline ki-calendar-8 fs-4 me-1"></i>Lessen</a>
                                                </li>
                                                <!--end:::Tab item-->
                                            </ul>
                                            <!--end:::Tabs-->
                                            <!--begin::Tab content-->
                                            <div class="tab-content" id="">
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade show active" id="kt_contact_view_general" role="tabpanel">
                                                    <!--begin::Additional details-->
                                                    <div class="d-flex flex-column gap-5 mt-7">
                                                        <!--begin::Company name-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bold text-muted">Company Name</div>
                                                            <div class="fw-bold fs-5">Keenthemes Inc</div>
                                                        </div>
                                                        <!--end::Company name-->
                                                        <!--begin::City-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bold text-muted">City</div>
                                                            <div class="fw-bold fs-5">Melbourne</div>
                                                        </div>
                                                        <!--end::City-->
                                                        <!--begin::Country-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bold text-muted">Country</div>
                                                            <div class="fw-bold fs-5">Australia</div>
                                                        </div>
                                                        <!--end::Country-->
                                                        <!--begin::Homework-->
                                                        <div class="d-flex flex-column gap-4 my-6">
                                                            <div class="fw-bold text-muted">Huiswerk</div>

                                                            @if($selectedSubject->homework->isEmpty())
                                                                    <p class="mb-0 text-muted">Geen huiswerk gevonden.</p>

                                                            @else
                                                                @foreach($selectedSubject->homework as $homework)
                                                                    <!--begin::Homework Item-->
                                                                    <div class="d-flex flex-stack position-relative">
                                                                        <!--begin::Bar-->
                                                                        <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                                        <!--end::Bar-->
                                                                        <!--begin::Info-->
                                                                        <div class="fw-semibold ms-5 text-gray-600">
                                                                            <!--begin::Time-->
                                                                            <div class="fs-5">{{ $homework->inlever_date }}

                                                                            </div>
                                                                            <!--end::Time-->
                                                                            <!--begin::Title-->
                                                                            <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">{{ $homework->vak }} - {{ $homework->title }}</a>
                                                                            <!--end::Title-->
                                                                            <!--begin::Description-->
                                                                            <div class="text-gray-500">{{ $homework->beschrijving }}</div>
                                                                            <!--end::Description-->
                                                                        </div>
                                                                        <!--end::Info-->
                                                                        <!--begin::Action-->
                                                                        <a href="{{ route('dashboard.homework.view', ['id' => $homework->unique_id]) }}" class="btn btn-bg-light btn-active-color-primary btn-sm">Bekijken</a>
                                                                        <!--end::Action-->
                                                                    </div>
                                                                    <!--end::Homework Item-->
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <!--end::Homework-->

                                                    </div>
                                                    <!--end::Additional details-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_meetings" role="tabpanel">
                                                    <!--begin::Dates-->
                                                    <ul class="nav nav-pills d-flex flex-stack flex-nowrap scroll-x pb-2">
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                                                <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                                                <span class="fs-6 fw-bold">22</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                                                <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                                                <span class="fs-6 fw-bold">23</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                                                <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                                                <span class="fs-6 fw-bold">24</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                                                <span class="opacity-50 fs-7 fw-semibold">We</span>
                                                                <span class="fs-6 fw-bold">25</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                                                <span class="opacity-50 fs-7 fw-semibold">Th</span>
                                                                <span class="fs-6 fw-bold">26</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                                                <span class="opacity-50 fs-7 fw-semibold">Fr</span>
                                                                <span class="fs-6 fw-bold">27</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                                                <span class="opacity-50 fs-7 fw-semibold">Sa</span>
                                                                <span class="fs-6 fw-bold">28</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                                                <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                                                <span class="fs-6 fw-bold">29</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                                                <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                                                <span class="fs-6 fw-bold">30</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                        <!--begin::Date-->
                                                        <li class="nav-item me-1">
                                                            <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 text-gray-900 text-active-white btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                                                <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                                                <span class="fs-6 fw-bold">31</span>
                                                            </a>
                                                        </li>
                                                        <!--end::Date-->
                                                    </ul>
                                                    <!--end::Dates-->
                                                    <!--begin::Tab Content-->
                                                    <div class="tab-content">
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_0" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">10:00 - 11:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">David Stevenson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">16:30 - 17:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Kendell Trevor</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Creative Content Initiative</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Michael Walters</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">12:00 - 13:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Karina Clarke</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">11:00 - 11:45
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Naomi Hayabusa</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Terry Robins</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_2" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">13:00 - 14:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Kendell Trevor</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">9:00 - 10:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Kendell Trevor</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">10:00 - 11:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Kendell Trevor</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_3" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">11:00 - 11:45
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Karina Clarke</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">12:00 - 13:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Michael Walters</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">16:30 - 17:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Karina Clarke</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_4" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-info rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Peter Marcus</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">13:00 - 14:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Peter Marcus</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Caleb Donaldson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_5" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">13:00 - 14:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Naomi Hayabusa</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">13:00 - 14:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Bob Harris</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Bob Harris</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_6" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">9:00 - 10:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">David Stevenson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Bob Harris</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">13:00 - 14:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">David Stevenson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_7" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">16:30 - 17:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Caleb Donaldson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">12:00 - 13:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Sales Pitch Proposal</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Peter Marcus</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">11:00 - 11:45
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Project Review & Testing</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Walter White</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_8" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-success rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">9:00 - 10:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Karina Clarke</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-primary rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">11:00 - 11:45
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Walter White</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">9:00 - 10:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Committee Review Approvals</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Terry Robins</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_9" class="tab-pane fade show">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-danger rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">16:30 - 17:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Development Team Capacity Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">David Stevenson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">14:30 - 15:30
                                                                        <span class="fs-7 text-gray-500 text-uppercase">pm</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Caleb Donaldson</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative my-6">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-warning rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-semibold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5">9:00 - 10:00
                                                                        <span class="fs-7 text-gray-500 text-uppercase">am</span></div>
                                                                    <!--end::Time-->
                                                                    <!--begin::Title-->
                                                                    <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::User-->
                                                                    <div class="text-gray-500">Lead by
                                                                        <a href="#">Michael Walters</a></div>
                                                                    <!--end::User-->
                                                                </div>
                                                                <!--end::Info-->
                                                                <!--begin::Action-->
                                                                <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Time-->
                                                        </div>
                                                        <!--end::Day-->
                                                    </div>
                                                    <!--end::Tab Content-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_activity" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">08:42</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-warning fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Text-->
                                                            <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And keep structure</div>
                                                            <!--end::Text-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">10:00</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-success fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Content-->
                                                            <div class="timeline-content d-flex">
                                                                <span class="fw-bold text-gray-800 ps-3">AEOL meeting</span>
                                                            </div>
                                                            <!--end::Content-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">14:37</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-danger fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content fw-bold text-gray-800 ps-3">Make deposit
                                                                <a href="#" class="text-primary">USD 700</a>. to ESL</div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-primary fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Text-->
                                                            <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                                            <!--end::Text-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-danger fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">16:50</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-primary fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Text-->
                                                            <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                                            <!--end::Text-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">21:03</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-danger fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Desc-->
                                                            <div class="timeline-content fw-semibold text-gray-800 ps-3">New order placed
                                                                <a href="#" class="text-primary">#XF-2356</a>.</div>
                                                            <!--end::Desc-->
                                                        </div>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <div class="timeline-item">
                                                            <!--begin::Label-->
                                                            <div class="timeline-label fw-bold text-gray-800 fs-6">10:30</div>
                                                            <!--end::Label-->
                                                            <!--begin::Badge-->
                                                            <div class="timeline-badge">
                                                                <i class="ki-outline ki-abstract-8 text-success fs-1"></i>
                                                            </div>
                                                            <!--end::Badge-->
                                                            <!--begin::Text-->
                                                            <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch preparion meeting</div>
                                                            <!--end::Text-->
                                                        </div>
                                                        <!--end::Item-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                            </div>
                                            <!--end::Tab content-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                            </div>
                        </div>
                        @include('includes.footer')
                    </div>
                </div>
            </div>
        </div>




    </div>
    <!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::App-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <i class="ki-outline ki-arrow-up"></i>
</div>
<!--end::Scrolltop--><!--begin::Javascript-->

<!-- Begin met het laden van jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Laad Bootstrap-bundel, die afhankelijk is van jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Begin met het laden van de globale Javascript-bundel (vermoedelijk Metronic, die mogelijk ook afhankelijk is van jQuery en Bootstrap) -->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!-- Einde globale Javascript-bundel -->

<!-- Begin met het laden van de vendors Javascript (voor pagina-specifieke functionaliteit) -->
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<!-- Einde vendors Javascript -->

<!-- Begin met het laden van de custom Javascript (voor pagina-specifieke functionaliteit en scripts die afhankelijk zijn van eerder geladen scripts) -->
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
<script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/type.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/budget.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/settings.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/team.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/targets.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/files.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/complete.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-project/main.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
<!-- Einde custom Javascript -->

</body>
</html>

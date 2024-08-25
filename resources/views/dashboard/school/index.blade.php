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
<!--begin::Body-->
<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
<!--begin::Theme mode setup on page load-->
<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
<!--end::Theme mode setup on page load-->
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        @include('includes.header')
        <!--begin::Wrapper-->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
            <!--begin::Toolbar-->
            <div id="kt_app_toolbar" class="app-toolbar py-6">
                <!--begin::Toolbar container-->
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex align-items-start">
                    <!--begin::Toolbar container-->
                    <div class="d-flex flex-column flex-row-fluid">
                        <!--begin::Toolbar wrapper-->
                        <div class="d-flex align-items-center pt-1">
                            <!--begin::Breadcrumb-->
                            <ul class="breadcrumb breadcrumb-separatorless fw-semibold">
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-white fw-bold lh-1">
                                    <a href="/" class="text-white">
                                        <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item">
                                    <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-white fw-bold lh-1">{{ $schoolInfo->name }}</li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Breadcrumb-->
                        </div>
                        <!--end::Toolbar wrapper=-->
                        <!--begin::Toolbar wrapper=-->
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <!--begin::Page title-->
                            <div class="page-title me-5">
                                <!--begin::Title-->
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    {{ $schoolInfo->name }}
                                    <!--begin::Description-->
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina vind je alle informatie over jou school!</span>
                                    <!--end::Description-->
                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::Stats-->
                            @include('includes.domain')
                            <!--end::Stats-->
                        </div>
                        <!--end::Toolbar wrapper=-->
                    </div>
                    <!--end::Toolbar container=-->
                </div>
                <!--end::Toolbar container-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Wrapper container-->
            <div class="app-container container-xxl">
                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <div id="container">


                                <!--begin::Row-->
                                <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                    <!--begin::Col-->
                                    <div class="col-xxl-6">
                                        <!--begin::Chart widget 22-->
                                        <div class="card rounded h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header position-relative py-0 border-bottom-2">
                                                <!--begin::Nav-->
                                                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                                    <!--begin::Item-->
                                                    <li class="nav-item p-0 ms-0 me-8">
                                                        <!--begin::Link-->
                                                        <a class="nav-link btn btn-color-dark px-0">
                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Mijn School</span>
                                                            <!--end::Subtitle-->
                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </li>
                                                    <!--end::Item-->
                                                </ul>
                                                <!--end::Nav-->
                                            </div>
                                            <!--end::Header-->



                                            <!--begin::Body-->
                                            <div class="card-body pb-3">
                                                <!--begin::Tab Content-->
                                                <div class="tab-content">
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade show active" id="kt_chart_widgets_22_tab_content_1">
                                                        <!--begin::Wrapper-->
                                                        <div class="d-flex flex-wrap flex-md-nowrap">
                                                            <!--begin::Items-->
                                                            <div class="me-md-5 w-100">
                                                                <!--begin::Item-->
                                                                <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                                                    <!--begin::Block-->
                                                                    <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                                        <!--begin::Symbol-->

                                                                        <!--end::Symbol-->
                                                                        <!--begin::Section-->
                                                                        <div class="me-2">
                                                                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $schoolInfo->name }}</a>
                                                                            <span class="text-gray-400 fw-bold d-block fs-7">School</span>
                                                                        </div>
                                                                        <!--end::Section-->
                                                                    </div>
                                                                    <!--end::Block-->
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex align-items-center">
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                                                    <!--begin::Block-->
                                                                    <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                                        <!--begin::Symbol-->

                                                                        <!--end::Symbol-->
                                                                        <!--begin::Section-->
                                                                        <div class="me-2">
                                                                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $schoolInfo->address }}, {{ $schoolInfo->city }}</a>
                                                                            <span class="text-gray-400 fw-bold d-block fs-7">Locatie</span>
                                                                        </div>
                                                                        <!--end::Section-->
                                                                    </div>
                                                                    <!--end::Block-->
                                                                    <!--begin::Info-->
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Item-->
                                                            </div>
                                                            <!--end::Items-->
                                                        </div>
                                                        <!--end::Wrapper-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                </div>
                                                <!--end::Tab Content-->
                                            </div>
                                            <!--end: Card Body-->
                                        </div>
                                        <!--end::Chart widget 22-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col-xxl-6">
                                        <!--begin::Timeline widget 2-->
                                        <div class="card rounded h-xl-100" id="kt_timeline_widget_2_card">
                                            <!--begin::Header-->
                                            <div class="card-header position-relative py-0 border-bottom-2">
                                                <!--begin::Nav-->
                                                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                                    <!--begin::Item-->
                                                    <li class="nav-item p-0 ms-0 me-8">
                                                        <!--begin::Link-->
                                                        <a class="nav-link btn btn-color-dark px-0">
                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Nieuwsbrief</span>
                                                            <!--end::Subtitle-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </li>
                                                    <!--end::Item-->
                                                </ul>
                                                <!--end::Nav-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <thead>
                                                        <tr>
                                                            <th class="p-0 w-10px"></th>
                                                            <th class="p-0 min-w-400px"></th>
                                                            <th class="p-0 min-w-100px"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @if($newsletter->isEmpty())
                                                            <tr>
                                                                <td colspan="3" class="text-center text-gray-500">Er zijn geen nieuwsbrieven gevonden...</td>
                                                            </tr>
                                                        @else
                                                            @foreach($newsletter as $newsletter)
                                                                <tr>
                                                                    <td class="p-0">
                                                                        <!-- Optional: Add an icon or any other element here -->
                                                                        <i class="ki-outline ki-email fs-2qx text-primary"></i>
                                                                    </td>
                                                                    <td class="p-0">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="ms-5">
                                                                                <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                                    {{ $newsletter->title }}
                                                                                </a>
                                                                                <span class="text-muted fw-semibold d-block">
                                {{ \Carbon\Carbon::parse($newsletter->created_at)->translatedFormat('d F Y') }}
                            </span>
                                                                                <p class="text-gray-600 mt-1 newsletter-content">
                                                                                    {{ Str::limit($newsletter->content, 320) }}
                                                                                </p>
                                                                                <small class="text-muted">Gemaakt door: {{ $newsletter->firstname }} {{ $newsletter->lastname }}</small>

                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-end pe-0">
                                                                        <!-- Optional: Add any action buttons or links here -->
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Timeline widget 2-->
                                    </div>
                                    <!--end::Col-->


                                    <div class="py-0">
                                        <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                                            <div class="col-md-4">
                                                <a href="#" class="card rounded hover-elevate-up  parent-hover">
                                                    <div class="card-body d-flex align-items">
                                                        <i class="ki-duotone ki-rocket fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Contacteer je mentor
                        </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="#" class="card hover-elevate-up rounded parent-hover">
                                                    <div class="card-body d-flex align-items">
                                                        <i class="ki-duotone ki-timer fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Bekijk je huiswerk
                        </span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-md-4">
                                                <a href="#" class="card hover-elevate-up rounded parent-hover">
                                                    <div class="card-body d-flex align-items">
                                                        <i class="ki-duotone ki-virus fs-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>
                                                        <span class="ms-3 text-gray-700 parent-hover-primary fs-6 fw-bold">
                            Meld je ziek
                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!--end::Row-->


                            </div>
                        </div>
                        <!--end::Content wrapper-->
                        @include('includes.footer')
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Javascript--


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

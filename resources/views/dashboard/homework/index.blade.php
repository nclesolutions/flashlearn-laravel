<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    @include('includes.meta')


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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Huiswerk</li>
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
                                    Huiswerk
                                    <!--begin::Description-->
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina vind je al je huiswerk!</span>
                                    <!--end::Description-->
                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Page title-->
                            <!--begin::DOMAIN-->
                            @include('includes.domain')
                            <!--end::DOMAIN-->
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
                            <!--begin::Contacts App- Getting Started-->
                            <div class="row g-7">
                                <!--begin::Search-->
                                <div class="col-lg-6 col-xl-4">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush" id="kt_contacts_list">
                                        <!--begin::Card header-->
                                        <div class="card-header pt-7" id="kt_contacts_list_header">
                                            <!--begin::Form-->
                                            <form class="d-flex align-items-center position-relative w-100 m-0" autocomplete="off">
                                                <!--begin::Icon-->
                                                <i class="ki-outline ki-magnifier fs-3 text-gray-500 position-absolute top-50 ms-5 translate-middle-y"></i>
                                                <!--end::Icon-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid ps-13" name="search" value="" placeholder="Zoeken in huiswerk" />
                                                <!--end::Input-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-5" id="kt_contacts_list_body">
                                            <!--begin::List-->
                                            <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
                                                @if ($groupedResults)
                                                    @foreach ($groupedResults as $inleverDatum => $huiswerk)
                                                        <div class="d-flex flex-stack py-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="ms-4">
                                                                    <div class="fw-semibold fs-7 text-muted">{{ $inleverDatum }}</div>
                                                                    @foreach ($huiswerk as $row)
                                                                        <a href="{{ url('/huiswerk/view/' . $row->unique_id) }}" class="fs-6 fw-bold text-hover-primary mb-2 text-gray-900">{{ $row->title }}</a>
                                                                        <div class="fw-semibold fs-7 text-muted"><b>{{ $row->subject }}</b></div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="separator separator-dashed d-none"></div>
                                                    @endforeach
                                                @else
                                                    <div class="text-center py-5">
                                                        <p class="text-gray-400 fs-4 fw-semibold mb-2">Geen huiswerk beschikbaar.</p>
                                                        <img class="mw-100 mh-300px" alt="" src="{{ asset('assets/media/illustrations/sketchy-1/5.png') }}" />
                                                    </div>
                                                @endif
                                            </div>
                                            <!--end::List-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--end::Search-->
                                <!--begin::Content-->
                                <div class="col-xl-8">
                                    <!--begin::Card-->
                                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                        <!--begin::Card body-->
                                        <div class="card-body p-0">
                                            <!--begin::Wrapper-->
                                            <div class="card-px text-center py-20 my-10">
                                                <!--begin::Title-->
                                                <h2 class="fs-2x fw-bold mb-10">Huiswerk</h2>
                                                <!--end::Title-->
                                                <!--begin::Description-->
                                                <p class="text-gray-400 fs-4 fw-semibold mb-10">Op deze pagina vind je al je huiswerk voor de komende weken.</p>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Contacts App- Getting Started-->

                        </div>
                        <!--end::Content-->
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

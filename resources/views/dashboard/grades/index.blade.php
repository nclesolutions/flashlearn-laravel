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
                                    <li class="breadcrumb-item text-white fw-bold lh-1">Cijfers</li>
                                </ul>
                            </div>
                            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                                <div class="page-title me-5">
                                    <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">Cijfers
                                        <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina vind je al je cijfers!</span>
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
                                                    <input type="text" class="form-control form-control-solid ps-13" name="search" value="" placeholder="Zoeken in cijfers" />
                                                </form>
                                            </div>
                                            <div class="card-body pt-5" id="kt_contacts_list_body">
                                                <div class="scroll-y me-n5 pe-5 h-300px h-xl-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_contacts_list_header" data-kt-scroll-wrappers="#kt_content, #kt_contacts_list_body" data-kt-scroll-stretch="#kt_contacts_list, #kt_contacts_main" data-kt-scroll-offset="5px">
                                                    @if ($subjects->isEmpty())
                                                        <div class="text-center py-5">
                                                            <p class="text-gray-400 fs-4 fw-semibold mb-2">Geen cijfers beschikbaar.</p>
                                                            <img class="mw-100 mh-300px" alt="" src="{{ asset('assets/media/illustrations/sketchy-1/5.png') }}" />
                                                        </div>
                                                    @endif
                                                    @foreach ($subjects as $subject)
                                                        <div class="d-flex flex-stack py-4">
                                                            <div class="d-flex align-items-center">
                                                                <div class="ms-4">
                                                                    <a href="{{ url('/cijfers/view/' . $subject->name) }}" class="fs-6 fw-bold text-gray-900 text-hover-primary mb-2">{{ $subject->name }}</a>
                                                                    <div class="fw-semibold fs-7 text-muted">Gemiddeld (Gewogen): {{ number_format($averageGrades[$subject->name] ?? 0.0, 1) }}                                                                    </div>
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
                                        <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                            <div class="card-body p-0">
                                                <div class="card-px text-center py-20 my-10">
                                                    <h2 class="fs-2x fw-bold mb-10">Cijfers</h2>
                                                    <p class="text-gray-400 fs-4 fw-semibold mb-10">Op deze pagina vind je al je cijfers van dit schooljaar.</p>
                                                </div>
                                            </div>
                                        </div>
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

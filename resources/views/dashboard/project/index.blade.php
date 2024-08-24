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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Werkstukken</li>
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
                                    Werkstukken
                                    <!--begin::Description-->
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina vind je al je werkstukken!</span>
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
                                <div id="row">
                                    <!--begin::Engage widget 4-->
                                    <div class="card rounded border-transparent" data-bs-theme="light" style="background-color: #1C325E;">
                                        <!--begin::Body-->
                                        <div class="card-body d-flex ps-xl-15">
                                            <!--begin::Wrapper-->
                                            <div class="m-0">
                                                <!--begin::Title-->
                                                <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-7">
                <span class="me-2">
                    Browse door
                    <span class="position-relative d-inline-block text-primary">
                        <a href="JavaScript:void(0)" class="text-primary opacity-75-hover">{{ $werkstukcount }}</a>
                        <span class="position-absolute opacity-50 bottom-0 start-0 border-4 border-primary border-bottom w-100"></span>
                    </span>
                </span>publieke werkstukken!
                                                </div>
                                                <!--end::Title-->

                                                <!--begin::Action and Filter Form-->
                                                <div class="d-flex align-items-center mb-3">
                                                    <!--begin::Action Button-->
                                                    <a href='/werkstuk/nieuw' class="btn btn-primary fw-semibold me-3">Nieuw</a>
                                                    <!--end::Action Button-->

                                                    <!--begin::Filter Form-->
                                                    <form method="GET" action="{{ route('dashboard.project.index') }}">
                                                        <div class="d-flex align-items-center">
                                                            <select class="form-select" id="vak" name="vak" onchange="this.form.submit()">
                                                                <option value="all" {{ request()->get('vak') == 'all' ? 'selected' : '' }}>Alle vakken</option>

                                                                @foreach($availableVakken as $vak)
                                                                    <option value="{{ $vak }}" {{ request()->get('vak') == $vak ? 'selected' : '' }}>
                                                                        {{ $vak }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                    <!--end::Filter Form-->
                                                </div>
                                                <!--end::Action and Filter Form-->

                                                <!--begin::Wrapper-->
                                                <!--begin::Illustration-->
                                                <img src="/assets/media/illustrations/sigma-1/17-dark.png" class="position-absolute me-3 bottom-0 end-0 h-200px" alt="" />
                                                <!--end::Illustration-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Engage widget 4-->


                                    </div>

                                <div class="row pt-5">
                                    @foreach($werkstukken as $werkstuk)
                                        <div class="col-md-6 col-lg-4 mb-6"> <!-- Consistente margin-bottom voor elke kaart -->
                                            <div class="card card-custom rounded gutter-b">
                                                <div class="card-header pt-3 pb-2"> <!-- Aangepaste padding voor betere header spacing -->
                                                    <div class="card-title">
                                                        <h3 class="card-label">
                                                            {{ $werkstuk->title }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="card-body py-4"> <!-- Aangepaste padding voor body spacing -->
                                                    <div class="d-flex align-items-center mb-4"> <!-- Verkleinde margin voor compacter design -->
                                                        <div class="symbol symbol-70px symbol-circle me-4"> <!-- Verkleinde margin voor strakkere weergave -->
                                                            <span class="symbol-label bg-light-success">
                                <i class="ki-outline ki-book-open fs-3x text-success"></i>
                            </span>
                                                        </div>
                                                        <div class="m-0">
                                                            <h4 class="fw-bold text-gray-800 mb-2">{{ $werkstuk->vak }}</h4> <!-- Verkleinde margin onder de titel -->
                                                            <div class="d-flex flex-column flex-shrink-0 me-4">
                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-1"> <!-- Verkleinde margin voor compactere lijst -->
                                    <i class="ki-outline ki-briefcase fs-6 text-gray-600 me-2"></i>{{ $werkstuk->niveau }}
                                </span>
                                                                <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-1"> <!-- Verkleinde margin voor compactere lijst -->
                                    <i class="ki-outline ki-note-2 fs-6 text-gray-600 me-2"></i>{{ $werkstuk->total_characters }} karakters
                                </span>
                                                                <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                    <i class="ki-outline ki-user fs-6 text-gray-600 me-2"></i>
                                    @if($werkstuk->creator)
                                                                        {{ $werkstuk->creator->firstname }} {{ $werkstuk->creator->lastname }}
                                                                    @else
                                                                        Onbekende Maker
                                                                    @endif
                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="m-0">
                                                        <a href="{{ url('/werkstuk/view/' . $werkstuk->unique_id) }}" class="btn rounded btn-sm btn-light me-2 mb-2">Bekijken</a>
                                                        @if ($werkstuk->creator->id == Auth::id())
                                                            <a href="{{ url('/werkstuk/bewerk/' . $werkstuk->unique_id) }}" class="btn rounded btn-sm btn-light me-2 mb-2">Bewerken</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

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

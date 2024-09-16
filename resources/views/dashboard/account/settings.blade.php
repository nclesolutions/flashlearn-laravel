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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Mijn Account</li>
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
                                <h1 class="page-heading d-flex flex-column justify-content-center my-0 text-white fw-bold fs-2">
                                    Mijn Profiel
                                    <span class="text-gray-700 fw-semibold fs-6 pt-3">
        Bekijk en beheer je profielinformatie hier.
    </span>
                                </h1>
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


                                <div class="card mb-5 mb-xl-10">
                                    <div class="card-body pt-9 pb-0">
                                        <div class="d-flex flex-wrap flex-sm-nowrap">
                                            <div class="me-7 mb-4">
                                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                    <img src="{{ Auth::user()->gravatar }}" alt="image" />
                                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                                    <div class="d-flex flex-column">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <a href="javascript:void(0)" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $account->firstname }} {{ $account->lastname }}</a>
                                                            <a href="javascript:void(0)">
                                                                <i class="ki-outline ki-verify text-primary"></i>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                                            <a href="javascript:void(0)" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                                                <i class="ki-outline ki-profile-circle fs-4 me-1"></i>{{ Auth::user()->getRoleNames()->first() }}</a>
                                                            <a href="javascript:void(0)" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                                                <i class="ki-outline ki-sms fs-4 me-1"></i>{{ $account->email }}</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-wrap flex-stack">
                                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="fs-2 fw-bold">{{ $account->created_at->format('d-m-Y') }}</div>
                                                                </div>
                                                                <div class="fw-semibold fs-6 text-gray-400">Lid sinds</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                                            <li class="nav-item mt-2">
                                                <a class="nav-link text-active-primary ms-0 me-10 py-5" href="/account/profiel">Overzicht</a>
                                            </li>
                                            <li class="nav-item mt-2">
                                                <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="/account/instellingen">Instellingen</a>
                                            </li>
                                            <li class="nav-item mt-2">
                                                <a class="nav-link text-active-primary ms-0 me-10 py-5 " href="/account/beveiliging">Beveiliging</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <form action="{{ route('profile.updateBio') }}" method="post">
                                    @csrf
                                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                                        <div class="card-header cursor-pointer">
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Instellingen</h3>
                                            </div>
                                        </div>
                                        <div class="card-body p-9">
                                            <!-- Biography -->
                                            <div class="row mb-10">
                                                <label class="col-lg-4 fw-semibold text-muted">Biografie</label>
                                                <div class="col-lg-8">
                                                    <textarea name="biography" class="form-control fw-semibold fs-6 text-gray-800">{{ old('biography', $account->biography) }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Save Button -->
                                            <div class="row">
                                                <div class="col-lg-8 offset-lg-4">
                                                    <button type="submit" class="btn btn-primary">Opslaan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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

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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Overzicht</li>
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
                                    {{ begroeting() }}, {{ htmlspecialchars(Auth::user()->firstname, ENT_QUOTES) }}!
                                    <!--begin::Description-->
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Welkom terug in de Flashlearn-leeromgeving. We zijn blij je weer te zien!</span>
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

                            @if (session('orgName'))
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
                                                        <span class="nav-text fw-semibold fs-4 mb-3">Overzicht</span>
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
                                                                    <div class="symbol symbol-50px me-4">
                                                            <span class="symbol-label">
                                                            <i class="ki-outline ki-file fs-2qx text-primary"></i>
                                                            </span>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Section-->
                                                                    <div class="me-2">
                                                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Gemaakte werkstukken</a>
                                                                        <span class="text-gray-400 fw-bold d-block fs-7">All-time</span>
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Block-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex align-items-center">
                                                                    <span class="text-dark fw-bolder fs-2x">{{ $werkstukCount }}</span>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Item-->
                                                            <!--begin::Item-->
                                                            <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                                                <!--begin::Block-->
                                                                <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-50px me-4">
                                                            <span class="symbol-label">
                                                            <i class="ki-outline ki-cheque fs-2qx text-primary"></i>
                                                            </span>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Section-->
                                                                    <div class="me-2">
                                                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Huiswerk</a>
                                                                        <span class="text-gray-400 fw-bold d-block fs-7">Deze week</span>
                                                                    </div>
                                                                    <!--end::Section-->
                                                                </div>
                                                                <!--end::Block-->
                                                                <!--begin::Info-->
                                                                <div class="d-flex align-items-center">
                                                                    <span class="text-dark fw-bolder fs-2x">{{ $huiswerkCount }}</span>
                                                                </div>
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
                                                        <span class="nav-text fw-semibold fs-4 mb-3">Recente Cijfers</span>
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
                                                    @forelse ($cijfers as $cijfer)
                                                        <tr>
                                                            <td>
                                                                @php
                                                                    $color = '';
                                                                    $status = '';
                                                                    $badgeColor = '';

                                                                    if ($cijfer->grade >= 6) {
                                                                        $color = 'bg-success';
                                                                        $status = 'Goedzo!';
                                                                        $badgeColor = 'badge-light-success';
                                                                    } elseif ($cijfer->grade >= 5.5) {
                                                                        $color = 'bg-warning';
                                                                        $status = 'Netjes!';
                                                                        $badgeColor = 'badge-light-warning';
                                                                    } else {
                                                                        $color = 'bg-danger';
                                                                        $status = 'Jammer!';
                                                                        $badgeColor = 'badge-light-danger';
                                                                    }
                                                                @endphp
                                                                <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px {{ $color }}"></span>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">Je hebt een <b>{{ $cijfer->grade }}</b> gehaald!</a>
                                                                <span class="text-gray-400 fw-bold fs-7 d-block">{{ $cijfer->name }} - {{ $cijfer->onderdeel }}</span>
                                                            </td>
                                                            <td class="text-end">
                                                                <span data-kt-element="status" class="badge {{ $badgeColor }}">{{ $status }}</span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-center text-gray-500">Je hebt nog geen cijfers behaald.</td>
                                                        </tr>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::Tables Widget 2-->
                                </div>
                                <!--end::Col-->

                                @if ($currentWeekRooster && !empty($currentWeekRooster['days']))
                                    <div class="col-xl-12">
                                        <div class="card rounded h-xl-100">
                                            <div class="card-header position-relative py-0 border-bottom-2">
                                                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                                    @foreach ($currentWeekRooster['days'] as $index => $day)
                                                        <li class="nav-item p-0 ms-0 me-8">
                                                            <a id="day-tab-{{ $index + 1 }}" class="nav-link btn btn-color-muted px-0" data-bs-toggle="tab" href="#kt_table_widget_7_tab_content_{{ $index + 1 }}">
                                                                <span class="nav-text fw-semibold fs-4 mb-3">{{ $day['day_of_week'] }}</span>
                                                                <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="d-flex align-items-center">
                                                    <div id="week-info" class="text-gray-600 fw-bold me-3">
                                                        <i class="fa fa-calendar-alt me-2"></i>
                                                        <span id="week-dates">
                            @php
                                $startOfWeek = \Carbon\Carbon::now()->setISODate(date('Y'), $currentWeekRooster['week_number']);
                                $startDate = $startOfWeek->format('d M Y');
                                $endOfWeek = $startOfWeek->copy()->addDays(6);
                                $endDate = $endOfWeek->format('d M Y');
                            @endphp
                            van {{ $startDate }} tot {{ $endDate }}
                        </span>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            @if ($currentWeekRooster['week_number'] == date('W'))
                                                                Deze week
                                                            @else
                                                                Week {{ $currentWeekRooster['week_number'] }}
                                                            @endif
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            @foreach ($weeks as $week)
                                                                @if ($week['week_number'] >= date('W'))
                                                                    <li>
                                                                        <a class="dropdown-item" href="?week={{ $week['week_number'] }}">
                                                                            @if ($week['week_number'] == date('W'))
                                                                                Huidige week
                                                                            @else
                                                                                Week {{ $week['week_number'] }}
                                                                            @endif
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content mb-2">
                                                    @foreach ($currentWeekRooster['days'] as $index => $day)
                                                        <div class="tab-pane fade" id="kt_table_widget_7_tab_content_{{ $index + 1 }}">
                                                            <div class="table-responsive">
                                                                <table class="table align-middle">
                                                                    <thead>
                                                                    <tr>
                                                                        <th class="min-w-150px p-0"></th>
                                                                        <th class="min-w-200px p-0"></th>
                                                                        <th class="min-w-100px p-0"></th>
                                                                        <th class="min-w-80px p-0"></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach ($day['schedule'] as $lesson)
                                                                        @if ($lesson['lesson'] === 'Pauze')
                                                                            <tr>
                                                                                <td class="bg-light rounded text-gray-600 px-3 py-2" colspan="4"><b>Pauze</b>: {{ $lesson['time'] }}</td>
                                                                            </tr>
                                                                        @else
                                                                            <tr>
                                                                                <td class="fs-6 fw-bold text-gray-800">{{ $lesson['time'] }}</td>
                                                                                <td class="fs-6 fw-bold text-gray-500">Les: <span class="text-gray-800">{{ $lesson['lesson'] }}</span></td>
                                                                                <td class="fs-6 fw-bold text-gray-500">Lokaal: <span class="text-gray-800">{{ $lesson['location'] }}</span></td>
                                                                                <td class="fs-6 fw-bold text-gray-500">Docent: <span class="text-gray-800">{{ $lesson['teacher'] }}</span></td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-xxl-12">
                                        <div class="card rounded h-xl-100">
                                            <div class="card-header position-relative py-0 border-bottom-2">
                                                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                                    <li class="nav-item p-0 ms-0 me-8">
                                                        <a class="nav-link btn btn-color-dark px-0">
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Geen rooster gevonden.</span>
                                                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <p>Er is geen rooster ingepland voor deze week. Je hebt vrij, maar het kan zijn dat je toch naar school moet voor andere verplichtingen of evenementen. Controleer je planning regelmatig voor eventuele updates.</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (Auth::user()->hasRole('Superadmin'))
                                    <div class="col-xxl-12">
                                        <div class="card rounded h-xl-100">
                                            <div class="card-header position-relative py-0 border-bottom-2">
                                                <ul class="nav nav-stretch nav-pills nav-pills-custom d-flex mt-3">
                                                    <li class="nav-item p-0 ms-0 me-8">
                                                        <a class="nav-link btn btn-color-dark px-0">
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Logs</span>
                                                            <span class="bullet-custom position-absolute z-index-2 w-100 h-2px top-100 bottom-n100 bg-primary rounded"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <p>hoi</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </div>
                            <!--end::Row-->
                            @else
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
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Overzicht</span>
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
                                                                        <div class="symbol symbol-50px me-4">
                                                            <span class="symbol-label">
                                                            <i class="ki-outline ki-file fs-2qx text-primary"></i>
                                                            </span>
                                                                        </div>
                                                                        <!--end::Symbol-->
                                                                        <!--begin::Section-->
                                                                        <div class="me-2">
                                                                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Gemaakte werkstukken</a>
                                                                            <span class="text-gray-400 fw-bold d-block fs-7">All-time</span>
                                                                        </div>
                                                                        <!--end::Section-->
                                                                    </div>
                                                                    <!--end::Block-->
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-dark fw-bolder fs-2x">{{ $werkstukCount }}</span>
                                                                    </div>
                                                                    <!--end::Info-->
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="d-flex border border-gray-300 border-dashed rounded p-6 mb-6">
                                                                    <!--begin::Block-->
                                                                    <div class="d-flex align-items-center flex-grow-1 me-2 me-sm-5">
                                                                        <!--begin::Symbol-->
                                                                        <div class="symbol symbol-50px me-4">
                                                            <span class="symbol-label">
                                                            <i class="ki-outline ki-cheque fs-2qx text-primary"></i>
                                                            </span>
                                                                        </div>
                                                                        <!--end::Symbol-->
                                                                        <!--begin::Section-->
                                                                        <div class="me-2">
                                                                            <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold">Huiswerk</a>
                                                                            <span class="text-gray-400 fw-bold d-block fs-7">Deze week</span>
                                                                        </div>
                                                                        <!--end::Section-->
                                                                    </div>
                                                                    <!--end::Block-->
                                                                    <!--begin::Info-->
                                                                    <div class="d-flex align-items-center">
                                                                        <span class="text-dark fw-bolder fs-2x">{{ $huiswerkCount }}</span>
                                                                    </div>
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
                                                            <span class="nav-text fw-semibold fs-4 mb-3">Mijn Werkstukken</span>
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
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <div class="table-responsive mb-4">
                                                    <table class="table align-middle gs-0 gy-4">
                                                        <thead>
                                                        <tr>
                                                            <th class="p-0 w-10px"></th>
                                                            <th class="p-0 min-w-400px"></th>
                                                            <th class="p-0 min-w-100px"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse ($werkstukken->take(2) as $index => $werkstuk)
                                                            @php
                                                                // Bepaal de kleur op basis van het niveau
                                                                switch($werkstuk->niveau) {
                                                                    case 'Makkelijk':
                                                                        $niveauColor = 'badge-light-success'; // Groene badge voor makkelijk niveau
                                                                        break;
                                                                    case 'Gemiddeld':
                                                                        $niveauColor = 'badge-light-warning'; // Gele badge voor gemiddeld niveau
                                                                        break;
                                                                    case 'Moeilijk':
                                                                        $niveauColor = 'badge-light-danger'; // Rode badge voor moeilijk niveau
                                                                        break;
                                                                    default:
                                                                        $niveauColor = 'badge-light-secondary'; // Grijze badge voor onbekend niveau
                                                                }

                                                                // Bepaal de kleur op basis van het vak
switch($werkstuk->vak) {
    case 'Wiskunde':
        $vakColor = 'bg-info'; // Blauwe bullet voor Wiskunde
        break;
    case 'Biologie':
        $vakColor = 'bg-success'; // Groene bullet voor Biologie
        break;
    case 'Nederlands':
        $vakColor = 'bg-warning'; // Gele bullet voor Nederlands
        break;
    case 'NASK':
        $vakColor = 'bg-danger'; // Rode bullet voor Natuur- & Scheikunde
        break;
    case 'Geschiedenis':
        $vakColor = 'bg-danger'; // Rode bullet voor Geschiedenis
        break;
    case 'Engels':
        $vakColor = 'bg-primary'; // Donkerblauwe bullet voor Engels
        break;
    case 'Economie':
        $vakColor = 'bg-secondary'; // Grijze bullet voor Economie
        break;
    case 'Aardrijkskunde':
        $vakColor = 'bg-success'; // Groene bullet voor Aardrijkskunde
        break;
    case 'K&C':
        $vakColor = 'bg-info'; // Blauwe bullet voor Kunst & Cultuur
        break;
    case 'Maatschappijleer':
        $vakColor = 'bg-warning'; // Gele bullet voor Maatschappijleer
        break;
    case 'Informatica':
        $vakColor = 'bg-dark'; // Zwarte bullet voor Informatica
        break;
    case 'Filosofie':
        $vakColor = 'bg-light'; // Lichtgrijze bullet voor Filosofie
        break;
    case 'L&G':
        $vakColor = 'bg-primary'; // Donkerblauwe bullet voor Klassieke Talen (Latijn & Grieks)
        break;
    case 'Muziek':
        $vakColor = 'bg-success'; // Groene bullet voor Muziek
        break;
    case 'Techniek':
        $vakColor = 'bg-secondary'; // Grijze bullet voor Handvaardigheid & Techniek
        break;
    case 'Godsdienst/Levensbeschouwing':
        $vakColor = 'bg-danger'; // Rode bullet voor Godsdienst/Levensbeschouwing
        break;
    case 'Frans':
        $vakColor = 'bg-info'; // Blauwe bullet voor Frans
        break;
    case 'Duits':
        $vakColor = 'bg-warning'; // Gele bullet voor Duits
        break;
    case 'Spaans':
        $vakColor = 'bg-danger'; // Rode bullet voor Spaans
        break;
    default:
        $vakColor = 'bg-secondary'; // Grijze bullet voor onbekend vak
}
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center h-40px {{ $vakColor }}"></span>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">{{ $werkstuk->title }}</a>
                                                                    <span class="text-gray-400 fw-bold fs-7 d-block">{{ $werkstuk->vak }}</span>
                                                                </td>
                                                                <td class="text-end">
                                                                    <span data-kt-element="status" class="badge {{ $niveauColor }}">{{ $werkstuk->niveau }}</span>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center text-gray-500">Er zijn geen werkstukken beschikbaar.</td>
                                                            </tr>
                                                        @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                @if ($werkstukken->count() > 2)
                                                    <p class="text-muted mt-auto mb-0">Staat je werkstuk er niet tussen? Klik <a href="{{ route('dashboard.project.index') }}" class="text-primary fw-semibold">hier</a> om een volledig overzicht te krijgen van al je ingediende werkstukken en projecten.</p>
                                                @endif
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Tables Widget 2-->
                                    </div>
                                    <!--end::Col-->




                                </div>
                                <!--end::Row-->
                            @endif



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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const daterangepicker = document.getElementById('daterangepicker');
        $(daterangepicker).daterangepicker({
            startDate: moment().startOf('isoWeek'),
            endDate: moment().endOf('isoWeek'),
            locale: {
                format: 'YYYY-MM-DD'
            },
            singleDatePicker: true,
            showDropdowns: true
        }, function(start) {
            const selectedDate = start.toDate();
            const selectedWeekNumber = moment(selectedDate).isoWeek();
            window.location.href = '?week=' + selectedWeekNumber;
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var currentDayOfWeek = new Date().getDay();
        var dayMapping = {
            0: 1, // Zondag wordt maandag
            1: 1,
            2: 2,
            3: 3,
            4: 4,
            5: 5,
            6: 1 // Zaterdag wordt maandag
        };
        var currentDayIndex = dayMapping[currentDayOfWeek];
        var currentTab = document.getElementById('day-tab-' + currentDayIndex);
        var currentContent = document.getElementById('kt_table_widget_7_tab_content_' + currentDayIndex);
        if (currentTab) {
            currentTab.classList.add('show', 'active');
        } else {
            console.log('Tab niet gevonden voor dag:', currentDayIndex);
        }
        if (currentContent) {
            currentContent.classList.add('show', 'active');
        } else {
            console.log('Content niet gevonden voor dag:', currentDayIndex);
        }
    });
</script>

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

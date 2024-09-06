<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    @include('includes.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Vendor Stylesheets -->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Global Stylesheets Bundle -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
</head>

<body id="kt_app_body" class="app-default">
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            themeMode = localStorage.getItem("data-bs-theme") || defaultThemeMode;
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>

<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Flitskaarten</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    Flitskaarten
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Beheer en studeer je flitskaarten!</span>
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
                            <div id="container">
                                <div class="card rounded">
                                    <div class="card-header">
                                        <h3 class="card-title">Flitskaarten <span class="badge badge-warning" style="margin-left: 5px;">BÉTA</span></h3>
                                        <div class="card-toolbar">
                                            <button type="button" class="btn btn-sm btn-light">
                                                Nieuwe Flitskaart
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        Welkom bij Flitskaarten, de gloednieuwe functie in Flashlearn! Met Flitskaarten kun je snel en effectief leren door middel van digitale kaartjes. Of je nu studeert voor een examen of gewoon je kennis wilt bijspijkeren, deze functie helpt je om op een eenvoudige en gestructureerde manier te oefenen. Maak je eigen kaartjes of kies uit onze uitgebreide collectie en verbeter je leerervaring in no time. Probeer het nu uit en ontdek hoe Flitskaarten je leren naar een hoger niveau tilt!
                                    </div>
                                </div>
                                <div class="row pt-5">
                                    @foreach ($subjects as $subject)
                                        <div class="col-md-6 col-lg-4 mb-6">
                                            <div class="card card-custom rounded gutter-b">
                                                <div class="card-header pt-3 pb-2">
                                                    <div class="card-title">
                                                        <h3 class="card-label">
                                                            {{ $subject->vak_naam }}
                                                        </h3>
                                                    </div>
                                                    <div class="card-toolbar">
                                                        <span class="badge badge-light-success">{{ $subject->flashcards->count() }} kaarten</span>
                                                    </div>
                                                </div>
                                                <div class="card-body py-4">
                                                    <div class="m-0">
                                                        <a href="{{ route('dashboard.flashcards.start', $subject->id) }}" class="btn rounded btn-sm btn-light me-2 mb-2">Start</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($subjects->isEmpty())
                                    <div class="alert alert-warning" role="alert">
                                        <strong>Geen vakken gevonden.</strong> Voeg een nieuw vak toe om te beginnen met flitskaarten!
                                    </div>
                                @endif
                            </div>
                        </div>
                        @include('includes.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>

</body>
</html>

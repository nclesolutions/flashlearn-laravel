<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('includes.meta')

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Vendor Stylesheets -->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Global Stylesheets Bundle -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .points-earned {
            font-size: 24px;
            color: #4caf50;
            font-weight: bold;
            transition: font-size 0.3s ease;
        }
    </style>
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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Resultaten</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    Resultaten
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Bekijk je vooruitgang!</span>
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
                                        <h3 class="card-title">Resultaten</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <h1>Resultaten</h1>
                                            @if($correct === true)
                                            <p>Correct! Je hebt <span class="points-earned">{{ $points ?? 0 }}</span> punten verdiend.</p>
                                            @elseif($correct === false)
                                            <p>Helaas, dat was niet correct. Geen punten verdiend.</p>
                                            @else
                                            <p>Je hebt deze flitskaart al beantwoord.</p>
                                            @endif

                                            @if($finished)
                                            <p>Goed gedaan! Je hebt alle flitskaarten van dit vak voltooid.</p>
                                            <a href="{{ route('dashboard.flashcards.result', $subject->id) }}" class="btn btn-primary">Bekijk totaalresultaat</a>
                                            @else
                                            <a href="{{ route('dashboard.flashcards.start', $subject->id) }}" class="btn btn-primary">Volgende Flitskaart</a>
                                            @endif

                                            <!-- Progress Bar -->
                                            <div class="progress my-4">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                                                    {{ $progress }}% voltooid
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-5"></div>
                            </div>
                        </div>
                        @include('includes.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Confetti -->
<script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pointsElement = document.getElementById('points');
        let points = parseInt(pointsElement.innerHTML);
        let displayedPoints = 0;
        const increment = points / 50;

        const interval = setInterval(() => {
            displayedPoints += increment;
            pointsElement.innerHTML = Math.floor(displayedPoints);

            if (displayedPoints >= points) {
                pointsElement.innerHTML = points;
                clearInterval(interval);
            }
        }, 20);

    @if($correct === true)
            confetti({
                particleCount: 100,
                spread: 70,
                origin: { y: 0.6 }
            });
    @endif
    });
</script>

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

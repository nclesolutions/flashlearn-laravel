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

    <style>
        /* Custom Styles for Gamification Elements */
        .progress-bar {
            height: 30px;
            background-color: #4caf50;
            border-radius: 15px;
            text-align: center;
            color: white;
            line-height: 30px;
        }
        .badge-reward {
            background-color: #ff9800;
            padding: 10px;
            border-radius: 10px;
            font-weight: bold;
            color: white;
        }
        .correct-answer {
            color: green;
        }
        .incorrect-answer {
            color: red;
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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Flitskaarten voor {{ $subject->name }}</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    Flitskaarten voor {{$subject->name}}
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
                                <div class="row pt-5">
                                    <!-- Flashcard Answer Section -->
                                    <div class="col-12">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $flashcard->question }}</h5>
                                                <form id="flashcardForm" action="{{ route('dashboard.flashcards.answer', $subject) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="flashcard_id" value="{{ $flashcard->id }}">
                                                    <div class="mb-3">
                                                        <input type="text" name="answer" class="form-control" placeholder="Uw antwoord" required>
                                                    </div>
                                                    <button type="submit" class="rounded btn btn-primary">Antwoord</button>
                                                </form>
                                                <!-- Interactive Feedback -->
                                                <div id="feedback" class="mt-3"></div>
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
</div>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('assets/js

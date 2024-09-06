<!-- resources/views/dashboard/flashcards/create.blade.php -->

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
                                <li class="breadcrumb-item text-white fw-bold lh-1">Nieuwe Flitskaarten</li>
                            </ul>
                        </div>
                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    Nieuwe Flitskaarten
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Maak nieuwe flitskaarten aan voor je vakken!</span>
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
                            <div class="container">
                                <div class="card rounded">
                                    <div class="card-header">
                                        <h3 class="card-title">Flitskaarten <span class="badge badge-warning" style="margin-left: 5px;">BÉTA</span></h3>
                                        <div class="card-toolbar">
                                            <a type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#importExportModal">
                                                Importeren (JSON)
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('dashboard.flashcards.store') }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="subject_id" class="form-label">Vak</label>
                                                <select name="subject_id" id="subject_id" class="form-control" required>
                                                    @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}">{{ $subject->vak_naam }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div id="flashcard-container">
                                                <div class="flashcard mb-3 p-3 rounded border bg-light">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="flashcards[0][question]" class="form-label">Vraag</label>
                                                            <input type="text" name="flashcards[0][question]" class="form-control" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="flashcards[0][answer]" class="form-label">Antwoord</label>
                                                            <input type="text" name="flashcards[0][answer]" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm mt-3 remove-flashcard">Verwijder flitskaart</button>
                                                </div>
                                            </div>

                                            <button type="button" id="add-flashcard" class="btn btn-secondary mt-3">Voeg nog een flitskaart toe</button>
                                            <button type="submit" class="btn btn-primary mt-3">Opslaan</button>
                                        </form>
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

<div class="modal fade" tabindex="-1" id="importExportModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Importeer Flitskaarten</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"></i>
                </div>
            </div>

            <div class="modal-body">
                <!-- Import Form -->
                <form action="{{ route('dashboard.flashcards.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Bestand uploaden (JSON)</label>
                        <input type="file" name="file" class="form-control" accept=".json" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Importeren</button>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Sluiten</button>
            </div>
        </div>
    </div>
</div>


<!-- JavaScript for Confetti -->
<script src="https://cdn.jsdelivr.net/npm/@tsparticles/confetti@3.0.3/tsparticles.confetti.bundle.min.js"></script>

<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/vis-timeline/vis-timeline.bundle.js') }}"></script>
<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
<script src="{{ asset('assets/js/custom/widgets.js') }}"></script>

<script>
    let flashcardIndex = 1;

    document.getElementById('add-flashcard').addEventListener('click', function() {
        const flashcardContainer = document.getElementById('flashcard-container');
        const newFlashcard = document.createElement('div');
        newFlashcard.classList.add('flashcard', 'mb-3', 'p-3', 'rounded', 'border', 'bg-light');
        newFlashcard.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <label for="flashcards[${flashcardIndex}][question]" class="form-label">Vraag</label>
                    <input type="text" name="flashcards[${flashcardIndex}][question]" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="flashcards[${flashcardIndex}][answer]" class="form-label">Antwoord</label>
                    <input type="text" name="flashcards[${flashcardIndex}][answer]" class="form-control" required>
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm mt-3 remove-flashcard">Verwijder flitskaart</button>
        `;
        flashcardContainer.appendChild(newFlashcard);
        flashcardIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-flashcard')) {
            e.target.closest('.flashcard').remove();
        }
    });
</script>


</body>
</html>

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

        <!-- Begin Wrapper -->
        <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">

            <!-- Begin Toolbar -->
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
                                <li class="breadcrumb-item text-gray-700">
                                    <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                </li>
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Werkstuk / </li>
                                <li class="breadcrumb-item text-white fw-bold lh-1">Bewerken</li>
                            </ul>
                        </div>

                        <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">
                            <div class="page-title me-5">
                                <h1 class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0">
                                    Werkstuk Bewerken
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina kan je een eerder gemaakt werkstuk bewerken!</span>
                                </h1>
                            </div>
                            @include('includes.domain')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Begin Wrapper Container -->
            <div class="app-container container-xxl">

                <!-- Begin Main -->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <!-- Begin Content Wrapper -->
                    <div class="d-flex flex-column flex-column-fluid">

                        <!-- Begin Content -->
                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <!-- Edit Form -->
                            <form action="{{ route('werkstuk.update') }}" method="post">
                                @csrf

                                <div class="card rounded shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Bewerk Werkstuk</h3>
                                    </div>

                                    <div class="card-body">
                                        <div class="input-group rounded input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Titel</span>
                                            <input type="text" id="title" name="title" class="form-control" placeholder="Geef een titel voor het werkstuk op." aria-label="Titel" aria-describedby="basic-addon1" value="{{ $werkstuk->title }}" />
                                            <input type="hidden" name="werkstuk_id" value="{{ $werkstuk->unique_id }}">
                                        </div>

                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Niveau</span>
                                            <select id="niveau" name="niveau" class="form-select rounded-start-0" aria-label="Niveau" aria-describedby="basic-addon1">
                                                <option value="" disabled selected>Kies het niveau voor het werkstuk</option>
                                                <option value="Makkelijk">Makkelijk</option>
                                                <option value="Gemiddeld">Gemiddeld</option>
                                                <option value="Moeilijk">Moeilijk</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Vak</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select rounded-start-0" data-control="select2" id="vak" name="vak" aria-label="Vak" data-placeholder="Selecteer een optie.">
                                                    @php
                                                        $vakken = ['Wiskunde', 'Biologie', 'Nederlands', 'NASK', 'Geschiedenis', 'Engels', 'Economie', 'Aardrijkskunde', 'K&C', 'Maatschappijleer', 'Informatica', 'Filosofie', 'L&G', 'Muziek', 'Techniek', 'Godsdienst/Levensbeschouwing', 'Frans', 'Duits', 'Spaans'];
                                                    @endphp

                                                    @foreach($vakken as $vak)
                                                        <option value="{{ $vak }}" {{ $werkstuk->vak == $vak ? 'selected' : '' }}>{{ $vak }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <textarea name="editor" id="editor">{{ $werkstuk->content }}</textarea>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary me-2">Opslaan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <!-- End Content Wrapper -->

                @include('includes.footer')
            </div>
            <!-- End Wrapper Container -->
        </div>



        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Javascript--


<!--begin::Javascript-->
    <script>var hostUrl = "{{ asset('assets/') }}";</script>

    <!--begin::Global Javascript Bundle (mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript (used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript (used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <!--end::Custom Javascript-->

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <!--end::Javascript-->


</body>
</html>

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
                                    <a href="{{ url('/') }}" class="text-white">
                                        <i class="ki-outline ki-home text-gray-700 fs-6"></i>
                                    </a>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-700">
                                    <i class="ki-outline ki-right fs-7 text-gray-700 mx-n1"></i>
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="breadcrumb-item text-gray-700 fw-bold lh-1">Werkstuk / </li>
                                <li class="breadcrumb-item text-white fw-bold lh-1">Nieuw</li>
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
                                    Nieuw Werkstuk
                                    <!--begin::Description-->
                                    <span class="page-desc text-gray-700 fw-semibold fs-6 pt-3">Op deze pagina kan je een nieuw werkstuk aanmaken!</span>
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
                            <form action="{{ route('werkstuk.store') }}" method="post">
                                @csrf
                                <div class="card shadow-sm">
                                    <div class="card-header">
                                        <h3 class="card-title">Nieuw Werkstuk</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Titel</span>
                                            <input type="text" id="title" name="title" class="form-control" placeholder="Geef een titel voor het werkstuk op." aria-label="Titel" aria-describedby="basic-addon1"/>
                                        </div>
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Niveau</span>
                                            <input type="text" id="niveau" name="niveau" class="form-control" placeholder="Geef een niveau voor het werkstuk op." aria-label="Niveau" aria-describedby="basic-addon1"/>
                                        </div>
                                        <div class="input-group input-group-solid mb-5">
                                            <span class="input-group-text" id="basic-addon1">Vak</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select rounded-start-0" data-control="select2" id="vak" name="vak" aria-label="Vak" data-placeholder="Selecteer een optie.">
                                                    <option value="Wiskunde">Wiskunde</option>
                                                    <option value="Biologie">Biologie</option>
                                                    <option value="Nederlands">Nederlands</option>
                                                    <option value="NASK">Natuur- &amp; Scheikunde</option>
                                                    <option value="Geschiedenis">Geschiedenis</option>
                                                    <option value="Engels">Engels</option>
                                                    <option value="Economie">Economie</option>
                                                    <option value="Aardrijkskunde">Aardrijkskunde</option>
                                                    <option value="K&C">Kunst &amp; Cultuur</option>
                                                    <option value="Maatschappijleer">Maatschappijleer</option>
                                                    <option value="Informatica">Informatica</option>
                                                    <option value="Filosofie">Filosofie</option>
                                                    <option value="L&G">Klassieke Talen (Latijn &amp; Grieks)</option>
                                                    <option value="Muziek">Muziek</option>
                                                    <option value="Techniek">Handvaardigheid &amp; Techniek</option>
                                                    <option value="Godsdienst/Levensbeschouwing">Godsdienst/Levensbeschouwing</option>
                                                    <option value="Frans">Frans</option>
                                                    <option value="Duits">Duits</option>
                                                    <option value="Spaans">Spaans</option>
                                                </select>
                                            </div>
                                        </div>
                                        <textarea name="content" id="editor">
                                       <h1>Maak gemakkelijk je werkstuk aan! Volg deze stappen om je werkstuk te maken:</h1>
                                          <ul>
                                             <li>Kies een onderwerp dat je interesseert.</li>
                                             <li>Verzamel informatie over je onderwerp. Zoek informatie op het internet, in boeken of in de bibliotheek. Zorg ervoor dat je de tekst in je eigen woorden herschrijft.</li>
                                             <li>Verzamel illustraties die bij de tekst passen. Deze verlevendigen je werkstuk en maken het duidelijker om te lezen.</li>
                                             <li>Schrijf je werkstuk. Begin met een inleiding waarin je kort vertelt waarom je voor het onderwerp hebt gekozen, over welke deelonderwerpen je iets gaat vertellen en wat je er zelf van denkt te leren. Sluit af met een slot dat aansluit bij de inleiding.</li>
                                             <li>Controleer de spelling, leestekens, hoofdletters en of de zinnen goed lopen.</li>
                                          </ul>
                                       <p>Succes met het maken van je werkstuk!</p>
                                    </textarea>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary me-2">Aanmaken</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                        <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Javascript--
                        @include('includes.footer')


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

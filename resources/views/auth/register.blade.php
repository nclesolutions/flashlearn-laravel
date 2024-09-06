<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('auth/img/favicon.png') }}" type="image/png" sizes="16x16">

    <title>FlashLearn - De Complete Digitale Leeromgeving voor Scholen en Individuele Gebruikers</title>
    <meta name="description" content="FlashLearn is de ultieme digitale leeromgeving voor scholen en individuele gebruikers. Beheer cijfers, huiswerk, en meer met gebruiksvriendelijke tools, terwijl gamification leren leuker maakt. Probeer het nu!">
    <meta name="keywords" content="FlashLearn, digitale leeromgeving, cijfers beheren, huiswerk systeem, gamified leren, online leren, educatie software, leren leuk maken, scholieren, onderwijs, scholen, individuele gebruikers, leren gamification, digitale educatie">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="FlashLearn - De Complete Digitale Leeromgeving voor Scholen en Individuele Gebruikers">
    <meta property="og:description" content="Met FlashLearn krijgen scholen en individuele gebruikers toegang tot een veelzijdige digitale leeromgeving die leren efficiënter en leuker maakt. Ontdek de mogelijkheden van deze innovatieve tool.">
    <meta property="og:url" content="https://www.flashlearn.com">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ asset('auth/img/favicon.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="FlashLearn - De Complete Digitale Leeromgeving voor Scholen en Individuele Gebruikers">
    <meta name="twitter:description" content="FlashLearn biedt alles wat je nodig hebt voor een effectieve en leuke leerervaring, van cijfers en huiswerk tot gamified leren.">
    <meta name="twitter:image" content="{{ asset('auth/img/favicon.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('auth/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('auth/css/custom.css') }}" rel="stylesheet">
</head>

<body>

<div id="preloader" class="bg-light-subtle">
    <div class="preloader-wrap">
        <div class="loading-bar"></div>
    </div>
</div>

<div class="main-wrapper">
    <section class="sign-up-in-section bg-dark ptb-60" style="background: url('{{ asset('auth/img/page-header-bg.svg') }}') no-repeat right bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12">
                    <div class="pricing-content-wrap bg-custom-light rounded-custom shadow-lg">
                        <div class="price-feature-col pricing-feature-info text-white left-radius p-5 order-1 order-lg-0">
                            <a href="https://nclesolutions.nl" class="mb-5 d-none d-xl-block d-lg-block"><img width="200" src="{{ asset('auth/img/logo-white.png') }}" alt="logo" class="img-fluid"></a>
                            <div class="customer-testimonial-wrap mt-60">
                                <blockquote>
                                    <h5>Welkom bij FlashLearn!</h5>
                                    We zijn verheugd om je een verbeterde ervaring te bieden met ons geoptimaliseerde Flashlearn-paneel.
                                </blockquote>
                                <div class="author-info mt-4">
                                    <h6 class="mb-0">Jochem van Rekum</h6>
                                    <span>Bestuur @ NCLE™ Solutions</span>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-60">
                                <div class="col-12">
                                    <p>Ontwikkeld en gepubliceerd door NCLE™ Solutions. Alle rechten voorbehouden.</p>
                                </div>
                            </div>
                        </div>
                        <div class="price-feature-col pricing-action-info p-5 right-radius bg-light-subtle order-0 order-lg-1">
                            <a href="https://nclesolutions.nl/" class="mb-5 d-block d-xl-none d-lg-none"><img src="{{ asset('auth/img/logo-color.png') }}" alt="logo" class="img-fluid"></a>
                            <h1 class="h3">Starten met FlashLearn!</h1>
                            <p class="text-muted">Ga vandaag nog aan de slag met uw gratis account. Geen creditcard nodig en geen opstartkosten.</p>

                            @if($errors->any() || session('success') || session('warning'))
                                <div class="alert
                @if($errors->any()) alert-danger
                @elseif(session('success')) alert-success
                @elseif(session('warning')) alert-warning
                @endif
                alert-dismissible fade show" role="alert">
                                    <strong>
                                        @if($errors->any())
                                            {{ __('Oeps!') }}
                                        @elseif(session('success'))
                                            {{ __('Gelukt!') }}
                                        @elseif(session('warning'))
                                            {{ __('Let op!') }}
                                        @endif
                                    </strong><br>

                                    @if($errors->any())
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}<br>
                                        @endforeach
                                    @elseif(session('success'))
                                        {{ session('success') }}
                                    @elseif(session('warning'))
                                        {{ session('warning') }}
                                    @endif

                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-right: 0;"></button>
                                </div>
                            @endif

                            <form action="{{ route('register.post') }}" method="post" class="mt-5 register-form">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="firstname" class="mb-1">Voornaam <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Voornaam" name="firstname" id="firstname" required aria-label="firstname" value="{{ old('firstname') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="lastname" class="mb-1">Achternaam <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Achternaam" name="lastname" id="lastname" required aria-label="lastname" value="{{ old('lastname') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="email" class="mb-1">E-Mailadres <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" placeholder="E-Mailadres" name="email" id="email" required aria-label="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="password" class="mb-1">Wachtwoord <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Wachtwoord" name="password" id="password" required aria-label="Wachtwoord">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="password_confirmation" class="mb-1">Herhaal Wachtwoord <span class="text-danger">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Bevestig Wachtwoord" name="password_confirmation" id="password_confirmation" required aria-label="Bevestig Wachtwoord">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check d-flex">
                                            <input class="form-check-input me-2" type="checkbox" name="terms" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                Ik ga akkoord met de <a href="https://nclesolutions.nl/documenten" class="text-decoration-none">algemene voorwaarden</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary mt-4 d-block w-100" type="submit">Aanmelden</button>
                                    </div>
                                </div>
                                <div class="position-relative d-flex align-items-center justify-content-center mt-4 py-4">
                                    <span class="divider-bar"></span>
                                    <h6 class="position-absolute text-center divider-text bg-light-subtle mb-0">Of</h6>
                                </div>
                                <div class="action-btns">
                                    <a href="#" class="btn google-btn mt-4 d-block bg-white shadow-sm d-flex align-items-center text-decoration-none justify-content-center">
                                        <img src="{{ asset('auth/img/google-icon.svg') }}" alt="google" class="me-3">
                                        <span>Aanmelden met Google</span>
                                    </a>
                                </div>
                                <p class="text-center text-muted mt-4 mb-0 fw-medium font-monospace">Heb je al een account? <a href="{{ route('login') }}" class="text-decoration-none">Log hier in</a>.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('auth/js/vendors/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('auth/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('auth/js/vendors/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('auth/js/vendors/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('auth/js/vendors/parallax.min.js') }}"></script>
<script src="{{ asset('auth/js/vendors/aos.js') }}"></script>
<script src="{{ asset('auth/js/vendors/massonry.min.js') }}"></script>
<script src="{{ asset('auth/js/app.js') }}"></script>
</body>

</html>

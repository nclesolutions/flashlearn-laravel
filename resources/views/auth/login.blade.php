<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('includes.meta')

    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700;9..40,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lily+Script+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/custom.css') }}">
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
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-5 col-md-8 col-12">
                    <a href="https://nclesolutions.nl" class="mb-4 d-block text-center"><img src="{{ asset('auth/img/logo-white.png') }}" width="200" alt="logo" class="img-fluid"></a>
                    <div class="register-wrap p-5 bg-light-subtle shadow rounded-custom">
                        <h1 class="h3">Welkom terug!</h1>
                        <p class="text-muted">Log in om toegang te krijgen tot de webgebaseerde methoden van innovatieve niches van uw account.</p>
                        <div class="action-btns">
                            <a href="#" class="btn google-btn bg-white shadow-sm mt-4 d-block d-flex align-items-center text-decoration-none justify-content-center">
                                <img src="{{ asset('auth/img/google-icon.svg') }}" alt="google" class="me-3">
                                <span>Inloggen met Google</span>
                            </a>
                        </div>
                        <div class="position-relative d-flex align-items-center justify-content-center mt-4 py-4">
                            <span class="divider-bar"></span>
                            <h6 class="position-absolute text-center divider-text bg-light-subtle mb-0">Of</h6>
                        </div>
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


                        <form action="{{ route('login.post') }}" method="post" class="mt-4 register-form">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <label for="email" class="mb-1">E-Mailadres <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="email" class="form-control" placeholder="E-Mailadres" name="email" id="email" required aria-label="email">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <label for="password" class="mb-1">Wachtwoord <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Wachtwoord" name="password" id="password" required aria-label="Password">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember_me" id="remember_me">
                                        <label class="form-check-label" for="remember_me">
                                            Mij onthouden
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary mt-3 d-block w-100">Inloggen</button>
                                </div>
                            </div>
                            <p class="font-monospace fw-medium text-center text-muted mt-3 pt-4 mb-0">Wachtwoord vergeten? <a href="/wachtwoord/vergeten" class="text-decoration-none">Herstel het hier!</a> Of wil je een nieuw <a href="/aanmelden" class="text-decoration-none">account aanmaken</a>?</p>
                        </form>
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

<?php
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\FlashcardController;
use App\Http\Middleware\FetchSchool;
use App\Http\Middleware\CheckUserActivation;
use App\Http\Middleware\CheckUserMembership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Algemene routes voor het dashboard, werkstukken en flitskaarten (geen CheckUserMembership nodig)
Route::middleware(['auth', 'verified', FetchSchool::class, CheckUserActivation::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Project Routes (toegankelijk voor iedereen)
    Route::prefix('werkstuk')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('dashboard.project.index');
        Route::get('/view/{id}', [ProjectController::class, 'view'])->name('dashboard.project.view');
        Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('dashboard.project.delete');
        Route::get('/bewerk/{id}', [ProjectController::class, 'edit'])->name('dashboard.project.edit');
        Route::get('/nieuw', [ProjectController::class, 'create'])->name('dashboard.project.create');
        Route::post('/edit', [ProjectController::class, 'update'])->name('werkstuk.update');
        Route::post('/insert', [ProjectController::class, 'store'])->name('werkstuk.store');
    });

    // Flashcard Routes (toegankelijk voor iedereen)
    Route::get('/flashcards', [FlashcardController::class, 'index'])->name('dashboard.flashcards.index');
    Route::get('/flashcards/create', [FlashcardController::class, 'create'])->name('dashboard.flashcards.create');
    Route::post('/flashcards/store', [FlashcardController::class, 'store'])->name('dashboard.flashcards.store');
    Route::get('/flashcards/start/{subject}', [FlashcardController::class, 'start'])->name('dashboard.flashcards.start');
    Route::post('/flashcards/answer/{subject}', [FlashcardController::class, 'answer'])->name('dashboard.flashcards.answer');
    Route::get('/flashcards/result/{subject}', [FlashcardController::class, 'result'])->name('dashboard.flashcards.result');
    Route::post('/flashcards/import', [FlashcardController::class, 'import'])->name('dashboard.flashcards.import');
    Route::get('/flashcards/export', [FlashcardController::class, 'export'])->name('dashboard.flashcards.export');
});

// Routes die alleen leerlingen moeten gebruiken (CheckUserMembership toegevoegd)
Route::middleware(['auth', 'verified', CheckUserMembership::class, CheckUserActivation::class])->group(function () {
    // Homework Routes
    Route::get('/huiswerk', [HomeworkController::class, 'index'])->name('dashboard.homework.index');
    Route::get('/huiswerk/view/{id}', [HomeworkController::class, 'view'])->name('dashboard.homework.view');

    // Absence Routes
    Route::get('/afwezigheid', [AbsenceController::class, 'index'])->name('dashboard.absence.index');
    Route::get('/afwezigheid/view/{id}', [AbsenceController::class, 'view'])->name('dashboard.absence.view');

    // Grades Routes
    Route::get('/cijfers', [GradesController::class, 'index'])->name('dashboard.grades.index');
    Route::get('/cijfers/view/{vak}', [GradesController::class, 'view'])->name('dashboard.grades.view');

    // Subject Routes
    Route::get('/vakken', [SubjectController::class, 'index'])->name('dashboard.subjects.index');
    Route::get('/vak/bekijk/{vak}', [SubjectController::class, 'view'])->name('dashboard.subjects.view');

    // School Routes
    Route::get('/school', [SchoolController::class, 'index'])->name('school.index');
    Route::get('/school/chat', [SchoolController::class, 'contact'])->name('school.contact');

});

// Account gerelateerde routes (toegankelijk voor iedereen)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('account')->group(function () {
        Route::get('/profiel', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/instellingen', [ProfileController::class, 'settings'])->name('profile.settings');
        Route::get('/beveiliging', [ProfileController::class, 'security'])->name('profile.security');
    });
    Route::post('/account/update-bio', [ProfileController::class, 'updateBio'])->name('profile.updateBio');
    Route::post('/account/update-security', [ProfileController::class, 'updateSecurity'])->name('profile.updateSecurity');
});

// Auth routes (geen middleware nodig)
Route::get('/inloggen', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/inloggen', [AuthController::class, 'login'])->name('login.post');
Route::get('/aanmelden', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/aanmelden', [AuthController::class, 'register'])->name('register.post');
Route::get('/wachtwoord/vergeten', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/wachtwoord/vergeten', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/wachtwoord/reset/{token?}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/wachtwoord/reset', [AuthController::class, 'resetPassword'])->name('password.update');

// Uitlog route
Route::middleware(['auth'])->post('/api/uitloggen', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/inloggen');
})->name('logout');

// E-mail verificatie routes
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::middleware(['auth'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

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
use App\Http\Middleware\CheckUserActivation;
use App\Http\Middleware\CheckUserMembership;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Dashboard Routes
Route::middleware(['auth', 'verified', CheckUserMembership::class, CheckUserActivation::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Homework Routes
    Route::get('/huiswerk', [HomeworkController::class, 'index'])->name('dashboard.homework.index');
    Route::get('/huiswerk/view/{id}', [HomeworkController::class, 'view'])->name('dashboard.homework.view');

    // Absence Routes
    Route::get('/afwezigheid', [AbsenceController::class, 'index'])->name('dashboard.absence.index');
    Route::get('/afwezigheid/view/{id}', [AbsenceController::class, 'view'])->name('dashboard.absence.view');

    // Grades Routes
    Route::get('/cijfers', [GradesController::class, 'index'])->name('dashboard.grades.index');
    Route::get('/cijfers/view/{vak}', [GradesController::class, 'view'])->name('dashboard.grades.view');

    Route::get('/vakken', [SubjectController::class, 'index'])->name('dashboard.subjects.index');
    Route::get('/vak/bekijk/{vak}', [SubjectController::class, 'view'])->name('dashboard.subjects.view');

    Route::get('/account/profiel', [ProfileController::class, 'index'])->name('profile.index');

    // Project Routes
    Route::prefix('werkstuk')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('dashboard.project.index');
        Route::get('/view/{id}', [ProjectController::class, 'view'])->name('dashboard.project.view');
        Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('dashboard.project.delete');
        Route::get('/bewerk/{id}', [ProjectController::class, 'edit'])->name('dashboard.project.edit');
        Route::get('/nieuw', [ProjectController::class, 'create'])->name('dashboard.project.create');
        Route::post('/edit', [ProjectController::class, 'update'])->name('werkstuk.update');
        Route::post('/insert', [ProjectController::class, 'store'])->name('werkstuk.store');
    });

    // School Routes
    Route::get('/school', [SchoolController::class, 'index'])->name('school.index');
    Route::get('/school/chat', [SchoolController::class, 'contact'])->name('school.contact');
});

Route::get('/inloggen', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/geblokkeerd', [AuthController::class, 'showBlocked'])->name('blocked');
Route::get('/onderhoud', [AuthController::class, 'showMaintenance'])->name('maintenance');

Route::post('/inloggen', [AuthController::class, 'login'])->name('login.post');
Route::get('/aanmelden', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/aanmelden', [AuthController::class, 'register'])->name('register.post');
Route::get('/wachtwoord/vergeten', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/wachtwoord/vergeten', [AuthController::class, 'sendResetLink'])->name('password.email');

Route::get('/wachtwoord/reset/{token?}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/wachtwoord/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth'])->group(function () {
    Route::post('/api/uitloggen', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/inloggen');
    })->name('logout');
});

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::middleware(['auth', 'signed'])->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
});

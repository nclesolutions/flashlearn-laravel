<?php

use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckUserActivation;
use App\Http\Middleware\CheckUserMembership;

Route::middleware(['auth:sanctum', CheckUserMembership::class, CheckUserActivation::class])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        // Voeg hier andere API-routes toe die deze middleware vereisen
    });

Route::post('/login', [AuthController::class, 'APILogin']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'APIshow']);
// Route voor het ophalen van alle werkstukken, eventueel gefilterd op vak
Route::get('/projects', [ProjectController::class, 'APIIndex']);

// Route voor het ophalen van een specifiek werkstuk op basis van ID
Route::get('/projects/{id}', [ProjectController::class, 'APIView']);

// Route voor het aanmaken van een nieuw werkstuk
Route::middleware('auth:sanctum')->post('/projects', [ProjectController::class, 'APIStore']);

// Route voor het bijwerken van een bestaand werkstuk op basis van ID
Route::middleware('auth:sanctum')->put('/projects/{id}', [ProjectController::class, 'APIUpdate']);

// Route voor het verwijderen van een werkstuk op basis van ID
Route::middleware('auth:sanctum')->delete('/projects/{id}', [ProjectController::class, 'APIDestroy']);

// Route voor het ophalen van beschikbare vakken
Route::get('/projects/vakken/available', [ProjectController::class, 'APIAvailableVakken']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/absences', [AbsenceController::class, 'APIIndex']);
    Route::get('/absences/{id}', [AbsenceController::class, 'APIView']);
});
Route::middleware('auth:sanctum')->get('/rooster', [DashboardController::class, 'APIIndex']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/homework', [HomeworkController::class, 'APIIndex']);
    Route::get('/homework/{id}', [HomeworkController::class, 'APIView']);
});
Route::middleware('auth:sanctum')->get('/school', [SchoolController::class, 'APIIndex']);
Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'APIIndex']);
Route::middleware('auth:sanctum')->get('/grades', [GradesController::class, 'APIIndex']);
Route::middleware('auth:sanctum')->get('/user-projects', [ProjectController::class, 'APIUserProjects']);
Route::middleware('auth:sanctum')->get('/subjects', [SubjectController::class, 'APIIndex']);

<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SafetyObservationFormController;
use App\Http\Controllers\SafetyBehaviorChecklistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'checkUserStatus']);

Route::middleware(['auth', 'checkUserStatus'])->prefix('dashboard/users')->group(function () {
    Route::get('/pending', [UserController::class, 'pendingUsers'])->name('users.pending');
    Route::get('/approved', [UserController::class, 'approvedUsers'])->name('users.approved');
    Route::get('/rejected', [UserController::class, 'rejectedUsers'])->name('users.rejected');
});

Route::middleware(['auth', 'checkUserStatus'])->prefix('dashboard')->group(function () {
    Route::get('/chart', [ChartJSController::class, 'index']);
    Route::resource('profile', ProfileController::class);
    Route::resource('users', UserController::class);
    Route::resource('location', LocationController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class);
    Route::resource('safety-observation-forms', SafetyObservationFormController::class);

    Route::get('safety-observation-forms/{safety_observation_form}/review-by-she', [SafetyObservationFormController::class, 'reviewByShe'])
        ->name('safety-observation-forms.review-by-she');
});


// Route::middleware(['auth', 'pegawai'])->prefix('dashboard')->group(function(){
//     Route::resource('profile', ProfileController::class);
//     Route::resource('safety-observation-forms', SafetyObservationFormController::class)->only(['create', 'stpre', 'edit']);
// });

// Route::middleware(['auth', 'SHE'])->prefix('dashboard')->group(function(){
//     Route::resource('profile', ProfileController::class);
//     Route::resource('location', LocationController::class)->only(['create', 'stpre', 'edit']);
//     Route::resource('companies', CompanyController::class)->only(['create', 'stpre', 'edit']);
//     Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class)->only(['create', 'stpre', 'edit']);
//     Route::resource('safety-observation-forms', SafetyObservationFormController::class)->only(['create', 'stpre', 'edit']);
// });

// Route::middleware(['auth', 'manager'])->prefix('dashboard')->group(function(){
//     Route::resource('profile', ProfileController::class);
//     Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class)->only(['create', 'stpre', 'edit']);
//     Route::resource('safety-observation-forms', SafetyObservationFormController::class)->only(['create', 'stpre', 'edit']);
// });

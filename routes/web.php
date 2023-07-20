<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth', 'checkUserStatus']);

Route::middleware(['auth', 'checkUserStatus'])->prefix('dashboard')->group(function () {
    Route::get('/users/pending', [UserController::class, 'pendingUsers'])->name('users.pending');
    });
    
Route::middleware(['auth', 'checkUserStatus'])->prefix('dashboard')->group(function () {
        Route::resource('profile', ProfileController::class);
        Route::resource('users', UserController::class);
        Route::resource('location', LocationController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class);
        Route::resource('safety-observation-forms', SafetyObservationFormController::class);
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


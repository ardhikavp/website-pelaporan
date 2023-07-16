<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->prefix('dashboard')->group(function(){
    Route::resource('location', LocationController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class);
    Route::resource('safety-observation-forms', SafetyObservationFormController::class);
});

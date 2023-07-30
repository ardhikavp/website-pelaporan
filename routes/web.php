<?php

use App\Events\MessageCreated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SafetyObservationFormController;
use App\Http\Controllers\SafetyBehaviorChecklistController;
use App\Models\Answer;
use App\Models\SafetyBehaviorChecklist;

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
// Route::get('/notifications', 'NotificationController@index');
Route::get('/', function () {
    MessageCreated::dispatch('welcome to website pelaporan');

    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('home')
    ->middleware(['auth']);

Route::middleware(['auth'])->prefix('dashboard/users')->group(function () {
    Route::get('/pending', [UserController::class, 'pendingUsers'])->name('users.pending');
    Route::get('/approved', [UserController::class, 'approvedUsers'])->name('users.approved');
    Route::get('/rejected', [UserController::class, 'rejectedUsers'])->name('users.rejected');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    // Route::get('notifications', [NotificationController::class,'notification']);
    Route::get('/chart', [ChartJSController::class, 'index']);
        Route::resource('profile', ProfileController::class);
        Route::resource('users', UserController::class);
        Route::resource('location', LocationController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('safety-behavior-checklist', SafetyBehaviorChecklistController::class);
        Route::resource('safety-observation-forms', SafetyObservationFormController::class);

        // Route::get('safety-observation-form/');
        Route::get('safety-observation-forms/{safety_observation_form}/review-by-she', [SafetyObservationFormController::class, 'reviewByShe'])
        ->name('safety-observation-forms.review-by-she');
        Route::put('/safety-observation-forms/{safety_observation_form}/reviewed-by-she', [SafetyObservationFormController::class, 'updateReviewedByShe'])
        ->name('safety-observation-forms.update-reviewed-by-she');
        Route::get('safety-observation-forms/{safety_observation_form}/approve-by-manager', [SafetyObservationFormController::class, 'approveByManager'])
        ->name('safety-observation-forms.approve-by-manager');
        Route::put('/safety-observation-forms/{safety_observation_form}/approved-by-manager', [SafetyObservationFormController::class, 'updateApprovedByManager'])
        ->name('safety-observation-forms.update-approved-by-manager');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        Route::get('safety-behavior-checklist/{answer}/agreement-by-pic', [SafetyBehaviorChecklistController::class, 'reviewByPIC'])
        ->name('safety-behavior-checklist.review-by-pic');
        Route::put('safety-behavior-checklist/{answer}/agreed-by-pic', [SafetyBehaviorChecklistController::class, 'updateReviewedByPIC'])
        ->name('safety-behavior-checklist.update-reviewed-by-pic');
        Route::get('safety-behavior-checklist/{answer}/approve-by-manager', [SafetyBehaviorChecklistController::class, 'approveByManager'])
        ->name('safety-behavior-checklist.approve-by-manager');
        Route::put('safety-behavior-checklist/{answer}/approved-by-manager', [SafetyBehaviorChecklistController::class, 'updateApprovedBymanager'])
        ->name('safety-behavior-checklist.update-approved-by-manager');
        // Route:get('safety-observation-forms/')
    });
Route::middleware(['auth'])->prefix('dashboard/safety-observation-forms')->group(function () {
    Route::get('/approved-table-data', 'SafetyObservationFormController@getApprovedTableData');
    Route::get('/pending-review-table-data', 'SafetyObservationFormController@getPendingReviewTableData');
    Route::get('/pending-approve-table-data', 'SafetyObservationFormController@getPendingApproveTableData');
    Route::get('/rejected-table-data', 'SafetyObservationFormController@getRejectedTableData');
    // Add more routes for other tables as needed
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

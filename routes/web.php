<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CekResiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ShipmentTrackingController; // Ensure this is imported
use Illuminate\Support\Facades\Route;

// Homepage route
Route::get('/', function () {
    return view('home'); // Point to the new homepage view
})->name('home');

// Dashboard route
Route::get('/dashboard', [ProfileController::class, 'show'])->middleware(['auth'])->name('dashboard');

// Profile edit route
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');

// Logout route
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth'])->name('logout');

// Other routes...

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

// Tracking route without authentication
Route::get('/cekresi', [CekResiController::class, 'showForm'])->name('cekresi.show');
Route::post('/cekresi/track', [CekResiController::class, 'track'])->name('cekresi.track');

// New route for saving tracking data
Route::post('/tracking/save', [ShipmentTrackingController::class, 'saveTrackingData'])->name('tracking.save');

// Other routes...

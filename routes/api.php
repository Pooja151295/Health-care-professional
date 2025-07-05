<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HealthcareProfessionalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/healthcare-professionals', [HealthcareProfessionalController::class, 'index']);
    Route::post('/book-appointment', [AppointmentController::class, 'store']);
    Route::get('/get-all-appointments', [AppointmentController::class, 'getUserAppointments']);
    Route::patch('/appointments/status', [AppointmentController::class, 'updateAppointmentStatus']);
});


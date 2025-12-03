<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

// 1. Route ROOT (Halaman Depan / Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. Route Tamu (Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// 3. Route Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 4. Route yang DIPROTEKSI (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- DAFTAR RESOURCE CONTROLLER (INI YANG SEBELUMNYA HILANG) ---
    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('attendances', AttendanceController::class);
    Route::resource('salaries', SalaryController::class);

    // Route Absensi Mandiri
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');

    Route::get('/salaries/{id}/print', [App\Http\Controllers\SalaryController::class, 'printPDF'])->name('salaries.print');
});
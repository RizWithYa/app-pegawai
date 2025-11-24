<?php

use Illuminate\Support\Facades\Route;
// Import semua controller yang dibutuhkan
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SalaryController;

Route::get('/', function () {
    return view('welcome');
});

// Route CRUD Pegawai (Sudah ada sebelumnya)
Route::resource('employees', EmployeeController::class);

// --- TUGAS 5: Tambahan Route untuk CRUD Master & Transaksi ---

// Route untuk CRUD Departemen
Route::resource('departments', DepartmentController::class);

// Route untuk CRUD Jabatan
Route::resource('positions', PositionController::class);

// Route untuk CRUD Absensi
Route::resource('attendances', AttendanceController::class);

// Route untuk CRUD Gaji
Route::resource('salaries', SalaryController::class);
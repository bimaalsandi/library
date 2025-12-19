<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/profile', [AuthController::class, 'profile'])->middleware('role:admin,member')->name('profile');
Route::put('/profile', [AuthController::class, 'updateProfile'])->middleware('role:admin,member')->name('profile.update');
Route::post('/change-password', [AuthController::class, 'changePassword'])->middleware('role:admin,member')->name('change.password');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('role:admin');
Route::get('/buku', [BukuController::class, 'index'])->middleware('role:admin');
Route::get('/buku/create', [BukuController::class, 'create'])->middleware('role:admin');
Route::post('/buku/save', [BukuController::class, 'save'])->middleware('role:admin');

Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->middleware('role:admin');
Route::put('/buku/update/{id}', [BukuController::class, 'update'])->middleware('role:admin');
Route::delete('/buku/delete/{id}', [BukuController::class, 'delete'])->middleware('role:admin');

Route::get('/pengunjung', [PengunjungController::class, 'index'])->middleware('role:admin');
Route::get('/pengunjung/edit/{id}', [PengunjungController::class, 'edit'])->middleware('role:admin');
Route::put('/pengunjung/update/{id}', [PengunjungController::class, 'update'])->middleware('role:admin');

Route::resource('/user', UserController::class)->middleware('role:admin');

Route::get('/report-mingguan', [ReportController::class, 'index'])->middleware('role:admin');
Route::get('/report-bulanan', [ReportController::class, 'indexBulanan'])->middleware('role:admin');
Route::get('/report-tahunan', [ReportController::class, 'indexTahunan'])->middleware('role:admin');

Route::get('/register', [AuthController::class, 'register']);
Route::post('/process-register', [AuthController::class, 'processRegister']);

Route::get('/dashboard-member', [DashboardController::class, 'indexMember'])->middleware('role:member');
Route::get('/buku/pinjam/{id}', [BukuController::class, 'pinjam'])->middleware('role:member');
Route::post('/buku/process-pinjam', [BukuController::class, 'processPinjam'])->middleware('role:member');
Route::get('/list-pinjaman-buku', [BukuController::class, 'listPinjamanBuku'])->middleware('role:member');

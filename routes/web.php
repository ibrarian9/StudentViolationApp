<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\SanksiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SmartController;
use App\Http\Controllers\SubkriteriaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::get('/guru/{user}/edit', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/{user}', [GuruController::class, 'update'])->name('guru.update');
    Route::post('/guru', [GuruController::class, 'store'])->name('guru.store');
    Route::delete('/guru/{user}', [GuruController::class, 'edit'])->name('guru.destroy');
    Route::resource('sanksi', SanksiController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('subkriteria', SubkriteriaController::class);
    Route::resource('pelanggaran', PelanggaranController::class);
    Route::get('/proses-smart', [SmartController::class, 'index'])->name('proses-smart');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    //Show Siswa
    Route::get('/siswa/{siswa}', [SiswaController::class, 'show'])->name('siswa.show');
    Route::get('/download/{siswa}', [SiswaController::class, 'downloadPdf'])->name('download.pdf');
    //Edit Subkriteria
    Route::get('/subkriteria/{id}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');
    Route::put('/subkriteria/{id}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');
});

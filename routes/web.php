<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtpController;
use App\Http\Controllers\PdfDownloadController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [KtpController::class, 'index'])->name('home')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/ktp/show-all', [KtpController::class, 'showAll'])->name('ktp.showAll');
    Route::get('/ktp/export', [KtpController::class, 'export'])->name('ktp.export');
    Route::get('/ktp/export-pdf', [KtpController::class, 'pdfExport'])->name('ktp.export.pdf');
    Route::get('/ktp/pdf/download', [PdfDownloadController::class, 'downloadKtpPdf'])->name('ktp.pdf.download')->middleware('auth');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('ktpCreate', [KtpController::class, 'create'])->name('ktpCreate');
    Route::post('ktpCreate', [KtpController::class, 'store'])->name('ktp.store');
    Route::get('ktp/{nik}/edit', [KtpController::class, 'edit'])->name('ktp.edit');
    Route::put('ktp/{nik}', [KtpController::class, 'update'])->name('ktp.update');
    Route::delete('ktp/{nik}', [KtpController::class, 'destroy'])->name('ktp.destroy');
});

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');



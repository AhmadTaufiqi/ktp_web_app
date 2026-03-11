<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KtpController;

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

Route::get('/', [KtpController::class, 'index'])->name('home');
Route::get('/ktp/show-all', [KtpController::class, 'showAll'])->name('ktp.showAll');

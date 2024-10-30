<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InternshipController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Mahasiswa\KegiatanController;
use App\Http\Controllers\Mahasiswa\MahasiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');

Route::middleware(['auth.custom'])->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index'])->name('admin.index');
        Route::resource('mahasiswa', InternshipController::class);
        Route::post('mahasiswa/{mahasiswa}/password', [InternshipController::class, 'password'])->name('mahasiswa.password');
    });

    Route::get('welcome', [MahasiswaController::class, 'index'])->name('user.index');
    Route::resource('kegiatan', KegiatanController::class);
    Route::put('kegiatan/{kegiatan}/status', [KegiatanController::class, 'status'])->name('kegiatan.status');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

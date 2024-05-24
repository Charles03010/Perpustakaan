<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SkripsiController;
use Illuminate\Support\Facades\Storage;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->as('admin.')->group(function () {
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('peminjaman', PeminjamanController::class, ['except' => ['update']]);
            Route::resource('pengarang', PengarangController::class, ['except' => ['update']]);
            Route::resource('penerbit', PenerbitController::class, ['except' => ['update']]);
            Route::resource('kategori', KategoriController::class, ['except' => ['update', 'show']]);
            Route::resource('fakultas', FakultasController::class, ['except' => ['update']]);
            Route::resource('prodi', ProdiController::class, ['except' => ['update']]);
            Route::resource('buku', BukuController::class, ['except' => ['update']]);
            Route::resource('skripsi', SkripsiController::class, ['except' => ['update']]);
            // Route::get('/download/{file}', function (string $file) {
            //     return redirect(Storage::url($file));
            // })->name('download')->where('file', '.*');;
        });
    });

    Route::middleware('role:pengguna')->group(function () {
        Route::prefix('pengguna')->as('pengguna.')->group(function () {
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('peminjaman', PeminjamanController::class, ['except' => ['update']]);
            Route::resource('skripsi', SkripsiController::class, ['except' => ['update']]);
        });
    });
    Route::get('/download/{file}', function (string $file) {
        return redirect(Storage::url($file));
    })->name('download')->where('file', '.*');;
});

<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\DetailBuku;
use App\Models\DetailSkripsi;
use App\Models\Penerbit;
use App\Models\Pengarang;
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
        Route::get('/dashboard-admin', function () {
            return view('dashboard-admin');
        })->name('dashboard-admin');
        Route::get('/peminjaman-admin', function () {
            return view('peminjaman-admin');
        })->name('peminjaman-admin');
        Route::get('/pengarang-admin', function () {
            return view('pengarang-admin', ['pengarang' => Pengarang::all()]);
        })->name('pengarang-admin');
        Route::get('/penerbit-admin', function () {
            return view('penerbit-admin',['penerbit' => Penerbit::all()]);
        })->name('penerbit-admin');
        Route::get('/buku-admin', function () {
            return view('buku-admin');
        })->name('buku-admin',['buku' => DetailBuku::all()]);
        Route::get('/skripsi-admin', function () {
            return view('skripsi-admin');
        })->name('skripsi-admin',['skripsi' => DetailSkripsi::all()]);

        // Pengarang
        Route::get('/pengarang-admin/tambah', function () {
            return view('func.tambah-pengarang-admin');
        })->name('tambah-pengarang-admin');
        Route::post('/pengarang-admin/tambah', [AdminController::class, 'addPengarang'])->name('addPengarang.process');
        Route::get('/pengarang-admin/edit/{id}', function ($id) {
            $pengarang = Pengarang::findOrFail($id);
            return view('func.tambah-pengarang-admin', ['pengarang' => $pengarang]);
        })->name('edit-pengarang-admin');
        Route::get('/pengarang-admin/delete/{id}', function ($id) {
            $pengarang = Pengarang::findOrFail($id);
            if ($pengarang->foto != 'default.jpg') {
                Storage::delete('public/' . $pengarang->foto);
            };
            $pengarang->delete();
            return redirect()->route('pengarang-admin');
        })->name('delete-pengarang-admin');
        Route::get('/pengarang-admin/detail/{id}', function ($id) {
            $pengarang = Pengarang::findOrFail($id);
            return view('func.detail-pengarang-admin', ['pengarang' => $pengarang]);
        })->name('detail-pengarang-admin');

        // Penerbit
        Route::get('/penerbit-admin/tambah', function () {
            return view('func.tambah-penerbit-admin');
        })->name('tambah-penerbit-admin');
        Route::post('/penerbit-admin/tambah', [AdminController::class, 'addPenerbit'])->name('addPenerbit.process');
        Route::get('/penerbit-admin/edit/{id}', function ($id) {
            $penerbit = Penerbit::findOrFail($id);
            return view('func.tambah-penerbit-admin', ['penerbit' => $penerbit]);
        })->name('edit-penerbit-admin');
        Route::get('/penerbit-admin/delete/{id}', function ($id) {
            $penerbit = Penerbit::findOrFail($id);
            if ($penerbit->foto != 'default.jpg') {
                Storage::delete('public/' . $penerbit->foto);
            };
            $penerbit->delete();
            return redirect()->route('penerbit-admin');
        })->name('delete-penerbit-admin');
        Route::get('/penerbit-admin/detail/{id}', function ($id) {
            $penerbit = Penerbit::findOrFail($id);
            return view('func.detail-penerbit-admin', ['penerbit' => $penerbit]);
        })->name('detail-penerbit-admin');
    });

    Route::middleware('role:pengguna')->group(function () {
        Route::get('/dashboard-pengguna', function () {
            return view('dashboard-pengguna');
        });
    });
});

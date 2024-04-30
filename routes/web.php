<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\DetailBuku;
use App\Models\DetailSkripsi;
use App\Models\Fakultas;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Prodi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

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
            return view('penerbit-admin', ['penerbit' => Penerbit::all()]);
        })->name('penerbit-admin');
        Route::get('/kategori-admin', function () {
            return view('kategori-admin', ['kategori' => Kategori::all()]);
        })->name('kategori-admin');
        Route::get('/fakultas-admin', function () {
            return view('fakultas-admin', ['fakultas' => Fakultas::all()]);
        })->name('fakultas-admin');
        Route::get('/prodi-admin', function () {
            return view('prodi-admin', ['prodi' => Prodi::all()]);
        })->name('prodi-admin');
        Route::get('/buku-admin', function () {
            $bukuList = [];
            foreach (DetailBuku::all() as $buku) {
                $bukuList[] = [$buku, $buku->repo];
            }
            return view('buku-admin', ['buku' => $bukuList]);
        })->name('buku-admin');
        Route::get('/skripsi-admin', function () {
            $skripsiList = [];
            foreach (DetailSkripsi::all() as $skripsi) {
                $skripsiList[] = [$skripsi, $skripsi->repo];
            }
            return view('skripsi-admin', ['skripsi' => $skripsiList]);
        })->name('skripsi-admin');

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

        // Kategori
        Route::get('/kategori-admin/tambah', function () {
            return view('func.tambah-kategori-admin');
        })->name('tambah-kategori-admin');
        Route::post('/kategori-admin/tambah', [AdminController::class, 'addKategori'])->name('addKategori.process');
        Route::get('/kategori-admin/edit/{id}', function ($id) {
            $kategori = Kategori::findOrFail($id);
            return view('func.tambah-kategori-admin', ['kategori' => $kategori]);
        })->name('edit-kategori-admin');
        Route::get('/kategori-admin/delete/{id}', function ($id) {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();
            return redirect()->route('kategori-admin');
        })->name('delete-kategori-admin');

        // Fakultas
        Route::get('/fakultas-admin/tambah', function () {
            return view('func.tambah-fakultas-admin');
        })->name('tambah-fakultas-admin');
        Route::post('/fakultas-admin/tambah', [AdminController::class, 'addFakultas'])->name('addFakultas.process');
        Route::get('/fakultas-admin/edit/{id}', function ($id) {
            $fakultas = Fakultas::findOrFail($id);
            return view('func.tambah-fakultas-admin', ['fakultas' => $fakultas]);
        })->name('edit-fakultas-admin');
        Route::get('/fakultas-admin/delete/{id}', function ($id) {
            $fakultas = Fakultas::findOrFail($id);
            if ($fakultas->foto != 'default.jpg') {
                Storage::delete('public/' . $fakultas->foto);
            };
            $fakultas->delete();
            return redirect()->route('fakultas-admin');
        })->name('delete-fakultas-admin');

        // prodi
        Route::get('/prodi-admin/tambah', function () {
            return view('func.tambah-prodi-admin');
        })->name('tambah-prodi-admin');
        Route::post('/prodi-admin/tambah', [AdminController::class, 'addProdi'])->name('addProdi.process');
        Route::get('/prodi-admin/edit/{id}', function ($id) {
            $prodi = Prodi::findOrFail($id);
            return view('func.tambah-prodi-admin', ['prodi' => $prodi]);
        })->name('edit-prodi-admin');
        Route::get('/prodi-admin/delete/{id}', function ($id) {
            $prodi = Prodi::findOrFail($id);
            if ($prodi->foto != 'default.jpg') {
                Storage::delete('public/' . $prodi->foto);
            };
            $prodi->delete();
            return redirect()->route('prodi-admin');
        })->name('delete-prodi-admin');

        // Buku
        Route::get('/buku-admin/tambah', function () {
            return view('func.tambah-buku-admin', ['pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all()]);
        })->name('tambah-buku-admin');
        Route::post('/buku-admin/tambah', [AdminController::class, 'addBuku'])->name('addBuku.process');
        Route::get('/buku-admin/edit/{id}', function ($id) {
            $buku = DetailBuku::findOrFail($id);
            return view('func.tambah-buku-admin', ['buku' => $buku, 'repo' => $buku->repo, 'pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all()]);
        })->name('edit-buku-admin');
        Route::get('/buku-admin/delete/{id}', function ($id) {
            $buku = DetailBuku::findOrFail($id);
            $repo = $buku->repo;
            if ($buku->foto != 'default.jpg') {
                Storage::delete('public/' . $buku->foto);
            };
            DB::transaction(function () use ($buku, $repo) {
                $repo->delete();
                $buku->delete();
            });
            return redirect()->route('buku-admin');
        })->name('delete-buku-admin');
        Route::get('/buku-admin/detail/{id}', function ($id) {
            $buku = DetailBuku::findOrFail($id);
            return view('func.detail-buku-admin', ['buku' => $buku, 'repo' => $buku->repo, 'pengarang' => Pengarang::findOrFail($buku->repo->id_pengarang), 'penerbit' => Penerbit::findOrFail($buku->repo->id_penerbit), 'kategori' => Kategori::findOrFail($buku->repo->id_kategori)]);
        })->name('detail-buku-admin');

        // Skripsi
        Route::get('/skripsi-admin/tambah', function () {
            return view('func.tambah-skripsi-admin', ['pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all(),"prodi"=>Prodi::all(),"fakultas"=>Fakultas::all()]);
        })->name('tambah-skripsi-admin');
        Route::post('/skripsi-admin/tambah', [AdminController::class, 'addskripsi'])->name('addskripsi.process');
        Route::get('/skripsi-admin/edit/{id}', function ($id) {
            $skripsi = Detailskripsi::findOrFail($id);
            return view('func.tambah-skripsi-admin', ['skripsi' => $skripsi, 'repo' => $skripsi->repo, 'pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all(),"prodi"=>Prodi::all(),"fakultas"=>Fakultas::all()]);
        })->name('edit-skripsi-admin');
        Route::get('/skripsi-admin/delete/{id}', function ($id) {
            $skripsi = Detailskripsi::findOrFail($id);
            $repo = $skripsi->repo;
            if ($skripsi->file != 'default.pdf') {
                Storage::delete('public/' . $skripsi->file);
            };
            DB::transaction(function () use ($skripsi, $repo) {
                $repo->delete();
                $skripsi->delete();
            });
            return redirect()->route('skripsi-admin');
        })->name('delete-skripsi-admin');
        Route::get('/skripsi-admin/detail/{id}', function ($id) {
            $skripsi = Detailskripsi::findOrFail($id);
            return view('func.detail-skripsi-admin', ['skripsi' => $skripsi, 'repo' => $skripsi->repo, 'pengarang' => Pengarang::findOrFail($skripsi->repo->id_pengarang), 'penerbit' => Penerbit::findOrFail($skripsi->repo->id_penerbit), 'kategori' => Kategori::findOrFail($skripsi->repo->id_kategori),"prodi"=>Prodi::findOrFail($skripsi->id_prodi),"fakultas"=>Fakultas::findOrFail($skripsi->id_fakultas)]);
        })->name('detail-skripsi-admin');
        Route::get('/download/{file}', function (string $file) {
            return redirect(Storage::url($file));
        })->name('download')->where('file', '.*');;


    });

    Route::middleware('role:pengguna')->group(function () {
        Route::get('/dashboard-pengguna', function () {
            return view('dashboard-pengguna');
        });
    });
});

<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\DetailSkripsi;
use App\Models\Fakultas;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\pengguna;
use App\Models\Prodi;
use App\Models\Repositori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function addPengarang(Request $request)
    {
        if (empty($request->id_pengarang)) {
            $request->validate([
                'email' => 'unique:pengarang,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $path = $request->fotoOld;
            $check = Pengarang::find($request->id_pengarang);
            if ($check->email != $request->email) {
                $request->validate([
                    'email' => 'unique:pengarang,email',
                ], [
                    'email.unique' => 'Email sudah terpakai',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('pengarang', ['disk' => 'public']);
                }
            }
        };
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'no' => 'required|numeric',
            'alamat' => 'required',
            'jenisKelamin' => 'required',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no.required' => 'Nomor HP tidak boleh kosong',
            'no.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'jenisKelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'tanggalLahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'tanggalLahir.date' => 'Tanggal Lahir harus berupa tanggal',
            'tempatLahir.required' => 'Tempat Lahir tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Pengarang::updateOrCreate([
            'id_pengarang' => $request->id_pengarang,
        ], [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenisKelamin,
            'tanggal_lahir' => \Carbon\Carbon::parse($request->tanggalLahir)->format('Y-m-d'),
            'tempat_lahir' => $request->tempatLahir,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
            'pendidikan_terakhir' => $request->pendidikanTerakhir,
            'pekerjaan' => $request->pekerjaan,
            'pengalaman_kerja' => $request->pengalamanKerja,
            'riwayat_pendidikan' => $request->pendidikanRiwayat,
            'riwayat_pekerjaan' => $request->riwayatPekerjaan,
            'penghargaan' => $request->penghargaan,
        ])) {
            return redirect('/pengarang-admin')->with('success', 'Pengarang berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addPenerbit(Request $request)
    {
        if (empty($request->id_penerbit)) {
            $request->validate([
                'email' => 'unique:penerbit,email',
            ], [
                'email.unique' => 'Email sudah terpakai',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $path = $request->fotoOld;
            $check = Penerbit::find($request->id_penerbit);
            if ($check->email != $request->email) {
                $request->validate([
                    'email' => 'unique:penerbit,email',
                ], [
                    'email.unique' => 'Email sudah terpakai',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('penerbit', ['disk' => 'public']);
                }
            }
        };
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'no' => 'required|numeric',
            'alamat' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no.required' => 'Nomor HP tidak boleh kosong',
            'no.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Penerbit::updateOrCreate([
            'id_penerbit' => $request->id_penerbit,
        ], [
            'nama_penerbit' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'alamat' => $request->alamat,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/penerbit-admin')->with('success', 'penerbit berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addKategori(Request $request)
    {
        if (empty($request->id_kategori)) {
            $request->validate([
                'nama' => 'unique:kategori,nama_kategori',
            ], [
                'nama.unique' => 'Kategori sudah tersedia',
            ]);
        } else {
            $check = Kategori::find($request->id_kategori);
            if ($check->nama_kategori != $request->nama) {
                $request->validate([
                    'nama' => 'unique:kategori,nama_kategori',
                ], [
                    'nama.unique' => 'kategori sudah tersedia',
                ]);
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
        ]);
        if (Kategori::updateOrCreate([
            'id_kategori' => $request->id_kategori,
        ], [
            'nama_kategori' => $request->nama,
            'deskripsi' => $request->desk,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/kategori-admin')->with('success', 'kategori berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addFakultas(Request $request)
    {
        if (empty($request->id_fakultas)) {
            $request->validate([
                'nama' => 'unique:fakultas,nama_fakultas',
            ], [
                'nama.unique' => 'fakultas sudah tersedia',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Fakultas::find($request->id_fakultas);
            $path = $check->foto;
            if ($check->nama_fakultas != $request->nama) {
                $request->validate([
                    'nama' => 'unique:fakultas,nama_fakultas',
                ], [
                    'nama.unique' => 'fakultas sudah tersedia',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('fakultas', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Fakultas::updateOrCreate([
            'id_fakultas' => $request->id_fakultas,
        ], [
            'nama_fakultas' => $request->nama,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/fakultas-admin')->with('success', 'fakultas berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addProdi(Request $request)
    {
        if (empty($request->id_prodi)) {
            $request->validate([
                'nama' => 'unique:prodi,nama_prodi',
            ], [
                'nama.unique' => 'prodi sudah tersedia',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = Prodi::find($request->id_prodi);
            $path = $check->foto;
            if ($check->nama_prodi != $request->nama) {
                $request->validate([
                    'nama' => 'unique:prodi,nama_prodi',
                ], [
                    'nama.unique' => 'prodi sudah tersedia',
                ]);
            } else if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('prodi', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'nama' => 'required',
            'desk' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'nama.required' => 'Nama tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);
        if (Prodi::updateOrCreate([
            'id_prodi' => $request->id_prodi,
        ], [
            'nama_prodi' => $request->nama,
            'deskripsi' => $request->desk,
            'foto' => $path,
            'slug' => Str::slug($request->nama),
        ])) {
            return redirect('/prodi-admin')->with('success', 'prodi berhasil dijalankan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }

    public function addBuku(Request $request)
    {
        if (empty($request->id_buku)) {
            $request->validate([
                'judul' => 'unique:repositori,judul',
                'isbn' => 'unique:detail_buku,isbn',
            ], [
                'judul.unique' => 'judul sudah tersedia',
                'isbn.unique' => 'ISBN sudah tersedia',
            ]);
            if ($request->foto) {
                $path = $request->file('foto')->store('buku', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $checkBuku = DetailBuku::find($request->id_buku);
            $checkRepo = Repositori::find($checkBuku->id_repositori);
            $path = $checkBuku->foto;
            if ($checkRepo->judul != $request->judul) {
                $request->validate([
                    'judul' => 'unique:repositori,judul',
                ], [
                    'judul.unique' => 'judul sudah tersedia',
                ]);
            };
            if ($checkBuku->isbn != $request->isbn) {
                $request->validate([
                    'isbn' => 'unique:detail_buku,isbn',
                ], [
                    'isbn.unique' => 'ISBN sudah tersedia',
                ]);
            };
            if ($request->foto) {
                if (Storage::delete('public/' . $checkBuku->foto)) {
                    $path = $request->file('foto')->store('buku', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'judul' => 'required',
            'desk' => 'required',
            'id_pengarang' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'isbn' => 'required',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'id_pengarang.required' => 'Pengarang tidak boleh kosong',
            'id_penerbit.required' => 'Penerbit tidak boleh kosong',
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'isbn.required' => 'ISBN tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ]);

        if (empty($request->id_buku)) {
            $Buku = new DetailBuku;
            $Repo = new Repositori;
        } else {
            $Buku = DetailBuku::find($request->id_buku);
            $Repo = Repositori::find($Buku->id_repositori);
        }
        $Repo->id_pengarang = $request->id_pengarang;
        $Repo->id_penerbit = $request->id_penerbit;
        $Repo->id_kategori = $request->id_kategori;
        $Repo->judul = $request->judul;
        $Repo->deskripsi = $request->desk;
        $Repo->slug = Str::slug($request->judul);
        $Repo->tahun_terbit = $request->tahun;

        $Buku->isbn = $request->isbn;
        $Buku->jumlah_buku = $request->jumlah;
        $Buku->foto = $path;

        try {
            DB::transaction(function () use ($Buku, $Repo) {
                $Repo->save();
                $Buku->id_repositori = $Repo->id_repositori;
                $Buku->save();
            }, 2);
            return redirect('/buku-admin')->with('success', 'buku berhasil dijalankan');
        } catch (\Exception $e) {
            return back()->withErrors('Maaf Proses Gagal')->withInput();
        };
    }

    public function addSkripsi(Request $request)
    {
        if (empty($request->id_skripsi)) {
            $request->validate([
                'judul' => 'unique:repositori,judul',
            ], [
                'judul.unique' => 'judul sudah tersedia',
            ]);
            if ($request->file) {
                $path = $request->file('file')->store('skripsi', ['disk' => 'public']);
            } else {
                $path = 'default.pdf';
            }
        } else {
            $checkskripsi = DetailSkripsi::find($request->id_skripsi);
            $checkRepo = Repositori::find($checkskripsi->id_repositori);
            $path = $checkskripsi->file;
            if ($checkRepo->judul != $request->judul) {
                $request->validate([
                    'judul' => 'unique:repositori,judul',
                ], [
                    'judul.unique' => 'judul sudah tersedia',
                ]);
            };
            if ($request->file) {
                if (Storage::delete('public/' . $checkskripsi->file)) {
                    $path = $request->file('file')->store('skripsi', ['disk' => 'public']);
                }
            }
        }
        $request->validate([
            'judul' => 'required',
            'desk' => 'required',
            'id_pengarang' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'tahun' => 'required|numeric',
            "prodi" => "required",
            "fakultas" => "required",
            "status" => "required|in:pending,diterima,ditolak",
            "pembimbing" => "required",
            "penguji" => "required",
            'file' => 'mimes:pdf,doc,docx|max:102400',
        ], [
            'judul.required' => 'Judul tidak boleh kosong',
            'desk.required' => 'Deskripsi tidak boleh kosong',
            'id_pengarang.required' => 'Pengarang tidak boleh kosong',
            'id_penerbit.required' => 'Penerbit tidak boleh kosong',
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'prodi.required' => 'Prodi tidak boleh kosong',
            'fakultas.required' => 'Fakultas tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status harus berupa pending, diterima, ditolak',
            'pembimbing.required' => 'Pembimbing tidak boleh kosong',
            'penguji.required' => 'Penguji tidak boleh kosong',
            'file.mimes' => 'File harus berupa file dengan format pdf, doc, docx',
            'file.max' => 'File tidak boleh lebih dari 100MB',
        ]);

        if (empty($request->id_skripsi)) {
            $Skripsi = new DetailSkripsi;
            $Repo = new Repositori;
        } else {
            $Skripsi = DetailSkripsi::find($request->id_skripsi);
            $Repo = Repositori::find($Skripsi->id_repositori);
        }
        $Repo->id_pengarang = $request->id_pengarang;
        $Repo->id_penerbit = $request->id_penerbit;
        $Repo->id_kategori = $request->id_kategori;
        $Repo->judul = $request->judul;
        $Repo->deskripsi = $request->desk;
        $Repo->slug = Str::slug($request->judul);
        $Repo->tahun_terbit = $request->tahun;

        $Skripsi->status = $request->status;
        $Skripsi->pembimbing = $request->pembimbing;
        $Skripsi->penguji = $request->penguji;
        $Skripsi->id_prodi = $request->prodi;
        $Skripsi->id_fakultas = $request->fakultas;
        $Skripsi->file = $path;

        try {
            DB::transaction(function () use ($Skripsi, $Repo) {
                $Repo->save();
                $Skripsi->id_repositori = $Repo->id_repositori;
                $Skripsi->save();
            }, 2);
            return redirect('/skripsi-admin')->with('success', 'skripsi berhasil dijalankan');
        } catch (\Exception $e) {
            return back()->withErrors('Maaf Proses Gagal')->withInput();
        };
    }
}

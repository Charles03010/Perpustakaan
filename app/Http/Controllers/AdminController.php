<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function add(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required',
            'no' => 'required|numeric',
            'alamat' => 'required',
            'jenisKelamin' => 'required',
            'tanggalLahir' => 'required|date',
            'tempatLahir' => 'required',
            'desk' => 'required',
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
        ]);
        if (Pengarang::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenisKelamin,
            'tanggal_lahir' => \Carbon\Carbon::parse($request->tanggalLahir)->format('Y-m-d'),
            'tempat_lahir' => $request->tempatLahir,
            'deskripsi' => $request->desk,
            'foto' => $request->foto != null ? $request->foto : 'default.jpg',
            'slug' => Str::slug($request->nama),
            'pendidikan_terakhir' => $request->pendidikanTerakhir,
            'pekerjaan' => $request->pekerjaan,
            'pengalaman_kerja' => $request->pengalamanKerja,
            'riwayat_pendidikan' => $request->pendidikanRiwayat,
            'riwayat_pekerjaan' => $request->riwayatPekerjaan,
            'penghargaan' => $request->penghargaan,
        ])) {
            return redirect('/pengarang-admin')->with('success', 'Pengarang berhasil ditambahkan');
        }
        return back()->withErrors('Maaf Proses Gagal')->withInput();
    }
}

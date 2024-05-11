<?php

namespace App\Http\Controllers;

use App\Http\Requests\BukuRequest;
use App\Models\DetailBuku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Repositori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BukuController extends Controller
{
    public function index()
    {
        $bukuList = [];
        foreach (DetailBuku::all() as $buku) {
            $bukuList[] = [$buku, $buku->repo];
        }
        return view('admin.buku.index', ['buku' => $bukuList]);
    }
    public function create()
    {
        return view('admin.buku.tambah', ['pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all()]);
    }
    public function store(BukuRequest $request)
    {
        function uniq_name($request)
        {
            $request->validate([
                'judul' => 'unique:repositori,judul',
            ], [
                'judul.unique' => 'judul sudah tersedia',
            ]);
        }
        if (empty($request->id_buku)) {
            uniq_name($request);
            if ($request->foto) {
                $path = $request->file('foto')->store('buku', ['disk' => 'public']);
            } else {
                $path = 'default.jpg';
            }
        } else {
            $check = DetailBuku::find($request->id_buku);
            $path = $check->foto;
            if ($check->repo->judul != $request->judul) {
                uniq_name($request);
            }
            if ($request->foto) {
                if (Storage::delete('public/' . $check->foto)) {
                    $path = $request->file('foto')->store('buku', ['disk' => 'public']);
                }
            }
        }
        $validated = $request->validated();
        $validated['foto'] = $path;
        $validated['slug'] = $validated['judul'];
        if (DB::transaction(function () use ($request, $validated) {
            $repo = $request->id_buku ? DetailBuku::find($request->id_buku)->repo : new Repositori();
            $repo->judul = $validated['judul'];
            $repo->id_pengarang = $validated['id_pengarang'];
            $repo->id_penerbit = $validated['id_penerbit'];
            $repo->id_kategori = $validated['id_kategori'];
            $repo->tahun_terbit = $validated['tahun_terbit'];
            $repo->slug = $validated['slug'];
            $repo->deskripsi = $validated['deskripsi'];
            $repo->save();
            
            $buku = $request->id_buku ? DetailBuku::find($request->id_buku) : new DetailBuku();
            $buku->id_repositori = $repo->id_repositori;
            $buku->isbn = $validated['isbn'];
            $buku->jumlah_buku = $validated['jumlah_buku'];
            $buku->foto = $validated['foto'];
            $buku->save();
        }) == null) {
            Alert::success('Success', 'buku berhasil ditambahkan');
            return redirect()->route('admin.buku.index')->with('success', 'buku berhasil ditambahkan');
        };
        Alert::error('Error', 'buku gagal ditambahkan');
        return back()->withErrors('Maaf Proses Gagal');
    }
    public function show($id)
    {
        $buku = DetailBuku::findOrFail($id);
        return view('admin.buku.detail', ['buku' => $buku, 'repo' => $buku->repo, 'pengarang' => Pengarang::findOrFail($buku->repo->id_pengarang), 'penerbit' => Penerbit::findOrFail($buku->repo->id_penerbit), 'kategori' => Kategori::findOrFail($buku->repo->id_kategori)]);
    }
    public function edit($id)
    {
        $buku = DetailBuku::findOrFail($id);
        return view('admin.buku.tambah', ['buku' => $buku, 'repo' => $buku->repo, 'pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all()]);
    }
    public function destroy($id)
    {
        $buku = DetailBuku::findOrFail($id);
        $repo = $buku->repo;
        if ($buku->foto != 'default.jpg') {
            Storage::delete('public/' . $buku->foto);
        };
        if (DB::transaction(function () use ($buku, $repo) {
            $repo->delete();
            $buku->delete();
        }) == null) {
            Alert::success('Success', 'buku berhasil dihapus');
            return redirect()->route('admin.buku.index')->with('success', 'buku berhasil dihapus');
        };
        Alert::error('Error', 'buku gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}

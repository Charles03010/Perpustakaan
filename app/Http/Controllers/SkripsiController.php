<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkripsiRequest;
use App\Models\DetailSkripsi;
use App\Models\Fakultas;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Prodi;
use App\Models\Repositori;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SkripsiController extends Controller
{
    public function index()
    {
        $skripsiList = [];
        foreach (DetailSkripsi::all() as $skripsi) {
            $skripsiList[] = [$skripsi, $skripsi->repo];
        }
        return view('admin.skripsi.index', ['skripsi' => $skripsiList]);
    }
    public function create()
    {
        return view('admin.skripsi.tambah', ['pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all(),'prodi'=>Prodi::all(),'fakultas'=>Fakultas::all()]);
    }
    public function store(SkripsiRequest $request)
    {
        function uniq_name($request)
        {
            $request->validate([
                'judul' => 'unique:repositori,judul',
            ], [
                'judul.unique' => 'judul sudah tersedia',
            ]);
        }
        if (empty($request->id_skripsi)) {
            uniq_name($request);
            if ($request->file) {
                $path = $request->file('file')->store('skripsi', ['disk' => 'public']);
            } else {
                $path = 'default.pdf';
            }
        } else {
            $check = DetailSkripsi::find($request->id_skripsi);
            $path = $check->file;
            if ($check->repo->judul != $request->judul) {
                uniq_name($request);
            }
            if ($request->file) {
                if (Storage::delete('public/' . $check->file)) {
                    $path = $request->file('file')->store('skripsi', ['disk' => 'public']);
                }
            }
        }
        $validated = $request->validated();
        $validated['file'] = $path;
        $validated['slug'] = $validated['judul'];
        if (DB::transaction(function () use ($request, $validated) {
            $repo = $request->id_skripsi ? DetailSkripsi::find($request->id_skripsi)->repo : new Repositori();
            $repo->judul = $validated['judul'];
            $repo->id_pengarang = $validated['id_pengarang'];
            $repo->id_penerbit = $validated['id_penerbit'];
            $repo->id_kategori = $validated['id_kategori'];
            $repo->tahun_terbit = $validated['tahun_terbit'];
            $repo->slug = $validated['slug'];
            $repo->deskripsi = $validated['deskripsi'];
            $repo->save();

            $skripsi = $request->id_skripsi ? DetailSkripsi::find($request->id_skripsi) : new Detailskripsi();
            $skripsi->id_repositori = $repo->id_repositori;
            $skripsi->status = $validated['status'];
            $skripsi->pembimbing = $validated['pembimbing'];
            $skripsi->penguji = $validated['penguji'];
            $skripsi->id_prodi = $validated['id_prodi'];
            $skripsi->id_fakultas = $validated['id_fakultas'];
            $skripsi->file = $validated['file'];
            $skripsi->save();
        }) == null) {
            Alert::success('Success', 'skripsi berhasil ditambahkan');
            return redirect()->route('admin.skripsi.index')->with('success', 'skripsi berhasil ditambahkan');
        };
        Alert::error('Error', 'skripsi gagal ditambahkan');
        return back()->withErrors('Maaf Proses Gagal');
    }
    public function show($id)
    {
        $skripsi = DetailSkripsi::findOrFail($id);
        return view('admin.skripsi.detail', ['skripsi' => $skripsi, 'repo' => $skripsi->repo, 'pengarang' => Pengarang::findOrFail($skripsi->repo->id_pengarang), 'penerbit' => Penerbit::findOrFail($skripsi->repo->id_penerbit), 'kategori' => Kategori::findOrFail($skripsi->repo->id_kategori), "prodi" => Prodi::findOrFail($skripsi->id_prodi), "fakultas" => Fakultas::findOrFail($skripsi->id_fakultas)]);
    }
    public function edit($id)
    {
        $skripsi = DetailSkripsi::findOrFail($id);
        return view('admin.skripsi.tambah', ['skripsi' => $skripsi, 'repo' => $skripsi->repo, 'pengarang' => Pengarang::all(), 'penerbit' => Penerbit::all(), 'kategori' => Kategori::all(), "prodi" => Prodi::all(), "fakultas" => Fakultas::all()]);
    }
    public function destroy($id)
    {
        $skripsi = DetailSkripsi::findOrFail($id);
        $repo = $skripsi->repo;
        if ($skripsi->file != 'default.pdf') {
            Storage::delete('public/' . $skripsi->file);
        };
        if (DB::transaction(function () use ($skripsi, $repo) {
            $repo->delete();
            $skripsi->delete();
        }) == null) {
            Alert::success('Success', 'skripsi berhasil dihapus');
            return redirect()->route('admin.skripsi.index')->with('success', 'skripsi berhasil dihapus');
        };
        Alert::error('Error', 'skripsi gagal dihapus');
        return back()->withErrors('Maaf Proses Gagal');
    }
}

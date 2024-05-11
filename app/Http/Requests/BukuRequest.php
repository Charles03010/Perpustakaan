<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => ['required'],
            'deskripsi' => ['required'],
            'id_pengarang' => ['required'],
            'id_penerbit' => ['required'],
            'id_kategori' => ['required'],
            'isbn' => ['required'],
            'tahun_terbit' => ['required', 'numeric'],
            'jumlah_buku' => ['required', 'numeric'],
            'foto' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
    public function messages()
    {
        return [
            'judul.required' => 'Judul tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'id_pengarang.required' => 'Pengarang tidak boleh kosong',
            'id_penerbit.required' => 'Penerbit tidak boleh kosong',
            'id_kategori.required' => 'Kategori tidak boleh kosong',
            'isbn.required' => 'ISBN tidak boleh kosong',
            'tahun_terbit.required' => 'Tahun tidak boleh kosong',
            'tahun_terbit.numeric' => 'Tahun harus berupa angka',
            'jumlah_buku.required' => 'Jumlah tidak boleh kosong',
            'jumlah_buku.numeric' => 'Jumlah harus berupa angka',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ];
    }
}

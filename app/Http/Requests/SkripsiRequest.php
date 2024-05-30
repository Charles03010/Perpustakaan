<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkripsiRequest extends FormRequest
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
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_pengarang' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'tahun_terbit' => 'required|numeric',
            "id_prodi" => "required",
            "id_fakultas" => "required",
            "status" => "required|in:pending,diterima,ditolak",
            "pembimbing" => "required",
            "penguji" => "required",
            'file' => 'mimes:zip,rar|max:102400',
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
            'tahun_terbit.required' => 'Tahun tidak boleh kosong',
            'tahun_terbit.numeric' => 'Tahun harus berupa angka',
            'id_prodi.required' => 'Prodi tidak boleh kosong',
            'id_fakultas.required' => 'Fakultas tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'status.in' => 'Status harus berupa pending, diterima, ditolak',
            'pembimbing.required' => 'Pembimbing tidak boleh kosong',
            'penguji.required' => 'Penguji tidak boleh kosong',
            'file.mimes' => 'File harus berupa file dengan format pdf, doc, docx',
            'file.max' => 'File tidak boleh lebih dari 100MB',
        ];
    }
}

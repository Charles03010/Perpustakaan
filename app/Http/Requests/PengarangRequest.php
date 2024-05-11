<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengarangRequest extends FormRequest
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
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'no_hp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'pendidikan_terakhir' => 'nullable',
            'riwayat_pendidikan' => 'nullable',
            'pengalaman_kerja' => 'nullable',
            'riwayat_pekerjaan' => 'nullable',
            'penghargaan' => 'nullable',
            'pekerjaan' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal Lahir tidak boleh kosong',
            'tanggal_lahir.date' => 'Tanggal Lahir harus berupa tanggal',
            'tempat_lahir.required' => 'Tempat Lahir tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenerbitRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'nama_penerbit' => ['required'],
            'no_hp' => ['required', 'numeric'],
            'alamat' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'nama_penerbit.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'no_hp.required' => 'Nomor HP tidak boleh kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ];
    }
}

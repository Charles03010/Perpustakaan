<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FakultasRequest extends FormRequest
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
            'nama_fakultas' => ['required'],
            'deskripsi' => ['required'],
            'foto' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
    public function messages(): array
    {
        return [
            'nama_fakultas.required' => 'Nama tidak boleh kosong',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong',
            'foto.image' => 'Foto harus berupa gambar',
            'foto.mimes' => 'Foto harus berupa gambar dengan format jpeg, png, jpg, gif, svg',
            'foto.max' => 'Foto tidak boleh lebih dari 2MB',
        ];
    }
}

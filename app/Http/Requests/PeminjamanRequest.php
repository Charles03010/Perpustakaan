<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'id_peminjaman' => ['nullable'],
            'id_pengguna' => ['required', 'string'],
            'id_repositori' => ['required', 'string'],
            'tanggal_pinjam' => ['nullable', 'date'],
            'tanggal_kembali' => ['date', 'nullable'],
            'status' => ['required', 'in:diajukan,dipinjam,dikembalikan'],
            'denda' => ['nullable', 'numeric'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
    public function message(): array
    {
        return [
            'id_pengguna.required' => 'Pengguna harus diisi',
            'id_pengguna.string' => 'Pengguna harus berupa string',
            'id_repositori.required' => 'Repositori harus diisi',
            'id_repositori.string' => 'Repositori harus berupa string',
            'tanggal_pinjam.date' => 'Tanggal Pinjam harus berupa tanggal',
            'tanggal_kembali.date' => 'Tanggal Kembali harus berupa tanggal',
            'status.required' => 'Status harus diisi',
            'status.in' => 'Status harus dipinjam atau dikembalikan',
            'denda.numeric' => 'Denda harus berupa angka',
            'keterangan.string' => 'Keterangan harus berupa string',
        ];
    }
}

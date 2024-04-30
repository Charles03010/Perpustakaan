<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'password' => ['required', 'confirmed'],
            'password_confirmation' => ['required'],
            'nama' => ['required'],
        ];
    }
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong'
        ]);
        if (auth()->attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard-admin');
            }
            elseif (auth()->user()->role == 'pengguna'){
                return redirect('/dashboard-pengguna');
            }
        }else{
            return back()->withErrors('Email atau password salah')->withInput();
        }
    }
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'name' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
        ]);

        if(
        pengguna::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nama' => $request->name,
            'role' => 'pengguna'
        ])){
            return redirect('/login')->with('success', 'Registrasi Berhasil, Silahkan Login');
        };
        return back()->withErrors('Registrasi Gagal')->withInput();
    }
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}

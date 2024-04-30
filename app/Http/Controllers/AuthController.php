<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\pengguna;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validated = $request->safe()->only(['email', 'password']);

        if (auth()->attempt($validated)) {
            if (auth()->user()->role == 'admin') {
                return redirect('/dashboard-admin');
            } elseif (auth()->user()->role == 'pengguna') {
                return redirect('/dashboard-pengguna');
            }
        } else {
            return back()->withErrors('Email atau password salah')->withInput();
        }
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        if (
            pengguna::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'nama' => $validated['nama'],
                'role' => 'pengguna'
            ])
        ) {
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

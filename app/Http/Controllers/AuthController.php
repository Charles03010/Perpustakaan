<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika berhasil login
            return redirect()->intended('/');
        }

        // Jika gagal login
        return redirect()->back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
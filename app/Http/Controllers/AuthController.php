<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function forgotPassword() {
        return view('forgot-password');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')->withSuccess('Selamat anda berhasil masuk !');
        }

        return back()->withErrors([
            'email' => 'Akun yang anda masukan tidak cocok, silahkan cek kembali !',
        ])->onlyInput('email');
    }
}

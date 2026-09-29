<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | TAMPILKAN HALAMAN LOGIN
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('auth.login');
    }


    /*
    |--------------------------------------------------------------------------
    | PROSES LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        // Validasi email dan password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        // Coba login menggunakan email
        if (Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ])) {

            // Regenerate session setelah berhasil login
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }


        // Jika email atau password salah
        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput(
                $request->only('email')
            );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan session login
        $request->session()->invalidate();

        // Buat token CSRF baru
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
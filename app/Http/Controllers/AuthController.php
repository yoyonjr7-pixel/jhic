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
        // Validasi username dan password
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);


        // Coba login menggunakan username
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {

            // Regenerate session setelah berhasil login
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }


        // Jika username atau password salah
        return back()
            ->withErrors([
                'username' => 'Username atau password salah.',
            ])
            ->withInput(
                $request->only('username')
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
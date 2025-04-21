<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // 1. Fungsi Menampilkan Halaman Login
    public function login()
    {
        return view('auth.login');
    }


    // 2. Fungsi Autentikasi Login
    public function autentikasi(Request $request)
    {
        $messages = [
            'required' => 'Maaf, :attribute tidak boleh kosong.',
        ];

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], $messages);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()->with('loginError', 'Email tidak terdaftar.');
        }

        if ($user->status == 'Non-Aktif') {
            return back()->with('loginError', 'Akun Anda tidak aktif. Silakan hubungi admin.');
        } elseif (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } else {
            return back()->with('loginError', 'Periksa kembali email dan password Anda.');
        }
    }


    // 3. Fungsi Untuk Log Out
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    // 1. Fungsi Menampilkan Halaman Lupa Password
    public function showLinkRequestForm()
    {

        return view('auth.ForgotPassword');
    }


    // 2. Fungsi Untuk Mengirim Link Reset Password Ke Gmail
    public function sendResetLinkEmail(Request $request)
    {

        $messages = [
            'required' => 'Maaf, :attribute tidak boleh kosong.',
            'email.exists' => 'Maaf, email yang anda masukkan tidak terdaftar di sistem ini.'
        ];

        $request->validate(['email' => 'required|email'], $messages);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link untuk reset password telah dikirim ke email anda.')
            : back()->withErrors(['email' => __($status)]);
    }


    // 3. Fungsi Untuk Menampilkan Halaman Reset Password
    public function showResetForm(Request $request, $token = null)
    {

        return view('auth.ResetPassword', ['token' => $token]);
    }


    // 4. Fungsi Untuk Mereset Password
    public function reset(Request $request)
    {

        $messages = [
            'required' => 'Maaf, :attribute tidak boleh kosong.',
            'min' => 'Maaf, :attribute harus minimal :min karakter.',
            'password_confirmation.required' => 'Maaf, konfirmasi password tidak boleh kosong.',
            'password_confirmation.min' => 'Maaf, konfirmasi password harus minimal :min karakter.',
            'password.same' => 'Maaf, Password Harus Sama Dengan Konfirmasi Password.',
        ];

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|same:password_confirmation',
            'password_confirmation' => 'required|min:6'
        ], $messages);


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset, silahkan login.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}

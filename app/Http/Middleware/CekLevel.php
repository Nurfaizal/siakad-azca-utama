<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$levels): Response
    {

        $user = Auth::user();

        if (!$user) {
            return redirect('/');
        }

        // Ambil semua level user
        $userLevels = $user->level->pluck('level')->toArray();

        // Cek apakah user memiliki salah satu level yang diizinkan
        foreach ($levels as $level) {
            if (in_array($level, $userLevels)) {
                return $next($request);
            }
        }

        // Kalau tidak punya level yang cocok, kembalikan response error
        return abort(403, 'Akses ditolak.');
    }
}

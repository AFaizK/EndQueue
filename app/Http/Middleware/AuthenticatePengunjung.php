<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthenticatePengunjung
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next)
     {
         // Debugging: Periksa apakah middleware dijalankan
         Log::info('Middleware AuthenticatePengunjung sedang dijalankan.');

         // Periksa apakah pengguna terotentikasi sebagai pengunjung
         if (Auth::guard('api_pengunjungs')->check()) {
             // Debugging: Periksa data pengguna jika diperlukan
             Log::info('Pengguna terotentikasi sebagai pengunjung.', ['user' => Auth::guard('api_pengunjungs')->user()]);
             return $next($request);
         }

         // Debugging: Jika pengguna tidak terotentikasi
         Log::info('Pengguna tidak terotentikasi sebagai pengunjung.');

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        return redirect()->route('loginpengunjung');
     }
}

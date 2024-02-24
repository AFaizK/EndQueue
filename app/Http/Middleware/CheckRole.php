<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   // app/Http/Middleware/CheckRole.php

   public function handle($request, Closure $next, ...$roles)
   {
     // Periksa apakah pengguna terotentikasi
    if (!$request->user()) {
        // Jika tidak terotentikasi, alihkan pengguna ke halaman login
        return redirect()->route('login'); // Sesuaikan dengan nama rute halaman login Anda
    }

    // Periksa apakah peran pengguna sesuai dengan yang diizinkan
    if (!in_array($request->user()->role, $roles)) {
        // Jika peran pengguna tidak sesuai, tampilkan pesan kesalahan
        abort(403, 'Unauthorized action.');
    }

    return $next($request);

   }

}

<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;


class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     return $request->expectsJson() ? null : route('login');
    // }
    // public function handle($request, Closure $next, ...$guards)
    // {
    //     if (Auth::guard('sanctum')->guest()) {
    //         return response()->json(['message' => 'Unauthenticated.'], 401);
    //     }
    //     return parent::handle($request, $next, ...$guards);
    // }
    // protected function redirectTo($request)
    // {
    //     if (!$request->expectsJson()) {
    //         return route('pages.page-login');
    //     }
    // }


    public function handle($request, Closure $next, ...$guards)
    {
        if (Auth::guard('sanctum')->guest() || !Auth::guard('sanctum')->user()) {
            // Jika permintaan meminta respons JSON
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // Jika tidak, alihkan pengguna kembali ke halaman login
            return redirect()->route('login'); // Sesuaikan dengan nama rute halaman login Anda
        }

        return parent::handle($request, $next, ...$guards);
    }


}

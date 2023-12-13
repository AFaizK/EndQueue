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
    public function handle($request, Closure $next, ...$guards)
{
    if (Auth::guard('sanctum')->guest() || !Auth::guard('sanctum')->user()) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    return parent::handle($request, $next, ...$guards);
}

}

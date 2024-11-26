<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next,  ...$role)
    // {

    //     if ($request->user()->role == $role) {
    //         dd('User Role:', $request->user()->role);
    //         return $next($request);
    //     }

    //     abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
    // }
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        if (!in_array($user->role, $roles)) {
            abort(403, 'Anda tidak memiliki hak mengakses laman tersebut!');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->role == 'owner') {
                    return redirect()->iroute('owner.dashboard');
                } else if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else if (Auth::user()->role == 'kasir') {
                    return redirect()->route('kasir.dashboard');
                } else if (Auth::user()->role == 'disabled') {
                    return redirect()->route('newuser.dashboard');
                }
            }
        }

        return $next($request);
    }
}

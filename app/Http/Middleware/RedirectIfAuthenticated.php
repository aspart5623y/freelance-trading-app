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
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (Auth::user()->profileable_type == 'investor') {
                    return redirect(RouteServiceProvider::INVESTOR_HOME);
                } else if (Auth::user()->profileable_type == 'trader') {
                    return redirect(RouteServiceProvider::TRADER_HOME);
                } else if (Auth::user()->profileable_type == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN_HOME);
                }
            }
        }

        return $next($request);
    }
}

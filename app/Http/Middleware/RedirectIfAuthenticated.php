<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            // if (Auth::guard($guard)->check()) {
            //     return redirect(RouteServiceProvider::HOME);
            // }
            
            if (Auth::guard($guard)->check()) {

                $user = Auth::guard($guard)->user();

                if ($user->status === 'admin' || $user->status === 'writer') {
                    return redirect(RouteServiceProvider::ADMIN);  // Ensure these constants are defined in RouteServiceProvider
                } else {
                    return redirect(RouteServiceProvider::USER);   // Ensure these constants are defined in RouteServiceProvider
                }
            }
        }

        return $next($request);
    }
}

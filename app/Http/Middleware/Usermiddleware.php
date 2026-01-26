<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Usermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle(Request $request, Closure $next)
{
    // যদি বর্তমান রুট password reset বা forget হয় তাহলে Middleware skip করো
    if (in_array($request->route()->getName(), ['password.forget', 'password.forget.post', 'password.reset', 'password.reset.post'])) {
        return $next($request);
    }

    if (!Auth::check()) {
        return redirect()->route('user.login')->with('error', 'Please login first.');
    }

    if (Auth::user()->role !== 'user') {
        return redirect()->route('user.login')->with('error', 'Access denied.');
    }

    return $next($request);
}




}

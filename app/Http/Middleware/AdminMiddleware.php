<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('status','error')->with('title', 'Please Login to continue');
        }
    
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('status','error')->with('title', 'Access Denied! You are not an admin');
        }
        return $next($request);
    }
}

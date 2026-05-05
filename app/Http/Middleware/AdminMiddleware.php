<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Check if user is not logged in
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Please login first');
        }

        // Check if user is logged in but is not admin
        if (auth()->user()->role !== 'admin') {
            return redirect('/')->with('error', 'Access denied. Admins only!');
        }

        // User is admin, allow through
        return $next($request);
    }
}

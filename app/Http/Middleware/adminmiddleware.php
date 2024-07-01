<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->usertype == 'admin') {
            return $next($request);
        }

        // Optionally, you can return a response with a message or redirect to a specific route
        // return redirect()->route('home')->with('error', 'You do not have admin access.');
        return redirect()->route('home')->withErrors('You do not have admin access.');
    }
}

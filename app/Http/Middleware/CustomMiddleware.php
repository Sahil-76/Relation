<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $username = Auth::user()->name;
        } else {
            $username = 'Guest';
        }

        // Pass the $username variable to the view
        view()->share('username', $username);

        return $next($request);
    }
}
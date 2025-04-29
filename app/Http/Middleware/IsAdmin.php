<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Provera da li je korisnik admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Ako nije admin, preusmerava ga
        return redirect()->route('user.orders')->with('error', 'Nemate pristup ovoj stranici.');
    }
}

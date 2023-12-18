<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthenticate
{

    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('client')->check()) {
            return redirect(route('client.index'));
        }
        return $next($request);
    }
}

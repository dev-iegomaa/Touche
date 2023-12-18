<?php

namespace App\Http\Middleware;

use App\Http\Traits\Api\apiResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiClientAuthenticate
{

    use apiResponse;
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::guard('client_api')->check()) {
            return $this->apiResponse(401, 'Unauthorized');
        }
        return $next($request);
    }
}

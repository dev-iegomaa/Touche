<?php

namespace App\Http\Middleware;

use App\Http\Traits\Api\apiResponse;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{

    use apiResponse;

    public function handle($request, Closure $next)
    {
        try {
            JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return $this->apiResponse(404,'Token is Invalid');
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return $this->apiResponse(404,'Token is Expired');
            }else{
                return $this->apiResponse(404,'Authorization Token not found');
            }
        }
        return $next($request);
    }
}

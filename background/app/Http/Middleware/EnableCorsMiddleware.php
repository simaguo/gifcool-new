<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class EnableCorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->getMethod() == "OPTIONS") {
            $response = new Response('', 200);
        }else{
            $response = $next($request);
        }

        $response->header('Access-Control-Allow-Origin','*');
        $response->header('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers','Content-Type, X-Auth-Token, Origin, Authorization');
        $response->header('Access-Control-Max-Age','1728000');
        return $response;
    }
}

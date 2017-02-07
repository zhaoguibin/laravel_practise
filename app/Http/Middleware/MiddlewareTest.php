<?php

namespace App\Http\Middleware;

use Closure;

class MiddlewareTest
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

        if($request->age <= 200){
            dd('小朋友啊！');
        }

        return $next($request);
    }
}

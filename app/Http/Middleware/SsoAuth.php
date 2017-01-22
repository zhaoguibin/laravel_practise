<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;


class SsoAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user_id = $request->session()->get('user_id');
        if($user_id){
            $is_login = Redis::get("login_{$user_id}");
            if($is_login){
                return $next($request);
            }
        }
        return redirect("http://192.168.10.17:7979/login/sendToSubSys?from=a&redirectURL=".urlencode($request->getUri()));
    }



}

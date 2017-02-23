<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;

class IsAdmin
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
        $user = new User;
        $is_admin = $user->IsAdmin(Auth::id());
        if($is_admin != 1){
            //触发错误
//            abort(503);
            return redirect('/home');
        }

        return $next($request);
    }
}

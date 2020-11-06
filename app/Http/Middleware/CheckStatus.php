<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class CheckStatus{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user()->approve==false){
            Auth::logout();
            $request->session()->flush();
           return redirect('/login?status=wap');
        }
        return $next($request);
    }
}

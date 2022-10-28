<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BanUser
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
        if(Auth::user()->isBanned == 1){
            Auth::logout();
            return redirect()->route('login')->with("alert",["icon"=>"error","title"=>"You are banned","message"=>"Account ပြန်လည်ရယူရန် Admin ကိုဆက်သွယ်ပါ။"]);
        }
        return $next($request);
    }
}

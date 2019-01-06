<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isUserMiddleware
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
        if (Auth::check()){
            $level = Auth::user()->level_id;
            if ($level == 0){
                return $next($request);
            }elseif ($level == 1){
                return redirect()->route('admin.index');
            }else{
                return redirect()->route('home.index');
            }
        }else{
            return redirect()->route('login');
        }
    }
}

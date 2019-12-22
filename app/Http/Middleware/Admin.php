<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
class Admin
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
//        dd(auth()->user());
        if(auth()->guest()){
            return redirect('/login');
        }

        if(auth()->user()->group != 'admin'){
            return redirect('/');
        }
        return $next($request);
    }
}

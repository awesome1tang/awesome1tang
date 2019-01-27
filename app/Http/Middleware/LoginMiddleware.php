<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Cookie;
use Closure;
use Illuminate\Http\Request;
class Loginmiddleware
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


        if (!$request->cookie('user')) {

            return redirect('admin/login');
        }

        

        return $next($request);


    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class IsShop
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
        $shop = session('shopurl');
        $accesstoken = session('accessToken');

        if ($shop &&  $accesstoken) {
            return $next($request);
        }
        return redirect('/install');
    }
}

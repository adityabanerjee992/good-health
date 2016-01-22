<?php

namespace App\Http\Middleware;

use Closure;

class AddApiKeyToRegisterCustomerRequest
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
        session()->forget('cart_count');
        $token = hash('sha256',uniqid("gh",true),false);
        $request['api_key'] = $token ;
        return $next($request);
    }
}

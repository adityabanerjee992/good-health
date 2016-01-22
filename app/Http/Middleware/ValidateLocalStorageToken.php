<?php

namespace App\Http\Middleware;

use Closure;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class ValidateLocalStorageToken
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
        // dd('wpor');
        if(Auth::check() != false){

            $token = Cookie::get('gh_token');

            $order = Order::where(['token' => $token])->get();
            
            if(!$order->isEmpty()){
                if($order->first()->customer_id != Auth::user()->id){
                    Session::set('different_user',1);
                }
            }
            // // dd(Cookie::get('user_id'));
            // // dd(Auth::user()->id != Cookie::get('user_id'));
            // if(Cookie::get('user_id') != NULL and Cookie::get('gh_token')!= NULL){
            //     if(Auth::user()->id != Cookie::get('user_id')){
                   
            //        $cookie1=  Cookie::forget('user_id');
            //        $cookie2 = Cookie::forget('gh_token');
                   
            //        return redirect()->back()->withCookie($cookie2);
            //     }
            // }
        }

        return $next($request);
    }
}

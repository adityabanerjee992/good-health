<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate as Gate;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel as Sentinel;

class CheckPermission
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
        $action = $request->route()->getAction();
        
        if(isset($action['permission']) and $action['permission'] != NULL){

            if(Sentinel::getUser() != NULL){
                if(!Sentinel::getUser()->hasAccess($action['permission'])){
                    return redirect('admin/404');
                }
            }
        }
        return $next($request);
    }
}

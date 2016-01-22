<?php

namespace App\Http\Middleware;

use Closure;
use App\Customer;

class CheckApiKey
{
    /**
     * List api routes to exclude 
     * from middleware check
     * 
     * @var array
     */
    public $excepts =['api/v1/register','api/v1/login'];
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($this->excepts as $except) {
            if ($request->is($except)) {
                return $next($request);
            }
        }

        if ($this->validApiKey($request)) {
            return $next($request);
        }
        return $this->errorMessage();
    }

    /**
     * It validates the api key of incoming api request ..
     * 
     * @param  array $request
     * @return bool
     */
    protected function validApiKey($request)
    {
        $customerCount = Customer::where(['id' => $request['customer_id'], 'api_key' => $request['api_key']])->get()->count();
        
        if ($customerCount == 1) {
            return true;
        }
        return false;
    }

    /**
     * It Returns the error message ..
     * 
     * @return array
     */
    protected function errorMessage()
    {
        return ['status' => 0 ,'message' => 'Invalid Api Key Or Invalid Request'];
    }
}

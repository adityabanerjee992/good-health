<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

class CouponController extends Controller
{
    public function applyCoupon()
    {
        $input=Request::all();

        return ['status'=>'ok'];
    }
}

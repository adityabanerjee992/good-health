<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Classes as ClassesContract;

class ClassesController extends Controller implements ClassesContract
{
     /**
     * Get the classes related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getClasses($product)
    {
        $classes=$product->classes()->get();

        $strClasses=null;

        foreach ($classes as $class) {
            $strClasses.= $class->class_name.'+';   
        }

        return trim($strClasses,'+');
    }   
}

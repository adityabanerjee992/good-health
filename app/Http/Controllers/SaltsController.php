<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Ailment as Ailment;
use App\Product as Product;
use App\Salt as Salt;
use App\Classes as Classes;
use App\Company as Company;
use URL;
use App\Http\Contracts\Salt as SaltContract;

class SaltsController extends Controller implements SaltContract
{
	/**
	 * Get salts by ailment id
	 * @param   integer 	$id 
	 * @return  /Illuminate/View
	 */
    public function getSaltsByAilments($id)
    {
    	$ailment = Ailment::find($id);

    	$category="Ailment";

        $previousUrl=route('drugs-by-ailment');

        $currentUrl = URL::current();

    	$ailmentId   = $ailment->id;
    	$name = $ailment->ailment_name;

    	$salts= $ailment->salts;

    	return View('salts.view-salts-by-ailment',compact('salts','name','ailmentId','category','currentUrl','previousUrl'));
    }	

    /**
     * Get salts by class id
     * @param   integer     $id 
     * @return  /Illuminate/View
     */
    public function getSaltsByClass($id)
    {
        $class = Classes::find($id);

        $category = "Class";

        $previousUrl = route('drugs-by-class');

        $currentUrl = URL::current();


        $classId   = $class->id;
        $name = $class->class_name;

        $salts = $class->salts;

        return View('salts.view-salts-by-class',compact('salts','name','classId','category','currentUrl','previousUrl'));
    }

    /**
     * Get the salts related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getSalts($product)
    {
        $salts=$product->salts()->get();

        $strSalts=null;

        foreach ($salts as $salt) {
            
            $strSalts.= $salt->salt_name.'+';   
        }

        return trim($strSalts,'+');
    }   
}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Contracts\Ailment as AilmentContract;

class AilmentController extends Controller implements AilmentContract
{
     /**
     * Get the ailments related to a particular product
     * 
     * @param  App/Product  $product
     * @return string
     */
    public function getAilments($product)
    {
        $Ailments=$product->ailments()->get();

        $strAilments=null;

        foreach ($Ailments as $ailment) {
            
            $strAilments.= $ailment->ailment_name.'+';   
        }

        return trim($strAilments,'+');
    }   
}

<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Contracts\Cart as CartContract;
use App\Http\Controllers\BaseControllers\BaseCartController as BaseCartController;

class CartController extends BaseCartController implements CartContract
{   
    /**
     * Display or show user cart
     *
     * @return Illuminate\Contracts\View
     */
    public function show()
    {  
        if(Auth::check())
        {
            return $this->getCartDataUserLoggedIn();
        }
        else
        {
            return $this->getCartDataUserNotLoggedIn();
        }
    }   

    /**
     * Add product to cart
     * 
     * @param  $productId
     * @return Response
     */
    public function add($productId)
    {
        $input = Request::all();
        /**
         *  Important Note Here : For the 
         *  time being now the product
         *  addition to cart is by
         *  GET.It should be 
         *  POST
         */
        return $this->addProductToCart($productId,$input['quantity']);
    }

    /**
     * Update user cart
     *
     * @return Response
     */
    public function update()
    {
        return $this->updateProductInCart();
    }

    /**
     * Remove the product from user's cart
     *
     * @return Response
     */
    public function destroy($id)
    {
        return $this->deleteProductFromCart();
    }
}

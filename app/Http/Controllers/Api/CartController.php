<?php namespace App\Http\Controllers\Api;

use Auth;
use Response;
use App\Order;
use App\Product;
use App\Customer;
use App\OrderDetails;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\Cart;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Acme\Transformers\CartTransformer as CartTransformer;
use App\Http\Controllers\Api\ApiController as ApiController;
use App\Http\Controllers\Api\Contracts\Cart as CartContract;

class CartController extends ApiController implements CartContract{

    use Cart;

    /**
     * Add the product to cart .. 
     */
    public function add()
    {
        $input = Request::all();

        $validator = $this->validator($input,['quantity','order_id']);
        
        if($validator->fails()){
            return $this->respondWithError($validator->messages());
        }

        //check if customer id is valid 
        if($this->validCustomerId($input['customer_id'])){

         //check if product id valid or not 
           if($this->validProductId($input['product_id'])){
            // dd('validated');
            $orderId = $this->addProductToCart($input['product_id'],$input['customer_id'],TRUE,$input['quantity']);

            if($orderId != False){
             return  $this->respond(['message' => 'Product Added SuccessFully','order_id' => $orderId,'is_added' => 1]);
         }

     } 
     return $this->respond(['message' => 'Not a valid product id . Product does not exist','is_added' => 0]);
 }
 return $this->respond(['message' => 'Not a valid customer id . Customer does not exist' ,'is_added' => 0]);
}

    /**
     * View cart item or product.
     * 
     * @return json
     */
    public function view(CartTransformer $transformer)
    {
        $input = Request::all();

        $validator = $this->validator($input,['product_id','quantity']);
        
        if($validator->fails()){
            return $this->respondWithError($validator->messages());
        }

        $cartData = $this->getCartDataUserLoggedIn($input['customer_id'],TRUE);

        if(!$cartData->isEmpty()){

            $cartTotal = $cartData->total;
            $cartData = $cartData->flatten()->toArray();
            
            $cartData = $transformer->tranformArray($cartData);

            $cartData['cart_total'] = $cartTotal;

            $cartTotalAfterDisc = (($cartTotal/100)*85); // since there is 15% discounts so (100-15 = 85)

            $cartData['cart_total_after_discount'] = $cartTotalAfterDisc;
            $cartData['discount_text'] = "Total Savings : 15%";
            $cartData['cart_total_before_tax'] = $cartTotalAfterDisc;

            $tax = (($cartTotalAfterDisc/100)*12);
            
            $cartData['cart_tax'] = $tax;
            $grandTotal = $cartTotalAfterDisc + $tax;
            $cartData['estimated_total'] = $grandTotal;
            $cartData['you_saved'] = $cartTotal - $cartTotalAfterDisc;
            return $this->respond($cartData);
        }
        return $this->respond(['message' => 'No cart data available','cart_get' => 0]);
    }

    /**
     * Update cart item or product.
     * 
     * @return json
     */
    public function update()
    {
        $input = Request::all();
        
        $validator = $this->validator($input);
        
        if($validator->fails()){
            return $this->respondWithError($validator->messages());
        }

        //check if customer id is valid 
        if($this->validCustomerId($input['customer_id'])){

             //check if product id valid or not 
           if($this->validProductId($input['product_id'])){

            return $this->udpateProductInCart($input);

        } 
        return $this->respond(['message' => 'Not a valid product id . Product does not exist','is_updated' => 0]);
    }

        // dd($this->updateProductInCart($customerId,TRUE,$orderId,$quantity,$productCode));
}

    /**
     * Delete product or item from cart
     * 
     * @return json
     */
    public function delete()
    {
        $input = Request::all();

        $validator = $this->validator($input,['quantity']);
        
        if($validator->fails()){
            return $this->respondWithError($validator->messages());
        }

        //check if customer id is valid 
        if($this->validCustomerId($input['customer_id'])){

             //check if product id valid or not 
           if($this->validProductId($input['product_id'])){
            return $this->deleteProductFromCart($input['product_id'],$input['order_id']);
        } 
        return $this->respondWithError( 'Not a valid product id . Product does not exist');
    }
}

    /**
     * Validor for product add api 
     *
     * @param  array $input
     * @return 
     */
    protected function validator($input,$exclude = [])
    {   
        $rules = [
        'product_id'   => 'required|integer',
        'customer_id'  => 'required|integer',
        'order_id'     => 'required|integer',
        'quantity'     => 'required|integer',
        ];

        if($exclude != NULL){
            foreach ($exclude as $key) {
                unset($rules[$key]);
            }
        }

        return Validator::make($input,$rules);
    }

    /**
     * Checks if provided customer id is valid or not 
     * 
     * @param  int $customerId
     * @return bool
     */
    protected function validCustomerId($customerId)
    {
        $customer = Customer::find($customerId);

        if(!is_null($customer)){
            return true;
        }        
        return false;
    }    

    /**
     * Checks if provided Product id is valid or not 
     * 
     * @param  int $productId
     * @return bool
     */
    protected function validProductId($productId)
    {
        $product = Product::find($productId);

        if(!is_null($product)){
            return true;
        }        
        return false;
    }

    /**
     * Gets the value of cartObject.
     *
     * @return mixed
     */
    public function getCartObject()
    {
        return $this->cartObject;
    }

    /**
     * Sets the value of cartObject.
     *
     * @param mixed $cartObject the cart object
     *
     * @return self
     */
    protected function setCartObject($cartObject)
    {
        $this->cartObject = $cartObject;

        return $this;
    }

    protected function deleteProductFromCart($productId,$orderId)
    {
        $order = Order::find($orderId);

        if($order != NULL and $order->order_status == 0){

            if($this->deleteProductFromOrderDetails($productId,$orderId)){
                $orderDetailsItemsCount = OrderDetails::where(['order_id' => $orderId])->get()->count();
                return $this->respond(['message' => 'Product Deleted From Cart Successfully .. !!',
                    'is_deleted' => 1,'items_count' => $orderDetailsItemsCount]);
            }
            return $this->respond(['message' => 'Unable to delete the product from cart','is_deleted' => 0]);
        }
        return $this->respond(['message' => 'Invalid Order Or Quote Id','is_deleted' => 0]);
    }

    protected function deleteProductFromOrderDetails($productId,$orderId)
    {
        $orderDetails = OrderDetails::where(['order_id' => $orderId , 'product_id' => $productId])->get();

        if(!$orderDetails->isEmpty()){
            if($orderDetails[0]->delete()){
                return true;
            }
        }
        return false;
    }

    protected function udpateProductInCart($data)
    {
        $customerId = $data['customer_id'];
        $orderId    = $data['order_id'];
        $quantity   = $data['quantity']; 
        $productId  = $data['product_id'];

        $orderDetails = OrderDetails::where(['order_id' => $orderId , 'product_id' => $productId])->get();

        if(!$orderDetails->isEmpty()){

            $orderDetail = $orderDetails->first();
            $orderDetail->quantity = $quantity;

            if($orderDetail->save()){
                return $this->respond(['message' => 'Product in Cart updated ','is_updated' => 1]);
            }
            return $this->respond(['message' => 'Product in Cart not updated ','is_updated' => 0]);
        }
        return $this->respond(['message' => 'Unable to find the order details','is_updated' => 0]);
    }
}

?>
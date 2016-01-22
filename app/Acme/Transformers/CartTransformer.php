<?php namespace App\Acme\Transformers;

class CartTransformer extends Transformer{
	
    /**
     * Used for transforming the cart data sent
     * over the api to make fiels consistent 
     * that is to decouple it from the database
     * fields ..
     * 
     * @param  [type] $cartItem [description]
     * @return [type]           [description]
     */
    public function transform($cartItem)
    {
        return [
            'product_id' => $cartItem['id'],
            'product_name' => $cartItem['name'],
            'product_quantity' => $cartItem['qty'],
            'product_price' => $cartItem['price'],
            'product_id' => $cartItem['id'],
            'product_prescription' => $cartItem['options']['prescription'],
            'product_manufacturer' => $cartItem['options']['manufacturer'],
            'product_salt' => $cartItem['options']['salt'],
            'product_unit' => $cartItem['options']['unit'],
            'product_packing' => $cartItem['options']['packing'],
            'product_subtotal' => $cartItem['subtotal']
        ];
    }
}
?>
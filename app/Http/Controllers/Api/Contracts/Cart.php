<?php namespace App\Http\Controllers\Api\Contracts;

interface Cart
{
    /**
     * Add the product to cart .. 
     */
    public function add();

    /**
     * View cart item or product.
     * 
     * @return json
     */
    public function view(\CartTransformer $transformer);

    /**
     * Update cart item or product.
     * 
     * @return json
     */
    public function update();

    /**
     * Delete product or item from cart
     * 
     * @return json
     */
    public function delete();
}

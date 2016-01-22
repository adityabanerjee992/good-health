<?php

namespace App\Http\Contracts;

interface Cart
{
 	/**
     * Display or show user cart
     *
     * @return Illuminate\View
     */
    public function show();

    /**
     * Add product to cart
     * 
     * @param  $productId
     * @return Response
     */
    public function add($productId);

    /**
     * Update user cart
     *
     * @param  int  $id
     * @return Response
     */
    public function update();

    /**
     * Remove the product from user's cart
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id);
}
<?php namespace App\Acme\Transformers;

class ProductTransformer extends Transformer{
	
    public function transform($product)
    {
       
        return [
        'product_id' => $product['id'],
        'product_code' => $product['product_code'],
        'product_name' => $product['product_name'],
        'salts' => $product['salts'],
        'categories' => $product['categories'],
        'packing'    => $product['packing'],
        'unit'       => $product['unit'],
        'company'    => $product['company'],
        'product_ailments' => $product['ailments'],
        'product_mrp'  => $product['product_mrp'],
        'product_tax'    => $product['product_tax']
        ];
    }
}
?>
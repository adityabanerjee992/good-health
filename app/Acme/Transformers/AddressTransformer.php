<?php namespace App\Acme\Transformers;

class AddressTransformer extends Transformer
{
    public function transform($address)
    {
        return [
            'address_id'          => $address['id'],
            'name'          => $address['name'],
            'pincode'        => $address['pincode'],
            'address'       => $address['address'],
            'phone'         => $address['phone'],
            'city'       => $address['city'],
            'state'       => $address['state'], 
            'country'       => $address['country'],
            'default'       => $address['is_default'],
            'creation_date' => $address['created_at'],
            'updation_date' => $address['updated_at']
        ];
    }
}

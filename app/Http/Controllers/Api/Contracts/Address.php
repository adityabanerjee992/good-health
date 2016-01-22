<?php namespace App\Http\Controllers\Api\Contracts;

interface Address
{
    /**
     * Add new address
     */
    public function add();

    /**
     * Get all customer address
     * 
     * @return json
     */
    public function get(\AddressTransformer $transformer);

    /**
     * Update customer address
     * 
     * @return json
     */
    public function update();

    /**
     * Delete customer address
     * 
     * @return json
     */
    public function delete();
}

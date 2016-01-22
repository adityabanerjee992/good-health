<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
    protected $table="order_details";

    /**
      * Specifies the Mass Assinable Fields
      * @var array
      */
    protected $fillable = [
    'order_id',
    'product_id',
    'product_code',
    'product_name',
    'quantity',
    'price'
    ];


    /**
     *  Get the order details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        $this->hasMany('App\Order');
    }

    public static function checkIfProductExist($productId)
    {
        $orderDetails = OrderDetails::where(['product_id' => $productId])->get();

        if (!$orderDetails->isEmpty()) {
            return true;
        }
        return false;
    }
}

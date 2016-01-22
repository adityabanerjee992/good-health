<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class Order extends Model
{
    /**
   * Specifies the database table
   *
   * @var string
   **/
   protected $table="orders";

    /**
      * Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'customer_id',
                            'store_id',
                            'token',
                            'order_status',
                           ];


    public function orderDetails()
    {
        return $this->hasMany('App\OrderDetails');
    }

    public static function anyCustomerOrderExist($customerId)
    {
        $orderCount = Order::where(['customer_id' => $customerId])->get()->count();

        if ($orderCount != 0) {
            return true;
        }
        return false;
    }

   
    /**
     * Get all the order by store id 
     * 
     * @param   int $storeId 
     * @return  \Illuminate\Support\Collection         
     */
    public static function getAllOrdersByStoreId($storeId)
    {
        //get all orders which has the store id that belongs to the current logged in chemist user.
        $orders = Order::where('store_id', $storeId)->where('order_status', '!=', 1)->orderBy('created_at', 'DESC')->get();
        return $orders;
    }


    /**
     * Get the order status name by its id
     * 
     * @param  $orderStatusId
     * @return string 
     */
    public static function getOrderStatusName($orderStatusId)
    {
        switch ($orderStatusId) {
            case 1:
                return 'Pending Review';
                break;
            case 2:
                return 'Order Reviewed';
            case 3:
                return 'Processing';
            case 4:
                return 'Confirmed';
                break;
            case 5:
                return 'Cancelled';
                break;
           case 6:
                return 'Rejected';
                break;
            case 7:
                return 'Prescription Awaited';
                break;
            case 8:
                return 'Under Shipment';
                break;
            case 9:
                return 'Order In Transit';
                break;
            case 10:
                return 'Delivered';
                break;
        }
    }

    public static function getOrderStatuses()
    {
        $user = Sentinel::getUser();

        if ($user->roles->first()->slug == 'central-verification-team') {
            return [  1 => 'Pending Review',
                  2 => 'Order Reviewed',
                  5 => 'Cancelled',
                  6 => 'Rejected',
               ];
        }
        elseif ($user->roles->first()->slug == 'chemist') {
            return [  1 => 'Pending Review',
                  3 => 'Processing',
                  4 => 'Confirmed',
                  5 => 'Cancelled',
                  6 => 'Rejected',
                  8 => 'Under Shipment',
                  9 => 'Order In Transit',
                  10 => 'Delivered'
                ];
        }        
        elseif ($user->roles->first()->slug == 'support') {
             return [  1 => 'Pending Review',
                  2 => 'Order Reviewed',
                  5 => 'Cancelled',
                  6 => 'Rejected',
               ];
        }
        else{
          //its admin man.
          return [  1 => 'Pending Review',
                    2 => 'Order Reviewed',
                    3 => 'Processing',
                    4 => 'Confirmed',
                    5 => 'Cancelled',
                    6 => 'Rejected',
                    8 => 'Under Shipment',
                    9 => 'Order In Transit',
                    10 => 'Delivered'
                  ];
        }
    }
}

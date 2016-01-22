<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderActionLog extends Model
{
    /**
   * Specifies the database table
   *
   * @var string
   **/
   protected $table="orders_actions_logs";

    /**
      * Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'user_id',
                            'name',
                            'user_role',
                            'order_id',
                            'description',
                           ];

    /**
     * Log the order action performed to the db
     * 
     * @param  array $dataArray 
     * @return boolean            
     */
    public static function logAction($dataArray)
    {
        if ($dataArray != null) {
            if (static::firstOrCreate($dataArray)) {
                return true;
            }
        }
        return false;
    }
}

<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="addresses";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'customer_id',
                            'name',
                            'pincode',
                            'address',
                            'city',
                            'state',
                            'country',
                            'phone',
                            'is_default'
                           ];
}

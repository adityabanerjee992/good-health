<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="manufacturers";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['manufacturer_name'];

    /**
     * A manufacturer has many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function products()
     {
        return $this->belongsToMany('App\Product','product_manufacturer')->withTimeStamps();
     }
}

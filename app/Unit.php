<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="units";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['unit_type'];

    /**
     * A unit has many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
     	$this->hasMany('App\Product');
     }
}

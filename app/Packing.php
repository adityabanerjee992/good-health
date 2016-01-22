<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     */
     protected $table="packings";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['packing_type'];

    /**
     * A packing can belongs to many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
     	$this->hasMany('App\Product');
     }
}

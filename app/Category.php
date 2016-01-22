<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="categories";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['category_name'];

	/**
     * A category has many products
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function products()
     {
     	$this->hasMany('App\Product');
     }
}

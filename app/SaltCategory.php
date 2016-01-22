<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SaltCategory extends Model
{
     /**
     * Specifies the database table
     *
     * @var string
     **/
     protected $table="salt_categories";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = ['name'];

    /**
     * A salt has many products 
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     // public function products()
     // {
     //    return $this->belongsToMany('App\Product','product_salt')->withTimeStamps();
     // }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    /**
     * Specifies the database table
 *
     * @var string
     **/
     protected $table="products";

     /**
      *  Specifies the Mass Assinable Fields
      * @var array
      */
     protected $fillable = [
                            'product_name',
                            'product_code',
                            'product_mrp',
                            'product_tax',
                            'is_prescription_drug'
                           ];

    /**
     * A product comes in a particular packing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function packings()
     {
     	return $this->belongsToMany('App\Packing','product_packing')->withTimeStamps();
     }
      
    /**
     * A product comes in a particular unit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function units()
     {
     	return $this->belongsToMany('App\Unit','product_unit')->withTimeStamps();
     }    

    /**
     * A product belongs to some company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function companies()
     {
        return $this->belongsToMany('App\Company','product_company')->withTimeStamps();
     } 

    /**
     * A product will fall under many or some categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function categories()
     {
        return $this->belongsToMany('App\Category','product_category')->withTimeStamps();
     } 

    /**
     * A product will fall under many or some ailments or diseases
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function ailments()
     {
        return $this->belongsToMany('App\Ailment','product_ailment')->withTimeStamps();
     } 

    /**
     * A product will fall under many or some ailments or diseaseail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function classes()
     {
        return $this->belongsToMany('App\Classes','product_classes')->withTimeStamps();
     } 

    /**
     * A product can consists of multiple salts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function salts()
     {
     	return $this->belongsToMany('App\Salt','product_salt')->withTimeStamps();
     } 

    /**
     * A Product belongs to some manufacturer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function manufacturers()
     {
        return $this->belongsToMany('App\Manufacturer','product_manufacturer')->withTimeStamps();
     }     

     /**
     * A Product belongs to many types 
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function types()
     {
     	return $this->belongsToMany('App\Type','product_type')->withTimeStamps();
     }    
}

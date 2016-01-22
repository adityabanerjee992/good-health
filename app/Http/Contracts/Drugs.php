<?php

namespace App\Http\Contracts;

interface Drugs
{
    /**
     * Get Drugs By Ailments 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byAilments();

     /**
     * Get Drugs By Class 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byClass();

    /**
     * Get Drugs By Company 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byCompany();

    /**
     * Get Drugs By Manufacturer 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byManufacturer();


    /**
     * Get Drugs By A to Z (in alphabatical order) 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byAZ();    
}
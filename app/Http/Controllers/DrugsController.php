<?php namespace App\Http\Controllers;

use URL;
use Request;
use App\Http\Requests;
use App\Ailment as Ailment;
use App\Classes as Classes;
use App\Company as Company;
use App\Product as Product;
use App\Http\Controllers\Controller;
use App\Manufacturer as Manufacturer;
use App\Http\Contracts\Drugs as DrugsContract;

class DrugsController extends Controller implements DrugsContract
{
    /**
     * Get Drugs By Ailments 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byAilments()
    {
    	$category="Ailments";

        $ailments = Ailment::all();

        $url = URL::current();

    	return view('drugs.by-ailment',compact('category','ailments','url'));
    }

    /**
     * Get Drugs By Class 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byClass()
    {
    	$category="Class";
    
        $classes = Classes::all();

        $url = URL::current();

    	return view('drugs.by-class',compact('category','classes','url'));
    }

    /**
     * Get Drugs By Company 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byCompany()
    {
        $category="Company";
        
        $companies = Company::all();

        $url = URL::current();

        return view('drugs.by-company',compact('category','companies','url'));    
    }  

    /**
     * Get Drugs By Manufacturer 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byManufacturer()
    {
    	$category="Manufacturer";
        
        $manufacturers = Company::all();

        $url = URL::current();

        return view('drugs.by-manufacturer',compact('category','manufacturers','url'));    
    }  

    /**
     * Get Drugs By A to Z (in alphabatical order) 
     * 
     * @return Illuminate\Contracts\View\View
     */
    public function byAZ()
    {
    	$category="A-Z List";

        $products = Product::orderBy('product_name', 'ASC')->paginate(20);

        $url=Request::url();

        return view('drugs.by-az',compact('category','products','url'));
    }

    /**
     * Temp code keeping it till final release 
     */

    // public function getMedicinesUnderAilments($category)
    // {
    //    $class='AILMENTS';
    
    //    $category=str_replace('-', ' ', $category);

    //    $category=ucfirst($category);


    //    $medicineList=[ 
    //                     'Astemizole',
    //                     'Azatadine',
    //                     'Cetirizine',
    //                     'Chlorphenamine',
    //                     'Chlorpheniramine',
    //                     'Clemastine',
    //                     'Codeine',
    //                     'Cyproheptadine',
    //                     'Desloratidine',
    //                     'Desloratidine',
    //                     'Dexchlorpheniramine',
    //                     'Dimethindene'
    //                   ];

    //    $currentUrl=Request::url();
       
    //    return View('drugs.show-medicines',compact('medicineList','currentUrl','class','category'));
    // }
    
    // public function getMedicinesUnderClass($category)
    // {
    //    $class='CLASS';


    //    $category=str_replace('-', ' ', $category);

    //    $category=ucfirst($category);

    //    $medicineList=[ 
    //             "Acarbose",
    //             "All Other Anti Diabetics Plain",
    //             "Atorvastatin",
    //             "Benfotiamine",
    //             "Biphasic Aspart",
    //             "Biphasic Lispro",
    //             "Bromocriptine",
    //             "Chlorpropamide",
    //             "Chromium",
    //             "Determir",
    //             "Epalrestat",
    //             "Exenatide",
    //             "Glibenclamide",
    //             "Glibenclamide + Metformin",
    //             "Gliclazide",
    //             "Gliclazide + Metformin",
    //             "Glimepiride",
    //             "Glimepiride + Metformin",
    //             "Glipizide",
    //             "Glipizide + Metformin",
    //             "Guar Gum",
    //             "Human Normal Immunoglobulin",
    //             "Insulin Aspart Protamine",
    //             "Insulin Degludec",
    //             "Insulin Glargine",
    //             "Insulin Isophane (NPH)",
    //             "Insulin Lispro",
    //             "Insulin Regular",
    //             "Linagliptin",
    //             "Liraglutide",
    //             "Metformin",
    //             "Methylcobalamin",
    //             "Miglitol",
    //             "Myo Inositol",
    //             "Nateglinide",
    //             "Phenformin",
    //             "Picolinic Acid",
    //             "Pioglitazone",
    //             "Pioglitazone + Glimepiride",
    //             "Pioglitazone + Metformin",
    //             "Pregabalin",
    //             "Ramipril",
    //             "Ranibizumab",
    //             "Regular Aspart",
    //             "Repaglinide",
    //             "Rosiglitazone",
    //             "Rosiglitazone + Gliclazide",
    //             "Rosiglitazone + Metformin",
    //             "Saroglitazar",
    //             "Saxagliptin",
    //             "Sitagliptin",
    //             "Teas Herbal Extracts",
    //             "Thioctic Acid",
    //             "Tolbutamide",
    //             "Vildagliptin",
    //             "Voglibose",
    //             "insulin Glulisine"
    //           ];

    //     $currentUrl=Request::url();
       
    //    return View('drugs.show-medicines',compact('medicineList','currentUrl','class','category'));
    //  }    

    //  public function getMedicinesUnderCompany($category)
    //  {

    //    $class='COMPANY';

    //    $category=str_replace('-', ' ', $category);

    //    $category=ucfirst($category);

    //    $medicineList=[ 
    //             "Acarbose",
    //             "All Other Anti Diabetics Plain",
    //             "Atorvastatin",
    //             "Benfotiamine",
    //             "Biphasic Aspart",
    //             "Biphasic Lispro",
    //             "Bromocriptine",
    //             "Chlorpropamide",
    //             "Chromium",
    //             "Determir",
    //             "Epalrestat",
    //             "Exenatide",
    //             "Glibenclamide",
    //             "Glibenclamide + Metformin",
    //             "Gliclazide",
    //             "Gliclazide + Metformin",
    //             "Glimepiride",
    //             "Glimepiride + Metformin",
    //             "Glipizide",
    //             "Glipizide + Metformin",
    //             "Guar Gum",
    //             "Human Normal Immunoglobulin",
    //             "Insulin Aspart Protamine",
    //             "Insulin Degludec",
    //             "Insulin Glargine",
    //             "Insulin Isophane (NPH)",
    //             "Insulin Lispro",
    //             "Insulin Regular",
    //             "Linagliptin",
    //             "Liraglutide",
    //             "Metformin",
    //             "Methylcobalamin",
    //             "Miglitol",
    //             "Myo Inositol",
    //             "Nateglinide",
    //             "Phenformin",
    //             "Picolinic Acid",
    //             "Pioglitazone",
    //             "Pioglitazone + Glimepiride",
    //             "Pioglitazone + Metformin",
    //             "Pregabalin",
    //             "Ramipril",
    //             "Ranibizumab",
    //             "Regular Aspart",
    //             "Repaglinide",
    //             "Rosiglitazone",
    //             "Rosiglitazone + Gliclazide",
    //             "Rosiglitazone + Metformin",
    //             "Saroglitazar",
    //             "Saxagliptin",
    //             "Sitagliptin",
    //             "Teas Herbal Extracts",
    //             "Thioctic Acid",
    //             "Tolbutamide",
    //             "Vildagliptin",
    //             "Voglibose",
    //             "insulin Glulisine"
    //           ];

    //     $currentUrl=Request::url();
       
    //    return View('drugs.show-medicines',compact('medicineList','currentUrl','class','category'));
    //  }

    //  public function getMedicinesUnderAZ($category)
    //  {
    //    $class='A-Z';

    //    $category=str_replace('-', ' ', $category);

    //    $category=ucfirst($category);

    //    $medicineList=[ 
    //             "Acarbose",
    //             "All Other Anti Diabetics Plain",
    //             "Atorvastatin",
    //             "Benfotiamine",
    //             "Biphasic Aspart",
    //             "Biphasic Lispro",
    //             "Bromocriptine",
    //             "Chlorpropamide",
    //             "Chromium",
    //             "Determir",
    //             "Epalrestat",
    //             "Exenatide",
    //             "Glibenclamide",
    //             "Glibenclamide + Metformin",
    //             "Gliclazide",
    //             "Gliclazide + Metformin",
    //             "Glimepiride",
    //             "Glimepiride + Metformin",
    //             "Glipizide",
    //             "Glipizide + Metformin",
    //             "Guar Gum",
    //             "Human Normal Immunoglobulin",
    //             "Insulin Aspart Protamine",
    //             "Insulin Degludec",
    //             "Insulin Glargine",
    //             "Insulin Isophane (NPH)",
    //             "Insulin Lispro",
    //             "Insulin Regular",
    //             "Linagliptin",
    //             "Liraglutide",
    //             "Metformin",
    //             "Methylcobalamin",
    //             "Miglitol",
    //             "Myo Inositol",
    //             "Nateglinide",
    //             "Phenformin",
    //             "Picolinic Acid",
    //             "Pioglitazone",
    //             "Pioglitazone + Glimepiride",
    //             "Pioglitazone + Metformin",
    //             "Pregabalin",
    //             "Ramipril",
    //             "Ranibizumab",
    //             "Regular Aspart",
    //             "Repaglinide",
    //             "Rosiglitazone",
    //             "Rosiglitazone + Gliclazide",
    //             "Rosiglitazone + Metformin",
    //             "Saroglitazar",
    //             "Saxagliptin",
    //             "Sitagliptin",
    //             "Teas Herbal Extracts",
    //             "Thioctic Acid",
    //             "Tolbutamide",
    //             "Vildagliptin",
    //             "Voglibose",
    //             "insulin Glulisine"
    //           ];

    //     $currentUrl=Request::url();
       
    //    return View('drugs.show-medicines',compact('medicineList','currentUrl','class','category'));
    //  }

    // public function getMedicineDetails($category,$subCategory)
    // {   
    //     $subCategory=str_replace('-', ' ', $subCategory);

    //     $subCategory=ucfirst($subCategory);

    //     $category=str_replace('-', ' ', $category);

    //     $category=ucfirst($category);

    //     $class='AILMENTS';

    //     return View('drugs.show-medicine-details',compact('subCategory','category','class'));
    // }
}

<?php namespace App\Http\Controllers;

use Route;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
   
    /**
     * Displays The Home View
     * 
     * @param  NoParams
     * @return Illuminate\Contracts\View
     *
     */
    public function index()
    {
        return view('home.index');
    }

}

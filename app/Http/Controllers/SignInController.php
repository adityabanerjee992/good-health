<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SignInController extends Controller
{
    /**
     * Displays The SignIn View Or Form
     * 
     * @param  NoParams
     * @return Illuminate\Contracts\View
     *
     **/
    public function getSignIn(){

    	return View('sign-in.login');
    }

    /**
     * undocumented function
     *
     * @return void
     * 
     **/
    public function postSignIn()
    {
    	return 'Sign In Form Posted Successfully';
    }

}

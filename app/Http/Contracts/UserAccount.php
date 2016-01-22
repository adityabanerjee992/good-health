<?php

namespace App\Http\Contracts;

interface UserAccount
{
	/**
	 * Get the user account info view
	 * @return  \Illuminate\Http\Response
	 */
    public function getUserAccount();   

	/**
	 * Handles the form post functionality
	 * of account info form
	 * 
	 * @return  \Illuminate\Http\Response
	 */
    public function postUserAccount();   

    /**
	 * Handles the funtionality of 
	 * user my addresses feature
	 * 
	 * @return  \Illuminate\Http\Response
	 */
    public function userAddresses();   

    /**
	 * Handles the funtionality of 
	 * user my documents feature
	 * 
	 * @param   string $type (Type of user documents)
	 * @return 	\Illuminate\Http\Response
	 */
    public function userDocuments($type);   

  	/**
	 * Handles the funtionality of 
	 * user my orders feature
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function userOrders();   

  	/**
  	 * Get the order details
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function userOrderDetails($id);   

  	/**
	 * Handles the funtionality of 
	 * user my cart feature
	 * 
	 * @return \Illuminate\Http\Response
	 */
    public function userCart();   

    /**
     * Print the order with the given order id 
     * @param  int $orderId 
     * 
     * @return Illuminate\View
     */
    public function printOrder($orderId);
}
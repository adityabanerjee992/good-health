<?php

namespace App\Http\Contracts;

interface Order
{
    /**
     * Add order to orders table
     * 
     * @param   Illuminate\Support\Collection  $cartData 
     * @param   string  $token
     *  
     * @return  boolean
     */
    public function createOrder($cartData,$token,$isApi,$customerId = NULL);

    /**
     * Get the product detailes by its Id
     * 
     * @param   integer     $id
     * @return  \Illuminate\View
     */
    // public function updateOrder($id);

    /**
     * Fetch the product detailes by its Id
     * 
     * @param   integer     $id
     * @return  \Illuminate\View
     */
    // public function getOrder($id);

    /**
     *  Delete order from order details table
     * 
     * @return \Illuminate\View
     */
    public function deleteOrderDetails($product_code,$order_id=NULL,$quantity,$token=NULL);   
    
    /**
     *  Delete order from orders table
     * 
     * @return \Illuminate\View
     */
    public function deleteOrder($order_id);   
    

    /**
     * Update Order Quantity
     * 
     * @param   Illuminate\Support\Collection  $cartData 
     * @param   string  $token
     *  
     * @return  boolean
     */
    public function updateOrderQuanity($product_code,$order_id=NULL,$quantity,$token=NULL); 

    
    /**
     * Update user id in the order entry 
     * 
     * @param   string  $token
     *  
     * @return  boolean
     */
    public function updateOrderUserId($token); 
    
    /**
     * Get order id by customer id
     * 
     * @param   interger  $customer_id
     *  
     * @return  integer   $order_id
     */
    public function getOrderId($customer_id); 
    
    /**
     * Get order details  
     * 
     * @param   interger  $id 
     *  
     * @return  Collection $orderDetails   
     */
    public function getOrderDetails($id);     

    /**
     * Get order details by uid
     * 
     * @param   interger  $uid
     * @param   string    $token
     *  
     * @return  Collection $orderDetails   
     */
    public function getOrderDetailsByUserIdAndUpdateToken($uid,$token); 
    
    /**
     * Update order data 
     * 
     * @param   interger  $orderId
     * @param   array     $orderData
     * 
     * @return  boolean   
     */
    public function udpateOrderData($orderId,$orderData); 

    /**
     * Checks if order exists or not 
     * 
     * @param   int  $orderId
     * @return  boolean   
     */
    public function checkIfOrderExist($orderId);

}
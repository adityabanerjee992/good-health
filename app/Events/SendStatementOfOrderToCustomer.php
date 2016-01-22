<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendStatementOfOrderToCustomer extends Event
{
    protected $userAddress;
    protected $paymentTypeDetails;
    protected $orderDetails;
    protected $orderStatus;
    protected $companies;
    protected $name;
    protected $email;

    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userAddress, $paymentTypeDetails, $orderDetails, $orderStatus, $companies,$name,$email)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setCompanies($companies);
        $this->setUserAddress($userAddress);
        $this->setOrderStatus($orderStatus);
        $this->setOrderDetails($orderDetails);
        $this->setPaymentTypeDetails($paymentTypeDetails);
    }

    /**     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }

    /**
     * Gets the value of userAddress.
     *
     * @return mixed
     */
    public function getUserAddress()
    {
        return $this->userAddress;
    }

    /**
     * Sets the value of userAddress.
     *
     * @param mixed $userAddress the user address
     *
     * @return self
     */
    protected function setUserAddress($userAddress)
    {
        $this->userAddress = $userAddress;

        return $this;
    }

    /**
     * Gets the value of paymentTypeDetails.
     *
     * @return mixed
     */
    public function getPaymentTypeDetails()
    {
        return $this->paymentTypeDetails;
    }

    /**
     * Sets the value of paymentTypeDetails.
     *
     * @param mixed $paymentTypeDetails the payment type details
     *
     * @return self
     */
    protected function setPaymentTypeDetails($paymentTypeDetails)
    {
        $this->paymentTypeDetails = $paymentTypeDetails;

        return $this;
    }

    /**
     * Gets the value of orderDetails.
     *
     * @return mixed
     */
    public function getOrderDetails()
    {
        return $this->orderDetails;
    }

    /**
     * Sets the value of orderDetails.
     *
     * @param mixed $orderDetails the order details
     *
     * @return self
     */
    protected function setOrderDetails($orderDetails)
    {
        $this->orderDetails = $orderDetails;

        return $this;
    }

    /**
     * Gets the value of orderStatus.
     *
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Sets the value of orderStatus.
     *
     * @param mixed $orderStatus the order status
     *
     * @return self
     */
    protected function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Gets the value of companies.
     *
     * @return mixed
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * Sets the value of companies.
     *
     * @param mixed $companies the companies
     *
     * @return self
     */
    protected function setCompanies($companies)
    {
        $this->companies = $companies;

        return $this;
    }

    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    protected function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of email.
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the value of email.
     *
     * @param mixed $email the email
     *
     * @return self
     */
    protected function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}

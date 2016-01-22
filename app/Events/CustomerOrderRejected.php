<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CustomerOrderRejected extends Event
{
    use SerializesModels;

    protected $name;
    protected $email;
    protected $rejectionReason;
    protected $orderId;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $email, $rejectionReason, $orderId)
    {
      $this->setName($name);
      $this->setEmail($email);
      $this->setRejectionReason($rejectionReason);
      $this->setOrderId($orderId);
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
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

    /**
     * Gets the value of rejectionReason.
     *
     * @return mixed
     */
    public function getRejectionReason()
    {
        return $this->rejectionReason;
    }

    /**
     * Sets the value of rejectionReason.
     *
     * @param mixed $rejectionReason the rejection reason
     *
     * @return self
     */
    protected function setRejectionReason($rejectionReason)
    {
        $this->rejectionReason = $rejectionReason;

        return $this;
    }

    /**
     * Gets the value of orderId.
     *
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Sets the value of orderId.
     *
     * @param mixed $orderId the order id
     *
     * @return self
     */
    protected function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }
}

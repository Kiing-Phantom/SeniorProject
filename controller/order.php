<?php
//class to represent an entry in the orders table
class Order {
    //properties
    private $orderId;
    private $orderDate;
    private $orderTotal;
    private $customerId;
    private $orderCode;

    public function __construct($orderId, $orderDate, $orderTotal, $customerId, $orderCode) {
        $this -> orderId = $orderId;
        $this -> orderDate = $orderDate;
        $this -> orderTotal = $orderTotal;
        $this -> customerId = $customerId;
        $this -> orderCode = $orderCode;
    }

    //get/set properties

    public function getOrderId() {
        return $this -> orderId;
    }

    public function setOrderId( $val ) {
        $this -> orderId = $val;
    }

    public function getOrderDate() {
        return $this -> orderDate;
    }

    public function setOrderDate( $val ) {
        $this -> orderDate = $val;
    }

    public function getOrderTotal() {
        return $this -> orderTotal;
    }

    public function setOrderTotal( $val ) {
        $this -> orderTotal = $val;
    }

    public function getCustomerId() {
        return $this -> customerId;
    }

    public function setCustomerId( $val ) {
        $this -> customerId = $val;
    }

    public function getOrderCode() {
        return $this -> orderCode;
    }

    public function setOrderCode( $val ) {
        $this -> orderCode = $val;
    }
}
?>
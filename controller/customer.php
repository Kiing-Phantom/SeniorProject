<?php
//class to represent an entry in the customers table
class Customer {
    //properties
    private $customerId;
    private $firstName;
    private $lastName;
    private $address;
    private $phone;
    private $email;
    private $customerCode;

    public function __construct($customerId, $firstName, $lastName, 
                                $address, $phone, $email, $customerCode) {
        $this -> customerId   = $customerId;
        $this -> firstName    = $firstName;
        $this -> lastName     = $lastName;
        $this -> address      = $address;
        $this -> phone        = $phone;
        $this -> email        = $email;
        $this -> customerCode = $customerCode;
    }

    //get/set properties
    public function getCustomerId() {
        return $this -> customerId;
    }

    public function setCustomerId( $val ) {
        $this -> customerId = $val;
    }

    public function getFirstName() {
        return $this -> firstName;
    }

    public function setFirstName( $val ) {
        $this -> firstName = $val;
    }

    public function getLastName() {
        return $this -> lastName;
    }

    public function setLastName( $val ) {
        $this -> lastName = $val;
    }

    public function getAddress() {
        return $this -> address;
    }

    public function setAddress( $val ) {
        $this -> address = $val;
    }

    public function getPhone() {
        return $this -> phone;
    }

    public function setPhone( $val ) {
        $this -> phone = $val;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function setEmail( $val ) {
        $this -> email = $val;
    }

    public function getCustomerCode() {
        return $this -> customerCode;
    }

    public function setCustomerCode( $val ){
        $this -> customerCode = $val;
    }
}
?>
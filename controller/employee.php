<?php
//class to represent an entry in the employees table
class Employee {
    //properties
    private $employeeId;
    private $firstName;
    private $lastName;
    private $address;
    private $phone;
    private $email;
    private $username;
    private $password;
    private $titleId;
    private $employeeCode;

    public function __construct($employeeId, $firstName, $lastName,
                                $address, $phone, $email,
                                $username, $password, $titleId, $employeeCode) {
        $this -> employeeId = $employeeId;
        $this -> firstName = $firstName;
        $this -> lastName = $lastName;
        $this -> address = $address;
        $this -> phone = $phone;
        $this -> email = $email;
        $this -> username = $username;
        $this -> password = $password;
        $this -> titleId = $titleId;
        $this -> employeeCode = $employeeCode;
    }

    //get/set properties
    public function getEmployeeId() {
        return $this -> employeeId;
    }

    public function setEmployeeId($val) {
        $this -> employeeId = $val;
    }

    public function getFirstName() {
        return $this -> firstName;
    }

    public function setFirstName($val) {
        $this -> firstName = $val;
    }

    public function getLastName() {
        return $this -> lastName;
    }

    public function setLastName($val) {
        $this -> lastName = $val;
    }

    public function getAddress() {
        return $this -> address;
    }

    public function setAddress($val) {
        $this -> address = $val;
    }

    public function getPhone() {
        return $this -> phone;
    }

    public function setPhone($val) {
        $this -> phone = $val;
    }

    public function getEmail() {
        return $this -> email;
    }

    public function setEmail($val) {
        $this -> email = $val;
    }

    public function getUsername() {
        return $this -> username;
    }

    public function setUsername($val) {
        $this -> username = $val;
    }

    public function getPassword() {
        return $this -> password;
    }

    public function setPassword($val) {
        $this -> password = $val;
    }

    public function getTitleId() {
        return $this -> titleId;
    }

    public function setTitleID($val) {
        $this -> titleId = $val;
    }

    public function getEmployeeCode() {
        return $this -> employeeCode;
    }

    public function setEmployeeCode( $val ) {
        $this -> employeeCode = $val;
    }
}
?>
<?php
//class to represent an entry in the suppliers table
class Supplier {
    //properties
    private $supplierId;
    private $supplierName;
    private $supplierAddress;
    private $supplierPhone;
    private $supplierFax;
    private $supplierEmail;
    private $supplierCode;

    public function __construct($supplierId, $supplierName, $supplierAddress,
                                $supplierPhone, $supplierFax, $supplierEmail, $supplierCode) {
        $this -> supplierId      = $supplierId;
        $this -> supplierName    = $supplierName;
        $this -> supplierAddress = $supplierAddress;
        $this -> supplierPhone   = $supplierPhone;
        $this -> supplierFax     = $supplierFax;
        $this -> supplierEmail   = $supplierEmail;
        $this -> supplierCode    = $supplierCode;
    }

    //get/set properties
    public function getSupplierId() {
        return $this -> supplierId;
    }

    public function setSupplierId( $val ) {
        $this -> supplierId = $val;
    }

    public function getSupplierName() {
        return $this -> supplierName;
    }

    public function setSupplierName( $val ) {
        $this -> supplierName = $val;
    }

    public function getSupplierAddress() {
        return $this -> supplierAddress;
    }

    public function setSupplierAddress( $val ) {
        $this -> supplierAddress = $val;
    }

    public function getSupplierPhone() {
        return $this -> supplierPhone;
    }

    public function setSupplierPhone( $val ) {
        $this -> supplierPhone = $val;
    }

    public function getSupplierFax() {
        return $this -> supplierFax;
    }

    public function setSupplierFax( $val ) {
        $this -> supplierFax = $val;
    }

    public function getSupplierEmail() {
        return $this -> supplierEmail;
    }

    public function setSupplierEmail( $val ) {
        $this -> supplierEmail = $val;
    }

    public function getSupplierCode() {
        return $this -> supplierCode;
    }

    public function setSupplierCode( $val ) {
        $this -> supplierCode = $val;
    }
}
?>
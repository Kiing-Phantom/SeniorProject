<?php
//class to represent an entry in the products table
class Product {
    //properties
    private $productId;
    private $productName;
    private $productDescription;
    private $productPrice;
    private $productQuantity;
    private $supplierId;
    private $categoryId;
    private $productCode;

    public function __construct($productId, $productName, $productDescription,
                                $productPrice, $productQuantity, $supplierId,
                                $categoryId, $productCode) {
        $this -> productId            = $productId;
        $this -> productName          = $productName;
        $this -> productDescription   = $productDescription;
        $this -> productPrice         = $productPrice;
        $this -> productQuantity      = $productQuantity;
        $this -> supplierId           = $supplierId;
        $this -> categoryId           = $categoryId;
        $this -> productCode          = $productCode;
    }

    //get/set properties
    public function getProductId() {
        return $this -> productId;
    }

    public function setProductId( $val ) {
        $this -> productId = $val;
    }

    public function getProductName() {
        return $this -> productName;
    }

    public function setProductName( $val ) {
        $this -> productName = $val;
    }

    public function getProductDescription() {
        return $this -> productDescription;
    }

    public function setProductDescription( $val ) {
        $this -> productDescription = $val;
    }

    public function getProductPrice() {
        return $this -> productPrice;
    }

    public function setProductPrice( $val ) {
        $this -> productPrice = $val;
    }

    public function getProductQuantity() {
        return $this -> productQuantity;
    }

    public function setProductQuantity( $val ) {
        $this -> productQuantity = $val;
    }

    public function getSupplierId() {
        return $this -> supplierId;
    }

    public function setSupplierId( $val ) {
        $this -> supplierId = $val;
    }

    public function getCategoryId() {
        return $this -> categoryId;
    }

    public function setCategoryId( $val ) {
        $this -> categoryId = $val;
    }

    public function getProductCode() {
        return $this -> productCode;
    }

    public function setProductCode( $val ) {
        $this -> productCode = $val;
    }
}
?>
<?php
//class to represent an entry in the categories table
class Category {
    //properties
    private $categoryId;
    private $categoryName;
    private $categoryCode;

    public function __construct( $categoryId, $categoryName, $categoryCode ) {
        $this -> categoryId   = $categoryId;
        $this -> categoryName = $categoryName;
        $this -> categoryCode = $categoryCode;
    }

    //get/set properties
    public function getCategoryId() {
        return $this -> categoryId;
    }

    public function setCategoryId( $val ) {
        $this -> categoryId = $val;
    }

    public function getCategoryName() {
        return $this -> categoryName;
    }

    public function setCategoryName( $val ) {
        $this -> categoryName = $val;
    }

    public function getCategoryCode() {
        return $this -> categoryCode;
    }

    public function setCategoryCode( $val ) {
        $this -> categoryCode = $val;
    }
}
?>
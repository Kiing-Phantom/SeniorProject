<?php
//class to represent an entry in the titles table
class Title {
    //properties
    private $titleId;
    private $titleName;
    private $titleCode;

    public function __construct( $titleId, $titleName, $titleCode ) {
        $this -> titleId   = $titleId;
        $this -> titleName = $titleName;
        $this -> titleCode = $titleCode;
    }

    //get/set properties
    public function getTitleId() {
        return $this -> titleId;
    }

    public function setTitleId( $val ) {
        $this -> titleId = $val;
    }

    public function getTitleName() {
        return $this -> titleName;
    }

    public function setTitleName( $val ) {
        $this -> titleName = $val;
    }

    public function getTitleCode() {
        return $this -> titleCode;
    }

    public function setTitleCode( $val ) {
        $this -> titleCode = $val;
    }
}
?>
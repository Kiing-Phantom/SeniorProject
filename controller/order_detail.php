<?php
//class to represent an entry in the order_details table
class OrderDetail {
    //properties
    private $orderDetailId;
    private $detailUnitPrice;
    private $detailQuantity;
    private $detailDiscount;
    private $detailTotal;
    private $productId;
    private $orderId;
    private $detailCode;

    public function __construct($orderDetailId, $detailUnitPrice, $detailQuantity,
                                $detailDiscount, $detailTotal, $productId, 
                                $orderId, $detailCode) {
        $this -> orderDetailId = $orderDetailId;
        $this -> detailUnitPrice = $detailUnitPrice;
        $this -> detailQuantity = $detailQuantity;
        $this -> detailDiscount = $detailDiscount;
        $this -> detailTotal = $detailTotal;
        $this -> productId = $productId;
        $this -> orderId = $orderId;
        $this -> detailCode = $detailCode;
    }

    //get/set properties
    public function getOrderDetailId() {
        return $this -> orderDetailId;
    }

    public function setOrderDetailId( $val ) {
        $this -> orderDetailId = $val;
    }

    public function getDetailUnitPrice() {
        return $this -> detailUnitPrice;
    }

    public function setDetailUnitPrice( $val ) {
        $this -> detailUnitPrice = $val;
    }

    public function getDetailQuantity() {
        return $this -> detailQuantity;
    }

    public function setDetailQuantity( $val ) {
        $this -> detailQuantity = $val;
    }

    public function getDetailDiscount() {
        return $this -> detailDiscount;
    }

    public function setDetailDiscount( $val ) {
        $this -> detailDiscount = $val;
    }

    public function getDetailTotal() {
        return $this -> detailTotal;
    }

    public function setDetailTotal( $val ) {
        $this -> detailTotal = $val;
    }

    public function getProductId() {
        return $this -> productId;
    }

    public function setProductId( $val ) {
        $this -> productId = $val;
    }

    public function getOrderId() {
        return $this -> orderId;
    }

    public function setOrderId( $val ) {
        $this -> orderId = $val;
    }
    public function getDetailCode() {
        return $this -> detailCode;
    }

    public function setDetailCode( $val ) {
        $this -> detailCode = $val;
    }
}
?>
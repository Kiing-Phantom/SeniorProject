<?php
include_once('order_detail.php');
include_once('../../model/order_details_db.php');

class OrderDetailController {

    public static function rowToOrderDetail( $row ) {
        $detail = new OrderDetail(
            $row[ 'Order_Detail_ID' ],
            $row[ 'Detail_Unit_Price' ],
            $row[ 'Detail_Quantity' ],
            $row[ 'Detail_Discount' ],
            $row[ 'Detail_Total' ],
            $row[ 'Product_ID' ],
            $row[ 'Order_ID' ],
            $row[ 'Order_Detail_Code' ]
        );

        $detail -> setOrderDetailId( $row[ 'Order_Detail_ID' ] );

        return $detail;
    }
    public static function getAllDetails() {
        $queryRes = OrderDetailsDB::getDetails();

        if ( $queryRes ) {
            //process results to array
            $details = array();
            foreach ( $queryRes as $row ) {
                $details[] = self::rowToOrderDetail( $row );
            }

            //return array
            return $details;
        } else {
            return false;
        }
    }

    public static function getDetailById( $order_detail_id ){
        $queryRes = OrderDetailsDB::getDetail( $order_detail_id );

        if ( $queryRes ) {
            $detail = self::rowToOrderDetail( $queryRes );

            return $detail;
        } else {
            return false;
        }
    }

    public static function searchDetails( $search ) {
        $queryRes = OrderDetailsDB::searchDetails( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function detailIdMax() {
        return OrderDetailsDB::getLastId();
    }

    public static function deleteDetail( $order_detail_id ) {
        return OrderDetailsDB::deleteDetail( $order_detail_id );
    }

    public static function addDetail( $detail ) {
        return OrderDetailsDB::addDetail(
            $detail -> getDetailUnitPrice(),
            $detail -> getDetailQuantity(),
            $detail -> getDetailDiscount(),
            $detail -> getDetailTotal(),
            $detail -> getProductId(),
            $detail -> getOrderId(),
            $detail -> getDetailCode()
        );
    }

    public static function updateDetail( $detail, $old_detail_id ) {
        return OrderDetailsDB::updateDetail(
            $detail -> getOrderDetailId(),
            $detail -> getDetailUnitPrice(),
            $detail -> getDetailQuantity(),
            $detail -> getDetailDiscount(),
            $detail -> getDetailTotal(),
            $detail -> getProductId(),
            $detail -> getOrderId(),
            $detail -> getDetailCode(),
            $old_detail_id
        );
    }
}
?>
<?php
include_once('order.php');
include_once('../../model/orders_db.php');

class OrderController {
    public static function rowToOrder($row) {
        $order = new Order(
            $row[ 'Order_ID' ],
            $row[ 'Order_Date' ],
            $row[ 'Order_Total' ],
            $row[ 'Customer_ID' ],
            $row[ 'Order_Code' ]
        );

        $order -> setOrderId ( $row[ 'Order_ID' ] );

        return $order;
    }

    public static function getAllOrders() {
        $queryRes = OrdersDB::getOrders();

        if ( $queryRes ) {
            //process results to array
            $orders = array();
            foreach ( $queryRes as $row ) {
                $orders[] = new Order($row[ 'Order_ID' ], $row[ 'Order_Date' ],
                                      $row[ 'Order_Total' ], $row[ 'Customer_ID' ],
                                      $row[ 'Order_Code' ]);
            }

            //return array
            return $orders;
        } else {
            return false;
        }
    }

    public static function searchOrders( $search ) {
        $queryRes = OrdersDB::searchOrders( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function orderIdMax() {
        return OrdersDB::getLastId();
    }

    public static function getOrderById( $order_id ) {
        $queryRes = OrdersDB::getOrder( $order_id );

        if ( $queryRes ) {
            $order = self::rowToOrder( $queryRes );
            
            return $order;
        } else {
            false;
        }
    }

    public static function deleteOrder( $order_id ) {
        return OrdersDB::deleteOrder( $order_id );
    }

    public static function addOrder( $order ) {
        return OrdersDB::addOrder(
            $order -> getOrderDate(),
            $order -> getOrderTotal(),
            $order -> getCustomerId(),
            $order -> getOrderCode()
        );
    }

    public static function updateOrder( $order ) {
        return OrdersDB::updateOrder(
            $order -> getOrderId(),
            $order -> getOrderDate(),
            $order -> getOrderTotal(),
            $order -> getCustomerId(),
            $order -> getOrderCode()
        );
    }

    public static function updatePrice( $order_id ) {
        OrdersDB::updatePrice( $order_id );
    }
}
?>
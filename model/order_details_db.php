<?php
require_once('database.php');

//class for doing all order_details table queries
class OrderDetailsDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all order details
    public static function getDetails() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM order_details ORDER BY Order_Detail_Code ASC";

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get a specific OrderDetail based on Order_Detail_ID
    public static function getDetail( $order_detail_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM order_details
                      WHERE Order_Detail_ID = '$order_detail_id'";

            //execute query
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Basic search of OrderDetails table
    public static function searchDetails( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM order_details a
                      JOIN products b
                        ON a.Product_ID = b.Product_ID
                      JOIN orders c
                        ON a.Order_ID = c.Order_ID
                      WHERE a.Detail_Unit_Price   like '%$search%'
                      OR    a.Detail_Quantity     like '%$search%'
                      OR    a.Detail_Discount     like '%$search%'
                      OR    a.Detail_Total        like '%$search%'
                      OR    a.Detail_Code         like '%$search%'
                      OR    b.Product_Name        like '%$search%'
                      OR    b.Product_Description like '%$search%'
                      OR    c.Order_ID            like '%$search%'
                      OR    c.Order_Total         like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Order_Detail_ID within the table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Order_Detail_ID) FROM order_details";

            //execute query
            $result = $dbConn -> query( $query );
            $intcvt = $result -> fetch_array();
            $int = intval($intcvt[0]);
            return $int;
        } else {
            false;
        }
    }
    /*******************
     * CRUD Operations *
     *******************/
    // Delete an OrderDetail based on Order_Detail_ID
    public static function deleteDetail( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM order_details
                      WHERE Order_Detail_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add an OrderDetail to the table
    // Updates Order_Total to reflect changes
    public static function addDetail(  $detail_unit_price, $detail_quantity,
                                       $detail_discount, $detail_total, $product_id,
                                       $order_id, $detail_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO order_details (Detail_Unit_Price, Detail_Quantity,
                                                 Detail_Discount, Detail_Total, Product_ID,
                                                 Order_ID, Order_Detail_Code)
                      VALUES('$detail_unit_price', '$detail_quantity',
                             '$detail_discount', '$detail_total', '$product_id',
                             '$order_id', '$detail_code')";
            $queryUpd = "UPDATE orders SET
                            Order_Total = 
                                (SELECT SUM(Detail_Total) 
                                     FROM order_details
                                 WHERE Order_ID = '$order_id')
                          WHERE Order_ID = '$order_id'";

            //execute query
            $dbConn -> query( $query );
            return $dbConn -> query( $queryUpd );
        } else {
            false;
        }
    }
    // Update a specific OrderDetail based on Order_Detail_ID
    // Updates Order_Total to reflect changes
    public static function updateDetail(  $order_detail_id, $detail_unit_price, $detail_quantity,
                                          $detail_discount, $detail_total, $product_id,
                                          $order_id, $detail_code, $old_order_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE order_details SET
                        Detail_Unit_Price   = '$detail_unit_price',
                        Detail_Quantity     = '$detail_quantity',
                        Detail_Discount     = '$detail_discount',
                        Detail_Total        = '$detail_total',
                        Product_ID          = '$product_id',
                        Order_ID            = '$order_id',
                        Order_Detail_Code   = '$detail_code'
                      WHERE Order_Detail_ID = '$order_detail_id'";
            $queryUpd = "UPDATE orders SET
                            Order_Total = 
                                (SELECT SUM(Detail_Total) 
                                     FROM order_details
                                 WHERE Order_ID = '$order_id')
                          WHERE Order_ID = '$order_id'";     
            $queryUpdOld = "UPDATE orders SET
                            Order_Total = 
                                (SELECT SUM(Detail_Total) 
                                     FROM order_details
                                 WHERE Order_ID = '$old_order_id')
                          WHERE Order_ID = '$old_order_id'";                   

            //execute query
            $dbConn -> query( $query );
            $dbConn -> query( $queryUpd );
            return $dbConn -> query( $queryUpdOld );
        } else {
            false;
        }
    }
}
?>
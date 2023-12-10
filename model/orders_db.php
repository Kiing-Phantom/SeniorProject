<?php
require_once('database.php');

//class for doing all orders table queries
class OrdersDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all orders
    public static function getOrders() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM orders';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Basic search of Orders table
    public static function searchOrders( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM orders a
                      JOIN customers b
                        ON a.Customer_ID = b.Customer_ID
                      WHERE a.Order_Date     like '%$search%'
                      OR    a.Order_Code     like '%$search%'
                      OR    b.First_Name     like '%$search%'
                      OR    b.Last_Name      like '%$search%'
                      OR    b.Phone          like '%$search%'
                      OR    b.Email          like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Order_ID used within the table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Order_ID) FROM orders";

            //execute query
            $result = $dbConn -> query( $query );
            $intcvt = $result -> fetch_array();
            $int = intval($intcvt[0]);
            return $int;
        } else {
            false;
        }
    }
    // Get a specific Order based on Order_ID
    public static function getOrder ( $order_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM orders
                      WHERE Order_ID = '$order_id'";

            //execute query
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    /*******************
     * CRUD Operations *
     *******************/
    // Delete an Order from the table
    public static function deleteOrder( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM orders
                      WHERE Order_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add an Order to the table
    public static function addOrder( $order_date, $order_total, $customer_id, $order_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO orders (Order_Date, Order_Total, 
                                          Customer_ID, Order_Code)
                      VALUES('$order_date', '$order_total', 
                             '$customer_id', '$order_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a specific Order from the table
    public static function updateOrder( $order_id, $order_date, $order_total, $customer_id, $order_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE orders SET
                        Order_Date   = '$order_date',
                        Order_Total  = '$order_total',
                        Customer_ID  = '$customer_id',
                        Order_Code   = '$order_code'
                      WHERE Order_ID = '$order_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update the price of the Order 
    // If not automatically update from Order_Detail
    // Or if Product Price changes
    public static function updatePrice ( $order_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE orders SET
                        Order_Total = (SELECT SUM(Detail_Total) 
                                        FROM order_details 
                                       WHERE Order_ID = '$order_id')
                      WHERE Order_ID = '$order_id'";

            //execute query
            return $dbConn -> query($query);
        } else {
            return false;
        }
    }
}
?>
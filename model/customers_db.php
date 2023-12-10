<?php
require_once('database.php');

//class for doing all customers table queries
class CustomersDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all customers
    public static function getCustomers() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM customers
                      ORDER BY Customer_Code ASC';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get a specific Customer by Customer_ID
    public static function getCustomer ( $id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM customers
                      WHERE Customer_ID = '$id'";

            //execute query
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Customer's name, both First_Name 
    // and Last_Name connected by a space
    public static function getCustomerName( $id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT First_Name, ' ', Last_Name FROM customers
                      WHERE Customer_ID = '$id'";

            //execute query, return false if not found
            $result = $dbConn -> query($query);
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Basic search of the Customer's table
    public static function searchCustomers( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM customers
                      WHERE First_Name like '%$search%'
                      OR    Last_Name  like '%$search%'
                      OR    Address    like '%$search%'
                      OR    Phone      like '%$search%'
                      OR    Email      like '%$search%'";
            //execute query
            return $dbConn -> query($query);
        }
    }
    // Search for last Customer_ID used.
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Customer_ID) FROM customers";

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
    // Delete a Customer from the table based on Customer_ID
    public static function deleteCustomer( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM customers
                      WHERE Customer_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add a Customer to the table
    public static function addCustomer( $customer_id, $first_name, $last_name, 
                                        $address, $phone, $email, $customer_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO customers (Customer_ID, First_Name, Last_Name,
                                             Address, Phone, Email, Customer_Code)
                      VALUES('$customer_id', '$first_name', '$last_name', 
                             '$address', '$phone', '$email', '$customer_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a Custoemr within the table based on Customer_ID
    public static function updateCustomer( $customer_id, $first_name, $last_name, 
                                           $address, $phone, $email, $customer_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE customers SET
                        First_Name      = '$first_name',
                        Last_Name       = '$last_name',
                        Address         = '$address',
                        Phone           = '$phone',
                        Email           = '$email',
                        Customer_Code   = '$customer_code'
                      WHERE Customer_ID = '$customer_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>
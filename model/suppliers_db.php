<?php
require_once('database.php');

//class for doing all suppliers table queries
class SuppliersDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all suppliers
    public static function getSuppliers() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM suppliers
                      ORDER BY Supplier_Code ASC';

            //execute query
            return $dbConn -> query($query);
        } else {
            return false;
        }
    }
    // Get a specific Supplier by Supplier_ID
    public static function getSupplier( $supplier_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM suppliers
                      WHERE Supplier_ID = '$supplier_id'";

            //execute query, return false if not found
            $result = $dbConn -> query($query);
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Supplier's name
    public static function getSupplierName( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Supplier_Name FROM suppliers
                      WHERE Supplier_ID = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            return false;
        }
    }
    // Basic search of Suppliers table
    public static function searchSuppliers( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM suppliers
                      WHERE Supplier_Name     like '%$search%'
                      OR    Supplier_Address  like '%$search%'
                      OR    Supplier_Phone    like '%$search%'
                      OR    Supplier_Fax      like '%$search%'
                      OR    Supplier_Email    like '%$search%'
                      OR    Supplier_Code     like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Supplier_ID within table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Supplier_ID) FROM suppliers";

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
    // Delete a Supplier from the table
    public static function deleteSupplier( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM suppliers
                      WHERE Supplier_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add a Supplier to the table
    public static function addSupplier( $supplier_name, $supplier_address, $supplier_phone, 
                                        $supplier_fax, $supplier_email, $supplier_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        $supplier_name_trim = preg_replace("/'/", '', $supplier_name);
        $supplier_address_trim = preg_replace("/'/", '', $supplier_address);
        $supplier_phone_trim = preg_replace("/'/", '', $supplier_phone);
        $supplier_fax_trim = preg_replace("/'/", '', $supplier_fax);
        $supplier_email_trim = preg_replace("/'/", '', $supplier_email);
        $supplier_code_trim = preg_replace("/'/", '', $supplier_code);

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO suppliers (Supplier_Name, Supplier_Address, Supplier_Phone, 
                                             Supplier_Fax, Supplier_Email, Supplier_Code)
                      VALUES('$supplier_name_trim', '$supplier_address_trim', '$supplier_phone_trim', 
                             '$supplier_fax_trim', '$supplier_email_trim', '$supplier_code_trim')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a specific Supplier
    public static function updateSupplier( $supplier_id, $supplier_name, $supplier_address, 
                                           $supplier_phone, $supplier_fax, $supplier_email, $supplier_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE suppliers SET
                        Supplier_Name       = '$supplier_name',
                        Supplier_Address    = '$supplier_address',
                        Supplier_Phone      = '$supplier_phone',
                        Supplier_Fax        = '$supplier_fax',
                        Supplier_Email      = '$supplier_email',
                        Supplier_Code       = '$supplier_code'
                      WHERE Supplier_ID     = '$supplier_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>
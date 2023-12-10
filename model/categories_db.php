<?php
require_once('database.php');

//class for doing all categories table queries
class CategoriesDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all Categories
    public static function getCategories() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM categories 
                      ORDER BY Category_Code ASC';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get an individual category from the Category_ID
    public static function getCategory( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM categories
                      WHERE Category_ID = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Category's Category_Name variable
    public static function getCategoryName( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Category_Name FROM categories
                      WHERE Category_Code = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            return false;
        }
    }
    // Get a specific Category's Category_Code variable
    public static function getCategoryCode( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Category_Code FROM categories
                      WHERE Category_ID = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            return false;
        }
    }
    // Search through Categories based on name, code or ID
    public static function searchCategories( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM categories
                      WHERE Category_Name like '%$search%'
                      OR    Category_Code like '%$search%'
                      OR    Category_ID   like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Category_ID within the table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Category_ID) FROM categories";

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
    // Delete a Category based on Category_ID
    public static function deleteCategory( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM categories
                      WHERE Category_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add a Category with parameters Category_ID, Category_Name, Category_Code
    public static function addCategory( $category_id, $category_name, $category_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO categories (Category_ID, Category_Name, Category_Code)
                      VALUES('$category_id', '$category_name', '$category_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a Category with parameters Category_Name, Category_Code based on Category_ID
    public static function updateCategory( $category_id, $category_name, $category_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE categories SET
                        Category_Name = '$category_name',
                        Category_Code = '$category_code'
                      WHERE Category_ID = '$category_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>

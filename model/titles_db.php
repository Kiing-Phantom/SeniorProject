<?php
require_once('database.php');

//class for doing all titles table queries
class TitlesDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all titles
    public static function getTitles() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM titles
                      ORDER BY Title_Code ASC';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get a specific Title by Title_ID
    public static function getTitle( $id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM titles
                      WHERE Title_ID = '$id'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Title's name
    public static function getTitleName( $id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Title_Name FROM titles
                      WHERE Title_ID = '$id'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_array()[0];
        } else {
            return false;
        }
    }
    // Basic search of Titles table
    public static function searchTitles( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM titles
                      WHERE Title_Name like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Title_ID within table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Title_ID) FROM titles";

            //execute query
            $result = $dbConn -> query( $query );
            $intcvt = $result -> fetch_array();
            $int = intval( $intcvt[0] );
            return $int;
        } else {
            false;
        }
    }
    /*******************
     * CRUD Operations *
     *******************/
    // Delete a Title from the table
    public static function deleteTitle( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM titles
                      WHERE Title_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add a Title to the table
    public static function addTitle( $title_name, $title_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO titles (Title_Name, Title_Code)
                      VALUES('$title_name', '$title_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a specific Title in the table
    public static function updateTitle( $title_id, $title_name, $title_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE titles SET
                        Title_Name = '$title_name',
                        Title_Code = '$title_code'
                      WHERE Title_ID = '$title_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>
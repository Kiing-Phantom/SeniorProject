<?php
require_once('database.php');

//class for doing all categories table queries
class CategoriesDB {
    //get all categories
    public static function getAllCategories() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM categories';

            //execute query
            return $dbConn -> query($query);
        } else {
            return false;
        }
    }
}
?>

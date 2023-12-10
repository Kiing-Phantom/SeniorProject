<?php
require_once('database.php');

//class for doing all employees table queries
class EmployeesDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all employees
    public static function getEmployees() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM employees 
                      ORDER BY Employee_Code ASC';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get a specific Employee by Username
    public static function getEmployeeByUsername( $username ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM employees
                      WHERE employees.Username = '$username'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Employee by Employee_ID
    public static function getEmployee( $id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM employees
                      INNER JOIN titles
                        ON employees.Title_ID = titles.Title_ID
                      WHERE Employee_ID = '$id'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Basic search of Employees table
    public static function searchEmployees( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM employees a
                      INNER JOIN titles b
                        ON b.Title_ID = a.Title_ID
                      WHERE a.First_Name    like '%$search%'
                      OR    a.Last_Name     like '%$search%'
                      OR    a.Address       like '%$search%'
                      OR    a.Phone         like '%$search%'
                      OR    a.Email         like '%$search%'
                      OR    a.Username      like '%$search%'
                      OR    a.Employee_Code like '%$search%'
                      OR    b.Title_Name    like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get the last Employee_ID within the table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Employee_ID) FROM employees";

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
    // Delete a specific Employee based on Employee_ID
    public static function deleteEmployee( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM employees
                      WHERE Employee_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add an Employee to the table
    public static function addEmployee( $first_name, $last_name, $address, 
                                        $phone, $email, $username, 
                                        $password, $title_id, $employee_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO employees (First_Name, Last_Name,
                                             Address, Phone, Email,
                                             Username, Password, Title_ID,
                                             Employee_Code)
                      VALUES('$first_name', '$last_name', '$address', 
                             '$phone', '$email', '$username', 
                             '$password', '$title_id', '$employee_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a specific Employee within the table based on Employee_ID
    public static function updateEmployee( $employee_id, $first_name, $last_name, 
                                           $address, $phone, $email, $username, 
                                           $password, $title_id, $employee_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE employees SET
                        First_Name      = '$first_name',
                        Last_Name       = '$last_name',
                        Address         = '$address',
                        Phone           = '$phone',
                        Email           = '$email',
                        Username        = '$username',
                        Password        = '$password',
                        Title_ID        = '$title_id',
                        Employee_Code   = '$employee_code'
                      WHERE Employee_ID = '$employee_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>
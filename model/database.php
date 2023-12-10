<?php
class Database {
    //DB conn paramaters
    private $hostname = 'localhost';
    private $dbname = 'cis480_project';
    private $user = 'root';
    private $password = '';

    //DB conn & error message
    private $conn;
    private $conn_error = '';

    //constructor to connect to DB or set error message
    function __construct() {
        //turn error reporting off
        mysqli_report(MYSQLI_REPORT_OFF);

        //connect to DB
        $this -> conn = mysqli_connect(
            $this -> hostname,
            $this -> user,
            $this -> password,
            $this -> dbname
        );

        //if connection fails, set error message
        if ( $this -> conn ===false ) {
            $this -> conn_error = "Failed to connect to Database: \n" .
                                  mysqli_connect_error();
        }
    }

    function __destruct() {
        mysqli_close($this -> conn);
    }

    function getDbConn() {
        return $this -> conn;
    }

    function getDbError() {
        return $this -> conn_error;
    }

    //get DB paramaters
    function getDbHost() {
        return $this -> hostname;
    }

    function getDbName() {
        return $this -> dbname;
    }

    function getDbUser() {
        return $this -> user;
    }

    function getDbUserPassword() {
        return $this -> password;
    }
}
?>
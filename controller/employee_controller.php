<?php
include_once('employee.php');
include_once('C:\xampp\htdocs\CIS480_Project\model\employees_db.php');
include_once('title.php');
include_once('C:\xampp\htdocs\CIS480_Project\util\input.php');

class EmployeeController {
    //helper function to convert DB row
    //to Employee object
    public static function rowToEmployee( $row ) {
        $emp = new Employee(
            $row[ 'Employee_ID' ],
            $row[ 'First_Name' ],
            $row[ 'Last_Name' ],
            $row[ 'Address' ],
            $row[ 'Phone' ],
            $row[ 'Email' ],
            $row[ 'Username' ],
            $row[ 'Password' ],
            $row[ 'Title_ID' ],
            $row[ 'Employee_Code' ]
        );

        $emp -> setEmployeeId( $row[ 'Employee_ID'] );

        return $emp;
    }

    //function to check login
    public static function validateEmployee( $username, $password ) {
        $queryRes = EmployeesDB::getEmployeeByUsername( $username );

        if ( $queryRes ) {
            //process employee
            $emp = self::rowToEmployee( $queryRes );
            $passCorrect = Input::passVerify( $password );
            if ( $passCorrect ) {
                return $emp -> getTitleId();
            } else {
                //can't connect or validate employee
                return false;
            }
        }
    }

    //get all employees
    public static function getAllEmployees() {
        $queryRes = EmployeesDB::getEmployees();

        if ( $queryRes ) {
            //process results to array
            $emps = array();
            foreach( $queryRes as $row ) {
                $emps[] = self::rowToEmployee( $row );
            }

            return $emps;
        } else {
            return false;
        }
    }

    public static function getEmployeeById( $id ) {
        $queryRes = EmployeesDB::getEmployee( $id );

        if ( $queryRes ) {
            $employee = self::rowToEmployee( $queryRes );
            
            return $employee;
        } else {
            false;
        }
    }

    public static function searchEmployees( $search ) {
        $queryRes = EmployeesDB::searchEmployees( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function deleteEmployee( $employee_id ) {
        return EmployeesDB::deleteEmployee( $employee_id );
    }

    public static function addEmployee( $employee ) {
        return EmployeesDB::addEmployee(
            $employee -> getFirstName(),
            $employee -> getLastName(),
            $employee -> getAddress(),
            $employee -> getPhone(),
            $employee -> getEmail(),
            $employee -> getUsername(),
            $employee -> getPassword(),
            $employee -> getTitleId(),
            $employee -> getEmployeeCode()
        );
    }

    public static function updateEmployee( $employee ) {
        return EmployeesDB::updateEmployee(
            $employee -> getEmployeeId(),
            $employee -> getFirstName(),
            $employee -> getLastName(),
            $employee -> getAddress(),
            $employee -> getPhone(),
            $employee -> getEmail(),
            $employee -> getUsername(),
            $employee -> getPassword(),
            $employee -> getTitleId(),
            $employee -> getEmployeeCode()
        );
    }

    public static function employeeIdMax() {
        return EmployeesDB::getLastId();
    }
}
?>
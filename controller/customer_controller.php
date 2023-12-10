<?php
include_once('customer.php');
include_once('../../model/customers_db.php');

class CustomerController {
    //helper function to convert DB row
    //to Customer object
    public static function rowToCustomer( $row ) {
        $cust = new Customer(
            $row[ 'Customer_ID' ],
            $row[ 'First_Name' ],
            $row[ 'Last_Name' ],
            $row[ 'Address' ],
            $row[ 'Phone' ],
            $row[ 'Email' ],
            $row[ 'Customer_Code' ]
        );

        $cust -> setCustomerId( $row[ 'Customer_ID' ] );

        return $cust;
    }
    

    public static function getAllCustomers() {
        $queryRes = CustomersDB::getCustomers();

        if ( $queryRes ) {
            //process results to array
            $customers = array();
            foreach ( $queryRes as $row ) {
                $customers[] = self::rowToCustomer( $row );
            }

            //return array
            return $customers;
        } else {
            return false;
        }
    }

    public static function getCustomerById ( $customerID ) {
        $queryRes = CustomersDB::getCustomer( $customerID );

        if ( $queryRes ) {
            $customer = self::rowToCustomer( $queryRes );

            return $customer;
        } else {
            false;
        }
    }

    public static function searchCustomers( $search ) {
        $queryRes = CustomersDB::searchCustomers( $search );
        
        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function getCustomerName( $id ) {
        $queryRes = CustomersDB::getCustomerName( $id );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function deleteCustomer( $customer_id ) {
        return CustomersDB::deleteCustomer( $customer_id );
    }

    public static function addCustomer( $customer ) {
        return CustomersDB::addCustomer(
            $customer -> getCustomerId(),
            $customer -> getFirstName(),
            $customer -> getLastName(),
            $customer -> getAddress(),
            $customer -> getPhone(),
            $customer -> getEmail(),
            $customer -> getCustomerCode()
        );
    }

    public static function updateCustomer( $customer ) {
        return CustomersDB::updateCustomer(
            $customer -> getCustomerId(),
            $customer -> getFirstName(),
            $customer -> getLastName(),
            $customer -> getAddress(),
            $customer -> getPhone(),
            $customer -> getEmail(),
            $customer -> getCustomerCode()
        );
    }

    public static function customerIdMax() {
        return CustomersDB::getLastId();
    }
}
?>
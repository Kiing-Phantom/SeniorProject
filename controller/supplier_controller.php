<?php
include_once('supplier.php');
include_once('../../model/suppliers_db.php');

class SupplierController {
    public static function rowToSupplier( $row ) {
        $sup = new Supplier(
            $row[ 'Supplier_ID' ],
            $row[ 'Supplier_Name' ],
            $row[ 'Supplier_Address' ],
            $row[ 'Supplier_Phone' ],
            $row[ 'Supplier_Fax' ],
            $row[ 'Supplier_Email' ],
            $row[ 'Supplier_Code' ]
        );

        $sup -> setSupplierId( $row[ 'Supplier_ID' ] );

        return $sup;
    }
    public static function getAllSuppliers() {
        $queryRes = SuppliersDB::getSuppliers();

        if ( $queryRes ) {
            //process results to array
            $suppliers = array();
            foreach ( $queryRes as $row ) {
                $suppliers[] = self::rowToSupplier( $row );
            }

            //return array
            return $suppliers;
        } else {
            return false;
        }
    }

    public static function getSupplierById( $supplier_id ) {
        $queryRes = SuppliersDB::getSupplier( $supplier_id );

        if ( $queryRes ) {
            return self::rowToSupplier( $queryRes );
        } else {
            return false;
        }
    }

    public static function searchSuppliers( $search ) {
        $queryRes = SuppliersDB::searchSuppliers( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function supplierName( $search ) {
        $queryRes = SuppliersDB::getSupplierName( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function supplierIdMax() {
        return SuppliersDB::getLastId();
    }

    public static function deleteSupplier( $supplier_id ) {
        return SuppliersDB::deleteSupplier( $supplier_id );
    }

    public static function addSupplier( $supplier ) {
        return SuppliersDB::addSupplier(
            $supplier -> getSupplierName(),
            $supplier -> getSupplierAddress(),
            $supplier -> getSupplierPhone(),
            $supplier -> getSupplierFax(),
            $supplier -> getSupplierEmail(),
            $supplier -> getSupplierCode()
        );
    }

    public static function updateSupplier( $supplier ) {
        return SuppliersDB::updateSupplier(
            $supplier -> getSupplierId(),
            $supplier -> getSupplierName(),
            $supplier -> getSupplierAddress(),
            $supplier -> getSupplierPhone(),
            $supplier -> getSupplierFax(),
            $supplier -> getSupplierEmail(),
            $supplier -> getSupplierCode()
        );
    }
}
?>
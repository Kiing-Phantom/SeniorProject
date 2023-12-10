<?php
require_once('database.php');

//class for doing all products table queries
class ProductsDB {
    /******************************
     * Basic Search Functionality *
     ******************************/
    // Get all products
    public static function getProducts() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = 'SELECT * FROM products
                      ORDER BY Product_Code ASC';

            //execute query
            return $dbConn -> query( $query );
        } else {
            return false;
        }
    }
    // Get a specific Product by Product_ID
    public static function getProductById( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM products
                      WHERE Product_ID = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Product by Product_Code
    public static function getProductByCode( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM products
                      WHERE Product_Code = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_assoc();
        } else {
            return false;
        }
    }
    // Get a specific Product's name
    public static function getProductName( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Product_Name FROM products
                      WHERE Product_Code = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            return false;
        }
    }
    // Get a specifc Product's name based on Product_ID
    public static function getProductNameById( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Product_Name FROM products
                      WHERE Product_ID = '$search'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            return false;
        }
    }
    // Basic search of Products table
    public static function searchProducts( $search ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT * FROM products a
                      JOIN suppliers b
                        ON a.Supplier_ID = b.Supplier_ID
                      JOIN categories c
                        ON a.Category_ID = c.Category_ID
                      WHERE a.Product_Name          like '%$search%'
                      OR    a.Product_Description   like '%$search%'
                      OR    a.Product_Code          like '%$search%'
                      OR    b.Supplier_Name         like '%$search%'
                      OR    b.Supplier_Email        like '%$search%'
                      OR    c.Category_Name         like '%$search%'
                      OR    c.Category_ID           like '%$search%'";
            //execute query
            return $dbConn -> query( $query );
        }
    }
    // Get a specific Product's Quantity
    public static function getProductQuantity( $product_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            $query = "SELECT Product_Quantity FROM products 
                      WHERE Product_ID = '$product_id'";

            //execute query, return false if not found
            $result = $dbConn -> query( $query );
            return $result -> fetch_column();
        } else {
            false;
        }
    }
    // Get the last Product_ID within table
    public static function getLastId() {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT MAX(Product_ID) FROM products";

            //execute query
            $result = $dbConn -> query( $query );
            $intcvt = $result -> fetch_array();
            $int = intval($intcvt[0]);
            return $int;
        } else {
            false;
        }
    }
    // Get a specific Product's Price
    public static function getPrice( $product_id ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "SELECT Product_Price FROM products
                      WHERE Product_ID = '$product_id'";

            //execute query
            $result = $dbConn -> query( $query );
            $intcvt = $result -> fetch_array();
            $int = floatval($intcvt[0]);
            return $int;
        } else {
            false;
        }
    }
    /*******************
     * CRUD Operations *
     *******************/
    // Delete a Product from the table
    public static function deleteProduct( $delete ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "DELETE FROM products
                      WHERE Product_ID = '$delete'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Add a Product to the table
    public static function addProduct( $product_name, $product_description,
                                        $product_price, $product_quantity, $supplier_id,
                                        $category_id, $product_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "INSERT INTO products (Product_Name, Product_Description,
                                            Product_Price, Product_Quantity, Supplier_ID,
                                            Category_ID, Product_Code)
                      VALUES('$product_name', '$product_description',
                             '$product_price', '$product_quantity', '$supplier_id',
                             '$category_id', '$product_code')";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Update a specific Product within the table
    public static function updateProduct( $product_id, $product_name, $product_description,
                                           $product_price, $product_quantity, $supplier_id,
                                           $category_id, $product_code ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create queries
            $query = "UPDATE products SET
                        Product_Name           = '$product_name',
                        Product_Description    = '$product_description',
                        Product_Price          = '$product_price',
                        Product_Quantity       = '$product_quantity',
                        Supplier_ID            = '$supplier_id',
                        Category_ID            = '$category_id',
                        Product_Code           = '$product_code'
                      WHERE Product_ID = '$product_id'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Inbound - Add quantity to Product
    public static function addQuantityInbound( $product_code, $add_qty ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE products 
                        SET Product_Quantity = Product_Quantity + '$add_qty'
                      WHERE Product_Code = '$product_code'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
    // Outbound - Remove quantity from Product
    public static function removeQuantityOutbound( $product_code, $remove_qty ) {
        //get DB conn
        $db = new Database();
        $dbConn = $db -> getDbConn();

        if ( $dbConn ) {
            //create query
            $query = "UPDATE products 
                        SET Product_Quantity = Product_Quantity - '$remove_qty'
                      WHERE Product_Code = '$product_code'";

            //execute query
            return $dbConn -> query( $query );
        } else {
            false;
        }
    }
}
?>
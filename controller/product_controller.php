<?php
include_once('product.php');
include_once('../../model/products_db.php');

class ProductController {
    public static function rowToProduct( $row ) {
        $prod = new Product (
            $row[ 'Product_ID' ],
            $row[ 'Product_Name' ],
            $row[ 'Product_Description' ],
            $row[ 'Product_Price' ],
            $row[ 'Product_Quantity' ],
            $row[ 'Supplier_ID' ],
            $row[ 'Category_ID' ],
            $row[ 'Product_Code' ]
        );

        $prod -> setProductId( $row[ 'Product_ID' ] );

        return $prod;
    }
    public static function getAllProducts() {
        $queryRes = ProductsDB::getProducts();

        if ( $queryRes ) {
            //process results to array
            $products = array();
            foreach ( $queryRes as $row ) {
                $products[] = self::rowToProduct( $row );
            }

            //return array
            return $products;
        } else {
            return false;
        }
    }

    public static function getProductById( $product_id ) {
        $queryRes = ProductsDB::getProductById( $product_id );

        if ( $queryRes ) {
            $product = self::rowToProduct( $queryRes );

            return $product;
        } else {
            return false;
        }
    }

    public static function getProductByCode( $product_code ) {
        $queryRes = ProductsDB::getProductByCode( $product_code );

        if ( $queryRes ) {
            $product = self::rowToProduct( $queryRes );

            return $product;
        } else {
            return false;
        }
    }

    public static function productName( $search ) {
        $queryRes = ProductsDB::getProductName( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }
    public static function productNameById( $search ) {
        $queryRes = ProductsDB::getProductNameById( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function productQuantity( $search ) {
        $queryRes = ProductsDB::getProductQuantity( $search );
        
        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function searchProducts( $search ) {
        $queryRes = ProductsDB::searchProducts( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function addQuantity( $product_id, $qty ) {
        $queryRes = ProductsDB::addQuantityInbound( $product_id, $qty );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function removeQuantity( $product_id, $qty ) {
        $queryRes = ProductsDB::removeQuantityOutbound( $product_id, $qty );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function productIdMax() {
        return ProductsDB::getLastId();
    }

    public static function productPrice( $product_id ) {
        return ProductsDB::getPrice( $product_id );
    }

    public static function deleteProduct( $product_id ) {
        return ProductsDB::deleteProduct( $product_id );
    }

    public static function addProduct( $product ) {
        return ProductsDB::addProduct(
            $product -> getProductName(),
            $product -> getProductDescription(),
            $product -> getProductPrice(),
            $product -> getProductQuantity(),
            $product -> getSupplierId(),
            $product -> getCategoryId(),
            $product -> getProductCode()
        );
    }

    public static function updateProduct( $product ) {
        return ProductsDB::updateProduct(
            $product -> getProductId(),
            $product -> getProductName(),
            $product -> getProductDescription(),
            $product -> getProductPrice(),
            $product -> getProductQuantity(),
            $product -> getSupplierId(),
            $product -> getCategoryId(),
            $product -> getProductCode()
        );
    }
}
?>
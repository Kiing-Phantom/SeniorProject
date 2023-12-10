<?php
include_once('category.php');
include_once('../../model/categories_db.php');

class CategoryController {
    //helper function to convert DB row
    //to Category object
    public static function rowToCategory( $row ) {
        $cat = new Category(
            $row[ 'Category_ID' ],
            $row[ 'Category_Name' ],
            $row[ 'Category_Code' ]
        );

        $cat -> setCategoryId( $row[ 'Category_ID' ] );

        return $cat;
    }
    public static function getAllCategories() {
        $queryRes = CategoriesDB::getCategories();

        if ( $queryRes ) {
            //process results to array
            $categories = array();
            foreach ( $queryRes as $row ) {
                $categories[] = self::rowToCategory( $row );
            }

            //return array
            return $categories;
        } else {
            return false;
        }
    }

    public static function getCategoryById( $category_id ){
        $queryRes = CategoriesDB::getCategory( $category_id );

        if ( $queryRes ) {
            $category = self::rowToCategory( $queryRes );

            return $category;
        } else {
            return false;
        }
    }

    public static function searchCategories( $search ) {
        $queryRes = CategoriesDB::searchCategories( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function categoryName( $search ) {
        $queryRes = CategoriesDB::getCategoryName( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function categoryCode( $search ) {
        $queryRes = CategoriesDB::getCategoryCode( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function deleteCategory( $category_id ) {
        return CategoriesDB::deleteCategory( $category_id );
    }

    public static function categoryIdMax() {
        return CategoriesDB::getLastId();
    }

    public static function addCategory( $category ) {
        return CategoriesDB::addCategory(
            $category -> getCategoryId(),
            $category -> getCategoryName(),
            $category -> getCategoryCode()
        );
    }

    public static function updateCategory( $category ) {
        return CategoriesDB::updateCategory(
            $category -> getCategoryId(),
            $category -> getCategoryName(),
            $category -> getCategoryCode()
        );
    }
}
?>

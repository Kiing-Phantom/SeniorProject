<?php
include_once('title.php');
include_once('../../model/titles_db.php');

class TitleController {
    public static function rowToTitle( $row ) {
        $title = new Title(
            $row[ 'Title_ID' ],
            $row[ 'Title_Name' ],
            $row[ 'Title_Code' ]
        );

        $title -> setTitleId( $row[ 'Title_ID' ] );

        return $title;
    }
    public static function getAllTitles() {
        $queryRes = TitlesDB::getTitles();

        if ( $queryRes ) {
            //process results to array
            $titles = array();
            foreach ( $queryRes as $row ) {
                $titles[] = self::rowToTitle( $row );
            }

            //return array
            return $titles;
        } else {
            return false;
        }
    }

    public static function getTitleName( $id ) {
        $queryRes = TitlesDB::getTitleName( $id );

        if ( $queryRes ) {
            return $queryRes;
        }
    }

    public static function getTitleById( $title_id ){
        $queryRes = TitlesDB::getTitle( $title_id );

        if ( $queryRes ) {
            return self::rowToTitle( $queryRes );
        } else {
            return false;
        }
    }

    public static function searchTitles( $search ) {
        $queryRes = TitlesDB::searchTitles( $search );

        if ( $queryRes ) {
            return $queryRes;
        } else {
            return false;
        }
    }

    public static function deleteTitle( $title_id ) {
        return TitlesDB::deleteTitle( $title_id );
    }

    public static function addTitle( $title ) {
        return TitlesDB::addTitle(
            $title -> getTitleName(),
            $title -> getTitleCode()
        );
    }

    public static function updateTitle( $title ) {
        return TitlesDB::updateTitle(
            $title -> getTitleId(),
            $title -> getTitleName(),
            $title -> getTitleCode()
        );
    }

    public static function titleIdMax() {
        return TitlesDB::getLastId();
    }
}
?>
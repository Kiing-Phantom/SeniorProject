<?php 
class  Input {
	static $errors = true;

	public static function int( $val ) {
		$val = filter_var( $val, FILTER_VALIDATE_INT );
		if ($val === false) {
			self::throwError( 'Invalid Integer', 901 );
		}
		return $val;
	}
	public static function flt( $val ) {
		$val = filter_var( $val, FILTER_VALIDATE_FLOAT );
		if ($val === false) {
			self::throwError( 'Invalid Float Value', 901 );
		}
		return $val;
	}

	public static function str( $val ) {
		if ( !is_string( $val ) ) {
			self::throwError( 'Invalid String', 902 );
		}
		$val = trim(htmlspecialchars( $val ));
		return $val;
	}

	public static function bool( $val ) {
		$val = filter_var( $val, FILTER_VALIDATE_BOOLEAN );
		return $val;
	}

	public static function email( $val ) {
		$val = filter_var( $val, FILTER_VALIDATE_EMAIL );
		if ( $val === false ) {
			self::throwError( 'Invalid Email', 903 );
		}
		return $val;
	}

    public static function hashPass( $val ) {
        if ( !is_string( $val ) ) {
            self::throwError( 'Invalid Password', 904 );
        } else {
            $hash = password_hash( $val, PASSWORD_BCRYPT );
        }
        return $hash;
    }

    public static function passVerify( $val ) {
        if( !is_string( $val ) ) {
            self::throwError( 'Password is not an accepted string.', 905 );
        } else {
            if ( $verify = password_verify( $val, password_hash( $val, PASSWORD_BCRYPT ) ) ) {
                return $verify;
            }
        }
    }

	public static function throwError( $error = 'Error In Processing', $errorCode = 0 ) {
		if ( self::$errors === true ) {
            return $error . $errorCode;
		}
	}
}
?>

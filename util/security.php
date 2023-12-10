<?php
class Security {
    //function to check if user is authorized for the page
    public static function checkAuth( $auth ) {
        if ( !isset( $_SESSION[ $auth ]) || !$_SESSION[ $auth ] ) {
            //set logout messge and return to login page
            header( "Location: ../../index.php" );
            exit();
        }
    }

    //function to facilitate clean-up for logging out
    public static function logout() {
        $_SESSION[ 'admin' ] = false; 
        $_SESSION[ 'lead' ] = false; 
        $_SESSION[ 'inbound' ] = false; 
        $_SESSION[ 'outbound' ] = false;
        $_SESSION[ 'logout_msg' ] = '';  //clear all session variables - hardset instead of session_destroy to ensure deletion

        unset($_POST); //clear post info to prevent back button and potential security breaches

        //set logout messge and return to login page
        $_SESSION[ 'logout_msg' ] = 'Successfully logged out!';
        header( 'Location: ../../index.php' );
        exit();
    }
}
?>
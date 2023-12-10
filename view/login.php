<?php
session_start();
require_once('../controller/employee.php');
require_once('../controller/employee_controller.php');
require_once('../util/security.php');

if ( isset( $_POST[ 'user' ] ) & isset( $_POST[ 'pw' ] ) ) {
    //login and password fields were set
    $title_id = EmployeeController::validateEmployee( $_POST[ 'user' ], $_POST[ 'pw' ] );

    if ( $title_id === '1' || $title_id === '2' || $title_id === '3' || $title_id === '4') {
        $_SESSION['admin'] = true;
        $_SESSION['lead'] = false;
        $_SESSION['inbound'] = false;
        $_SESSION['outbound'] = false;
        header("Location: admin/admin.php");
    } else if ( $title_id === '5') {
        $_SESSION['admin'] = false;
        $_SESSION['lead'] = true;
        $_SESSION['inbound'] = false;
        $_SESSION['outbound'] = false;
        header("Location: lead/lead.php");
    } else if ( $title_id === '6' ) {
        $_SESSION['admin'] = false;
        $_SESSION['lead'] = false;
        $_SESSION['inbound'] = true;
        $_SESSION['outbound'] = false;
        header("Location: inbound/inbound.php");
    } else if ( $title_id === '7' ) {
        $_SESSION['admin'] = false;
        $_SESSION['lead'] = false;
        $_SESSION['inbound'] = false;
        $_SESSION['outbound'] = true;
        header("Location: outbound/outbound.php");
    } else {
        $login_msg = 'Failed Authentication - try again.';
    }
}
?>

<hmtl>
    <head>
        <title>Richard Pack - CIS480 - Capstone Project</title>
        <link rel="stylesheet" href="/styles/dropdown.css">
        <link rel="stylesheet" href="/styles/navbar.css">
        <link rel="stylesheet" href="/styles/input.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>

        <!-- Navbar Setup -->

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">WarehouseManagementSystems</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Actual Body -->

        <h1>Login</h1>
        <form method='POST'>
            <h3>Username: <input type="text" name="user"></h3>
            <h3>Password: <input type="password" name="pw"></h3>
            <input type="submit" value="Login" name="login">
        </form>
    </body>
</html>
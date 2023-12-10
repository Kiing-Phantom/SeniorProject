<?php
session_start();
require_once('controller/employee.php');
require_once('controller/employee_controller.php');
require_once('util/security.php');
?>

<hmtl>
    <head>
        <title>Richard Pack - CIS480 - Capstone Project</title>
        <link rel="stylesheet" href="/styles/dropdown.css">
        <link rel="stylesheet" href="/styles/navbar.css">
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
                    <a class="navbar-brand" href="index.php">WarehouseManagementSystems</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="view/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Actual Body -->

        <h1 style="text-align:center" >
            <span >
                Welcome to the WarehouseManagementSystems Home Page!
            </span>
        </h1>

        <p style="text-align:center" >
            From here, we can custom make your new web site application to fit your warehouse's needs.
        </p>
        <p style="text-align:center" >
            Please click 'Login' and enter the preview username and password combinations to begin your virtual tour.
        </p>
    </body>
</html>
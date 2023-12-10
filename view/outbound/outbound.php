<?php
session_start();
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('outbound');
?>

<hmtl>
    <head>
        <link rel="stylesheet" href="../../styles/dropdown.css">
        <link rel="stylesheet" href="../../styles/navbar.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../outbound/outbound.php">Outbound Home Page</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li>
                    <div class="dropdown">
                        <button class="dropbtn">Order Information</button>
                        <div class="dropdown-content">
                            <a href="../outbound/display_orders.php">Orders</a>
                            <a href="../outbound/display_order_details.php">Order Details</a>
                                <a href="../outbound/remove_product_quantity.php">Remove Product from Inventory</a>
                        </div>
                    </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </div>
            </div>
        </nav>
        
        <!-- Actual Body -->

        <h2 style="text-align:center" >Outbound Home Page</h2>
    </body>
</hmtl>
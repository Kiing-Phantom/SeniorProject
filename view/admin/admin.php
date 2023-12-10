<?php
session_start();
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);
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

        <!-- Navbar Setup -->

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../admin/admin.php">Admin Home Page</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><div class="dropdown">
                            <button class="dropbtn">Order Information</button>
                            <div class="dropdown-content">
                                <a href="../admin/display_orders.php">Orders</a>
                                <a href="../admin/display_order_details.php">Order Details</a>
                                <a href="../admin/display_customers.php">Customers</a>
                            </div>
                        </div></li>
                        <li><div class="dropdown">
                            <button class="dropbtn">Product Information</button>
                            <div class="dropdown-content">
                                <a href="../admin/display_products.php">Products</a>
                                <a href="../admin/display_suppliers.php">Suppliers</a>
                                <a href="../admin/display_categories.php">Categories</a>
                            </div>
                        </div></li>
                        <li><div class="dropdown">
                            <button class="dropbtn">Personnel Information</button>
                            <div class="dropdown-content">
                                <a href="../admin/display_employees.php">Employees</a>
                                <a></a>
                                <a></a>
                                <a></a>
                                <a></a>
                                <a href="../admin/display_titles.php">Titles</a>
                            </div>
                        </div></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Actual Body -->

        <h2 style="text-align:center" >Admin Home Page</h2>
    </body>
</hmtl>
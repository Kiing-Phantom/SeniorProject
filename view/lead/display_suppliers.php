<?php
session_start();
require_once('../../controller/supplier.php');
require_once('../../controller/supplier_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('lead');
//uncomment this line to check session variables
//var_dump($_SESSION);

//user clicked the logout button
if ( isset( $_POST['back'] ) ) {
    header('Location: ../lead/lead.php');
}
?>

<hmtl>
    <head>
        <link rel="stylesheet" href="../../styles/dropdown.css">
        <link rel="stylesheet" href="../../styles/navbar.css">
        <link rel="stylesheet" href="../../styles/view_table.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>

        <!-- Navbar Setup -->


        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../lead/lead.php">Lead Home Page</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><div class="dropdown">
                        <button class="dropbtn">Order Information</button>
                        <div class="dropdown-content">
                            <a href="../lead/display_orders.php">Orders</a>
                            <a href="../lead/display_order_details.php">Order Details</a>
                            <a href="../lead/display_customers.php">Customers</a>
                        </div>
                    </div>
                    </li>
                    <li>
                    <div class="dropdown">
                        <button class="dropbtn">Product Information</button>
                        <div class="dropdown-content">
                            <a href="../lead/display_products.php">Products</a>
                            <a href="../lead/display_suppliers.php">Suppliers</a>
                            <a href="../lead/display_categories.php">Categories</a>
                        </div>
                    </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="../lead/search_suppliers.php"><span class="fa fa-search"></span> Search</a></li>
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </div>
            </div>
        </nav>
        

        <!-- Actual Body -->

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u>Suppliers</u></h3><br/>
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th>Supplier Code</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Fax</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach (SupplierController::getAllSuppliers() as $sup) : ?>
                        <tr>
                            <td><?php echo $sup -> getSupplierCode(); ?></td>
                            <td><?php echo $sup -> getSupplierName(); ?></td>
                            <td><?php echo $sup -> getSupplierAddress(); ?></td>
                            <td><?php echo $sup -> getSupplierPhone(); ?></td>
                            <td><?php echo $sup -> getSupplierFax(); ?></td>
                            <td><?php echo $sup -> getSupplierEmail(); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
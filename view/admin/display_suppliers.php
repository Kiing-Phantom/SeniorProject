<?php
session_start();
require_once('../../controller/supplier.php');
require_once('../../controller/supplier_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

if ( isset( $_POST[ 'update' ] ) ) {
    if ( isset( $_POST[ 'sIdUpd' ] ) ) {
        header('Location: ../admin/add_update_supplier.php?sId=' . $_POST[ 'sIdUpd' ]);
    }

    unset( $_POST[ 'update' ] );
    unset( $_POST[ 'sIdUpd' ] );
}

if ( isset( $_POST[ 'delete' ] ) ) {
    if ( isset( $_POST[ 'sIdDel' ] ) ) {
        SupplierController::deleteSupplier( $_POST[ 'sIdDel' ] );
    }

    unset( $_POST[ 'delete' ] );
    unset( $_POST[ 'sIdDel' ] );
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
                        <li><a href="../admin/search_suppliers.php"><span class="fa fa-search"></span> Search</a></li>
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
                            <td><?php echo '('.substr($sup -> getSupplierPhone(), 0, 3).') '.substr($sup -> getSupplierPhone(), 3, 3).'-'.substr($sup -> getSupplierPhone(),6); ?></td>
                            <td><?php echo '('.substr($sup -> getSupplierFax(), 0, 3).') '.substr($sup -> getSupplierFax(), 3, 3).'-'.substr($sup -> getSupplierFax(),6); ?></td>
                            <td><?php echo $sup -> getSupplierEmail(); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="sIdUpd"
                                        value="<?php echo $sup -> getSupplierId(); ?>" />
                                    <input type="submit" value="Update" name="update" />
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="sIdDel"
                                        value="<?php echo $sup -> getSupplierId(); ?>" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                        <tr>                          
                            <td>
                                <button type="submit"><a href="../admin/add_update_supplier.php">Add New Supplier</a></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
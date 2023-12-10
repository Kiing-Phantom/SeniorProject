<?php
session_start();
require_once('../../controller/supplier.php');
require_once('../../controller/supplier_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default Supplier with empty strings
$sup        = new Supplier(-1, '', '', '', '', '', '');
$page_title = "Add a new Supplier";
$btn        = "Add";

//retrieve Supplier_ID from query string and use it to update Supplier object for that ID
if ( isset( $_GET[ 'sId' ] ) )  {
    $sup        = SupplierController::getSupplierById( $_GET[ 'sId' ] );
    $page_title = "Update an existing Supplier";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $name      = Input::str( $_POST[ 'sName' ] );
    $address   = Input::str( $_POST[ 'sAddress' ] );
    $phone     = Input::int( $_POST[ 'sPhone' ] );
    $fax       = Input::int( $_POST[ 'sFax' ] );
    $email     = Input::email( $_POST[ 'sEmail' ] );
    $code      = Input::int( $_POST[ 'sCode' ] );

    //save button performs add/update
    $supp = new Supplier( $_POST[ 'sIdSAVE' ], $name, $address, 
                          $phone, $fax, $email, $code );

    if ( $supp -> getSupplierId() === '-1' ) {
        //add
        SupplierController::addSupplier( $supp );
    } else {
        //update
        SupplierController::updateSupplier( $supp );
    }

    //return to Supplier list
    header('Location: ../admin/display_suppliers.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Supplier list
    header('Location: ../admin/display_suppliers.php');
}
?>

<hmtl>
    <head>
        <link rel="stylesheet" href="../../styles/dropdown.css">
        <link rel="stylesheet" href="../../styles/navbar.css">
        <link rel="stylesheet" href="../../styles/input.css">
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
                                <a href="../admin/display_employees.php">Customers</a>
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

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u><?php echo $page_title; ?></u></h3><br/>
            <div class="table-responsive">          
                <table class="table">
                    <form method="POST">
                        <thead>
                            <tr>
                                <th>Supplier Code</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $sup -> getSupplierCode(); ?>"    name="sCode" pattern="[0-9]+"
                                            title="Please use numbers only." required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $sup -> getSupplierName(); ?>"    name="sName"    required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $sup -> getSupplierAddress(); ?>" name="sAddress" required >
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Phone Number</th>
                                <th>Fax</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $sup -> getSupplierPhone(); ?>"   name="sPhone" pattern="[0-9]+"
                                            title="Please enter a 10 digit phone number." required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $sup -> getSupplierFax(); ?>"     name="sFax"   pattern="[0-9]+"
                                            title="Please enter a 10 digit fax number." required >
                                </td>
                                <td>
                                    <input type="email" value="<?php echo $sup -> getSupplierEmail(); ?>"  name="sEmail" required >
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="hidden" value="<?php echo $sup -> getSupplierId(); ?>" name="sIdSAVE" >
                                    <input type="submit" value="<?php echo $btn; ?>" name="save">
                                </td>
                            </tr>
                        </tbody>
                    </form>
                    <form method="POST">
                        <tbody>
                            <tr>
                                <td>
                                    <input type = "submit" value = "Cancel" name = "cancel">
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
<?php
session_start();
require_once('../../controller/customer.php');
require_once('../../controller/customer_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default Customer with empty strings
$cust       = new Customer(-1, '', '', '', '', '', '');
$page_title = "Add a new Customer";
$btn        = "Add";

//retrieve Customer_ID from query string and use it to update Customer object for that ID
if ( isset( $_GET[ 'cId' ] ) )  {
    $cust       = CustomerController::getCustomerById( $_GET['cId'] );
    $page_title = "Update an existing Customer";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $fName   = Input::str( $_POST[ 'cFName' ] );
    $lName   = Input::str( $_POST[ 'cLName' ] );
    $address = Input::str( $_POST[ 'cAddress' ] );
    $phone   = Input::int( $_POST[ 'cPhone' ] );
    $email   = Input::email( $_POST[ 'cEmail' ] );
    $code    = Input::int( $_POST[ 'cCode' ] );

    //save button performs add/update
    $cust = new Customer( $_POST[ 'cIdSAVE' ], $fName, $lName, $address, $phone, $email, $code );

    if ( $cust -> getCustomerId() === '-1' ) {
        //add
        $cust -> setCustomerId( CustomerController::customerIdMax() + 1 );
        CustomerController::addCustomer( $cust );
    } else {
        //update
        CustomerController::updateCustomer( $cust );
    }

    //return to Customer list
    header('Location: ../admin/display_customers.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Customer list
    header('Location: ../admin/display_customers.php');
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

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u><?php echo $page_title; ?></u></h3><br/>
            <div class="table-responsive">          
                <table class="table">
                    <form method="POST">
                        <thead>
                            <tr>
                                <th>Customer Code</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $cust -> getCustomerCode(); ?>" name="cCode" pattern="[0-9]+"
                                            title="Please use numbers only." required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $cust -> getFirstName(); ?>" name="cFName" required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $cust -> getLastName(); ?>" name="cLName" required >
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $cust -> getAddress(); ?>" name="cAddress" required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $cust -> getPhone(); ?>" name="cPhone" pattern="[0-9]+"
                                            title="Please enter a 10 digit phone number." required >
                                </td>
                                <td>
                                    <input type="email" value="<?php echo $cust -> getEmail(); ?>" name="cEmail" required >
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type = "submit" value = "<?php echo $btn; ?>" name = "save">
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $cust -> getCustomerId(); ?>" name="cIdSAVE">
                                    
                                </td>
                            </tr>
                        </tbody>
                    </form>
                    <tbody>
                        <tr>
                            <td>
                                <form method="POST">
                                    <input type = "submit" value = "Cancel" name = "cancel">
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php
session_start();
require_once('../../controller/order.php');
require_once('../../controller/order_controller.php');
require_once('../../controller/customer.php');
require_once('../../controller/customer_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

$customers = CustomerController::getAllCustomers();

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default Order with empty strings
$order      = new Order(-1, '', '', $customers[0], '');
$page_title = "Add a new Order";
$btn        = "Add";

//retrieve Order_ID from query string and use it to update Order object for that ID
if ( isset( $_GET[ 'oId' ] ) )  {
    $order      = OrderController::getOrderById( $_GET[ 'oId' ] );
    $page_title = "Update an existing Order";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $total           = Input::flt( $_POST[ 'oTotal' ] );
    $customerId      = Input::int( $customers[ $_POST[ 'oCustomerId' ] - 1 ] -> getCustomerId() );
    $code            = Input::int( $_POST[ 'oCode' ] );

    //save button performs add/update
    $order = new Order( $_POST[ 'oIdSAVE' ], $_POST[ 'oDate' ],
                        $total, $customerId, $code );

    if ( $order -> getOrderId() === '-1' ) {
        //add
        OrderController::addOrder( $order );
    } else {
        //update
        OrderController::updateOrder( $order );
    }

    //return to Order list
    header('Location: ../admin/display_orders.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Order list
    header('Location: ../admin/display_orders.php');
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
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Order Date</th>
                            <th>Customer</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $order -> getOrderCode(); ?>" name="oCode" pattern="[0-9]+"
                                            title="Please use numbers only." required />
                                </td>
                                <td>
                                    <input type="date" value="<?php echo $order -> getOrderDate(); ?>" name="oDate" required />
                                </td>
                                <td>
                                    <select name="oCustomerId">
                                        <?php foreach ($customers as $customer) : ?>
                                            <option value="<?php echo $customer -> getCustomerID(); ?>" >
                                                <?php echo $customer -> getFirstName() . ' ' . $customer -> getLastName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" value="<?php echo $btn; ?>" name="save">
                                    <input type="hidden" name="oIdSAVE" value="<?php echo $order -> getOrderId(); ?>">
                                    <input type="hidden" name="oTotal" value="<?php echo $order -> getOrderTotal(); ?>">
                                </td>
                            </tr>
                        </form>
                    </tbody>
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
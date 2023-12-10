<?php
session_start();
require_once('../../controller/order_detail.php');
require_once('../../controller/order_detail_controller.php');
require_once('../../controller/product.php');
require_once('../../controller/product_controller.php');
require_once('../../controller/order.php');
require_once('../../controller/order_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);
var_dump($_POST);


$products = ProductController::getAllProducts();
$orders = OrderController::getAllOrders();

//default Order Detail with empty strings
$od         = new OrderDetail(-1, '', '', '', '', $products[0], '', '');
$odIdOLD    = '';
$page_title = "Add a new Order Detail";
$btn        = "Add";

//retrieve  Order Detail_ID from query string and use it to update Order Detail object for that ID
if ( isset( $_GET[ 'odId' ] ) )  {
    $od         = OrderDetailController::getDetailById( $_GET[ 'odId' ] );
    $odIdOLD    = $od -> getOrderId();
    $page_title = "Update an existing Order Detail" . ' ' .$odIdOLD;
    $btn        = "Update";
}

if ( isset( $_POST[ 'genPrice' ] ) ) {
    header('Location: ../admin/add_update_order_detail.php?odQuantity=' . $_POST[ 'odQuantity' ] 
    . '&odDiscount=' . $_POST[ 'odDiscount' ] . '&odProdId=' . $_POST[ 'odProdId' ] . '&odOrderId=' 
    . $_POST[ 'odOrderId' ] . '&odCode=' . $_POST[ 'odCode' ] . '&odIdSAVE=' . $_POST[ 'odIdSAVE' ] . '&oldId=' . $odIdOLD );
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $price    = Input::flt( $_POST[ 'odPrice' ] );
    $qty      = Input::int( $_GET[ 'odQuantity' ] );
    $discount = Input::flt( $_GET[ 'odDiscount' ] );
    $total    = Input::flt( $_POST[ 'odTotal' ] );
    $prodId   = Input::int( $_GET[ 'odProdId' ] );
    $orderId  = Input::int( $_GET[ 'odOrderId' ] );
    $code     = Input::int( $_GET[ 'odCode' ] );

    //save button performs add/update
    $od = new OrderDetail( $_GET[ 'odIdSAVE' ], $price, $qty, 
                           $discount, $total, $prodId, $orderId, 
                           $code );
    

    if ( $od -> getOrderDetailId() === '-1' ) {
        //add
        $od -> setOrderDetailId( OrderDetailController::detailIdMax() + 1 );
        OrderDetailController::addDetail( $od );
    } else {
        //update
        OrderDetailController::updateDetail( $od, $_GET[ 'oldId' ] );
    }

    //return to Order Detail list
    header('Location: ../admin/display_order_details.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Order Detail list
    header('Location: ../admin/display_order_details.php');
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
                    <thead>
                        <tr>
                            <th>Order Detail Code</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Discount ($)</th>
                            <th>Order ID</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $od -> getDetailCode(); ?>" name="odCode" pattern="[0-9]+"
                                            title="Please use numbers only." required />
                                </td>
                                <td>
                                    <select name="odProdId">
                                        <?php foreach ($products as $product) : ?>
                                            <option value="<?php echo $product -> getProductId(); ?>"
                                                <?php if ($product -> getProductId() ===
                                                    $od -> getProductId() ) {
                                                        echo 'selected';} ?> >
                                                <?php echo $product -> getProductName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select required>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $od -> getDetailQuantity(); ?>" name="odQuantity" required />
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $od -> getDetailDiscount(); ?>" name="odDiscount" required />
                                </td>
                                <td>
                                    <select name="odOrderId">
                                        <?php foreach ($orders as $order) : ?>
                                            <option value="<?php echo $order -> getOrderId(); ?>"
                                                <?php if ($order -> getOrderId() ===
                                                    $od -> getOrderId() ) {
                                                        echo 'selected';} ?> >
                                                <?php echo $order -> getOrderId(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select  required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type = "submit" value = "Generate Price" name = "genPrice">
                                    <input type="hidden" value="<?php echo $od -> getOrderDetailId(); ?>" name="odIdSAVE">
                                </td>
                            </tr>
                        </form>
                        <?php if ( isset( $_GET['odQuantity'] ) ) {  ?>
                            <form method="POST">
                                <tr>
                                    <th>
                                        Product Unit Price
                                    </th>
                                    <th>
                                        Order Detail Total
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        $<?php $od -> setDetailUnitPrice( ProductController::productPrice( $_GET[ 'odProdId' ] ) ); echo $od ->getDetailUnitPrice(); ?>
                                        <input type="hidden" value="<?php echo $od -> getDetailUnitPrice(); ?>" name="odPrice">
                                    </td>
                                    <td>
                                        $<?php $od -> setDetailTotal( ( ProductController::productPrice( $_GET[ 'odProdId' ] ) 
                                        * $_GET[ 'odQuantity' ] ) - $_GET[ 'odDiscount' ] ); echo $od -> getDetailTotal(); ?>
                                        <input type="hidden" value="<?php echo $od -> getDetailTotal(); ?>" name="odTotal">
                                    </td>
                                </tr>
                                    <td>
                                        <input type="hidden" value="<?php echo $od -> getOrderDetailId(); ?>" name="odIdSAVE">
                                        <input type = "submit" value = "Save" name = "save">
                                    </td>
                                </tr>
                            </form>
                        <?php }?>
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
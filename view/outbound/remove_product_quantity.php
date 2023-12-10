<?php
session_start();
require_once('../../controller/product.php');
require_once('../../controller/product_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('outbound');
//uncomment this line to check session variables
//var_dump($_SESSION);

$prod        = new Product('', '', '', '', '', '', '', '');
$page_title  = "Remove Product from Inventory";
$prodCode    = '';
$prodQTY     = '';
$pCodeLOOKUP = '';
$prodName    = '';

if ( isset( $_POST[ 'lookup' ] ) ) {
    $prodCode            = $_POST[ 'pCodeLOOKUP' ];
    $_SESSION[ 'pCode' ] = $prodCode;
    $prod                = ProductController::getProductByCode( $_POST[ 'pCodeLOOKUP' ] );
    $prodName            = ProductController::productName( $prodCode );
}

if ( isset( $_POST[ 'save' ] ) ) {
    //save button performs update
    $prodCode = $_SESSION['pCode'];
    $prodQTY  = $_POST[ 'pQTY' ];

    ProductController::removeQuantity( $prodCode, $prodQTY );
    

    //return to Products list
    unset($_SESSION['pCode']);
    header('Location: ../outbound/outbound.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Products list
    header('Location: ../outbound/outbound.php');
}
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
                    <a class="navbar-brand" href="../outbound/outbound.php">Inbound Home Page</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                        <div class="dropdown">
                            <button class="dropbtn">Product Information</button>
                            <div class="dropdown-content">
                                <a href="../outbound/display_orders.php">Orders</a>
                                <a href="../outbound/display_order_details.php">Order Details</a>
                                <a href="../outbound/remove_product_inventory.php">Remove Product from Inventory</a>
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

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u><?php echo $page_title; ?></u></h3><br/>
            <form method="POST">
                <h4><u><input type="text" name="pCodeLOOKUP" value=""><button type="submit" name="lookup">Lookup Product</button></u></h4><br/>
            </form>
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Product Quantity to Remove</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <tr>
                                <td>
                                    <?php echo $prodCode ?>
                                </td>
                                <td>
                                    <?php echo $prod -> getProductName(); ?>
                                </td>
                                <td>
                                    <input type="text" name="pQTY" value="" />
                                </td>
                                <td>
                                    <input type = "submit" value = "Save" name = "save">
                                </td>
                                <td>
                                    <input type = "submit" value = "Cancel" name = "cancel">
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
<?php
session_start();
require_once('../../controller/product.php');
require_once('../../controller/product_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('inbound');
//uncomment this line to check session variables
//var_dump($_SESSION);
//var_dump($_POST);

$page_title = "Add Product to Inventory";
$prodCode = '';
$prodQTY = '';
$pIdLOOKUP = '';
$prodName = '';

if ( isset( $_POST[ 'lookup' ] ) ) {
    $prodCode = $_POST[ 'pCodeLOOKUP' ];
    $_SESSION[ 'pCode' ] = $prodCode;
    $prodName = ProductController::productName( $prodCode );
}

if ( isset( $_POST[ 'save' ] ) ) {
    //save button performs update
    $prodCode = $_SESSION['pCode'];
    $prodQTY  = $_POST[ 'pQTY' ];

    ProductController::addQuantity( $prodCode, $prodQTY );
    

    //return to Product list
    unset($_SESSION['pCode']);
    header('Location: ../inbound/display_products.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Product list
    header('Location: ../inbound/display_products.php');
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
                    <a class="navbar-brand" href="../inbound/inbound.php">Inbound Home Page</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li>
                        <div class="dropdown">
                            <button class="dropbtn">Product Information</button>
                            <div class="dropdown-content">
                                <a href="../inbound/display_products.php">Products</a>
                                <a href="../inbound/display_categories.php">Categories</a>
                                <a href="../inbound/add_product_inventory.php">Add Product to Inventory</a>
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
                            <th>Product Quantity to Add</th>
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
                                    <?php echo $prodName ?>
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

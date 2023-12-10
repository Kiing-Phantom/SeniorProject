<?php
session_start();
require_once('../../controller/product.php');
require_once('../../controller/product_controller.php');
require_once('../../controller/category.php');
require_once('../../controller/category_controller.php');
require_once('../../controller/supplier.php');
require_once('../../controller/supplier_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

$categories = CategoryController::getAllCategories();
$suppliers  = SupplierController::getAllSuppliers();

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default Product with empty strings
$prod       = new Product(-1, '', '', '', '', '', '', '');
$page_title = "Add a new Customer";
$btn        = "Add";

//retrieve Product_ID from query string and use it to update Product object for that ID
if ( isset( $_GET[ 'pId' ] ) )  {
    $prod       = ProductController::getProductById( $_GET['pId'] );
    $page_title = "Update an existing Product";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $name           = Input::str( $_POST[ 'pName' ] );
    $description    = Input::str( $_POST[ 'pDesc' ] );
    $price          = Input::flt( $_POST[ 'pPrice' ] );
    $qty            = Input::int( $_POST[ 'pQty' ] );
    $supplierId     = Input::int( $suppliers[ $_POST[ 'pSupplierId' ] - 1 ] -> getSupplierId() );
    $categoryId     = Input::int( $categories[ $_POST[ 'pCategoryId' ] - 1 ] -> getCategoryId() );
    $code           = Input::int( $_POST[ 'pCode' ] );

    //save button performs add/update
    $prod = new Product(  $_POST[ 'pIdSAVE' ], $name, $description, $price, 
                          $qty, $supplierId, $categoryId, $code );

    if ( $prod -> getProductId() === '-1' ) {
        //add
        $prod -> setProductId( ProductController::productIdMax() + 1 );
        ProductController::addProduct( $prod );
    } else {
        //update
        ProductController::updateProduct( $prod );
    }

    //return to Product list
    header('Location: ../admin/display_products.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Product list
    header('Location: ../admin/display_products.php');
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
                                <th>Product Code</th>
                                <th>Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $prod -> getProductCode(); ?>" name="pCode" pattern="[0-9]+"
                                            title="Please use numbers only." required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $prod -> getProductName(); ?>" name="pName" required >
                                </td>
                                <td>
                                    <textarea type="text" name="pDesc" required ><?php echo $prod -> getProductDescription(); ?></textarea>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Price ($)</th>
                                <th>Quantity</th>
                                <th>Supplier</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $prod -> getProductPrice(); ?>" name="pPrice" required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $prod -> getProductQuantity(); ?>" name="pQty" required >
                                </td>
                                <td>
                                    <select name="pSupplierId">
                                        <?php foreach ($suppliers as $supplier) : ?>
                                            <option value="<?php echo $supplier -> getSupplierId(); ?>"
                                                <?php if ($supplier -> getSupplierId() ===
                                                    $prod -> getSupplierId() ) {
                                                        echo 'selected';} ?> >
                                                <?php echo $supplier -> getSupplierName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Category</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <select name="pCategoryId">
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?php echo $category -> getCategoryId(); ?>"
                                                <?php if ($category -> getCategoryId() ===
                                                    $prod -> getCategoryId() ) {
                                                        echo 'selected';} ?> >
                                                <?php echo $category -> getCategoryName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type = "submit" value = "<?php echo $btn; ?>" name = "save">
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $prod -> getProductId(); ?>" name="pIdSAVE">
                                    
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
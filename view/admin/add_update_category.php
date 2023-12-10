<?php
session_start();
require_once('../../controller/category.php');
require_once('../../controller/category_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default category with empty strings
$cat        = new Category(-1, '', '');
$page_title = "Add a new Category";
$btn        = "Add";

//retrieve Category_ID from query string and use it to update Category object for that ID
if ( isset( $_GET[ 'cId' ] ) )  {
    $cat        = CategoryController::getCategoryById( $_GET[ 'cId' ] );
    $page_title = "Update an existing Category";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $name    = Input::str( $_POST[ 'cName' ] );
    $code    = Input::int( $_POST[ 'cCode' ] );

    //save button performs add/update
    $cat = new Category( $_POST[ 'cIdSAVE' ], $name, $code );

    if ( $cat -> getCategoryId() === '-1' ) {
        //add
        $cat -> setCategoryId( CategoryController::categoryIdMax() + 1 );
        CategoryController::addCategory( $cat );
    } else {
        //update
        CategoryController::updateCategory( $cat );
    }

    //return to Category list
    header('Location: ../admin/display_categories.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Category list
    header('Location: ../admin/display_categories.php');
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
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $cat -> getCategoryCode(); ?>" name="cCode" pattern="[0-9]+"
                                            title="Please use numbers only." required>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $cat -> getCategoryName(); ?>" name="cName" required>
                                </td>
                            </tr>
                            <tr>   
                                <td>
                                    <input type="hidden" value="<?php echo $cat -> getCategoryId(); ?>" name="cIdSAVE" required>
                                    <input type = "submit" value = "<?php echo $btn; ?>" name = "save">
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

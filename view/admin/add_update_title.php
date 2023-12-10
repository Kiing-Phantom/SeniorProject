<?php
session_start();
require_once('../../controller/Title.php');
require_once('../../controller/Title_controller.php');
require_once('../../util/security.php');
require_once('../../util/input.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default Title with empty strings
$title      = new Title(-1, '', '');
$page_title = "Add a new Title";

//retrieve Title_ID from query string and use it to update Title object for that ID
if ( isset( $_GET[ 'tId' ] ) )  {
    $title      = TitleController::getTitleById( $_GET[ 'tId' ] );
    $page_title = "Update an existing Title";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $name    = Input::str( $_POST[ 'tName' ] );
    $code    = Input::int( $_POST[ 'tCode' ] );

    //save button performs add/update
    $title = new Title( $_POST[ 'tIdSAVE' ], $name, $code );

    if ( $title -> getTitleId() === '-1' ) {
        //add
        $title -> setTitleId( TitleController::titleIdMax() + 1 );
        TitleController::addTitle( $title );
    } else {
        //update
        TitleController::updateTitle( $title );
    }

    //return to Title list
    header('Location: ../admin/display_titles.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Title list
    header('Location: ../admin/display_titles.php');
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
                            <th>Title Code</th>
                            <th>Title Name</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="POST">
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $title -> getTitleCode(); ?>" name="tCode" pattern="[0-9]+"
                                            title="Please use numbers only." required>
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $title -> getTitleName(); ?>" name="tName" required/>
                                </td>
                                <td>
                                    <input type="hidden" value="<?php echo $title -> getTitleId(); ?>" name="tIdSAVE">
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
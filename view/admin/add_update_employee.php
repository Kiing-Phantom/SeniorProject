<?php
session_start();
require_once('../../controller/employee.php');
require_once('../../controller/employee_controller.php');
require_once('../../controller/title.php');
require_once('../../controller/title_controller.php');
require_once('../../util/security.php');
include_once('../../util/input.php');

$titles = TitleController::getAllTitles();

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

//default employee with empty strings
$emp        = new Employee(-1, '', '', '', '', '', '', '', $titles[0], '');
$page_title = "Add a new Employee";
$btn        = "Add";

//retrieve Employee_ID from query string and use it to update Employee object for that ID
if ( isset( $_GET[ 'eId' ] ) )  {
    $emp        = EmployeeController::getEmployeeById( $_GET[ 'eId' ] );
    $page_title = "Update an existing Employee";
    $btn        = "Update";
}

if ( isset( $_POST[ 'save' ] ) ) {
    //validate user input
    $fName   = Input::str( $_POST[ 'eFName' ] );
    $lName   = Input::str( $_POST[ 'eLName' ] );
    $address = Input::str( $_POST[ 'eAddress' ] );
    $phone   = Input::int( $_POST[ 'ePhone' ] );
    $email   = Input::email( $_POST[ 'eEmail' ] );
    $user    = Input::str( $_POST[ 'eUser' ] );
    $pass    = Input::hashPass( $_POST[ 'ePass' ] );
    $tId     = Input::int( $titles[ $_POST[ 'eTitleID' ] - 1 ] -> getTitleId() );
    $code    = Input::int( $_POST[ 'eCode' ] );

    //save button performs add/update
    $emp = new Employee( $_POST[ 'eIdSAVE' ], $fName, $lName, 
                         $address, $phone, $email, $user, $pass, 
                         $titles[ $_POST[ 'eTitleID' ] - 1 ] -> getTitleId(), $code );

    if ( $emp -> getEmployeeId() === '-1' ) {
        //add
        EmployeeController::addEmployee( $emp );
    } else {
        //update
        EmployeeController::updateEmployee( $emp );
    }

    //return to Employee list
    header('Location: ../admin/display_employees.php');
}

if ( isset( $_POST[ 'cancel' ] ) ) {
    //cancel button - go back to Employee list
    header('Location: ../admin/display_employees.php');
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
                    <form method="POST" >
                        <thead>
                            <tr>
                                <th>Employee Code</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $emp -> getEmployeeCode(); ?>" name="eCode" pattern="[0-9]+"
                                            title="Please use numbers only." required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $emp -> getFirstName(); ?>" name="eFName" required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $emp -> getLastName(); ?>" name="eLName" required >
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
                                    <input type="text" value="<?php echo $emp -> getAddress(); ?>" name="eAddress" required >
                                </td>
                                <td>
                                    <input type="text" value="<?php echo $emp -> getPhone(); ?>" name="ePhone" pattern="[0-9]+"
                                            title="Please enter a 10 digit phone number." required >
                                </td>
                                <td>
                                    <input type="email" value="<?php echo $emp -> getEmail(); ?>" name="eEmail" required >
                                </td>
                            </tr>
                        </tbody>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Title ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" value="<?php echo $emp -> getUsername(); ?>" name="eUser" pattern="(?=.*[a-z]).{6,}" 
                                            title="Must contain only lowercase letters and numbers, and at least 6 or more characters" required >
                                </td>
                                <td>
                                    <input type="password" value="<?php echo $emp -> getPassword(); ?>" name="ePass" id="psw" 
                                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and 
                                            lowercase letter, and at least 8 or more characters" required >
                                </td>
                                <td>
                                    <select name="eTitleID">
                                        <?php foreach ($titles as $title) : ?>
                                            <option value="<?php echo $title -> getTitleID(); ?>"
                                                <?php if ($title -> getTitleId() ===
                                                    $emp -> getTitleId() ) {
                                                        echo 'selected';} ?> > 
                                                <?php echo $title -> getTitleName(); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tbody>
                                <tr>
                                    <td>
                                        <input type="hidden" value="<?php echo $emp -> getEmployeeId(); ?>" name="eIdSAVE">
                                        <input type="submit" value="<?php echo $btn; ?>" name="save">
                                    </td>
                                </tr>
                        </tbody>
                    </form>
                    <form method="POST">
                        <tbody>
                            <tr>
                                <td>
                                    <form method="POST">
                                        <input type = "submit" value = "Cancel" name = "cancel">
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
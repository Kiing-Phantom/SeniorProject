<?php
session_start();
require_once('../../controller/employee.php');
require_once('../../controller/employee_controller.php');
require_once('../../model/titles_db.php');
require_once('../../controller/title_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

if ( isset( $_POST[ 'update' ] ) ) {
    if ( isset( $_POST[ 'eIdUpd' ] ) ) {
        header('Location: ../admin/add_update_employee.php?eId=' . $_POST[ 'eIdUpd' ]);
    }

    unset( $_POST[ 'update' ] );
    unset( $_POST[ 'eIdUpd' ] );
}

if ( isset( $_POST[ 'delete' ] ) ) {
    if ( isset( $_POST[ 'eIdDel' ] ) ) {
        EmployeeController::deleteEmployee( $_POST[ 'eIdDel' ] );
    }

    unset( $_POST[ 'delete' ] );
    unset( $_POST[ 'eIdDel' ] );
}
?>

<hmtl>
    <head>
        <link rel="stylesheet" href="../../styles/dropdown.css">
        <link rel="stylesheet" href="../../styles/navbar.css">
        <link rel="stylesheet" href="../../styles/view_table.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <li><a href="../admin/search_employees.php"><span class="fa fa-search"></span> Search</a></li>
                        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Actual Body -->

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u>Employees</u></h3><br/>
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th>Employee Code</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach (EmployeeController::getAllEmployees() as $emp) : ?>
                        <tr>
                            <td><?php     echo $emp -> getEmployeeCode(); ?></td>
                            <td><?php     echo $emp -> getFirstName() . " " . $emp -> getLastName(); ?></td>
                            <td><?php     echo $emp -> getAddress(); ?></td>
                            <td><?php     echo '('.substr($emp -> getPhone(), 0, 3).') '.substr($emp -> getPhone(), 3, 3).'-'.substr($emp -> getPhone(),6); ?></td>
                            <td><?php     echo $emp -> getEmail(); ?></td>
                            <td><?php     echo $emp -> getUsername(); ?></td>
                            <td><?php $title = $emp -> getTitleID(); $STRINGNAME = TitleController::getTitleName( $title ); echo $STRINGNAME; ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="eIdUpd"
                                        value="<?php echo $emp -> getEmployeeId(); ?>" />
                                    <input type="submit" value="Update" name="update" />
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="eIdDel"
                                        value="<?php echo $emp -> getEmployeeId(); ?>" />
                                    <input type="submit" value="Delete" name="delete" />
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>                          
                            <td>
                                <button type="submit"><a href="../admin/add_update_employee.php">Add New Employee</a></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
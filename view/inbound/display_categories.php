<?php
session_start();
require_once('../../controller/category.php');
require_once('../../controller/category_controller.php');
require_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('inbound');
//uncomment this line to check session variables
//var_dump($_SESSION);
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
                        <li><a href="../inbound/search_categories.php"><span class="fa fa-search"></span> Search</a></li>
                    <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
                </div>
            </div>
        </nav>

        <!-- Actual Body -->

        <div class="container">
            <br/><br/>
            <br/><br/>
            <h3><u>Titles</u></h3><br/>
            <div class="table-responsive">          
                <table class="table">
                    <thead>
                        <tr>
                            <th>Category Code</th>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (CategoryController::getAllCategories() as $cat) : ?>
                            <tr>
                                <td><?php echo $cat -> getCategoryCode(); ?></td>
                                <td><?php echo $cat -> getCategoryName(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
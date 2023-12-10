<?php
session_start();
include_once('../../controller/product_controller.php');
include_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('admin');
//uncomment this line to check session variables
//var_dump($_SESSION);

$search_err = '';
$product_details = [];
if ( isset( $_POST[ 'save' ] ) ) {
    if ( !empty( $_POST[ 'search' ] ) ) {
        $search = $_POST[ 'search' ];
        $product_details = ProductController::searchProducts( $search );
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="../../styles/dropdown.css">
        <link rel="stylesheet" href="../../styles/navbar.css">
        <link rel="stylesheet" href="../../styles/search.css">
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
                            <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Actual Body -->

            <div class="container">
                <br/><br/>
                <form class="form-horizontal" action="#" method="post">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-sm-4"><b>Search Product Information</b></label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="search" placeholder="Enter Product Information to Search...">
                        </div>
                        <div class="col-sm-2">
                        <button type="submit" name="save" class="search-btn">Search</button>
                        </div>
                    </div>
                    
                    <!-- Error Information -->
                    <?php if ( $search_err != '') { ?>
                        <div class="form-group">
                            <span class="error" style="color:red;">* <?php echo $search_err;?></span>
                        </div>
                    <?php } ?>
                    
                </div>
                </form>
                <br/><br/>
                <h3><u>Search Result</u></h3><br/>
                <div class="table-responsive">          
                <table class="table">
                    <thead>
                    <tr>
                        <th>Entry #</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Phone Number</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            if(!$product_details) {
                                echo '<tr><td>No data found</td></tr>';
                            }
                            else{
                                foreach($product_details as $key=>$value) {?>
                                    <tr>
                                        <td><?php  echo $key + 1; ?></td>
                                        <td><?php  echo $value['Product_Code'];?></td>
                                        <td><?php  echo $value['Product_Name'];?></td>
                                        <td><?php  echo $value['Product_Description'];?></td>
                                        <td>$<?php echo $value['Product_Price'];?></td>
                                        <td><?php  echo $value['Product_Quantity'];?></td>
                                        <td><?php  echo $value['Category_Name'];?></td>
                                        <td><?php  echo $value['Supplier_Name'];?></td>
                                        <td><?php  echo $value['Supplier_Phone'];?></td>
                                    </tr>
                                <?php
                                } 
                            }
                            ?>
                    </tbody>
                </table>
                </div>
            </div>
        </body>
    </head>
</html>
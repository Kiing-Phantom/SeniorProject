<?php
session_start();
include_once('../../controller/order_detail_controller.php');
include_once('../../util/security.php');

//confirm user is authorized for the page
Security::checkAuth('outbound');
//uncomment this line to check session variables
//var_dump($_SESSION);

$search_err = '';
$detail_details = [];
if ( isset( $_POST[ 'save' ] ) ) {
    if ( !empty( $_POST[ 'search' ] ) ) {
        $search = $_POST[ 'search' ];
        $detail_details = OrderDetailController::searchDetails( $search );
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
                        <a class="navbar-brand" href="../outbound/outbound.php">Outbound Home Page</a>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li><div class="dropdown">
                                <button class="dropbtn">Order Information</button>
                                <div class="dropdown-content">
                                    <a href="../outbound/display_orders.php">Orders</a>
                                    <a href="../outbound/display_order_details.php">Order Details</a>
                                <a href="../outbound/remove_product_inventory.php">Remove Product from Inventory</a>
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
                        <label class="control-label col-sm-4"><b>Search Order Detail Information</b></label>
                        <div class="col-sm-4">
                        <input type="text" class="form-control" name="search" placeholder="Enter Order Detail Information to Search...">
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
                        <th>Detail Code</th>
                        <th>Order #</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Quantity</th>
                        <th>Price Per Product</th>
                        <th>Discount</th>
                        <th>Total</th>
                        <th>Complete Order Total</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                            if(!$detail_details) {
                                echo '<tr><td>No data found</td></tr>';
                            }
                            else{
                                foreach($detail_details as $key=>$value) {?>
                                    <tr>
                                        <td><?php  echo $key+1; ?></td>
                                        <td><?php  echo $value['Detail_Code'];?></td>
                                        <td><?php  echo $value['Order_ID'];?></td>
                                        <td><?php  echo $value['Product_Name'];?></td>
                                        <td><?php  echo $value['Product_Description'] ?></td>
                                        <td><?php  echo $value['Detail_Quantity'];?></td>
                                        <td>$<?php echo $value['Detail_Unit_Price'];?></td>
                                        <td>$<?php echo $value['Detail_Discount'];?></td>
                                        <td>$<?php echo $value['Detail_Total'];?></td>
                                        <td>$<?php echo $value['Order_Total'];?></td>
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
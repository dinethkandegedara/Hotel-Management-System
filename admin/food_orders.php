<?php
session_start();
if(!isset($_SESSION["user"]))
{
 header("location:index.php");
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OCEAN VIEW HOTEL ADMIN</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">OCEAN VIEW HOTEL </a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="usersetting.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="home.php"><i class="fa fa-dashboard"></i> Status</a>
                    </li>
                    <li>
                        <a href="messages.php"><i class="fa fa-desktop"></i> News</a>
                    </li>
                    <li>
                        <a href="roombook.php"><i class="fa fa-bar-chart-o"></i> Room Booking</a>
                    </li>
                    <li>
                        <a href="room.php"><i class="fa fa-qrcode"></i> Room</a>
                    </li>
                    <li>
                        <a href="payment.php"><i class="fa fa-qrcode"></i> Payment</a>
                    </li>
                    <li>
                        <a href="foods.php"><i class="fa fa-cutlery"></i> Food Management</a>
                    </li>
                    <li>
                        <a class="active-menu" href="food_orders.php"><i class="fa fa-list"></i> Food Orders</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">Food Orders <small>Manage customer food orders</small></h1>
                    </div>
                </div>

                <!-- Food Orders List -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Recent Food Orders</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Email</th>
                                                <th>Food Item</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total Amount</th>
                                                <th>Order Time</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('db.php');
                                            $sql = "SELECT fo.*, f.name as food_name, f.category, f.price 
                                                   FROM food_orders fo 
                                                   JOIN foods f ON fo.food_id = f.id 
                                                   ORDER BY fo.order_time DESC";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_array($result)) {
                                                $status_class = $row['status'] == 'pending' ? 'label-warning' : 
                                                              ($row['status'] == 'completed' ? 'label-success' : 'label-info');
                                                echo "<tr>";
                                                echo "<td>".$row['id']."</td>";
                                                echo "<td>".$row['email']."</td>";
                                                echo "<td>".$row['food_name']."</td>";
                                                echo "<td>".$row['category']."</td>";
                                                echo "<td>".$row['quantity']."</td>";
                                                echo "<td>LKR ".number_format($row['price'], 2)."</td>";
                                                echo "<td>LKR ".number_format($row['bill_amount'], 2)."</td>";
                                                echo "<td>".date('Y-m-d H:i', strtotime($row['order_time']))."</td>";
                                                echo "<td><span class='label $status_class'>".ucfirst($row['status'])."</span></td>";
                                                echo "<td>";
                                                if($row['status'] == 'pending') {
                                                    echo "<a href='?complete_id=".$row['id']."' class='btn btn-success btn-sm'>Mark Complete</a>";
                                                }
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Custom scripts -->
    <script src="assets/js/custom.js"></script>

</body>
</html>

<?php
include('db.php');

// Mark order as complete
if(isset($_GET['complete_id'])) {
    $order_id = mysqli_real_escape_string($con, $_GET['complete_id']);
    $sql = "UPDATE food_orders SET status = 'completed' WHERE id = '$order_id'";
    if(mysqli_query($con, $sql)) {
        echo "<script>alert('Order marked as completed!'); window.location='food_orders.php';</script>";
    } else {
        echo "<script>alert('Error updating order status!');</script>";
    }
}
?>
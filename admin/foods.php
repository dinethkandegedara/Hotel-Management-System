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
                        <a href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-book"></i> Reservations<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="reservation.php"><i class="fa fa-plus-circle"></i> New Reservation</a>
                            </li>
                            <li>
                                <a href="roombook.php"><i class="fa fa-list"></i> View Bookings</a>
                            </li>
                            <li>
                                <a href="payment.php"><i class="fa fa-money"></i> Payments</a>
                            </li>
                            <li>
                                <a href="profit.php"><i class="fa fa-bar-chart-o"></i> Profit Report</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-bed"></i> Room Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="settings.php"><i class="fa fa-list-alt"></i> View All Rooms</a>
                            </li>
                            <li>
                                <a href="room.php"><i class="fa fa-plus-circle"></i> Add New Room</a>
                            </li>
                            <li>
                                <a href="roomdel.php"><i class="fa fa-trash-o"></i> Delete Room</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="#"><i class="fa fa-cutlery"></i> Food Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="foods.php"><i class="fa fa-list"></i> Food Items</a>
                            </li>
                            <li>
                                <a href="food_orders.php"><i class="fa fa-shopping-cart"></i> Food Orders</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="messages.php"><i class="fa fa-envelope"></i> Newsletters</a>
                    </li>
                    
                    <li>
                        <a href="usersetting.php"><i class="fa fa-users"></i> User Management</a>
                    </li>
                    
                    <li>
                        <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                    </li>

                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">Food Management <small>Add and manage food items</small></h1>
                    </div>
                </div>
                
                <!-- Add Food Form -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">Add New Food Item</div>
                            <div class="panel-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Food Name</label>
                                        <input type="text" name="food_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="category" class="form-control" required>
                                            <option value="">Select Category</option>
                                            <option value="Main Course">Main Course</option>
                                            <option value="Breakfast">Breakfast</option>
                                            <option value="Dessert">Dessert</option>
                                            <option value="Beverage">Beverage</option>
                                            <option value="Snacks">Snacks</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Price (LKR)</label>
                                        <input type="number" name="price" class="form-control" step="0.01" required>
                                    </div>
                                    <button type="submit" name="add_food" class="btn btn-primary">Add Food Item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Food Items List -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Food Items</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Price (LKR)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            include('db.php');
                                            $sql = "SELECT * FROM foods ORDER BY category, name";
                                            $result = mysqli_query($con, $sql);
                                            while($row = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>".$row['id']."</td>";
                                                echo "<td>".$row['name']."</td>";
                                                echo "<td>".$row['category']."</td>";
                                                echo "<td>LKR ".number_format($row['price'], 2)."</td>";
                                                echo "<td>
                                                    <a href='?delete_id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                                </td>";
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

// Add new food item
if(isset($_POST['add_food'])) {
    $food_name = mysqli_real_escape_string($con, $_POST['food_name']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    
    $sql = "INSERT INTO foods (name, category, price) VALUES ('$food_name', '$category', '$price')";
    if(mysqli_query($con, $sql)) {
        echo "<script>alert('Food item added successfully!'); window.location='foods.php';</script>";
    } else {
        echo "<script>alert('Error adding food item!');</script>";
    }
}

// Delete food item
if(isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($con, $_GET['delete_id']);
    $sql = "DELETE FROM foods WHERE id = '$delete_id'";
    if(mysqli_query($con, $sql)) {
        echo "<script>alert('Food item deleted successfully!'); window.location='foods.php';</script>";
    } else {
        echo "<script>alert('Error deleting food item!');</script>";
    }
}
?>
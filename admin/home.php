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
    <title>Administrator	</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
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
                <a class="navbar-brand" href="home.php"> <?php echo $_SESSION["user"]; ?> </a>
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
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="home.php"><i class="fa fa-dashboard"></i> Dashboard</a>
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
                                <a href="foods.php"><i class="fa fa-list"></i> Food Items</a>
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
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Dashboard <small>Overview</small>
                        </h1>
                    </div>
                </div>
                
                <!-- Room Statistics -->
                <?php
						include ('db.php');
						
						// Get total rooms
						$total_rooms_query = "SELECT COUNT(*) as total FROM room";
						$total_rooms_result = mysqli_query($con, $total_rooms_query);
						$total_rooms_row = mysqli_fetch_assoc($total_rooms_result);
						$total_rooms = $total_rooms_row['total'];
						
						// Get available rooms (check if status column exists)
						$check_status = mysqli_query($con, "SHOW COLUMNS FROM room LIKE 'status'");
						$has_status = mysqli_num_rows($check_status) > 0;
						
						if($has_status) {
							$available_query = "SELECT COUNT(*) as available FROM room WHERE status = 'Available'";
							$available_result = mysqli_query($con, $available_query);
							$available_row = mysqli_fetch_assoc($available_result);
							$available_rooms = $available_row['available'];
							
							$booked_query = "SELECT COUNT(*) as booked FROM room WHERE status = 'Booked'";
							$booked_result = mysqli_query($con, $booked_query);
							$booked_row = mysqli_fetch_assoc($booked_result);
							$booked_rooms = $booked_row['booked'];
						} else {
							$available_rooms = $total_rooms;
							$booked_rooms = 0;
						}
						
						// Get booking statistics
						$total_bookings_query = "SELECT COUNT(*) as total FROM roombook";
						$total_bookings_result = mysqli_query($con, $total_bookings_query);
						$total_bookings_row = mysqli_fetch_assoc($total_bookings_result);
						$total_bookings = $total_bookings_row['total'];
				?>
				
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="panel panel-primary text-center no-boder bg-color-blue">
							<div class="panel-body">
								<i class="fa fa-building-o fa-5x"></i>
								<h3><?php echo $total_rooms; ?></h3>
							</div>
							<div class="panel-footer back-footer-blue">
								Total Rooms
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="panel panel-primary text-center no-boder bg-color-green">
							<div class="panel-body">
								<i class="fa fa-check-circle fa-5x"></i>
								<h3><?php echo $available_rooms; ?></h3>
							</div>
							<div class="panel-footer back-footer-green">
								Available Rooms
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="panel panel-primary text-center no-boder bg-color-red">
							<div class="panel-body">
								<i class="fa fa-ban fa-5x"></i>
								<h3><?php echo $booked_rooms; ?></h3>
							</div>
							<div class="panel-footer back-footer-red">
								Booked Rooms
							</div>
						</div>
					</div>
					
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="panel panel-primary text-center no-boder bg-color-brown">
							<div class="panel-body">
								<i class="fa fa-calendar fa-5x"></i>
								<h3><?php echo $total_bookings; ?></h3>
							</div>
							<div class="panel-footer back-footer-brown">
								Total Bookings
							</div>
						</div>
					</div>
				</div>
                
                <!-- Booking Status Section -->
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="page-header" style="margin-top: 30px;">
                            Room Booking Status
                        </h2>
                    </div>
                </div>
                <!-- /. ROW  -->
				<?php
						$sql = "select * from roombook";
						$re = mysqli_query($con,$sql);
						$c =0;
						while($row=mysqli_fetch_array($re) )
						{
								$new = $row['stat'];
								$cin = $row['cin'];
								$id = $row['id'];
								if($new=="Not Conform")
								{
									$c = $c + 1;
									
								
								}
						
						}
						
									
									

						
				?>

					<div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
							
							<div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
											<button class="btn btn-default" type="button">
												 New Room Bookings  <span class="badge"><?php echo $c ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse in" style="height: auto;">
                                        <div class="panel-body">
                                           <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Country</th>
											<th>Room</th>
											<th>Bedding</th>
											<th>Meal</th>
											<th>Check In</th>
											<th>Check Out</th>
											<th>Status</th>
											<th>More</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
									$tsql = "select * from roombook";
									$tre = mysqli_query($con,$tsql);
									while($trow=mysqli_fetch_array($tre) )
									{	
										$co =$trow['stat']; 
										if($co=="Not Conform")
										{
											echo"<tr>
												<th>".$trow['id']."</th>
												<th>".$trow['FName']." ".$trow['LName']."</th>
												<th>".$trow['Email']."</th>
												<th>".$trow['Country']."</th>
												<th>".$trow['TRoom']."</th>
												<th>".$trow['Bed']."</th>
												<th>".$trow['Meal']."</th>
												<th>".$trow['cin']."</th>
												<th>".$trow['cout']."</th>
												<th>".$trow['stat']."</th>
												
												<th><a href='roombook.php?rid=".$trow['id']." ' class='btn btn-primary'>Action</a></th>
												</tr>";
										}	
									
									}
									?>
                                        
                                    </tbody>
                                </table>
								
                            </div>
                        </div>
                    </div>
                      <!-- End  Basic Table  --> 
                                        </div>
                                    </div>
                                </div>
								<?php
								
								$rsql = "SELECT * FROM `roombook`";
								$rre = mysqli_query($con,$rsql);
								$r =0;
								while($row=mysqli_fetch_array($rre) )
								{		
										$br = $row['stat'];
										if($br=="Conform")
										{
											$r = $r + 1;
											
											
											
										}
										
								
								}
						
								?>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed">
											<button class="btn btn-primary" type="button">
												 Booked Rooms  <span class="badge"><?php echo $r ; ?></span>
											</button>
											
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" style="height: 0px;">
                                        <div class="panel-body">
										<?php
										$msql = "SELECT * FROM `roombook`";
										$mre = mysqli_query($con,$msql);
										
										while($mrow=mysqli_fetch_array($mre) )
										{		
											$br = $mrow['stat'];
											if($br=="Conform")
											{
												$fid = $mrow['id'];
												 
											echo"<div class='col-md-3 col-sm-12 col-xs-12'>
													<div class='panel panel-primary text-center no-boder bg-color-blue'>
														<div class='panel-body'>
															<i class='fa fa-users fa-5x'></i>
															<h3>".$mrow['FName']."</h3>
														</div>
														<div class='panel-footer back-footer-blue'>
														<a href=show.php?sid=".$fid ."><button  class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
													Show
													</button></a>
															".$mrow['TRoom']."
														</div>
													</div>	
											</div>";
															
												
					
				
												
											}
											
									
										}
										?>
                                           
										</div>
										
                                    </div>
									
                                </div>
                                <?php
								
								$fsql = "SELECT * FROM `contact`";
								$fre = mysqli_query($con,$fsql);
								$f =0;
								while($row=mysqli_fetch_array($fre) )
								{
										$f = $f + 1;
								
								}
						
								?>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed">
											<button class="btn btn-primary" type="button">
												 Followers  <span class="badge"><?php echo $f ; ?></span>
											</button>
											</a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
											<th>Follow Start</th>
                                            <th>Permission status</th>
                                            
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
									$csql = "select * from contact";
									$cre = mysqli_query($con,$csql);
									while($crow=mysqli_fetch_array($cre) )
									{	
										
											echo"<tr>
												<th>".$crow['id']."</th>
												<th>".$crow['fullname']."</th>
												<th>".$crow['email']." </th>
												<th>".$crow['cdate']." </th>
												<th>".$crow['approval']."</th>
												</tr>";
										
									
									}
									?>
                                        
                                    </tbody>
                                </table>
								<a href="messages.php" class="btn btn-primary">More Action</a>
                            </div>
                        </div>
                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
			
				<!-- DEOMO-->
				<div class='panel-body'>
                            <button class='btn btn-primary btn' data-toggle='modal' data-target='#myModal'>
                              Update 
                            </button>
                            <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                            <h4 class='modal-title' id='myModalLabel'>Change the User name and Password</h4>
                                        </div>
										<form method='post>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                            <label>Change User name</label>
                                            <input name='usname' value='<?php echo $fname; ?>' class='form-control' placeholder='Enter User name'>
											</div>
										</div>
										<div class='modal-body'>
                                            <div class='form-group'>
                                            <label>Change Password</label>
                                            <input name='pasd' value='<?php echo $ps; ?>' class='form-control' placeholder='Enter Password'>
											</div>
                                        </div>
										
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
											
                                           <input type='submit' name='up' value='Update' class='btn btn-primary'>
										  </form>
										   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
				
				<!--DEMO END-->
				
										
                    

                <!-- /. ROW  -->
				
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>


</body>

</html>
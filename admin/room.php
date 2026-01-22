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
    <title>SUNRISE HOTEL</title>
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
                <a class="navbar-brand" href="home.php">MAIN MENU </a>
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
                        <a  href="settings.php"><i class="fa fa-dashboard"></i>Rooms Status</a>
                    </li>
					<li>
                        <a  class="active-menu" href="room.php"><i class="fa fa-plus-circle"></i>Add Room</a>
                    </li>
                    <li>
                        <a  href="roomdel.php"><i class="fa fa-desktop"></i> Delete Room</a>
                    </li>
					

                    
            </div>

        </nav>
        <!-- /. NAV SIDE  -->
       
        
       
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           NEW ROOM <small></small>
                        </h1>
                    </div>
                </div>
				
				<?php
				// Check if room_number column exists
				include('db.php');
				$check_column = mysqli_query($con, "SHOW COLUMNS FROM room LIKE 'room_number'");
				$has_room_number = mysqli_num_rows($check_column) > 0;
				
				if(!$has_room_number) {
					echo '<div class="row">
						<div class="col-md-12">
							<div class="alert alert-warning alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong><i class="fa fa-exclamation-triangle"></i> Database Update Required!</strong><br>
								The room_number feature is not enabled in your database. 
								<a href="../migrate_room_status.php" class="btn btn-sm btn-primary" style="margin-left:10px;">
									<i class="fa fa-wrench"></i> Run Migration Script
								</a>
							</div>
						</div>
					</div>';
				}
				?> 
                 
                                 
            <div class="row">
                
                <div class="col-md-5 col-sm-5">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ADD NEW ROOM
                        </div>
                        <div class="panel-body">
						<form name="form" method="post">
                            <div class="form-group">
                                            <label>Type Of Room *</label>
                                            <select name="troom"  class="form-control" required>
												<option value selected ></option>
                                                <option value="Superior Room">SUPERIOR ROOM</option>
                                                <option value="Deluxe Room">DELUXE ROOM</option>
												<option value="Guest House">GUEST HOUSE</option>
												<option value="Single Room">SINGLE ROOM</option>
												<option value="Ocean View Single">OCEAN VIEW SINGLE</option>
												<option value="Ocean View Double">OCEAN VIEW DOUBLE</option>
												<option value="Beach Suite">BEACH SUITE</option>
												<option value="Family Room">FAMILY ROOM</option>
												<option value="Deluxe Suite">DELUXE SUITE</option>
												<option value="Luxury Room">LUXURY ROOM</option>
                                            </select>
                              </div>
							  
							  <?php
							  // Only show room number field if column exists
							  $check_col = mysqli_query($con, "SHOW COLUMNS FROM room LIKE 'room_number'");
							  if(mysqli_num_rows($check_col) > 0) {
							  ?>
							  <div class="form-group">
                                            <label>Room Number *</label>
                                            <input name="room_number" type="text" class="form-control" placeholder="e.g. 101, 102, 201" required>
											<small class="form-text text-muted">Each room must have a unique number</small>
                              </div>
							  <?php } ?>
							  
								<div class="form-group">
                                            <label>Bedding Type</label>
                                            <select name="bed" class="form-control" required>
												<option value selected ></option>
                                                <option value="Single">Single</option>
                                                <option value="Double">Double</option>
												<option value="Triple">Triple</option>
                                                <option value="Quad">Quad</option>
												<option value="King Size">King Size</option>
												<option value="Queen Size">Queen Size</option>
												<option value="Twin">Twin</option>
												<option value="Twin + Sofa Bed">Twin + Sofa Bed</option>
												<option value="None">None</option>
                                                                                             
                                            </select>
                                            
                               </div>
							 <input type="submit" name="add" value="Add New" class="btn btn-primary"> 
							</form>
							<?php
							 include('db.php');
							 if(isset($_POST['add']))
							 {
										$room = $_POST['troom'];
										$bed = $_POST['bed'];
										$room_number = isset($_POST['room_number']) ? $_POST['room_number'] : '';
										$place = 'Free';
										$status = 'Available';
										
										// Check if room_number column exists
										$check_column = mysqli_query($con, "SHOW COLUMNS FROM room LIKE 'room_number'");
										$has_room_number = mysqli_num_rows($check_column) > 0;
										
										if($has_room_number && !empty($room_number)) {
											// Check if room number already exists
											$check="SELECT * FROM room WHERE room_number = '$room_number'";
											$rs = mysqli_query($con,$check);
											$data = mysqli_fetch_array($rs, MYSQLI_NUM);
											
											if($data && $data[0] >= 1) {
												echo "<script type='text/javascript'> alert('Room Number Already Exists! Please use a different room number.')</script>";
											}
											else
											{
												$sql ="INSERT INTO `room`(`type`, `bedding`, `room_number`, `place`, `status`) VALUES ('$room','$bed','$room_number','$place','$status')" ;
												if(mysqli_query($con,$sql))
												{
												 echo '<script>alert("New Room Added Successfully!") </script>' ;
												}else {
													echo '<script>alert("Error: ' . mysqli_error($con) . '") </script>' ;
												}
											}
										}
										elseif($has_room_number && empty($room_number)) {
											echo '<script>alert("Please enter a room number!") </script>' ;
										}
										else
										{
											// Old database without room_number column - use old method
											$check="SELECT * FROM room WHERE type = '$room' AND bedding = '$bed'";
											$rs = mysqli_query($con,$check);
											$data = mysqli_fetch_array($rs, MYSQLI_NUM);
											
											if($data && $data[0] >= 1) {
												echo "<script type='text/javascript'> alert('Room Already Exists')</script>";
											}
											else
											{
												$sql ="INSERT INTO `room`(`type`, `bedding`, `place`, `status`) VALUES ('$room','$bed','$place','$status')" ;
												if(mysqli_query($con,$sql))
												{
												 echo '<script>alert("New Room Added! Note: Run migration script to enable room numbers.") </script>' ;
												}else {
													echo '<script>alert("Error: ' . mysqli_error($con) . '") </script>' ;
												}
											}
										}
							}
							
							?>
                        </div>
                        
                    </div>
                </div>
                
                  
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            ROOMS INFORMATION
                        </div>
                        <div class="panel-body">
								<!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <?php
						$sql = "select * from room limit 0,10";
						$re = mysqli_query($con,$sql);
						
						// Check if room_number column exists for display
						$check_rn = mysqli_query($con, "SHOW COLUMNS FROM room LIKE 'room_number'");
						$show_room_number = mysqli_num_rows($check_rn) > 0;
						?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <?php if($show_room_number) { echo '<th>Room Number</th>'; } ?>
                                            <th>Room Type</th>
											<th>Bedding</th>
											<th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										while($row= mysqli_fetch_array($re))
										{
												$id = $row['id'];
												$room_num = ($show_room_number && isset($row['room_number'])) ? $row['room_number'] : '-';
												$status = isset($row['status']) ? $row['status'] : 'Available';
												$status_color = ($status == 'Available') ? 'green' : 'red';
												
											if($id % 2 == 0) 
											{
												echo "<tr class='odd gradeX'>
													<td>".$row['id']."</td>";
												if($show_room_number) {
													echo "<td><strong>".$room_num."</strong></td>";
												}
												echo "<td>".$row['type']."</td>
												   <td>".$row['bedding']."</td>
												   <td style='color:$status_color; font-weight:bold;'>".$status."</td>
												</tr>";
											}
											else
											{
												echo "<tr class='even gradeC'>
													<td>".$row['id']."</td>";
												if($show_room_number) {
													echo "<td><strong>".$room_num."</strong></td>";
												}
												echo "<td>".$row['type']."</td>
												   <td>".$row['bedding']."</td>
												   <td style='color:$status_color; font-weight:bold;'>".$status."</td>
												</tr>";
											
											}
										}
									?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                    
                       
                            
							  
							 
							 
							  
							  
							   
                       </div>
                        
                    </div>
                </div>
                
               
            </div>
                    
            
				
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
      <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>

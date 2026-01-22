<?php
session_start();
include('db.php');

// Check if cart has items
if (!isset($_SESSION['room_cart']) || empty($_SESSION['room_cart'])) {
    header('Location: rooms.php');
    exit;
}

$cart_rooms = $_SESSION['room_cart'];

// Define pricing for different room types
$room_prices = array(
    'Ocean View Single' => 22000,
    'Ocean View Double' => 32000,
    'Beach Suite' => 45000,
    'Family Room' => 38000,
    'Deluxe Suite' => 55000,
    'Deluxe Room' => 45000,
    'Luxury Room' => 32000,
    'Guest House' => 26000,
    'Single Room' => 22000,
    'Superior Room' => 35000,
    'Presidential Suite' => 75000,
    'Honeymoon Suite' => 60000
);

// Calculate total
$total_per_night = 0;
foreach ($cart_rooms as $room) {
    $room_name = $room['type'];
    $price = isset($room_prices[$room_name]) ? $room_prices[$room_name] : 30000;
    $total_per_night += $price;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MULTI-ROOM RESERVATION - OCEAN VIEW HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="admin/assets/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom Styles-->
    <link href="admin/assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <style>
       .selected-rooms-panel {
           background: #f9f9f9;
           border: 2px solid #ffce14;
           border-radius: 8px;
           padding: 20px;
           margin-bottom: 20px;
       }
       .room-item {
           background: white;
           padding: 15px;
           margin-bottom: 10px;
           border-radius: 5px;
           border-left: 4px solid #28a745;
       }
       .room-item h5 {
           color: #333;
           margin-bottom: 10px;
           font-weight: 600;
       }
       .room-item-details {
           font-size: 14px;
           color: #666;
           margin-bottom: 5px;
       }
       .total-summary {
           background: #2c3e50;
           color: white;
           padding: 20px;
           border-radius: 8px;
           margin-top: 15px;
       }
       .total-summary h4 {
           margin-bottom: 15px;
       }
       .total-line {
           display: flex;
           justify-content: space-between;
           margin-bottom: 10px;
           font-size: 16px;
       }
       .grand-total {
           font-size: 24px;
           font-weight: 700;
           border-top: 2px solid #ffce14;
           padding-top: 15px;
           margin-top: 15px;
       }
       .panel-heading {
           background: #2c3e50 !important;
           color: white !important;
       }
       .alert-info {
           background: #d1ecf1;
           border: 1px solid #bee5eb;
           color: #0c5460;
           padding: 15px;
           border-radius: 5px;
           margin-bottom: 20px;
       }
   </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="index.php"><i class="fa fa-home"></i> Homepage</a>
                    </li>
                    <li>
                        <a href="rooms.php"><i class="fa fa-arrow-left"></i> Back to Rooms</a>
                    </li>
				</ul>
            </div>
        </nav>
       
        <div id="page-wrapper">
            <div id="page-inner">
			    <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            MULTI-ROOM RESERVATION <small>Complete Your Booking</small>
                        </h1>
                    </div>
                </div>
                
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> <strong>You are booking <?php echo count($cart_rooms); ?> room(s).</strong> 
                    Please fill in your details below. All rooms will be booked under the same guest information and dates.
                </div>
                
                <div class="row">
                    <!-- Selected Rooms Panel -->
                    <div class="col-md-12">
                        <div class="selected-rooms-panel">
                            <h3 style="margin-top: 0; color: #2c3e50;">
                                <i class="fa fa-shopping-cart"></i> Your Selected Rooms
                            </h3>
                            
                            <?php foreach ($cart_rooms as $index => $room): 
                                $room_name = $room['type'];
                                $price = isset($room_prices[$room_name]) ? $room_prices[$room_name] : 30000;
                            ?>
                            <div class="room-item">
                                <h5><i class="fa fa-bed"></i> <?php echo $room_name; ?></h5>
                                <div class="room-item-details">
                                    <i class="fa fa-door-open"></i> Room #<?php echo $room['room_number']; ?> | 
                                    <i class="fa fa-bed"></i> <?php echo $room['bedding']; ?> Bedding | 
                                    <span style="color: #28a745; font-weight: 600;">
                                        <i class="fa fa-money"></i> LKR <?php echo number_format($price); ?>/night
                                    </span>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            
                            <div class="total-summary">
                                <h4><i class="fa fa-calculator"></i> Price Summary</h4>
                                <div class="total-line">
                                    <span>Number of Rooms:</span>
                                    <span><?php echo count($cart_rooms); ?></span>
                                </div>
                                <div class="total-line">
                                    <span>Total Per Night:</span>
                                    <span>LKR <?php echo number_format($total_per_night); ?></span>
                                </div>
                                <div class="total-line grand-total">
                                    <span>Estimated Total:</span>
                                    <span id="grandTotal">LKR <?php echo number_format($total_per_night); ?></span>
                                </div>
                                <p style="font-size: 12px; margin-top: 10px; margin-bottom: 0; opacity: 0.8;">
                                    <i class="fa fa-info-circle"></i> Final amount will be calculated based on your stay duration (check-in to check-out dates)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Personal Information -->
                    <div class="col-md-6 col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-user"></i> PERSONAL INFORMATION
                            </div>
                            <div class="panel-body">
                                <form name="form" method="post" id="bookingForm">
                                    <div class="form-group">
                                        <label>Title*</label>
                                        <select name="title" class="form-control" required>
                                            <option value="" selected></option>
                                            <option value="Dr.">Dr.</option>
                                            <option value="Miss.">Miss.</option>
                                            <option value="Mr.">Mr.</option>
                                            <option value="Mrs.">Mrs.</option>
                                            <option value="Prof.">Prof.</option>
                                            <option value="Rev.">Rev.</option>
                                            <option value="Rev. Fr.">Rev. Fr.</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name*</label>
                                        <input name="fname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name*</label>
                                        <input name="lname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email*</label>
                                        <input name="email" type="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nationality*</label>
                                        <div>
                                            <label class="radio-inline">
                                                <input type="radio" name="nation" value="Sri Lankan" checked> Sri Lankan
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="nation" value="Non Sri Lankan"> Non Sri Lankan
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
                                    ?>
                                    <div class="form-group">
                                        <label>Passport Country*</label>
                                        <select name="country" class="form-control" required>
                                            <option value="" selected></option>
                                            <?php
                                            foreach($countries as $country) {
                                                echo '<option value="'.$country.'">'.$country.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number*</label>
                                        <input name="phone" type="text" class="form-control" required>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Reservation Information -->
                    <div class="col-md-6 col-sm-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <i class="fa fa-calendar"></i> RESERVATION INFORMATION
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>Meal Plan*</label>
                                    <select name="meal" class="form-control" required>
                                        <option value="" selected></option>
                                        <option value="Room only">Room only</option>
                                        <option value="Breakfast">Breakfast</option>
                                        <option value="Half Board">Half Board</option>
                                        <option value="Full Board">Full Board</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Check-In Date*</label>
                                    <input name="cin" id="checkin" type="date" class="form-control" required onchange="calculateTotal()">
                                </div>
                                <div class="form-group">
                                    <label>Check-Out Date*</label>
                                    <input name="cout" id="checkout" type="date" class="form-control" required onchange="calculateTotal()">
                                </div>
                                <div class="form-group">
                                    <label>Number of Days:</label>
                                    <input type="text" id="numDays" class="form-control" readonly value="0" style="background: #f5f5f5; font-weight: 600;">
                                </div>
                                
                                <div class="alert alert-success" style="margin-top: 20px;">
                                    <h4 style="margin-top: 0;"><i class="fa fa-info-circle"></i> Booking Details</h4>
                                    <p><strong>Rooms:</strong> <?php echo count($cart_rooms); ?> room(s)</p>
                                    <p><strong>Total Per Night:</strong> LKR <?php echo number_format($total_per_night); ?></p>
                                    <p style="margin-bottom: 0;"><strong>Estimated Total:</strong> <span id="estimatedTotal">LKR <?php echo number_format($total_per_night); ?></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Verification and Submit -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="well">
                            <h4><i class="fa fa-lock"></i> HUMAN VERIFICATION</h4>
                            <p>Type this code: <strong style="font-size: 20px; color: #ff6b6b;"><?php $Random_code=rand(); echo $Random_code; ?></strong></p>
                            <div class="form-group">
                                <input type="text" name="code1" class="form-control" placeholder="Enter the code above" required style="max-width: 300px; display: inline-block;">
                                <input type="hidden" name="code" value="<?php echo $Random_code; ?>">
                                <input type="hidden" name="room_ids" value="<?php echo implode(',', array_column($cart_rooms, 'id')); ?>">
                                <input type="hidden" name="total_price" id="totalPriceInput" value="<?php echo $total_per_night; ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg" style="background: #ffce14; border: none; color: #2c3e50; font-weight: 600;">
                                <i class="fa fa-check-circle"></i> Confirm Booking
                            </button>
                            <a href="rooms.php" class="btn btn-default btn-lg">
                                <i class="fa fa-arrow-left"></i> Back to Rooms
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php
                if(isset($_POST['submit'])) {
                    $code1 = $_POST['code1'];
                    $code = $_POST['code']; 
                    
                    if($code1 != "$code") {
                        echo "<div class='alert alert-danger'><i class='fa fa-times'></i> Invalid verification code!</div>";
                    } else {
                        $con = mysqli_connect("localhost", "root", "", "hotel");
                        
                        // Check if user already exists
                        $email = mysqli_real_escape_string($con, $_POST['email']);
                        $check = "SELECT * FROM roombook WHERE email = '$email'";
                        $rs = mysqli_query($con, $check);
                        $data = mysqli_fetch_array($rs, MYSQLI_NUM);
                        
                        if($data[0] > 1) {
                            echo "<script type='text/javascript'> alert('User Already Exists'); window.location.href='multi_reservation.php';</script>";
                        } else {
                            // Book all rooms
                            $success_count = 0;
                            $room_ids = explode(',', $_POST['room_ids']);
                            
                            foreach($cart_rooms as $room) {
                                $new = "Not Conform";
                                $title = mysqli_real_escape_string($con, $_POST['title']);
                                $fname = mysqli_real_escape_string($con, $_POST['fname']);
                                $lname = mysqli_real_escape_string($con, $_POST['lname']);
                                $email = mysqli_real_escape_string($con, $_POST['email']);
                                $nation = mysqli_real_escape_string($con, $_POST['nation']);
                                $country = mysqli_real_escape_string($con, $_POST['country']);
                                $phone = mysqli_real_escape_string($con, $_POST['phone']);
                                $troom = mysqli_real_escape_string($con, $room['type']);
                                $bed = mysqli_real_escape_string($con, $room['bedding']);
                                $meal = mysqli_real_escape_string($con, $_POST['meal']);
                                $cin = mysqli_real_escape_string($con, $_POST['cin']);
                                $cout = mysqli_real_escape_string($con, $_POST['cout']);
                                $room_num = mysqli_real_escape_string($con, $room['room_number']);
                                
                                $newUser = "INSERT INTO `roombook`(`Title`, `FName`, `LName`, `Email`, `National`, `Country`, `Phone`, `TRoom`, `Bed`, `NRoom`, `Meal`, `cin`, `cout`,`stat`,`nodays`) 
                                            VALUES ('$title','$fname','$lname','$email','$nation','$country','$phone','$troom (Room #$room_num)','$bed','1','$meal','$cin','$cout','$new',DATEDIFF('$cout','$cin'))";
                                
                                if (mysqli_query($con, $newUser)) {
                                    // Update room status to booked
                                    $update_room = "UPDATE room SET status = 'Booked' WHERE id = " . $room['id'];
                                    mysqli_query($con, $update_room);
                                    $success_count++;
                                }
                            }
                            
                            if($success_count == count($cart_rooms)) {
                                // Clear cart
                                $_SESSION['room_cart'] = array();
                                
                                echo "<script type='text/javascript'> 
                                    alert('Success! All " . $success_count . " rooms have been booked.\\n\\nYour booking applications have been sent for confirmation.');
                                    window.location.href='index.php';
                                </script>";
                            } else {
                                echo "<script type='text/javascript'> 
                                    alert('Partial success: " . $success_count . " out of " . count($cart_rooms) . " rooms were booked.');
                                </script>";
                            }
                        }
                    }
                }
                ?>
                
                </form>
            </div>
        </div>
    </div>
    
    <!-- JS Scripts-->
    <script src="admin/assets/js/jquery-1.10.2.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>
    <script src="admin/assets/js/jquery.metisMenu.js"></script>
    <script src="admin/assets/js/custom-scripts.js"></script>
    
    <script>
    const totalPerNight = <?php echo $total_per_night; ?>;
    
    function calculateTotal() {
        const checkin = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        
        if(checkin && checkout) {
            const date1 = new Date(checkin);
            const date2 = new Date(checkout);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if(diffDays > 0 && date2 > date1) {
                document.getElementById('numDays').value = diffDays + ' day(s)';
                const grandTotal = totalPerNight * diffDays;
                document.getElementById('grandTotal').textContent = 'LKR ' + grandTotal.toLocaleString();
                document.getElementById('estimatedTotal').textContent = 'LKR ' + grandTotal.toLocaleString();
                document.getElementById('totalPriceInput').value = grandTotal;
            } else {
                document.getElementById('numDays').value = '0';
                document.getElementById('grandTotal').textContent = 'LKR ' + totalPerNight.toLocaleString();
                document.getElementById('estimatedTotal').textContent = 'LKR ' + totalPerNight.toLocaleString();
                if(date2 <= date1) {
                    alert('Check-out date must be after check-in date!');
                }
            }
        }
    }
    
    // Set minimum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('checkin').setAttribute('min', today);
    document.getElementById('checkout').setAttribute('min', today);
    </script>
</body>
</html>

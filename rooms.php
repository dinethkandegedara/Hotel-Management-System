<?php
include('db.php');

// Get filter parameters
$room_type = isset($_GET['type']) ? trim($_GET['type']) : '';
$bedding = isset($_GET['bedding']) ? trim($_GET['bedding']) : '';
$max_price = isset($_GET['max_price']) ? trim($_GET['max_price']) : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build query with filters - using simple mysqli_query for better compatibility
$query = "SELECT * FROM room WHERE 1=1";

if (!empty($room_type)) {
    $room_type_escaped = mysqli_real_escape_string($con, $room_type);
    $query .= " AND type LIKE '%$room_type_escaped%'";
}

if (!empty($bedding)) {
    $bedding_escaped = mysqli_real_escape_string($con, $bedding);
    $query .= " AND bedding LIKE '%$bedding_escaped%'";
}

if (!empty($search)) {
    $search_escaped = mysqli_real_escape_string($con, $search);
    $query .= " AND (type LIKE '%$search_escaped%' OR place LIKE '%$search_escaped%' OR bedding LIKE '%$search_escaped%')";
}

$query .= " ORDER BY id ASC";

// Execute query
$result = mysqli_query($con, $query);

// Check for query errors
if (!$result) {
    die("Database query failed: " . mysqli_error($con));
}

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

// Room ratings
$room_ratings = array(
    'Ocean View Single' => 3,
    'Ocean View Double' => 4,
    'Beach Suite' => 5,
    'Family Room' => 4,
    'Deluxe Suite' => 5,
    'Deluxe Room' => 4,
    'Luxury Room' => 4,
    'Guest House' => 3,
    'Single Room' => 2,
    'Superior Room' => 4,
    'Presidential Suite' => 5,
    'Honeymoon Suite' => 5
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Rooms & Rates - OCEAN VIEW HOTEL</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Ocean View Hotel Rooms, Kalpitiya Beach Rooms, Hotel Reservations" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
<style>
/* Rooms Page Specific Styles */
.rooms-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    color: white;
    padding: 60px 0 40px;
    margin-top: 0;
    position: relative;
    overflow: hidden;
}

.rooms-header::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: #ffce14;
}

.rooms-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 15px;
}

.rooms-header p {
    font-size: 18px;
    opacity: 0.9;
}

.search-filter-section {
    background: #f8f9fa;
    padding: 30px 0;
    margin-bottom: 40px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.search-box {
    position: relative;
    margin-bottom: 20px;
}

.search-box input {
    width: 100%;
    padding: 15px 50px 15px 20px;
    border: 2px solid #ddd;
    border-radius: 30px;
    font-size: 16px;
    transition: all 0.3s;
}

.search-box input:focus {
    border-color: #ffce14;
    outline: none;
    box-shadow: 0 0 10px rgba(255, 206, 20, 0.3);
}

.search-box button {
    position: absolute;
    right: 5px;
    top: 5px;
    background: #ffce14;
    border: none;
    padding: 10px 25px;
    border-radius: 25px;
    color: #2c3e50;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.search-box button:hover {
    background: #f0c000;
}

.filter-options {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.filter-group {
    flex: 1;
    min-width: 200px;
}

.filter-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #333;
}

.filter-group select {
    width: 100%;
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s;
}

.filter-group select:focus {
    border-color: #ffce14;
    outline: none;
}

.filter-buttons {
    display: flex;
    gap: 10px;
    align-items: flex-end;
}

.btn-filter {
    padding: 12px 30px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s;
}

.btn-apply {
    background: #ffce14;
    color: #2c3e50;
    font-weight: 600;
}

.btn-apply:hover {
    background: #f0c000;
}

.btn-clear {
    background: #6c757d;
    color: white;
}

.btn-clear:hover {
    background: #5a6268;
}

.rooms-grid {
    padding: 40px 0;
}

.room-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.room-image {
    position: relative;
    overflow: hidden;
    height: 250px;
}

.room-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s;
}

.room-card:hover .room-image img {
    transform: scale(1.1);
}

.room-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(102, 126, 234, 0.9);
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.room-details {
    padding: 25px;
}

.room-title {
    font-size: 24px;
    font-weight: 700;
    color: #333;
    margin-bottom: 10px;
}

.room-rating {
    margin-bottom: 15px;
}

.room-rating i {
    color: #ffc107;
    font-size: 16px;
}

.room-features {
    list-style: none;
    padding: 0;
    margin: 15px 0;
}

.room-features li {
    padding: 8px 0;
    color: #666;
    border-bottom: 1px solid #f0f0f0;
}

.room-features li:last-child {
    border-bottom: none;
}

.room-features i {
    color: #ffce14;
    margin-right: 10px;
    width: 20px;
}

.room-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 25px;
    background: #f8f9fa;
    border-top: 1px solid #e9ecef;
}

.room-price {
    font-size: 28px;
    font-weight: 700;
    color: #28a745;
}

.room-price span {
    font-size: 16px;
    color: #666;
    font-weight: 400;
}

.btn-book {
    background: #ffce14;
    color: #2c3e50;
    padding: 12px 30px;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s;
    border: none;
}

.btn-book:hover {
    background: #f0c000;
    color: #2c3e50;
    text-decoration: none;
    transform: translateY(-2px);
}

.no-rooms {
    text-align: center;
    padding: 60px 20px;
    color: #666;
}

.no-rooms i {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 20px;
}

.no-rooms h3 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .filter-options {
        flex-direction: column;
    }
    
    .filter-group {
        width: 100%;
    }
    
    .rooms-header h1 {
        font-size: 32px;
    }
}
</style>
</head>
<body>
<!-- header -->
<div class="banner-top">
			<div class="contact-bnr-w3-agile">
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@oceanviewhotel.com">INFO@OCEANVIEWHOTEL.COM</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>+94 (32)225-8800</li>	
					<li style="margin-left: 20px;"><a href="admin/index.php" class="btn btn-primary btn-sm" style="background-color: #ff6b6b; border: none; padding: 8px 20px; border-radius: 4px;">Admin Login</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
	<div class="w3_navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="navbar-header navbar-left">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1><a class="navbar-brand" href="index.php">OCEAN <span>VIEW</span><p class="logo_w3l_agile_caption">Kalpitiya Beach Hotel</p></a></h1>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
					<nav class="menu menu--iris">
						<ul class="nav navbar-nav menu__list">
							<li class="menu__item"><a href="index.php" class="menu__link">Home</a></li>
							<li class="menu__item"><a href="index.php#about" class="menu__link scroll">About</a></li>
							<li class="menu__item menu__item--current"><a href="rooms.php" class="menu__link">Rooms</a></li>
							<li class="menu__item"><a href="food_order.php" class="menu__link">Food Order</a></li>
						</ul>
					</nav>
				</div>
			</nav>
		</div>
	</div>
<!-- //header -->

<!-- Rooms Header -->
<div class="rooms-header">
    <div class="container">
        <h1>Our Rooms & Rates</h1>
        <p>Discover the perfect accommodation for your Kalpitiya beach getaway</p>
        <?php 
        $total_rooms = mysqli_num_rows($result);
        if (!empty($search) || !empty($room_type) || !empty($bedding)) {
            echo "<p style='margin-top: 10px; font-size: 16px;'><strong>$total_rooms</strong> room(s) found</p>";
        }
        ?>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="search-filter-section">
    <div class="container">
        <?php
        // Show active filters
        $active_filters = array();
        if (!empty($search)) $active_filters[] = "Search: '$search'";
        if (!empty($room_type)) $active_filters[] = "Type: '$room_type'";
        if (!empty($bedding)) $active_filters[] = "Bedding: '$bedding'";
        
        if (count($active_filters) > 0) {
            echo "<div style='background: #fff3cd; border: 1px solid #ffc107; padding: 12px; border-radius: 8px; margin-bottom: 20px;'>";
            echo "<strong><i class='fa fa-filter'></i> Active Filters:</strong> " . implode(" | ", $active_filters);
            echo " <a href='rooms.php' style='margin-left: 15px; color: #dc3545;'><i class='fa fa-times'></i> Clear All</a>";
            echo "</div>";
        }
        ?>
        <form method="GET" action="rooms.php" id="filterForm">
            <div class="search-box">
                <input type="text" name="search" placeholder="Search rooms by name, amenities, or location..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit"><i class="fa fa-search"></i> Search</button>
            </div>
            
            <div class="filter-options">
                <div class="filter-group">
                    <label><i class="fa fa-bed"></i> Room Type</label>
                    <select name="type">
                        <option value="">All Room Types</option>
                        <option value="Single" <?php echo ($room_type == 'Single') ? 'selected' : ''; ?>>Single Rooms</option>
                        <option value="Double" <?php echo ($room_type == 'Double') ? 'selected' : ''; ?>>Double Rooms</option>
                        <option value="Suite" <?php echo ($room_type == 'Suite') ? 'selected' : ''; ?>>Suites</option>
                        <option value="Family" <?php echo ($room_type == 'Family') ? 'selected' : ''; ?>>Family Rooms</option>
                        <option value="Deluxe" <?php echo ($room_type == 'Deluxe') ? 'selected' : ''; ?>>Deluxe Rooms</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label><i class="fa fa-users"></i> Bedding Type</label>
                    <select name="bedding">
                        <option value="">All Bedding Types</option>
                        <option value="Single" <?php echo ($bedding == 'Single') ? 'selected' : ''; ?>>Single Bed</option>
                        <option value="Double" <?php echo ($bedding == 'Double') ? 'selected' : ''; ?>>Double Bed</option>
                        <option value="King" <?php echo ($bedding == 'King') ? 'selected' : ''; ?>>King Size</option>
                        <option value="Twin" <?php echo ($bedding == 'Twin') ? 'selected' : ''; ?>>Twin Beds</option>
                    </select>
                </div>
                
                <div class="filter-buttons">
                    <button type="submit" class="btn-filter btn-apply"><i class="fa fa-filter"></i> Apply Filters</button>
                    <a href="rooms.php" class="btn-filter btn-clear"><i class="fa fa-refresh"></i> Clear</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Rooms Grid -->
<div class="rooms-grid">
    <div class="container">
        <div class="row">
            <?php
            $room_count = 0;
            $room_images = array('r1.jpg', 'r2.jpg', 'r3.jpg', 'r4.jpg');
            
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $room_count++;
                    $room_name = $row['type'];
                    $price = isset($room_prices[$room_name]) ? $room_prices[$room_name] : 30000;
                    $rating = isset($room_ratings[$room_name]) ? $room_ratings[$room_name] : 3;
                    $image = $room_images[($room_count - 1) % 4];
                    
                    // Apply price filter if set
                    if (!empty($max_price) && $price > $max_price) {
                        continue;
                    }
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="room-card">
                    <div class="room-image">
                        <img src="images/<?php echo $image; ?>" alt="<?php echo $room_name; ?>">
                        <?php if ($row['place'] == 'Ocean Front') { ?>
                        <div class="room-badge">Ocean View</div>
                        <?php } ?>
                    </div>
                    
                    <div class="room-details">
                        <h3 class="room-title"><?php echo $room_name; ?></h3>
                        
                        <div class="room-rating">
                            <?php 
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $rating) {
                                    echo '<i class="fa fa-star"></i>';
                                } else {
                                    echo '<i class="fa fa-star-o"></i>';
                                }
                            }
                            ?>
                        </div>
                        
                        <ul class="room-features">
                            <li><i class="fa fa-bed"></i> Bedding: <?php echo isset($row['bedding']) ? $row['bedding'] : 'N/A'; ?></li>
                            <li><i class="fa fa-map-marker"></i> <?php echo isset($row['place']) ? $row['place'] : 'N/A'; ?></li>
                            <li><i class="fa fa-wifi"></i> <?php echo isset($row['area']) ? $row['area'] : 'N/A'; ?></li>
                            <li><i class="fa fa-expand"></i> <?php echo isset($row['size']) ? $row['size'] : 'N/A'; ?></li>
                        </ul>
                    </div>
                    
                    <div class="room-footer">
                        <div class="room-price">
                            <span>LKR</span> <?php echo number_format($price); ?>
                            <span>/night</span>
                        </div>
                        <a href="admin/reservation.php" class="btn-book">Book Now</a>
                    </div>
                </div>
            </div>
            <?php 
                }
            } else {
            ?>
            <div class="col-md-12">
                <div class="no-rooms">
                    <i class="fa fa-bed"></i>
                    <h3>No rooms found</h3>
                    <p>Try adjusting your search or filter criteria</p>
                    <a href="rooms.php" class="btn-filter btn-apply" style="margin-top: 20px; display: inline-block;">View All Rooms</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="copy">
    <p>© 2025 OCEAN VIEW HOTEL . All Rights Reserved | Design by <a href="index.php">OCEAN VIEW HOTEL</a> </p>
</div>

<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
</body>
</html>
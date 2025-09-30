<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>OCEAN VIEW HOTEL</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/swipebox.css" rel="stylesheet">
<!-- web font -->
<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<!-- //web font -->
</head>
<body>
<!-- header -->
<div class="header" id="home">
	<div class="content white">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!--/.navbar-header-->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<nav class="link-effect-2" id="link-effect-2">
						<ul class="nav1 nav navbar-nav">
							<li><a href="index.php" class="effect-3">Home</a></li>
							<li><a href="index.php#about" class="effect-3">About</a></li>
							<li><a href="index.php#gallery" class="effect-3">Gallery</a></li>
							<li><a href="index.php#rooms" class="effect-3">Rooms</a></li>
							<li><a href="food_order.php" class="effect-3">Food Order</a></li>
							<li><a href="index.php#contact" class="effect-3">Contact Us</a></li>
						</ul>
					</nav>
				</div>
				<!--/.navbar-collapse-->
				<!--/.navbar-->
			</div>
		</nav>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
			<p>Call us : <span>+94 (32)225-8800</span></p>
		</div>
		<div class="col-md-4 logo">
			<h1><a href="index.php">OCEAN VIEW<br><span>KALPITIYA BEACH HOTEL</span></a></h1>
		</div>
		<div class="col-md-4 header-right">
			<p><i class="fa fa-map-marker" aria-hidden="true"></i>Kalpitiya Beach Side, 1km from Kalpitiya Town, Sri Lanka</p>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //header-bot -->

<!-- food order section -->
<div class="banner-bottom">
	<div class="container">	
		<div class="agileits_banner_bottom">
			<div class="col-md-12 wthree_banner_bottom_right">
				<h3 class="title-w3-agileits title-black-wthree">Room Service - <span class="title-w3-agileits1">Food Order</span></h3>
				
				<div class="food-order-container">
					<form method="post" id="foodOrderForm">
						<div class="customer-email-section">
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<div class="form-group">
										<label for="customer_email">Customer Email <span style="color:red;">*</span></label>
										<input type="email" name="customer_email" id="customer_email" class="form-control" required placeholder="Enter your email for order confirmation">
									</div>
								</div>
							</div>
						</div>
						
						<div class="food-menu">
							<?php
							// Get all categories
							$categories_sql = "SELECT DISTINCT category FROM foods ORDER BY category";
							$categories_result = mysqli_query($con, $categories_sql);
							
							while($category_row = mysqli_fetch_array($categories_result)) {
								$category = $category_row['category'];
								echo "<div class='food-category'>";
								echo "<h3 class='category-title'>".$category."</h3>";
								echo "<div class='row'>";
								
								// Get foods for this category
								$food_sql = "SELECT * FROM foods WHERE category = '$category' ORDER BY name";
								$food_result = mysqli_query($con, $food_sql);
								
								while($food = mysqli_fetch_array($food_result)) {
									echo "<div class='col-md-4 col-sm-6 mb-4'>";
									echo "<div class='food-item'>";
									echo "<h5>".$food['name']."</h5>";
									echo "<p class='price'>LKR ".number_format($food['price'], 2)."</p>";
									echo "<div class='quantity-control'>";
									echo "<label>Quantity:</label>";
									echo "<select name='quantity[".$food['id']."]' class='form-control quantity-select' data-price='".$food['price']."' data-name='".$food['name']."'>";
									echo "<option value='0'>0</option>";
									for($i = 1; $i <= 10; $i++) {
										echo "<option value='$i'>$i</option>";
									}
									echo "</select>";
									echo "</div>";
									echo "</div>";
									echo "</div>";
								}
								echo "</div>";
								echo "</div>";
							}
							?>
						</div>
						
						<div class="order-summary-section">
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<div class="order-summary">
										<h4>Order Summary</h4>
										<div id="orderItems"></div>
										<div class="total-section">
											<h5>Total: LKR <span id="totalAmount">0.00</span></h5>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="order-actions">
							<div class="text-center">
								<button type="submit" name="place_order" class="btn btn-success btn-lg">Place Order</button>
								<button type="button" class="btn btn-secondary" onclick="clearOrder()">Clear Order</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- //food order section -->

<!-- contact -->
<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
			<div class="contact-agileits">
				<h4>Contact Us</h4>
				<p class="contact-agile2">Sign Up For Our News Letters</p>
				<form  method="post" name="sentMessage" id="contactForm" >
					<div class="control-group form-group">
                        
                            <label class="contact-p1">Full Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required >
                            <p class="help-block"></p>
                       
                    </div>	
                    <div class="control-group form-group">
                        
                            <label class="contact-p1">Phone Number:</label>
                            <input type="tel" class="form-control" name="phone" id="phone" required >
							<p class="help-block"></p>
						
                    </div>
                    <div class="control-group form-group">
                        
                            <label class="contact-p1">Email Address:</label>
                            <input type="email" class="form-control" name="email" id="email" required >
							<p class="help-block"></p>
						
                    </div>
                    
                    
                    <input type="submit" name="sub" value="Send Now" class="btn btn-primary">	
				</form>
				<?php
				if(isset($_POST['sub']))
				{
					$name =$_POST['name'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$approval = "Not Allowed";
					$sql = "INSERT INTO `contact`(`fullname`, `phoneno`, `email`,`cdate`,`approval`) VALUES ('$name','$phone','$email',now(),'$approval')" ;
					
					
					if(mysqli_query($con,$sql))
					echo"OK";
					
				}
				?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
			<h4>Connect With Us</h4>
			<p class="contact-agile1"><strong>Phone :</strong>+94 (32)225-8800</p>
			<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:info@oceanviewhotel.com">INFO@OCEANVIEWHOTEL.COM</a></p>
			<p class="contact-agile1"><strong>Address :</strong> Kalpitiya Beach Side, 1km from Kalpitiya Town, Sri Lanka</p>
																
			<div class="social-bnr-agileits footer-icons-agileinfo">
				<ul class="social-icons3">
								<li><a href="#" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="#" class="fa fa-google-plus icon-border googleplus"> </a></li> 
								
							</ul>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- /contact -->
<div class="copy">
	<p>© 2025 OCEAN VIEW HOTEL . All Rights Reserved | Design by <a href="index.php">OCEAN VIEW HOTEL</a> </p>
</div>
<!--/footer -->

<!-- Custom CSS for Food Order Page -->
<style>
/* Food Order Page Specific Styles */
.food-order-container {
    padding: 40px 0;
}

.customer-email-section {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 40px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.customer-email-section label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 10px;
}

.food-category {
    margin-bottom: 50px;
}

.category-title {
    color: #2c3e50;
    font-size: 2.2em;
    font-weight: 700;
    text-align: center;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
}

.category-title:after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: #ffce14;
}

.food-item {
    background: white;
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.food-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    border-color: #ffce14;
}

.food-item h5 {
    color: #2c3e50;
    font-size: 1.4em;
    font-weight: 700;
    margin-bottom: 15px;
    text-transform: capitalize;
}

.food-item .price {
    color: #28a745;
    font-size: 1.3em;
    font-weight: 700;
    margin-bottom: 20px;
}

.quantity-control label {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.quantity-select {
    max-width: 80px;
    margin: 0 auto;
    text-align: center;
    font-weight: 600;
}

.order-summary-section {
    margin: 40px 0;
}

.order-summary {
    background: #f8f9fa;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    text-align: center;
}

.order-summary h4 {
    color: #2c3e50;
    font-size: 1.8em;
    font-weight: 700;
    margin-bottom: 20px;
    text-transform: uppercase;
}

.total-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #dee2e6;
}

.total-section h5 {
    color: #28a745;
    font-size: 1.5em;
    font-weight: 700;
}

.order-actions {
    margin: 40px 0;
}

.btn {
    padding: 15px 40px;
    font-size: 1.1em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    border-radius: 30px;
    transition: all 0.3s ease;
    margin: 0 10px;
}

.btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    color: white;
}

.btn-success:hover {
    background: linear-gradient(45deg, #218838, #1ea080);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(40,167,69,0.3);
}

.btn-secondary {
    background: linear-gradient(45deg, #6c757d, #5a6268);
    border: none;
    color: white;
}

.btn-secondary:hover {
    background: linear-gradient(45deg, #5a6268, #495057);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(108,117,125,0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .category-title {
        font-size: 1.8em;
    }
    
    .food-item {
        margin-bottom: 25px;
    }
    
    .btn {
        display: block;
        width: 100%;
        margin: 10px 0;
    }
}
</style>

<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>

<script>
// Order calculation functionality
function updateOrderSummary() {
    var orderItems = [];
    var total = 0;
    
    $('.quantity-select').each(function() {
        var quantity = parseInt($(this).val());
        if (quantity > 0) {
            var price = parseFloat($(this).data('price'));
            var name = $(this).data('name');
            var itemTotal = quantity * price;
            
            orderItems.push({
                name: name,
                quantity: quantity,
                price: price,
                total: itemTotal
            });
            
            total += itemTotal;
        }
    });
    
    // Update order summary
    var summaryHtml = '';
    if (orderItems.length > 0) {
        orderItems.forEach(function(item) {
            summaryHtml += '<div class="order-item">';
            summaryHtml += '<span class="item-name">' + item.name + '</span>';
            summaryHtml += '<span class="item-details"> × ' + item.quantity + ' = LKR ' + item.total.toFixed(2) + '</span>';
            summaryHtml += '</div>';
        });
    } else {
        summaryHtml = '<p class="text-muted">No items selected</p>';
    }
    
    $('#orderItems').html(summaryHtml);
    $('#totalAmount').text(total.toFixed(2));
}

// Clear order function
function clearOrder() {
    $('.quantity-select').val('0');
    updateOrderSummary();
}

$(document).ready(function() {
    // Update order summary when quantities change
    $('.quantity-select').on('change', updateOrderSummary);
    
    // Initial update
    updateOrderSummary();
    
    // Form validation
    $('#foodOrderForm').on('submit', function(e) {
        var hasItems = false;
        $('.quantity-select').each(function() {
            if (parseInt($(this).val()) > 0) {
                hasItems = true;
                return false;
            }
        });
        
        if (!hasItems) {
            e.preventDefault();
            alert('Please select at least one item to order.');
            return false;
        }
        
        var email = $('#customer_email').val();
        if (!email) {
            e.preventDefault();
            alert('Please enter your email address.');
            return false;
        }
    });
});
</script>

<!-- Bootstrap JS -->
<script src="js/bootstrap-3.1.1.min.js"></script>

</body>
</html>

<?php
// Process order submission
if(isset($_POST['place_order'])) {
    $customer_email = mysqli_real_escape_string($con, $_POST['customer_email']);
    $order_time = date('Y-m-d H:i:s');
    $total_bill = 0;
    $orders_placed = 0;
    
    // Process each food item
    if(isset($_POST['quantity'])) {
        foreach($_POST['quantity'] as $food_id => $quantity) {
            if($quantity > 0) {
                // Get food details
                $food_sql = "SELECT * FROM foods WHERE id = '$food_id'";
                $food_result = mysqli_query($con, $food_sql);
                $food = mysqli_fetch_array($food_result);
                
                if($food) {
                    $bill_amount = $food['price'] * $quantity;
                    $total_bill += $bill_amount;
                    
                    // Insert order
                    $order_sql = "INSERT INTO food_orders (email, food_id, quantity, order_time, bill_amount) 
                                 VALUES ('$customer_email', '$food_id', '$quantity', '$order_time', '$bill_amount')";
                    
                    if(mysqli_query($con, $order_sql)) {
                        $orders_placed++;
                    }
                }
            }
        }
    }
    
    if($orders_placed > 0) {
        echo "<script>
                alert('Order placed successfully! Total: LKR " . number_format($total_bill, 2) . "\\nYou will receive confirmation at $customer_email');
                window.location='food_order_new.php';
              </script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }
}
?>
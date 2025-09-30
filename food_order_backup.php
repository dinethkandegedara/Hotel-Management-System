<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>OCEAN VIEW 		<div class="agileits_banner_bottom">
			<div class="col-md-12 wthree_banner_bottom_right" style="background: none !important;">
				<h3 class="title-w3-agileits title-black-wthree">Room Service - <span class="title-w3-agileits1">Food Order</span></h3>
				<div class="row">
					<div class="col-lg-12">
						<div class="food-order-form">- Food Order</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->
</head>
<body>
<!-- header -->
<div class="banner-top">
			<div class="social-bnr-agileits">
				<ul class="social-icons3">
								<li><a href="https://www.facebook.com/" class="fa fa-facebook icon-border facebook"> </a></li>
								<li><a href="https://twitter.com/" class="fa fa-twitter icon-border twitter"> </a></li>
								<li><a href="https://plus.google.com/u/0/" class="fa fa-google-plus icon-border googleplus"> </a></li> 
							</ul>
			</div>
			<div class="contact-bnr-w3-agile">
				<ul>
					<li><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@oceanviewhotel.com">INFO@OCEANVIEWHOTEL.COM</a></li>
					<li><i class="fa fa-phone" aria-hidden="true"></i>+94 (32)225-8800</li>	
					<li class="s-bar">
						<div class="search">
							<input class="search_box" type="checkbox" id="search_box">
							<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
							<div class="search_form">
								<form action="#" method="post">
									<input type="search" name="Search" placeholder=" " required=" " />
									<input type="submit" value="Search">
								</form>
							</div>
						</div>
					</li>
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
							<li class="menu__item"><a href="index.php#about" class="menu__link">About</a></li>
							<li class="menu__item"><a href="index.php#gallery" class="menu__link">Gallery</a></li>
							<li class="menu__item"><a href="index.php#rooms" class="menu__link">Rooms</a></li>
							<li class="menu__item menu__item--current"><a href="food_order.php" class="menu__link">Food Order</a></li>
							<li class="menu__item"><a href="index.php#contact" class="menu__link">Contact Us</a></li>
						</ul>
					</nav>
				</div>
			</nav>

		</div>
	</div>
<!-- //header -->

<!-- food order section -->
<div class="banner-bottom">
	<div class="container">	
		<div class="agileits_banner_bottom">
			<div class="col-md-12 wthree_banner_bottom_right" style="background: none !important; background-image: none !important;">
				<h3 class="title-w3-agileits title-black-wthree">Room Service - <span class="title-w3-agileits1">Food Order</span></h3>
		<div class="row">
			<div class="col-lg-12">
				<div class="food-order-form">
					<form method="post" id="foodOrderForm">
						<div class="email-section">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Customer Email <span style="color:red;">*</span></label>
										<input type="email" name="customer_email" class="form-control" required>
										<small>Please provide your email for order confirmation</small>
									</div>
								</div>
							</div>
						</div>
						
						<div id="foodItems" class="food-categories">
							<?php
							include('db.php');
							$categories = array();
							$sql = "SELECT DISTINCT category FROM foods ORDER BY category";
							$result = mysqli_query($con, $sql);
							while($row = mysqli_fetch_array($result)) {
								$categories[] = $row['category'];
							}
							
							foreach($categories as $category) {
								echo "<div class='category-section'>";
								echo "<h4 class='category-title'>$category</h4>";
								echo "<div class='row'>";
								
								$food_sql = "SELECT * FROM foods WHERE category = '$category' ORDER BY name";
								$food_result = mysqli_query($con, $food_sql);
								while($food = mysqli_fetch_array($food_result)) {
									echo "<div class='col-md-6 col-lg-4 mb-3'>";
									echo "<div class='food-item'>";
									echo "<div class='food-details'>";
									echo "<h5>".$food['name']."</h5>";
									echo "<p class='price'>LKR ".number_format($food['price'], 2)."</p>";
									echo "<div class='quantity-selector'>";
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
									echo "</div>";
								}
								echo "</div>";
								echo "</div>";
							}
							?>
						</div>
						
						<div class="order-summary">
							<h4>Order Summary</h4>
							<div id="orderItems"></div>
							<div class="total-amount">
								<strong>Total: LKR <span id="totalAmount">0.00</span></strong>
							</div>
						</div>
						
						<div class="form-actions">
							<button type="submit" name="place_order" class="btn btn-success btn-lg">Place Order</button>
							<button type="button" class="btn btn-secondary" onclick="clearOrder()">Clear Order</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //food order section -->

<!-- footer -->
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

<style>
/* Food Order Page Styles - Override any background images */
.banner-bottom {
    padding: 80px 0;
    background: #f8f9fa !important;
    background-image: none !important;
    min-height: auto;
}

.agileits_banner_bottom {
    background: none !important;
    background-image: none !important;
    width: 100% !important;
    margin: 0 !important;
}

.wthree_banner_bottom_right {
    background: none !important;
    background-image: none !important;
    background-color: transparent !important;
}

.banner-bottom {
    background: none !important;
    background-image: none !important;
    background-color: #f8f9fa !important;
}

.agileits_banner_bottom {
    background: none !important;
    background-image: none !important;
}

.email-section {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 30px;
}

/* Content spacing to prevent squashing */
.wthree_banner_bottom_right .container {
    padding-top: 40px;
    padding-bottom: 40px;
}

/* Complete background override - remove any city backgrounds */
body {
    background: #fff !important;
    background-image: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

html {
    margin: 0 !important;
    padding: 0 !important;
}

/* Remove only the problematic margins */
html, body {
    margin: 0 !important;
    padding: 0 !important;
}

.container {
    padding: 15px !important;
}

/* Override any possible parent container backgrounds */
* {
    background-attachment: scroll !important;
}

.banner-bottom, .banner-bottom *, 
.wthree_banner_bottom_right, .wthree_banner_bottom_right *,
.agileits_banner_bottom, .agileits_banner_bottom * {
    background-image: none !important;
    background: transparent !important;
}

/* Main content area clean background */
.banner-bottom {
    background: #fff !important;
    padding: 50px 0 !important;
    margin: 0 !important;
}

/* Remove all margins and borders */
* {
    box-sizing: border-box !important;
}

.container-fluid {
    padding: 0 !important;
    margin: 0 !important;
}

/* Remove white space around page */
.header, .header-top {
    margin: 0 !important;
}

.container {
    background: transparent !important;
    max-width: 100% !important;
    width: 100% !important;
    padding-left: 30px !important;
    padding-right: 30px !important;
}

/* Footer styling to match home page exactly */
.contact-w3ls {
    background: url('images/contact.jpg') no-repeat center center !important;
    background-size: cover !important;
    position: relative !important;
    padding: 80px 0 !important;
    margin: 0 !important;
    width: 100% !important;
}

.contact-w3ls::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: rgba(44, 62, 80, 0.9) !important;
    z-index: 1 !important;
}

.contact-w3ls .container {
    position: relative !important;
    z-index: 2 !important;
}

.contact-w3ls h4 {
    color: #ffce14 !important;
    font-size: 2em !important;
    font-weight: 600 !important;
    text-transform: uppercase !important;
    margin-bottom: 30px !important;
    letter-spacing: 2px !important;
}

.contact-agile2 {
    color: #fff !important;
    font-size: 1.1em !important;
    margin-bottom: 30px !important;
}

.contact-w3ls .form-control {
    background: rgba(255,255,255,0.1) !important;
    border: 1px solid rgba(255,255,255,0.3) !important;
    color: #fff !important;
    padding: 15px !important;
    margin-bottom: 20px !important;
    border-radius: 0 !important;
}

.contact-w3ls .form-control:focus {
    background: rgba(255,255,255,0.2) !important;
    border-color: #ffce14 !important;
    box-shadow: none !important;
}

.contact-w3ls .form-control::placeholder {
    color: rgba(255,255,255,0.7) !important;
}

.contact-p1 {
    color: #fff !important;
    font-weight: 600 !important;
    margin-bottom: 10px !important;
    display: block !important;
}

.contact-w3ls .btn-primary {
    background: #ffce14 !important;
    border: 2px solid #ffce14 !important;
    color: #2c3e50 !important;
    font-weight: 700 !important;
    padding: 15px 40px !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    border-radius: 0 !important;
    transition: all 0.3s ease !important;
}

.contact-w3ls .btn-primary:hover {
    background: transparent !important;
    color: #ffce14 !important;
    border-color: #ffce14 !important;
}

.contact-agile1 {
    color: #fff !important;
    font-size: 1.1em !important;
    line-height: 2 !important;
    margin-bottom: 15px !important;
}

.contact-agile1 strong {
    color: #ffce14 !important;
    font-weight: 600 !important;
}

.contact-agile1 a {
    color: #fff !important;
    text-decoration: none !important;
}

.contact-agile1 a:hover {
    color: #ffce14 !important;
}

.social-bnr-agileits {
    margin-top: 40px !important;
}

.social-icons3 {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
}

.social-icons3 li {
    display: inline-block !important;
    margin-right: 10px !important;
}

.social-icons3 a {
    display: inline-block !important;
    width: 45px !important;
    height: 45px !important;
    line-height: 45px !important;
    text-align: center !important;
    background: rgba(255,206,20,0.1) !important;
    border: 2px solid #ffce14 !important;
    color: #ffce14 !important;
    font-size: 18px !important;
    transition: all 0.3s ease !important;
}

.social-icons3 a:hover {
    background: #ffce14 !important;
    color: #2c3e50 !important;
    transform: translateY(-3px) !important;
}

.copy {
    background: #1a252f !important;
    padding: 25px 0 !important;
    text-align: center !important;
    margin: 0 !important;
    border-top: 1px solid rgba(255,255,255,0.1) !important;
}

.copy p {
    color: #fff !important;
    margin: 0 !important;
    font-size: 1em !important;
    line-height: 1.6 !important;
}

.copy a {
    color: #ffce14 !important;
    text-decoration: none !important;
    font-weight: 600 !important;
}

.copy a:hover {
    color: #fff !important;
}

.title-w3-agileits {
    text-align: center;
    font-size: 3em;
    color: #333;
    margin-bottom: 50px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.food-order-form {
    background: transparent;
    padding: 0px;
    margin-top: 30px;
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 25px;
}

.form-group label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: block;
    font-size: 16px;
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
    box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.category-section {
    margin-bottom: 50px;
    padding: 30px 0;
    border-bottom: 3px solid #eee;
    background: white;
    border-radius: 10px;
    margin-top: 20px;
    padding: 30px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.category-title {
    color: #007bff;
    font-size: 2.2em;
    font-weight: 700;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 15px;
}

.category-title:after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 4px;
    background: linear-gradient(45deg, #007bff, #0056b3);
    border-radius: 2px;
}

.food-item {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    margin-bottom: 25px;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.food-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    border-color: #007bff;
}

.food-details h5 {
    color: #2c3e50 !important;
    font-weight: 700 !important;
    font-size: 1.4em !important;
    margin-bottom: 15px !important;
    text-transform: capitalize !important;
}

.price {
    color: #28a745;
    font-size: 1.6em;
    font-weight: 700;
    margin-bottom: 20px;
    display: block;
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-top: 15px;
}

.quantity-selector label {
    font-weight: 600;
    color: #555;
    margin-bottom: 0;
}

.quantity-select {
    width: 90px;
    padding: 8px 12px;
    border: 2px solid #ddd;
    border-radius: 6px;
    font-size: 16px;
    font-weight: 600;
    background: white;
}

.order-summary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
    padding: 30px;
    border-radius: 15px;
    margin: 40px 0;
    box-shadow: 0 10px 30px rgba(0,123,255,0.3);
}

.order-summary h4 {
    color: white;
    font-size: 1.8em;
    margin-bottom: 20px;
    font-weight: 700;
    text-align: center;
}

.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    margin-bottom: 10px;
}

.order-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.item-total {
    font-weight: 700;
    font-size: 1.1em;
}

.total-amount {
    font-size: 1.8em;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid rgba(255,255,255,0.3);
    text-align: center;
    font-weight: 700;
}

.form-actions {
    text-align: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #eee;
}

.btn {
    padding: 15px 40px;
    font-size: 18px;
    font-weight: 600;
    border-radius: 50px;
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    margin: 0 10px;
}

.btn-success {
    background: linear-gradient(45deg, #28a745, #20c997);
    color: white;
}

.btn-success:hover {
    background: linear-gradient(45deg, #218838, #1ea080);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40,167,69,0.3);
}

.btn-secondary {
    background: linear-gradient(45deg, #6c757d, #5a6268);
    color: white;
}

.btn-secondary:hover {
    background: linear-gradient(45deg, #5a6268, #495057);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(108,117,125,0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
    .title-w3-agileits {
        font-size: 2.2em;
    }
    
    .food-order-form {
        padding: 25px;
    }
    
    .category-title {
        font-size: 1.8em;
    }
    
    .food-item {
        padding: 20px;
    }
    
    .btn {
        padding: 12px 30px;
        font-size: 16px;
        margin: 5px;
        display: block;
        width: 100%;
    }
}
</style>

<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>

<!-- /contact form -->	
<!-- Calendar -->
		<script src="js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->
<!-- gallery popup -->
<link rel="stylesheet" href="css/swipebox.css">
				<script src="js/jquery.swipebox.min.js"></script> 
					<script type="text/javascript">
						jQuery(function($) {
							$(".swipebox").swipebox();
						});
					</script>
<!-- //gallery popup -->
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
<!-- flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
			<!-- //flexSlider -->
<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
		<!--search-bar-->
		<script src="js/main.js"></script>	
<!--//search-bar-->
<!--tabs-->
<script src="js/easy-responsive-tabs.js"></script>
<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion           
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->
<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
		*/								
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	
	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
<!-- //smooth scrolling -->
<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>

<script>
$(document).ready(function() {
    $('.quantity-select').change(function() {
        updateOrderSummary();
        // Add visual feedback
        var $foodItem = $(this).closest('.food-item');
        if ($(this).val() > 0) {
            $foodItem.addClass('selected');
        } else {
            $foodItem.removeClass('selected');
        }
    });
    
    // Initialize order summary
    updateOrderSummary();
});

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
    
    var orderHtml = '';
    if (orderItems.length > 0) {
        orderItems.forEach(function(item) {
            orderHtml += '<div class="order-item">';
            orderHtml += '<span>' + item.name + ' x ' + item.quantity + '</span>';
            orderHtml += '<span class="item-total">LKR ' + formatNumber(item.total) + '</span>';
            orderHtml += '</div>';
        });
    } else {
        orderHtml = '<p style="text-align: center; opacity: 0.7;">No items selected yet</p>';
    }
    
    $('#orderItems').html(orderHtml);
    $('#totalAmount').text(formatNumber(total));
    
    // Show/hide order summary based on items
    if (orderItems.length > 0) {
        $('.order-summary').show();
    } else {
        $('.order-summary').hide();
    }
}

function formatNumber(num) {
    return parseFloat(num).toLocaleString('en-US', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

function clearOrder() {
    $('.quantity-select').val('0');
    $('.food-item').removeClass('selected');
    updateOrderSummary();
    
    // Smooth scroll to top
    $('html, body').animate({
        scrollTop: $('.food-order-form').offset().top - 100
    }, 500);
}

// Form submission validation
$('#foodOrderForm').submit(function(e) {
    var hasItems = false;
    var email = $('input[name="customer_email"]').val();
    
    $('.quantity-select').each(function() {
        if (parseInt($(this).val()) > 0) {
            hasItems = true;
            return false;
        }
    });
    
    if (!email) {
        e.preventDefault();
        alert('Please provide your email address.');
        $('input[name="customer_email"]').focus();
        return false;
    }
    
    if (!hasItems) {
        e.preventDefault();
        alert('Please select at least one food item.');
        return false;
    }
    
    // Show loading state
    $(this).find('button[type="submit"]').text('Placing Order...').prop('disabled', true);
});

// Add visual feedback for selected items
$('head').append(`
<style>
.food-item.selected {
    border-color: #28a745 !important;
    background: linear-gradient(135deg, #f8fff9, #f0fff4);
}

.food-item.selected .food-details h5 {
    color: #28a745;
}

.order-summary {
    display: none;
}
</style>
`);
</script>

</body>
</html>

<?php
if(isset($_POST['place_order'])) {
    include('db.php');
    
    $customer_email = mysqli_real_escape_string($con, $_POST['customer_email']);
    $order_time = date('Y-m-d H:i:s');
    $total_bill = 0;
    $orders_placed = 0;
    
    // Process each food item
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
    
    if($orders_placed > 0) {
        echo "<script>
                alert('Order placed successfully! Total: LKR " . number_format($total_bill, 2) . "\\nYou will receive confirmation at $customer_email');
                window.location='food_order.php';
              </script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }
}
?>
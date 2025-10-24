<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>OCEAN VIEW HOTEL - Food Order</title>
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
							<li class="menu__item"><a href="index.php#about" class="menu__link scroll">About</a></li>
							<li class="menu__item"><a href="rooms.php" class="menu__link">Rooms</a></li>
							<li class="menu__item menu__item--current"><a href="food_order.php" class="menu__link">Food Order</a></li>
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
			<div class="col-md-12 wthree_banner_bottom_right">
				<h3 class="title-w3-agileits title-black-wthree">Room Service - <span class="title-w3-agileits1">Food Order</span></h3>
				
				<!-- Floating Cart Widget -->
				<div id="cartWidget" class="cart-widget">
					<i class="fa fa-shopping-cart"></i>
					<span id="cartCount" class="cart-count">0</span>
				</div>

				<div class="food-order-container">
					<!-- Food Menu -->
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
								echo "<button type='button' class='btn btn-primary add-to-cart' 
									data-id='".$food['id']."' 
									data-name='".$food['name']."' 
									data-price='".$food['price']."'>
									<i class='fa fa-cart-plus'></i> Add to Cart
								</button>";
								echo "</div>";
								echo "</div>";
							}
							echo "</div>";
							echo "</div>";
						}
						?>
					</div>
				</div>

				<!-- Cart Modal -->
				<div class="modal fade" id="cartModal" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-shopping-cart"></i> Your Cart</h4>
							</div>
							<div class="modal-body">
								<div id="cartItems">
									<p class="text-center text-muted">Your cart is empty</p>
								</div>
								<div class="cart-total">
									<h4>Total: LKR <span id="cartTotal">0.00</span></h4>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Continue Shopping</button>
								<button type="button" class="btn btn-danger" onclick="clearCart()">
									<i class="fa fa-trash"></i> Clear Cart
								</button>
								<button type="button" class="btn btn-success" onclick="proceedToCheckout()" id="checkoutBtn" disabled>
									<i class="fa fa-check"></i> Proceed to Checkout
								</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Checkout Modal -->
				<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><i class="fa fa-credit-card"></i> Checkout</h4>
							</div>
							<form method="post" id="checkoutForm">
								<div class="modal-body">
									<div class="form-group">
										<label>Your Email <span style="color:red;">*</span></label>
										<input type="email" name="customer_email" id="customer_email" class="form-control" required 
											placeholder="Enter your email for order confirmation">
									</div>
									<div class="form-group">
										<label>Room Number (Optional)</label>
										<input type="text" name="room_number" class="form-control" 
											placeholder="Enter your room number if applicable">
									</div>
									<div class="form-group">
										<label>Special Instructions (Optional)</label>
										<textarea name="special_instructions" class="form-control" rows="3" 
											placeholder="Any special requests or dietary requirements"></textarea>
									</div>
									<div class="checkout-summary">
										<h5>Order Summary:</h5>
										<div id="checkoutItems"></div>
										<div class="checkout-total">
											<h4>Total Amount: LKR <span id="checkoutTotal">0.00</span></h4>
										</div>
									</div>
									<input type="hidden" name="cart_data" id="cartData">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									<button type="submit" name="place_order" class="btn btn-success btn-lg">
										<i class="fa fa-check-circle"></i> Place Order
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<!-- //food order section -->

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

/* Cart Widget */
.cart-widget {
    position: fixed;
    top: 120px;
    right: 30px;
    background: #28a745;
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    z-index: 1000;
    transition: all 0.3s ease;
}

.cart-widget:hover {
    background: #218838;
    transform: scale(1.1);
}

.cart-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    border: 2px solid white;
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

.add-to-cart {
    width: 100%;
    padding: 12px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.add-to-cart:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,123,255,0.3);
}

/* Cart Modal Styles */
.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #dee2e6;
    background: #f8f9fa;
    margin-bottom: 10px;
    border-radius: 8px;
}

.cart-item-info {
    flex: 1;
}

.cart-item-name {
    font-weight: 700;
    color: #2c3e50;
    font-size: 1.1em;
}

.cart-item-price {
    color: #28a745;
    font-weight: 600;
}

.cart-item-controls {
    display: flex;
    align-items: center;
    gap: 10px;
}

.qty-btn {
    background: #007bff;
    color: white;
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.qty-btn:hover {
    background: #0056b3;
}

.qty-display {
    min-width: 40px;
    text-align: center;
    font-weight: 700;
    font-size: 1.1em;
}

.remove-item {
    background: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.remove-item:hover {
    background: #c82333;
}

.cart-total {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #dee2e6;
    text-align: right;
}

.cart-total h4 {
    color: #28a745;
    font-weight: 700;
}

/* Checkout Styles */
.checkout-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
    margin-top: 20px;
}

.checkout-item {
    padding: 10px 0;
    border-bottom: 1px solid #dee2e6;
}

.checkout-total {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px solid #28a745;
    text-align: right;
}

.checkout-total h4 {
    color: #28a745;
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
// Simple Cart System using sessionStorage
let cart = [];

// Load cart from sessionStorage on page load
function loadCart() {
    const savedCart = sessionStorage.getItem('foodCart');
    if (savedCart) {
        cart = JSON.parse(savedCart);
    }
    updateCartDisplay();
}

// Save cart to sessionStorage
function saveCart() {
    sessionStorage.setItem('foodCart', JSON.stringify(cart));
    updateCartDisplay();
}

// Add item to cart
function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push({
            id: id,
            name: name,
            price: parseFloat(price),
            quantity: 1
        });
    }
    
    saveCart();
    
    // Visual feedback
    const btn = event.target.closest('.add-to-cart');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fa fa-check"></i> Added!';
    btn.style.background = '#28a745';
    setTimeout(() => {
        btn.innerHTML = originalText;
        btn.style.background = '';
    }, 1000);
}

// Update cart count and enable/disable buttons
function updateCartDisplay() {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    $('#cartCount').text(count);
    
    if (count > 0) {
        $('#checkoutBtn').prop('disabled', false);
    } else {
        $('#checkoutBtn').prop('disabled', true);
    }
    
    renderCartItems();
}

// Render cart items in modal
function renderCartItems() {
    let html = '';
    let total = 0;
    
    if (cart.length === 0) {
        html = '<p class="text-center text-muted">Your cart is empty</p>';
    } else {
        cart.forEach((item, index) => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            html += `
                <div class="cart-item">
                    <div class="cart-item-info">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">LKR ${item.price.toFixed(2)} each</div>
                    </div>
                    <div class="cart-item-controls">
                        <button class="qty-btn" onclick="updateQuantity(${index}, -1)">-</button>
                        <span class="qty-display">${item.quantity}</span>
                        <button class="qty-btn" onclick="updateQuantity(${index}, 1)">+</button>
                        <button class="remove-item" onclick="removeItem(${index})">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
        });
    }
    
    $('#cartItems').html(html);
    $('#cartTotal').text(total.toFixed(2));
}

// Update item quantity
function updateQuantity(index, change) {
    cart[index].quantity += change;
    
    if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
    }
    
    saveCart();
}

// Remove item from cart
function removeItem(index) {
    cart.splice(index, 1);
    saveCart();
}

// Clear entire cart
function clearCart() {
    if (confirm('Are you sure you want to clear your cart?')) {
        cart = [];
        saveCart();
    }
}

// Proceed to checkout
function proceedToCheckout() {
    if (cart.length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    // Populate checkout summary
    let html = '';
    let total = 0;
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        html += `
            <div class="checkout-item">
                <strong>${item.name}</strong> × ${item.quantity} = LKR ${itemTotal.toFixed(2)}
            </div>
        `;
    });
    
    $('#checkoutItems').html(html);
    $('#checkoutTotal').text(total.toFixed(2));
    
    // Set cart data as hidden input for form submission
    $('#cartData').val(JSON.stringify(cart));
    
    // Close cart modal and open checkout modal
    $('#cartModal').modal('hide');
    $('#checkoutModal').modal('show');
}

$(document).ready(function() {
    // Load cart on page load
    loadCart();
    
    // Cart widget click
    $('#cartWidget').click(function() {
        $('#cartModal').modal('show');
    });
    
    // Add to cart button click
    $(document).on('click', '.add-to-cart', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const price = $(this).data('price');
        addToCart(id, name, price);
    });
    
    // Checkout form submission
    $('#checkoutForm').on('submit', function(e) {
        const email = $('#customer_email').val();
        if (!email) {
            e.preventDefault();
            alert('Please enter your email address.');
            return false;
        }
        
        if (cart.length === 0) {
            e.preventDefault();
            alert('Your cart is empty!');
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
    $room_number = mysqli_real_escape_string($con, $_POST['room_number']);
    $special_instructions = mysqli_real_escape_string($con, $_POST['special_instructions']);
    $order_time = date('Y-m-d H:i:s');
    $total_bill = 0;
    $orders_placed = 0;
    
    // Get cart data from hidden input
    if(isset($_POST['cart_data']) && !empty($_POST['cart_data'])) {
        $cart_items = json_decode($_POST['cart_data'], true);
        
        foreach($cart_items as $item) {
            $food_id = mysqli_real_escape_string($con, $item['id']);
            $quantity = mysqli_real_escape_string($con, $item['quantity']);
            $price = mysqli_real_escape_string($con, $item['price']);
            
            $bill_amount = $price * $quantity;
            $total_bill += $bill_amount;
            
            // Insert order
            $order_sql = "INSERT INTO food_orders (email, food_id, quantity, order_time, bill_amount) 
                         VALUES ('$customer_email', '$food_id', '$quantity', '$order_time', '$bill_amount')";
            
            if(mysqli_query($con, $order_sql)) {
                $orders_placed++;
            }
        }
    }
    
    if($orders_placed > 0) {
        $order_details = "Order placed successfully!\\n";
        $order_details .= "Total: LKR " . number_format($total_bill, 2) . "\\n";
        $order_details .= "Confirmation email sent to: $customer_email";
        if($room_number) {
            $order_details .= "\\nRoom Number: $room_number";
        }
        
        echo "<script>
                alert('$order_details');
                sessionStorage.removeItem('foodCart');
                window.location='food_order.php';
              </script>";
    } else {
        echo "<script>alert('Error placing order. Please try again.');</script>";
    }
}
?>
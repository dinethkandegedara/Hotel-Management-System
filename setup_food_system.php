<?php
include('db.php');

echo "<h2>Creating Food System Tables...</h2>";

// Create foods table
$create_foods = "CREATE TABLE IF NOT EXISTS `foods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if(mysqli_query($con, $create_foods)) {
    echo "✅ Foods table created successfully<br>";
} else {
    echo "❌ Error creating foods table: " . mysqli_error($con) . "<br>";
}

// Create food_orders table
$create_orders = "CREATE TABLE IF NOT EXISTS `food_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_time` datetime NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `bill_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `food_id` (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1";

if(mysqli_query($con, $create_orders)) {
    echo "✅ Food orders table created successfully<br>";
} else {
    echo "❌ Error creating food orders table: " . mysqli_error($con) . "<br>";
}

// Check if foods already exist
$check_foods = "SELECT COUNT(*) as count FROM foods";
$result = mysqli_query($con, $check_foods);
$row = mysqli_fetch_array($result);

if($row['count'] == 0) {
    // Insert demo food items
    $foods = [
        ['Chicken Fried Rice', 'Main Course', 1200.00],
        ['Vegetable Kottu', 'Main Course', 900.00],
        ['Egg Hoppers', 'Breakfast', 350.00],
        ['Fruit Platter', 'Breakfast', 500.00],
        ['Fish Curry', 'Main Course', 1300.00],
        ['Chocolate Cake', 'Dessert', 600.00],
        ['Ice Cream', 'Dessert', 400.00],
        ['Sri Lankan Tea', 'Beverage', 250.00],
        ['Coffee', 'Beverage', 300.00],
        ['Fresh Juice', 'Beverage', 350.00]
    ];
    
    foreach($foods as $food) {
        $insert_sql = "INSERT INTO foods (name, category, price) VALUES ('{$food[0]}', '{$food[1]}', {$food[2]})";
        if(mysqli_query($con, $insert_sql)) {
            echo "✅ Added: {$food[0]}<br>";
        } else {
            echo "❌ Error adding {$food[0]}: " . mysqli_error($con) . "<br>";
        }
    }
} else {
    echo "ℹ️ Food items already exist in database ({$row['count']} items)<br>";
}

echo "<br><h3>Database Setup Complete!</h3>";
echo "<p><a href='food_order.php'>Go to Food Order Page</a></p>";
echo "<p><a href='admin/foods.php'>Go to Admin Food Management</a></p>";
?>
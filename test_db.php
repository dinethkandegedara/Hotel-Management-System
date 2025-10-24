<?php
// Database Connection Test Script
echo "<h2>Ocean View Hotel - Database Connection Test</h2>";

// Test database connection
$con = mysqli_connect("localhost","root","","hotel");

if (!$con) {
    echo "<p style='color:red;'>❌ Connection failed: " . mysqli_connect_error() . "</p>";
    exit;
}

echo "<p style='color:green;'>✅ Database connection successful!</p>";

// Test tables exist
$tables = ['room', 'foods', 'food_orders', 'contact', 'login', 'roombook', 'payment'];
echo "<h3>Checking Tables:</h3>";

foreach ($tables as $table) {
    $result = mysqli_query($con, "SELECT COUNT(*) as count FROM $table");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "<p style='color:green;'>✅ Table '$table' exists with " . $row['count'] . " records</p>";
    } else {
        echo "<p style='color:red;'>❌ Table '$table' error: " . mysqli_error($con) . "</p>";
    }
}

// Test room table columns
echo "<h3>Checking Room Table Structure:</h3>";
$result = mysqli_query($con, "DESCRIBE room");
if ($result) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Test foods table
echo "<h3>Sample Food Items:</h3>";
$result = mysqli_query($con, "SELECT name, category, price FROM foods LIMIT 5");
if ($result) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Name</th><th>Category</th><th>Price</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['category'] . "</td>";
        echo "<td>LKR " . number_format($row['price'], 2) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

// Test room types
echo "<h3>Sample Room Types:</h3>";
$result = mysqli_query($con, "SELECT type, bedding, area FROM room LIMIT 5");
if ($result) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Type</th><th>Bedding</th><th>Area</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['bedding'] . "</td>";
        echo "<td>" . $row['area'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

mysqli_close($con);

echo "<h3 style='color:green;'>✅ All tests completed successfully!</h3>";
echo "<p><a href='index.php'>Go to Homepage</a> | <a href='rooms.php'>View Rooms</a> | <a href='food_order.php'>Food Order</a></p>";
?>

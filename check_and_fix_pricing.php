<?php
include('db.php');

echo "<h2>Current Payment Records:</h2>";

// Check current payment records
$sql = "SELECT * FROM payment ORDER BY id DESC LIMIT 5";
$result = mysqli_query($con, $sql);

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Room Type</th><th>Bed Type</th><th>Days</th><th>Room Total</th><th>Bed Total</th><th>Meal Total</th><th>Final Total</th></tr>";

while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['title']." ".$row['fname']." ".$row['lname']."</td>";
    echo "<td>".$row['troom']."</td>";
    echo "<td>".$row['tbed']."</td>";
    echo "<td>".$row['noofdays']."</td>";
    echo "<td>".$row['ttot']."</td>";
    echo "<td>".$row['btot']."</td>";
    echo "<td>".$row['mepr']."</td>";
    echo "<td>".$row['fintot']."</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Recalculating with correct pricing...</h2>";

// Get the latest record for recalculation
$sql = "SELECT * FROM payment ORDER BY id DESC LIMIT 1";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

if($row) {
    $id = $row['id'];
    $troom = $row['troom'];
    $bed = $row['tbed'];
    $meal = $row['meal'];
    $days = $row['noofdays'];
    $nroom = $row['nroom'];
    
    // Correct room pricing
    $type_of_room = 0;
    if($troom=="Superior Room") {
        $type_of_room = 45000;
    } else if($troom=="Deluxe Room") {
        $type_of_room = 32000;
    } else if($troom=="Guest House") {
        $type_of_room = 26000;
    } else if($troom=="Single Room") {
        $type_of_room = 22000;
    }
    
    // Correct bed pricing
    $type_of_bed = 0;
    if($bed=="Single") {
        $type_of_bed = 1500;
    } else if($bed=="Double") {
        $type_of_bed = 2500;
    } else if($bed=="Triple") {
        $type_of_bed = 3500;
    } else if($bed=="Quad") {
        $type_of_bed = 4500;
    } else if($bed=="None") {
        $type_of_bed = 0;
    }
    
    // Correct meal pricing
    $type_of_meal = 0;
    if($meal=="Room only") {
        $type_of_meal = 0;
    } else if($meal=="Breakfast") {
        $type_of_meal = 2000;
    } else if($meal=="Half Board") {
        $type_of_meal = 3500;
    } else if($meal=="Full Board") {
        $type_of_meal = 5000;
    }
    
    // Calculate totals
    $ttot = $type_of_room * $days * $nroom;
    $btot = $type_of_bed * $days * $nroom;
    $mepr = $type_of_meal * $days * $nroom;
    $fintot = $ttot + $btot + $mepr;
    
    echo "<h3>Correct Calculations for Record ID: $id</h3>";
    echo "<p><strong>Room:</strong> $troom - LKR " . number_format($type_of_room) . " × $days days × $nroom rooms = LKR " . number_format($ttot) . "</p>";
    echo "<p><strong>Bed:</strong> $bed - LKR " . number_format($type_of_bed) . " × $days days × $nroom rooms = LKR " . number_format($btot) . "</p>";
    echo "<p><strong>Meal:</strong> $meal - LKR " . number_format($type_of_meal) . " × $days days × $nroom rooms = LKR " . number_format($mepr) . "</p>";
    echo "<p><strong>Final Total:</strong> LKR " . number_format($fintot) . "</p>";
    
    echo "<h3>Current vs Correct:</h3>";
    echo "<table border='1'>";
    echo "<tr><th>Item</th><th>Current (Wrong)</th><th>Correct</th></tr>";
    echo "<tr><td>Room Total</td><td>LKR " . number_format($row['ttot']) . "</td><td>LKR " . number_format($ttot) . "</td></tr>";
    echo "<tr><td>Bed Total</td><td>LKR " . number_format($row['btot']) . "</td><td>LKR " . number_format($btot) . "</td></tr>";
    echo "<tr><td>Meal Total</td><td>LKR " . number_format($row['mepr']) . "</td><td>LKR " . number_format($mepr) . "</td></tr>";
    echo "<tr><td>Final Total</td><td>LKR " . number_format($row['fintot']) . "</td><td>LKR " . number_format($fintot) . "</td></tr>";
    echo "</table>";
    
    echo "<br><a href='?update=1&id=$id'>Click here to update this record with correct pricing</a>";
    
    // Update the record if requested
    if(isset($_GET['update']) && $_GET['update'] == '1' && $_GET['id'] == $id) {
        $update_sql = "UPDATE payment SET ttot='$ttot', btot='$btot', mepr='$mepr', fintot='$fintot' WHERE id='$id'";
        if(mysqli_query($con, $update_sql)) {
            echo "<p style='color: green;'><strong>SUCCESS:</strong> Record updated with correct pricing!</p>";
            echo "<a href='admin/payment.php'>Go to Payment Admin Panel</a>";
        } else {
            echo "<p style='color: red;'><strong>ERROR:</strong> Failed to update record: " . mysqli_error($con) . "</p>";
        }
    }
}
?>
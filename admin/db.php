<?php
// Database connection for Ocean View Hotel Admin
$con = mysqli_connect("localhost","root","","hotel");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to UTF-8 for proper character handling
mysqli_set_charset($con, "utf8mb4");
?>
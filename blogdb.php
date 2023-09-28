<?php
$host = "localhost"; // Change this to your MySQL host
$username = "root"; // Change this to your MySQL username
$password = "mysql"; // Change this to your MySQL password
$database = "blogs"; // Change this to your MySQL database name

// Create a database connection
$con = mysqli_connect($host, $username, $password, $database);

// Check the connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

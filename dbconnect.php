<?php
// Database connection settings
$sname = "localhost";
$uname = "root";
$db_password = "Captain@56";
$db_name = "virtual_lab_sim";
$port = 3307;

// Create a connection using the provided settings
$conn = mysqli_connect($sname, $uname, $db_password, $db_name, $port);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

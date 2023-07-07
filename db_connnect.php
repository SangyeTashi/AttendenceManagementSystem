<?php

$connection = mysqli_connect("localhost", "phpmyadmin", "phpmyadmin");
mysqli_select_db($connection, "UMS");
// $connection = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
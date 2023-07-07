<?php
$mysqli = new mysqli('localhost', 'phpmyadmin', 'phpmyadmin', 'laundry_db');
if ($mysqli->connect_errno) {
   echo $mysqli->connect_errno . ": " . $mysqli->connect_error;
}


?>
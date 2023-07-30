<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

include 'db_connect.php';
$table = $_GET['table'];
$redirect = $_GET['redirect'];

$sql = 'insert into ' . $table . ' values ()';
$res = mysqli_query($connection, $sql);

if ($res) {
    header('Location: ' . $redirect);
    exit();
} else {
    echo 'Error deleting record: ' . mysqli_error($connection);
}

?>
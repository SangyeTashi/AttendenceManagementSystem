<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName']) && !isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}
try {

    // Retrieve form data
    $title = $_POST['title'];
    $content = $_POST['content'];
    $to = $_POST['to'];
    $writer = '';
    $writerId = '';
    $redirect = 'admin';
    if (isset($_SESSION['adminName'])) {
        $writer = 'admins';
        $writerId = $_SESSION['adminName'];
    } else {
        $writer = 'staffs';
        $writerId = $_SESSION['staffId'];
        $redirect = 'staff';
    }

    include 'db_connect.php';

    // Prepare the SQL statement
    $stmt = $connection->prepare("INSERT INTO announcements VALUES (UUID(), CURDATE(), ?, ?, ?, ?, ?)");

    $stmt->execute([$title, $content, $to, $writer, $writerId]);
    header("Location: " . $redirect . "Dashboard.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$connection = null;
?>
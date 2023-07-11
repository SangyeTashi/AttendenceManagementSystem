<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName']) && !isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<?php
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
include '../public/db_connect.php';

// Prepare the SQL statement
$sql = "insert into announcements values(CURDATE(),'$title','$content','$to',' $writer','$writerId')";

try {

    if (mysqli_query($connection, $sql)) {
        header("Location: " . $redirect . "Dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

// Close the database connection
mysqli_close($connection);

?>
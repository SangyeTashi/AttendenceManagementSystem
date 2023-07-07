<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

$username = $_SESSION['adminName'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo "$username" ?>
    </title>
</head>

<body>
    <?php include 'nav.php' ?>
    <h2>Welcome,
        <?php echo $_SESSION['adminName']; ?>!
    </h2>
    <a href="logout.php">Logout</a>
</body>

</html>
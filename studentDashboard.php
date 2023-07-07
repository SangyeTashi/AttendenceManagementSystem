<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['studentId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];
$department = $_SESSION['department'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo "$name | $department" ?>
    </title>
</head>

<body>
    <h2>Welcome,
        <?php echo $_SESSION['name']; ?>!
    </h2>
    <a href="logout.php">Logout</a>
</body>

</html>
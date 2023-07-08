<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['staffId'])) {
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        .staff-profile {}
    </style>
</head>

<body>
    <?php include './staffNav.php' ?>
    <div class="staff-profile">
        <h2>Welcome,
            <?php echo $_SESSION['name']; ?>!
        </h2>
        <a href="logout.php">Logout</a>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </div>

</body>

</html>
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<body>
    <?php include 'adminNav.php' ?>
    <div class="" style="margin-top: calc(74+8rem);">
        <h2>Welcome,
            <?php echo $_SESSION['adminName']; ?>!
        </h2>
        <a href="logout.php">Logout</a>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>
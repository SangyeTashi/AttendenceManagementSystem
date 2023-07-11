<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Add admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <?php
    include_once './adminNav.php'
        ?>


    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class='form-title'>Enter Admin details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">admin added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">admin Id already exists in the database. Please try a different admin Id</p>';
        }
        ?>
        <form style="margin-top:2rem" class="form" action="./doAddAdmin.php" method="POST">
            <div>
                <label class="form-label" for="adminId">username</label>
                <input class="form-control" type="text" name="username" id="username" required>
            </div>

            <div>
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <input class="form-control btn btn-primary mt-3" type="submit" value="Add admin">
        </form>
    </div>
    <?php include 'footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
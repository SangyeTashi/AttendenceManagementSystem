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
    <title>Add Staff</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <?php
    include_once './nav.php'
        ?>


    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class='form-title'>Enter staff details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">staff added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">staff Id already exists in the database. Please try a different staff Id</p>';
        }
        ?>
        <form style="margin-top:2rem" class="form" action="./doAddStaff.php" method="POST">
            <div>
                <label class="form-label" for="staffId">Staff Id</label>
                <input class="form-control" type="number" name="staffId" id="staffId" required>
            </div>
            <div>
                <label class="form-label" for="staffName">Staff Name </label>
                <input class="form-control" type="text" name="name" id="name" required>
            </div>
            <div>
                <label class="form-label" for="password">Password:</label>
                <input class="form-control" type="password" name="password" id="password" required>
            </div>
            <div>
                <label class="form-label" for="department">Department</label>
                <select class="form-select" required name="department">
                    <option value="BCA">BCA</option>
                    <option value="BCOM">BCOM</option>
                    <option value="BBA">BBA</option>
                    <option value="TIB">TIB</option>
                </select>
            </div>
            <input class="form-control btn btn-primary mt-3" type="submit" value="Add staff">
        </form>
    </div>
    <?php include 'footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
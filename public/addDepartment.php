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
    include_once './adminNav.php'
        ?>


    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class='form-title'>Enter Department details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">Department added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">Department Id already exists in the database. Please try a different Department Id</p>';
        }
        ?>
        <form style="margin-top:2rem" class="form" action="./doAddDepartment.php" method="POST">
            <div>
                <label class="form-label" for="departmentId">Department Id</label>
                <input class="form-control" type="text" name="departmentId" id="DepartmentId" required>
            </div>
            <div>
                <label class="form-label" for="departmentName">Department Name </label>
                <input class="form-control" type="text" name="departmentName" id="name" required>
            </div>
            <div>
                <label class="form-label" for="hod">HOD Id:</label>
                <input class="form-control" type="number" name="hod" id="password" required>
            </div>

            <input class="form-control btn btn-primary mt-3" type="submit" value="Add Department">
        </form>
    </div>
    <?php include 'footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
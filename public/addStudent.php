<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<style>

</style>

<body>


    <?php include '../adminNav.php' ?>
    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class="form-title">Enter student details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">Student added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">Student Id already exists in the database. Please try a different Student Id</p>';
        }
        ?>
        <form style="margin-top : 3rem" class="form" action="./pushStudent.php" method="POST">
            <div>
                <label class="form-label" for="rollNo">Roll No</label>
                <input class="form-control" type="number" name="rollNo" id="rollNo" required>
            </div>
            <div>
                <label class="form-label" for="name">Name:</label>
                <input class="form-control" type="text" name="name" id="name" required>
            </div>
            <div>
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" name="password" required>
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
            <div>
                <label class="form-label" for="semester">Semester:</label>
                <input class="form-control" type="number" name="semester" id="semester" required>

            </div>

            <input class="form-control btn btn-primary mt-3" type="submit" value="Add Student">
        </form>

    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php' ?>
</body>

</html>
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
    <title>Add Subject</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body style="margin-top:7rem">
    <?php
    include_once './adminNav.php'
        ?>


    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class='form-title'>Enter subject details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">Subject added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">Subject Id already exists in the database. Please try a different Subject Id</p>';
        }
        ?>
        <form style="margin-top:2rem" class="form" action="./doAddSubject.php" method="POST">
            <div>
                <label class="form-label" for="subjectId">Subject Id</label>
                <input class="form-control" type="number" name="subjectId" id="subjectId" required>
            </div>
            <div>
                <label class="form-label" for="subjectName">Subject Name </label>
                <input class="form-control" type="text" name="subjectName" id="subjectName" required>
            </div>
            <div>
                <label class="form-label" for="teacherId">Teacher Id</label>
                <input class="form-control" type="number" name="teacherId" id="teacherId" required>
            </div>
            <div>
                <label class="form-label" for="department">Department</label>
                <select class="form-select" required name="department">
                    <?php
                    include 'db_connect.php';
                    $sql = 'select id from departments';
                    $res = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        ?>

                        <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div>
                <label class="form-label" for="semester">Semester:</label>
                <input class="form-control" type="number" name="semester" id="semester" required>

            </div>

            <input class="form-control btn btn-primary mt-3" type="submit" value="Add Subject">
        </form>
    </div>
    <?php include 'footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
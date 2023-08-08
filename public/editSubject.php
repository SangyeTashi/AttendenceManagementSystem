<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}
include 'db_connect.php';

if (isset($_POST['runUpdate'])) {
    try {
        $subjectId = $_POST['subjectId'];
        $prevId = $_POST['prevId'];
        $subjectName = $_POST['subjectName'];
        $department = $_POST['department'];
        $staffId = $_POST['teacherId'];
        $semester = $_POST['semester'];

        // Assuming you have a database connection called $connection

        // Assume $id, $subjectName, $department, $staffId, $semester, and $prevId are properly defined and sanitized

        $updateQry = 'UPDATE subjects SET id = ?, name = ?, department = ?, staff_id = ?, semester = ? WHERE id = ?';

        $stmt = mysqli_prepare($connection, $updateQry);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "issiii", $subjectId, $subjectName, $department, $staffId, $semester, $prevId);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Successful update
                header('Location: /addSubject.php');
                exit;
            } else {
                echo "Error : " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Prepared statement error: " . mysqli_error($connection);
        }

    } catch (Exception $e) {
        if ($e->getCode() == 1452)
            echo '<div class="text-danger" style="text-align:center">A teacher with that ID doesn\'t exist</div>';
        else
            echo 'an error occurred, please try again';
    }
}



$id = urldecode($_GET['id']);


$qry = 'select * from subjects where id = ' . $id . '';
$datas = mysqli_query($connection, $qry);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Edit Subject</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php include 'adminNav.php'; ?>

<body style="margin-top: 7rem;">
    <div class="addForm" style="max-width: 500px;margin: 0 auto;">
        <h2 class="form-title">Enter Subject details</h2>
        <?php
        while ($data = mysqli_fetch_array($datas)) {
            ?>

            <form style="margin-top:2rem" class="form" action="" method="POST">
                <div>
                    <label class="form-label" for="subjectId">Subject Id</label>
                    <input class="form-control" type="number" name="subjectId" id="subjectId"
                        value="<?php echo $data['id'] ?>" required>
                </div>
                <div>
                    <label class="form-label" for="subjectName">Subject Name </label>
                    <input class="form-control" value="<?php echo $data['name'] ?>" type="text" name="subjectName"
                        id="subjectName" required>
                </div>
                <div>
                    <label class="form-label" for="teacherId">Teacher Id</label>
                    <input class="form-control" type="number" name="teacherId" id="teacherId"
                        value="<?php echo $data['staff_id'] ?>" required>
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

                            <option value="<?php echo $row['id'] ?>" <?php if ($data['department'] == $row['id'])
                                   echo 'selected' ?>><?php echo $row['id'] ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <label class="form-label" for="semester">Semester:</label>
                    <input class="form-control" type="number" name="semester" id="semester"
                        value="<?php echo $data['semester'] ?>" required>

                </div>
                <input style="display: none;" type="number" name='prevId' value="<?php echo $data['id'] ?>">


                <div>
                    <input class="form-control btn btn-primary mt-3" type="submit" name="runUpdate" value="Update Subject">
                </div>

            </form>
        <?php } ?>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
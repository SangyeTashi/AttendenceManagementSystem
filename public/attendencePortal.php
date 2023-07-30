<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body style="margin-top:7rem">
    <?php
    include_once 'nav.php';
    include 'db_connect.php'
        ?>
    <div style="max-width: 500px;margin: 0 auto;">
        <h2 class="form-title">Enter Attendence details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">Attendence added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">Student Id already exists in the database. Please try a different Student Id</p>';
        }
        ?>
        <form style="margin-top : 3rem" class="form" action="recordAttendence.php" method="POST">
            <div>
                <label class="form-label" for="staffId">Staff</label>
                <input class="form-control" type="number" name="staffId" id="staffId" required>
            </div>

            <div>
                <label class="form-label" for="department">Department</label>
                <select class="form-select" required name="department">
                    <?php

                    $qry = "select * from departments";
                    $res = mysqli_query($connection, $qry);
                    while ($r = mysqli_fetch_array($res)) {
                        ?>
                        <option value="<?php echo $r['id'] ?>">
                            <?php echo $r['id']; ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label class="form-label" for="semester">Semester:</label>
                <input class="form-control" type="number" name="semester" id="semester" required>

            </div>

            <input class="form-control btn btn-primary mt-3" type="submit" value="ok">
        </form>

    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <?php include '../footer.php' ?>
</body>

</html>
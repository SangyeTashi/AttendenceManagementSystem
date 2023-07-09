<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: staffLogin.php");
    exit;
}

$subject = $_GET['subjectId'];
$semester = $_GET['semester'];
$staffId = $_SESSION['staffId'];
$subjectName = $_GET['name'];
$department = $_SESSION['department'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $department . ' Attendence' ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">


</head>

<body>


    <?php
    echo $department;
    include 'db_connect.php';
    include 'staffNav.php';

    $qry = "select * from students where semester = '$semester' and department = '$department'";
    $res = mysqli_query($connection, $qry);

    ?>
    <div style="margin-top:8rem"></div>
    <form style="max-width: 400px;margin: 0 auto; display:flex;flex-direction: column;" method="post"
        action="doRecordAttendence.php?subjectId=<?php echo $subject ?> ">
        <?php
        while ($r = mysqli_fetch_array($res)) {
            ?>
            <div style="display: flex;margin-top: .5rem;">
                <legend>
                    <?php echo $r['name'] ?>
                </legend>
                <div style="display:flex">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" style="padding:5px;cursor: pointer;"
                            name="attendence[<?php echo $r['roll_no'] ?>]" id="inlineRadio1" value="1" checked>
                        <label class="form-check-label" for="inlineRadio1">P</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" style="padding:5px;cursor: pointer;"
                            name="attendence[<?php echo $r['roll_no'] ?>]" id="inlineRadio2" value="0">
                        <label class="form-check-label" for="inlineRadio2">A</label>
                    </div>
                </div>

            </div>
        <?php } ?>
        <input type="submit" class="btn btn-primary" style="margin:.5rem auto;">
    </form>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
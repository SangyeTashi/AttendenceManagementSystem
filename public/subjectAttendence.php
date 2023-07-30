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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $subject . ' Attendence' ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">


</head>

<body style="margin-top:7rem">


    <?php

    include 'db_connect.php';
    include 'staffNav.php';

    try {
        $qry = "SELECT students.name , SUM(attendence.isPresent = 1) AS present_count, 
    SUM(attendence.isPresent = 0) AS absent_count
    FROM students
    JOIN attendence ON attendence.stid = students.id
    JOIN subjects ON subjects.id = attendence.subid  WHERE subjects.id = '$subject' AND students.semester ='$semester' GROUP BY students.name
    ";
        $res = mysqli_query($connection, $qry);

    } catch (Exception $e) {
        echo $e->getMessage();
    }
    ?>
    <div style="margin-top:8rem"></div>
    <div style="max-width: 400px;margin: 0 auto; display:flex;flex-direction: column;"
        action="doRecordAttendence.php?subjectId=<?php echo $subject ?> ">
        <table>
            <tr>
                <th>Student Name</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Percentage</th>
            </tr>
            <?php


            while ($row = mysqli_fetch_array($res)) {
                ?>
                <tr>
                    <td>
                        <?php echo $row['name'] ?>
                    </td>
                    <td>
                        <?php echo $row['present_count'] ?>
                    </td>
                    <td>
                        <?php echo $row['absent_count'] ?>
                    </td>
                    <td></td>
                    <td>
                        <?php $percentage = $row['present_count'] / ($row['present_count'] + $row['absent_count']) * 100;
                        echo number_format($percentage, 1) ?>
                    </td>
                    <td></td>
                </tr>

            <?php } ?>
        </table>

    </div>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
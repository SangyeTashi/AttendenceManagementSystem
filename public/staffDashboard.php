<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];
$department = $_SESSION['department'];

include './db_connect.php'
    ?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo "$name | $department" ?>
    </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        .staff-container {
            margin-top: calc(88px);
            padding: 3rem;
        }
    </style>
</head>

<body style="margin-top:7rem">
    <?php include './staffNav.php' ?>
    <div class="staff-container">
        <h2>Welcome,
            <?php echo ucwords($_SESSION['name']); ?>!
        </h2>
        <h3>Record Attendence</h3>
        <ul>
            <?php
            $staffId = $_SESSION['staffId'];
            $qry = "select * from subjects where staff_id = " . $staffId;
            $res = mysqli_query($connection, $qry);
            while ($r = mysqli_fetch_array($res)) {
                echo '<li>' . $r['name'] . '. <a href="/recordAttendence.php?subjectId='
                    . $r['id']
                    . '&semester=' . $r['semester']
                    . '&name=' . $r['name']
                    . '">'
                    . 'Record' . "</a>";
                echo '<a href="/subjectAttendence.php?subjectId='
                    . $r['id']
                    . '&semester=' . $r['semester']
                    . '&name=' . $r['name']
                    . '">'
                    . '   View' . "</a></li>";

            }
            ?>
        </ul>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </div>

</body>

</html>
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

$username = $_SESSION['adminName'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo "$username" ?>
    </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

<style>
    .container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(15rem, 100%), 1fr));
        grid-gap: 3%;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.60);
        border-radius: 2rem;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    card-title {
        text-align: center;
    }

    .png-img {
        width: 70%;
        padding: 1rem;

    }

    .btn-container {
        align-self: flex-end;

    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 1rem;
    }
</style>

<body style="margin-top:7rem">
    <?php include 'adminNav.php' ?>
    <div class="container stats" style="margin-top:8rem">
        <div>
            <h3>
                Number of Students with attendance shortage
            </h3>
            <div></div>
        </div>
    </div>
    <div class="container" style="">
        <div class="card">
            <h4 class='card-title'>Manage Students</h4>
            <img class="png-img" src="./img/student.png" alt="student-png-image">
            <a class="btn-container" href="./addStudent.php">
                <button class='btn btn-primary'>
                    Go
                </button>
            </a>
        </div>
        <div class="card">
            <h4 class='card-title'>Manage Staffs</h4>
            <img class="png-img" src="./img/classroom.png" alt="student-png-image">
            <a class="btn-container" href="./addStaff.php">
                <button class='btn btn-primary'>
                    Go
                </button>
            </a>
        </div>
        <div class="card">
            <h4 class='card-title'>Manage Departments</h4>
            <img class="png-img" src="./img/classmates.png" alt="student-png-image">
            <a class="btn-container" href="./addDepartment.php">
                <button class='btn btn-primary'>
                    Go
                </button>
            </a>
        </div>
        <div class="card">
            <h4 class='card-title'>Write Annoucement</h4>
            <img class="png-img" src="./img/notification.png" alt="student-png-image">
            <a class="btn-container" href="./createAnnouncement.php">
                <button class='btn btn-primary'>
                    Go
                </button>
            </a>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>
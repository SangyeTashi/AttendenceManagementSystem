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
        aspect-ratio: 1/1;
    }
</style>

<body>
    <?php include 'adminNav.php' ?>
    <div class="container" style="margin-top:8rem">
        <div class="card">
            <h4>Edit</h4>
            <ul>
                <li><a href="./addStudent.php"> Student</a></li>
                <li>Staff</li>
                <li>Subject</li>
                <li>Department</li>
                <li>Annoucement</li>
            </ul>

        </div>
        <div class="card">Add Students</div>
        <div class="card">Write an Annoucement</div>
        <div class="card"></div>
        <div class="card"></div>
        <div class="card"></div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>
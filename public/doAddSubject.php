<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<?php
// Retrieve form data
$subjectId = $_POST['subjectId'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$subjectName = $_POST['subjectName'];
$teacherId = $_POST['teacherId'];


require_once './db_connect.php';
// Prepare the SQL statement
$sql = "insert into subjects values($subjectId,'$subjectName','$teacherId','$department', $semester)";


// Check if subjectId already exists
$checkQuery = "select id FROM subjects WHERE id='$subjectId'";
$result = mysqli_query($connection, $checkQuery);


if (mysqli_num_rows($result) > 0) {
    // subjectId already exists
    header("Location: addSubject.php?msg=3");

} else {

    if (mysqli_query($connection, $sql)) {
        header("Location: addSubject.php?msg=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

?>
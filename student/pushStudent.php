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
$rollNo = $_POST['rollNo'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$name = ucwords($_POST['name']);
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

require_once '../db_connnect.php';
// Prepare the SQL statement
$sql = "insert into students values($rollNo, '$department', $semester, '$name','$hashedPassword' )";


// Check if RollNo already exists
$checkQuery = "select roll_no FROM students WHERE roll_no = '$rollNo'";
$result = mysqli_query($connection, $checkQuery);


if (mysqli_num_rows($result) > 0) {
    // RollNo already exists
    header("Location: addStudent.php?msg=3");

} else {

    if (mysqli_query($connection, $sql)) {
        header("Location: addStudent.php?msg=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

?>
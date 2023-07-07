<?php
// Retrieve form data
$rollNo = $_POST['rollNo'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$name = $_POST['name'];

require_once '../db_connnect.php';
// Prepare the SQL statement
$sql = "insert into students values($rollNo, '$department', $semester, '$name' )";


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
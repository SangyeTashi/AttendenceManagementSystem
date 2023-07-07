<?php
// Retrieve form data
$subjectId = $_POST['subjectId'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$subjectName = $_POST['subjectName'];
$teacherId = $_POST['teacherId'];


require_once './db_connnect.php';
// Prepare the SQL statement
$sql = "insert into subjects values($subjectId,'$subjectName','$teacherId','$department', $semester)";


// Check if subjectId already exists
$checkQuery = "select subject_id FROM subjects WHERE subject_id='$subjectId'";
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
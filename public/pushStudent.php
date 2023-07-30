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
try {

    // Retrieve form data
    $rollNo = $_POST['rollNo'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $name = ucwords($_POST['name']);
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    require_once 'db_connect.php';
    // Prepare the SQL statement
    $sql = "insert into students values($rollNo, '$department', $semester, '$name','$hashedPassword' )";


    // Check if RollNo already exists
    $checkQuery = "select id FROM students WHERE id = '$rollNo'";
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

} catch (Exception $e) {
    echo $e->getMessage();
}
// Close the database connection
mysqli_close($connection);

?>
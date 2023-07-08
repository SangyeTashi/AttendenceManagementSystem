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
$staffId = $_POST['staffId'];
$department = $_POST['department'];
$name = ucwords($_POST['name']);
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

require_once './db_connnect.php';
// Prepare the SQL statement
$sql = "insert into staffs values($staffId, '$name','$hashedPassword','$department' )";


// Check if staffId already exists
$checkQuery = "select id FROM staffs WHERE id = '$staffId'";
$result = mysqli_query($connection, $checkQuery);


if (mysqli_num_rows($result) > 0) {
    // staffId already exists
    header("Location: addStaff.php?msg=3");

} else {

    if (mysqli_query($connection, $sql)) {
        header("Location: addStaff.php?msg=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

?>
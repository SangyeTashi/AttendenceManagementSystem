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
session_start();

// Retrieve form data
$username = $_POST['username'];
$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

require_once './db_connnect.php';
// Prepare the SQL statement
$sql = "insert into admins values('$username','$hashedPassword' )";


// Check if username already exists
$checkQuery = "select username FROM admins WHERE username = '$username'";
$result = mysqli_query($connection, $checkQuery);


if (mysqli_num_rows($result) > 0) {
    // username already exists
    header("Location: addAdmin.php?msg=3");

} else {

    if (mysqli_query($connection, $sql)) {
        header("Location: addAdmin.php?msg=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

?>
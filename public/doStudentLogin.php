<?php

session_start();


include 'db_connect.php';


$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM  students WHERE id = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("i", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $row = $result->fetch_assoc();
    // Verify the password (use appropriate password hashing algorithm, e.g., password_hash())
    if (password_verify($password, $row['password'])) {
        // Authentication successful, store user details in the session
        $_SESSION['studentId'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['semester'] = $row['semester'];
        $_SESSION['department'] = $row['department'];

        header("Location: studentDashboard.php");
        exit();
    } else {
        // Invalid password
        echo "Invalid password.";
    }

} else {
    // User not found
    echo "User not found.";
}



// Close the database connection
$stmt->close();
$conn->close();

?>
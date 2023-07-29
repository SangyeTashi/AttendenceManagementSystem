<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connect.php';

    // Get the submitted staffId and password
    $adminName = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user credentials against the database
    $sql = "SELECT * FROM admins WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $adminName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password (use appropriate password hashing algorithm, e.g., password_hash())
        if (password_verify($password, $row['password'])) {
            // Authentication successful, store user details in the session
            $_SESSION['adminName'] = $row['id'];

            header("Location: adminDashboard.php");
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
}
?>
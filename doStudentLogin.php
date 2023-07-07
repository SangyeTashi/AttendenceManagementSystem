<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db_connnect.php';

    // Get the submitted studentId and password
    $studentId = $_POST["studentId"];
    $password = $_POST["password"];

    // Validate the user credentials against the database
    $sql = "SELECT * FROM students WHERE roll_no = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password (use appropriate password hashing algorithm, e.g., password_hash())
        if (password_verify($password, $row['password'])) {
            // Authentication successful, store user details in the session
            $_SESSION['studentId'] = $row['roll_no'];
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
}
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '/db_connnect.php';

    // Get the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user credentials against the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password (use appropriate password hashing algorithm, e.g., password_hash())
        if (password_verify($password, $row['password'])) {
            // Authentication successful, store user details in the session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];

            // Redirect to the welcome page
            header("Location: welcome.php");
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
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

try {
    // Retrieve form data
    $departmentName = $_POST['departmentName'];
    $departmentId = $_POST['departmentId'];
    $hod = $_POST['hod'];


    require_once './db_connect.php';

    // Prepare the SQL statement using prepared statements to avoid SQL injection
    $sql = "INSERT INTO departments (Id, name, hod_Id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($connection, $sql);
    mysqli_stmt_bind_param($stmt, "ssi", $departmentId, $departmentName, $hod);

    // Check if departmentId already exists
    $checkQuery = "SELECT Id FROM departments WHERE Id = ?";
    $checkStmt = mysqli_prepare($connection, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "s", $departmentId);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // departmentId already exists
        header("Location: addDepartment.php?msg=3");
        exit;
    } else {
        // Execute the INSERT statement
        if (mysqli_stmt_execute($stmt)) {
            header("Location: addDepartment.php?msg=1");
            exit;
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
    // Close the connection
    mysqli_close($connection);
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<?php
try {

    $attendence = $_POST['attendence'] ?? array();
    $subjectId = $_GET['subjectId'] ?? '';

    if (!empty($attendence)) {
        include 'db_connect.php';

        foreach ($attendence as $stdId => $status) {
            // Sanitize and validate the input
            $stdId = mysqli_real_escape_string($connection, $stdId);
            $status = mysqli_real_escape_string($connection, $status);

            // Create the SQL query using prepared statements
            $sql = "INSERT INTO attendence VALUES (CURDATE(),?, ?,?)";
            $stmt = mysqli_prepare($connection, $sql);

            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($stmt, "iii", $stdId, $subjectId, $status);

            // Execute the prepared statement
            mysqli_stmt_execute($stmt);

            // Close the statement
            mysqli_stmt_close($stmt);

            echo "Record for Student ID $stdId with Status $status inserted into attendence table.<br/>";
        }

        mysqli_close($connection);

        header('Location: staffDashboard.php');
        exit();
    } else {
        echo "No attendence data provided.";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

?>
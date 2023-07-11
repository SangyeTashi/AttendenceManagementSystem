<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect the user to the home page
header("Location: index.php");
exit;
?>
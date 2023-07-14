<?php
// Redirect back two pages
if (isset($_SERVER['HTTP_REFERER'])) {
    $previousPage = $_SERVER['HTTP_REFERER'];
    header("Location: $previousPage");
    exit();
} else {
    // Handle the case when there is no previous page
    // Redirect to a default page or display an error message
}
?>
<?php
$a = $_GET["id"];
$con = mysqli_connect('localhost', 'phpmyadmin', 'phpmyadmin');
mysqli_select_db($con, 'db_state');
$qry = "DELETE FROM tbl_state WHERE stid=" . $a . ";";
$res = mysqli_query($con, $qry);
if ($res > 0) {
    header('location:state.php?msg=3');
} else {
    header('location:state.php?msg=0');
}
?>
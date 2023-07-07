<?php
$a = $_POST["id"];
$stname = $_POST['stname'];
$con = mysqli_connect("localhost", "phpmyadmin", "phpmyadmin");
mysqli_select_db($con, "db_state");
$qry = "UPDATE tbl_state SET stname='$stname' WHERE stid='$a'";
$res = mysqli_query($con, $qry);
if ($res > 0) {
    header("Location: state.php?msg=1");
} else {
    header("Location: state.php?msg=0");
}
;
?>
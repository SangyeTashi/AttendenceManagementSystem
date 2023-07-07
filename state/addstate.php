<?php
$sname = $_GET["txt_state"];
$con = mysqli_connect("localhost", "phpmyadmin", "phpmyadmin");
mysqli_select_db($con, "db_state");
$qry = "select ifnull(max(stid),0)+1 from tbl_state";
$res = mysqli_query($con, $qry);
$r = mysqli_fetch_array($res);
$qry = "insert into tbl_state values($r[0],'$sname')";
$res = mysqli_query($con, $qry);
if ($res > 0) {
    header("location:state.php?msg=1");
} else {
    header("location:state.php?msg=0");
}

?>
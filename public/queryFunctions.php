<?php
require "./db_connect.php";
function getStudents()
{
    $sql = 'select roll_no,name,department,semester from students';
    $res = mysqli_query($connection, $sql);
    return $res;
}
?>
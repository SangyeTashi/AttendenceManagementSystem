<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit State</title>
</head>

<body>

    <?php
    $a = $_GET["id"];
    $con = mysqli_connect("localhost", "phpmyadmin", "phpmyadmin");
    mysqli_select_db($con, "db_state");
    $qry = "select stname from tbl_state where stid=$a";
    $res = mysqli_query($con, $qry);
    $r = mysqli_fetch_array($res);
    ?>
    <form method="post" action="updatestate.php">
        <table>
            <tr>
                <td>
                <th>EDIT STATE</th>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $r[0] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="stname" placeholder="enter updated state">
                    <input type="hidden" name="id" value=<?php echo $a; ?>>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit">Submit</button>
                </td>
            </tr>
        </table>
    </form>
</body>

</html>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Untitled Document</title>
</head>

<body>
  <form method="post" action="addstate.php">
    <table width="200" border="1">
      <tr>
        <td colspan="2" align="center">ADD/EDIT/DELETE STATE </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <?php
          if (isset($_GET["msg"])) {
            if ($_GET["msg"] == 1) {
              echo "state added";
            }
            if ($_GET["msg"] == 0) {
              echo "error";
            }
            if ($_GET["msg"] == 2) {
              echo "state deleted";
            }
            if ($_GET["msg"] == 3) {
              echo "state deleted";
            }
          }

          ?>
        </td>
      </tr>
      <tr>
        <td>state</td>
        <td><label>
            <input name="txt_state" type="text" id="txt_state" />
          </label></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="Submit" value="Add" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <table width="200" border="1">
            <tr>
              <td height="29">state</td>
              <td>edit</td>
              <td>delete</td>
            </tr>
            <?php
            $con = mysqli_connect("localhost", "phpmyadmin", "phpmyadmin");
            mysqli_select_db($con, "db_state");
            $qry = "select * from tbl_state";
            $res = mysqli_query($con, $qry);
            while ($r = mysqli_fetch_array($res)) {
              ?>
              <tr>
                <td>
                  <?php echo $r[1]; ?>
                </td>
                <td><a href="editstate.php?id=<?php echo $r[0]; ?>">edit</a></td>
                <td><a href="deletestate.php?id=<?php echo $r[0]; ?>">delete</a></td>
              </tr>
              <?php
            }
            ?>



          </table>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>
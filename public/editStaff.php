<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

include 'db_connect.php';
try {

    if (isset($_POST['runUpdate'])) {
        $prevId = $_POST['prevId'];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $department = $_POST['department'];

        $updateQry = "UPDATE staffs SET id = " . $id . ",
                                    name = '" . $name . "',
                                    department = '" . $department . "'
                                     WHERE id = " . $prevId . "";
        $result = mysqli_query($connection, $updateQry);
        if ($result) {
            header('Location: /addStaff.php');
        } else {
            echo "Error : " . mysqli_error($connection);
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

$id = $_GET['id'];


$qry = 'select * from staffs where id = ' . $id . '';
$datas = mysqli_query($connection, $qry);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Edit Staff</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php include 'adminNav.php'; ?>

<body style="margin-top: 7rem;">
    <div class="addForm" style="max-width: 500px;margin: 0 auto;">
        <h2 class="form-title">Enter Staff details</h2>
        <form style="margin-top : 3rem" class="form" action="" method="POST">
            <?php
            while ($data = mysqli_fetch_array($datas)) {
                ?>

                <div class="form-row">
                    <div class='col'>
                        <label class="form-label" for="id">Id</label>
                        <input class="form-control" type="number" name='id' value="<?php echo $data['id'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class='col'>
                        <label class="form-label" for=" name">Name</label>
                        <input class="form-control" type="text" name='name' value="<?php echo $data['name'] ?>">
                    </div>
                </div>
                <div class='col'>
                    <label class="form-label" for="department">Department:</label>
                    <select name="department">
                        <?php
                        $sql = "select * from departments";
                        $res = mysqli_query($connection, $sql);
                        while ($r = mysqli_fetch_array($res)) {
                            ?>
                            <option value="<?php echo $r['id'] ?>" <?php if ($r['id'] == $data['department'])
                                   echo 'selected'
                                       ?>>
                                <?php echo $r['id']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <input style="display: none;" type="number" name='prevId' value="<?php echo $data['id'] ?>">
                <?php
            }
            ?>
            <input class="btn btn-primary" type="submit" name="runUpdate" value="Update">

        </form>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>
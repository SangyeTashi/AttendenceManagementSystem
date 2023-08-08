<?php

session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName']) && !isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}
include 'db_connect.php';

if (isset($_POST['runUpdate'])) {


    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $content = mysqli_real_escape_string($connection, $_POST['content']);
    $writtenTo = mysqli_real_escape_string($connection, $_POST['written_to']);

    $updateQry = 'UPDATE announcements SET title = "' . $title . '",
        content = "' . $content . '",
        written_to = "' . $writtenTo . '" 
         WHERE id = ' . $_GET["id"];
    try {

        $result = mysqli_query($connection, $updateQry);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($result) {
        header('Location: /createAnnouncement.php');
    } else {
        echo "Error : " . mysqli_error($connection);
    }

}


$id = urldecode($_GET['id']);


$qry = 'select * from announcements where id = ' . $id . '';
$datas = mysqli_query($connection, $qry);
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<?php include 'adminNav.php'; ?>

<body style="margin-top: 7rem;">
    <div class="addForm" style="max-width: 800px;margin: 0 auto;">
        <h2 class="form-title">Enter Announcement details</h2>
        <form style="margin-top : 3rem" class="form" action="" method="POST">
            <?php
            while ($data = mysqli_fetch_array($datas)) {
                ?>
                <div>
                    <label class="form-label" for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="username" required
                        value="<?php echo $data['title'] ?>">
                </div>
                <div>
                    <label class=" form-label" for="content">Announcement</label>
                    <textarea style="height: 15rem;" class="form-control" type="text" name="content"
                        required><?php echo $data['content'] ?></textarea>
                </div>
                <div>
                    <label class="form-label" for="content">To</label>
                    <select class="form-control" type="text" name="written_to" required>
                        <option value="everyone" <?php if ($data['written_to'] == 'everyone')
                            echo 'selected' ?>>everyone
                            </option>
                            <option value="staff" <?php if ($data['written_to'] == 'staff')
                            echo 'selected' ?>>staff</option>
                            <?php
                        $sql = 'select id from departments';
                        $res = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_array($res)) {
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php if ($row['id'] == $data['written_to'])
                                   echo 'selected' ?>><?php echo $row['id'] ?></option>
                            <?php
                        }
                        ?>
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
<html>

<head>
    <title>Make Announcement</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="addForm" style=" max-width: 700px;margin: 0 auto;">
        <h2 class="form-title">Enter Announcement details</h2>
        <form style="margin-top : 3rem" class="form" action="./doAddAnnouncement.php" method="POST">
            <div>
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" id="username" required>
            </div>
            <div>
                <label class="form-label" for="content">Announcement</label>
                <textarea style="height: 16rem;" class="form-control" type="text" name="content" required></textarea>
            </div>
            <div>
                <label class="form-label" for="content">To</label>
                <select class="form-control" type="text" name="to" required>
                    <option value="everyone">Everyone</option>
                    <option value="staff">staff</option>
                    <?php
                    include 'db_connect.php';
                    $sql = 'select id from departments';
                    $res = mysqli_query($connection, $sql);
                    while ($row = mysqli_fetch_array($res)) {
                        ?>

                        <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <input style="display:none" type="text" name="writer" value="staff">
            <input class="form-control btn btn-primary mt-3" type="submit" value="Add Announcement">
        </form>

    </div>
</body>

</html>
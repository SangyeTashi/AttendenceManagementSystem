<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['adminName']) && !isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: /unauthorized.php");
    exit;
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Write Announcements</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <?php
    include_once './adminNav.php'
        ?>


    <div style="max-width: 700px;margin: 0 auto;">
        <h2 class='form-title'>Enter Announcement details</h2>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === '1') {
            echo '<p class="form-description text-success">Announcement added successfully! Add more..</p>';
        }
        if (isset($_GET['msg']) && $_GET['msg'] === '3') {
            echo '<p class="form-description text-danger">Announcement Id already exists in the database. Please try a different Announcement Id</p>';
        }
        ?>
        <form style="margin-top:2rem" class="form" action="doAddAnnouncement.php" method="POST">
            <div>
                <label class="form-label" for="title">Title</label>
                <input class="form-control" type="text" name="title" id="username" required>
            </div>
            <div>
                <label class="form-label" for="content">Announcement</label>
                <textarea style="height: 8rem;" class="form-control" type="text" name="content" required> </textarea>
            </div>
            <div>
                <label class="form-label" for="content">To</label>
                <select class="form-control" type="text" name="to" required>
                    <option value="everyone">Everyone</option>
                    <option value="staff">staff</option>
                    <option value="BCA">BCA</option>
                    <option value="BCOM">BCOM</option>
                    <option value="BCOM">BBA</option>
                    <option value="TIB">TIB</option>
                </select>
            </div>

            <input class=" form-control btn btn-primary mt-3" type="submit" value="Publish Announcement">
        </form>
    </div>
    <?php include 'footer.php' ?>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>
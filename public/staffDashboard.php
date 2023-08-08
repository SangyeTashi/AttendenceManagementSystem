<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['staffId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

$name = $_SESSION['name'];
$department = $_SESSION['department'];

include './db_connect.php';


try {



    $qry_announcement_admin = "SELECT admins.id as adminName,announcements.id,announcements.title,announcements.date,announcements.content FROM admins JOIN announcements ON admins.id = announcements.writerId WHERE announcements.writer='admins' AND announcements.written_to='$department' OR announcements.written_to = 'everyone' OR announcements.written_to = 'staff'";

    $qry_announcement_staff = "SELECT staffs.name,announcements.id,announcements.title,announcements.date,announcements.content FROM staffs JOIN announcements ON staffs.id = announcements.writerId WHERE announcements.writer='staffs' AND announcements.written_to='$department' OR announcements.written_to = 'everyone' OR announcements.written_to = 'staff'";

    $announcements_admin = mysqli_query($connection, $qry_announcement_admin);

    $announcements_staff = mysqli_query($connection, $qry_announcement_staff);

} catch (Exception $e) {
    echo $e->getMessage();
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>
        <?php echo "$name | $department" ?>
    </title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <style>
        .staff-container {
            padding: 3rem;
        }

        .student-container {
            padding: 3rem;
        }


        svg {
            display: inline-flex;
            vertical-align: bottom;
            width: 200px;
            height: 200px;
        }

        circle {
            stroke: rgba(#fff, 0.25);
            stroke-width: 5px;
            stroke-dasharray: 0;
            fill: none;
        }

        .meter {
            stroke-width: 5px;
            fill: none;
            transition: stroke-dashoffset 1s cubic-bezier(0.43, 0.41, 0.22, 0.91);
            transform-origin: center center;
            transform: rotate(-90deg) scaleX(-1);
            width: 4rem;
            height: 4rem;
        }

        text {
            fill: #111;
            font-weight: bold;
        }

        .circle-container {
            transform: scale(0.35);
            margin: -4rem;
            margin-right: -3rem;
        }

        .attendence {
            background-color: rgba(255, 255, 255, 0.65);

            padding: 2rem 2rem;
            border-radius: 2rem;
        }

        .attendence-card {
            display: flex;
            align-items: center;
            padding: .6rem 0rem;
        }

        .attendence-card:not(:last-child) {
            border-bottom: 1px #ccc solid;
        }

        .profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.65);
            aspect-ratio: 1/1;
            border-radius: 2rem;
            padding: 2rem 2rem;
            margin-bottom: 1rem;
        }

        .profile-picture {
            width: 6rem;
            border-radius: 50%;
            margin-bottom: 2rem;
        }

        .student {
            min-width: 20rem;
            margin-right: 1rem;
        }

        .student-container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
        }

        .anouncements {
            background-color: rgba(255, 255, 255, 0.65);
            padding: 2rem 2rem;
            border-radius: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .announcement {
            margin: 2rem 0;
            max-width: 700px;
        }
    </style>
</head>

<body style="margin-top:6rem">
    <?php include './staffNav.php' ?>
    <div class="student-container">
        <div class='student'>
            <div class="profile">
                <img class="profile-picture" src="./img/blankProfile.jpg" alt="">
                <h4>
                    <?php echo ucwords($_SESSION['name']); ?>
                </h4>
                <span>
                    Lecturer
                </span>
                <div style="margin-top:1rem;display:flex;align-items:center;justify-content:space-around;width: 100%;"
                    ;>
                    <div>
                        <?php echo $_SESSION['department'] ?>
                    </div>
                    <div>
                        ID:
                        <?php echo $_SESSION['staffId'] ?>
                    </div>
                </div>
            </div>
            <div class='attendence'>
                <h5 class="fw-semibold " style="text-align:center;margin-bottom: 2rem">Record Attendence</h5>
                <div>
                    <?php
                    $staffId = $_SESSION['staffId'];
                    $qry = "select * from subjects where staff_id = " . $staffId;
                    $res = mysqli_query($connection, $qry);
                    while ($r = mysqli_fetch_array($res)) {
                        echo '<div style="display:flex;flex-direction:column;align-items:center"> 
                            <div style="margin-bottom:.5rem;font-size:17px;text-align:right">
                            ' . $r['name'] . '
                            </div>
                            <div style="display:flex;justify-content:flex-end;margin-bottom:1rem">
                                    <a style="margin-right:0.5rem" href="/recordAttendence.php?subjectId=' . $r['id'] . '&semester=' . $r['semester'] . '&name=' . $r['name'] . '">'
                            . '<button style="width:60px;font-size:13px;text-align:center;"  class="btn btn-dark">Record</button>' .
                            '</a> 
                                <a href="/subjectAttendence.php?subjectId='
                            . $r['id']
                            . '&semester=' . $r['semester']
                            . '&name=' . $r['name']
                            . '">'
                            . ' <button style="width:60px;font-size:13px;text-align:center;" class="btn btn-dark" >View</button>' . "</a>
                                
                            </div>
                        </div>";

                    }
                    ?>
                </div>
            </div>
        </div>
        <div class='anouncements'>
            <h6>Announcements</h6>
            <?php while ($r = mysqli_fetch_array($announcements_admin)) { ?>

                <div class="announcement">
                    <div style="display:flex;align-items:center">
                        <h5>
                            <?php echo $r['title'] ?>
                        </h5>
                        <h6 style="margin-left: auto;color:gray;font-size:.9rem">
                            -
                            <?php echo $r['adminName'] ?>
                        </h6>
                    </div>
                    <p style="margin: 0rem 0;">
                        <?php echo substr($r['content'], 0, 40) ?>...
                    </p>
                    <div style="display: flex;align-items: center">
                        <span style=" color: gray">
                            <?php echo $r['date'] ?>
                        </span>
                        <a style="margin-left:auto;margin-right:2rem;"
                            href="/announcement.php?w=<?php echo $r['adminName'] ?>&id=<?php echo $r['id'] ?>">view</a>
                    </div>
                </div>
            <?php }

            while ($r = mysqli_fetch_array($announcements_staff)) { ?>


                <div class="announcement">
                    <div style="display:flex;align-items:center">
                        <h5>
                            <?php echo $r['title'] ?>
                        </h5>
                        <h6 style="margin-left: auto;color:gray;font-size:.9rem">
                            -
                            <?php
                            echo $r['name'];
                            ?>

                        </h6>
                    </div>
                    <p style="margin: 0rem 0;">
                        <?php echo substr($r['content'], 0, 60) ?>...
                    </p>
                    <div style="display: flex;align-items: center">
                        <span style=" color: gray">
                            <?php echo $r['date'] ?>
                        </span>
                        <a style="margin-left:auto;margin-right:2rem;" href="/announcement.php?w=<?php echo $r['name'];
                        ?>&id=<?php echo $r['id'] ?>">view</a>
                    </div>
                </div>
            <?php } ?>
            <a href="createAnnouncement.php">
                <button class="btn btn-primary" style="align-self: flex-end;">Make an Announcement</button>
            </a>
        </div>
    </div>

    <script src=" ../js/bootstrap.bundle.min.js"></script>

</body>

</html>
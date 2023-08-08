<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['studentId'])) {
    // Redirect the user to the login page if not logged in
    header("Location: index.php");
    exit;
}

include 'db_connect.php';

$name = $_SESSION['name'];
$department = $_SESSION['department'];
$studentId = $_SESSION['studentId'];

try {

    $qry = "SELECT subjects.name,SUM(attendence.isPresent=1) as present_count,SUM(attendence.isPresent = 0) as absent_count 
            FROM subjects JOIN attendence on subjects.id = attendence.subid JOIN students ON attendence.stid=students.id 
            WHERE students.id = '$studentId' GROUP BY subjects.name";


    $res = mysqli_query($connection, $qry);

    $qry_announcement_admin = "SELECT admins.id as adminName,announcements.id,announcements.title,announcements.date,announcements.content FROM admins JOIN announcements ON admins.id = announcements.writerId WHERE announcements.writer='admins' AND announcements.written_to='$department' OR announcements.written_to = 'everyone'";

    $qry_announcement_staff = "SELECT staffs.name,announcements.id,announcements.title,announcements.date,announcements.content FROM staffs JOIN announcements ON staffs.id = announcements.writerId WHERE announcements.writer='staffs' AND announcements.written_to='$department' OR announcements.written_to = 'everyone'";

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
        .student-container {
            margin-top: calc(88px);
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
            margin-top: 5rem;
        }

        .anouncements {
            background-color: rgba(255, 255, 255, 0.65);
            padding: 2rem 2rem;
            border-radius: 2rem;
            flex-grow: 1;
        }

        .announcement {
            margin: 2rem 0;
            max-width: 700px;
        }
    </style>
</head>

<body style="margin-top:7rem">
    <?php
    include './studentNav.php';
    ?>
    <div class="student-container">
        <div class='student'>
            <div class="profile">
                <img class="profile-picture" src="./img/blankProfile.jpg" alt="">
                <h4>
                    <?php echo ucwords($_SESSION['name']); ?>
                </h4>
                <span>
                    <?php echo $_SESSION['semester'] . "th Semester" ?>
                </span>
                <div style="margin-top:1rem;display:flex;align-items:center;justify-content:space-around;width: 100%;"
                    ;>
                    <div>
                        <?php echo $_SESSION['department'] ?>
                    </div>
                    <div>
                        ID:
                        <?php echo $_SESSION['studentId'] ?>
                    </div>
                </div>
            </div>
            <div class='attendence'>
                <h4 style='text-align: center' ;>Attendance</h4>
                <?php
                while ($r = mysqli_fetch_array($res)) { ?>


                    <?php $percentage = $r['present_count'] / ($r['present_count'] + $r['absent_count']) * 100;
                    $color = '';
                    if ($percentage >= 85) {
                        $color = 'green';
                    } elseif ($percentage >= 75) {
                        $color = 'orange';
                    } else {
                        $color = 'red';
                    }
                    ?>
                    <div class="attendence-card">
                        <div class="circle-container">
                            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                                data-value="<?php echo number_format($percentage, 1) ?>">
                                <circle r="" cx="5" cy="5" />
                                <!-- 282.78302001953125 is auto-calculated by path.getTotalLength() -->
                                <path style="stroke:<?php echo $color ?>" class="meter"
                                    d="M5,50a45,45 0 1,0 90,0a45,45 0 1,0 -90,0" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-dashoffset="282.78302001953125"
                                    stroke-dasharray="282.78302001953125" />
                                <!-- Value automatically updates based on data-value set above -->
                                <text x="50" y="50" text-anchor="middle" dominant-baseline="central" font-size="20"></text>
                            </svg>
                        </div>
                        <div>
                            <h6>
                                <?php echo $r['name'] ?>
                            </h6>
                            <div>
                                <strong>
                                    <?php echo $r['present_count'] ?>
                                    <span style='color:gray'>
                                        /
                                        <?php echo $r['absent_count'] + $r['present_count'] ?>
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                <?php }
                ?>
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
        </div>
    </div>
    <script>


        const meters = document.querySelectorAll('svg[data-value] .meter');

        meters.forEach((path) => {

            let length = path.getTotalLength();

            let value = parseInt(path.parentNode.getAttribute('data-value'));
            // Calculate the percentage of the total length
            let to = length * ((100 - value) / 100);
            // Trigger Layout in Safari hack https://jakearchibald.com/2013/animated-line-drawing-svg/
            path.getBoundingClientRect();
            // Set the Offset
            path.style.strokeDashoffset = Math.max(0, to); path.nextElementSibling.textContent = `${value}%`;
        });




    </script>
    <script src="../js/bootstrap.bundle.min.js"></script>

</body>

</html>